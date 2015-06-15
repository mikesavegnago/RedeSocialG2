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
        $target_path = getcwd() . '/public/fotos/';
        $target_path = $target_path . basename($file['name']);
        if ($file['type'] != 'image/jpg' && $file['type'] != 'image/png' && $file['type'] != 'image/jpeg')
            throw new InvalidMagicMimeFileException('O arquivo enviado não é uma imagem válida');
        $rand = uniqid();
        $origem = $target_path;
        $novo = '/fotos/' . $rand . basename($file['name']);
        move_uploaded_file($file['tmp_name'], getcwd() . '/public/' . $novo);
        return $novo;
    }
}
