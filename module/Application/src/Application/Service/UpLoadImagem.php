<?php

namespace Application\Service;

use Core\Service\Service;
use Doctrine\ORM\NoResultException;
use Zend\Validator\Exception\InvalidMagicMimeFileException;

/**
 * 
 *
 * @category Application
 * @package Service
 * @author Ana
 */
class UpLoadImagem extends Service
{

    public function uploadPhoto($file) {
        $target_path = getcwd() . '/public/temp/';
        $target_path = $target_path . basename($file['name']);
        $validator_img = new \Zend\Validator\File\IsImage(array('image/jpg', 'image/png', 'image/jpeg'));
        move_uploaded_file($file['tmp_name'], $target_path);
        if (!$validator_img->isValid($target_path))
            throw new InvalidMagicMimeFileException('O arquivo enviado não é uma imagem válida');
        $rand = uniqid();
        $origem = $target_path;
        $this->thumb($origem);
        $novo = getcwd() . '/public/temp/' . $rand;
        copy($origem, $novo);
        $image = file_get_contents($novo);
        $data = base64_encode($image);
        unlink($origem);
        unlink($novo);
        return $data;
    }
    public function getPhoto($id)
    {
        if ((int) $id <= 0)
            throw new \InvalidArgumentException('Parâmetros inválidos');
        $user = $this->getEm()->find('\Application\Entity\Usuario', (int) $id);
        if (!$user)
            throw new NoResultException('Usuário não existe');
        $base = null;
        if ($user->getPhoto() != null) {
            $stream = stream_get_contents($user->getPhoto());
            $base = base64_decode($stream);
        }
        return $base;
    }
    private function thumb($origem)
    {
        header ('Content-Type: image');
        $size =  getimagesize($origem);
        $image_p = @imagecreatetruecolor(800, 600);
        $image = imagecreatefromjpeg($origem);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 800, 600, $size[0], $size[1]);
        imagejpeg($image_p, $origem, 50);
    }

}
