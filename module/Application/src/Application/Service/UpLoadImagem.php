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
    
//    public function uploadPhoto($values) {
//        $path = BASE_PROJECT . '/public/tmp/' . substr(uniqid(), -5);
//        move_uploaded_file($values['tmp_name'], $path);
//        @$foto = base64_encode(file_get_contents($path));
//        @unlink($path);
//        
//        return $foto;
//    }

   

    private function thumb($origem)
    {
        $size =  getimagesize($origem);
        $image_p = imagecreatetruecolor(160, 120);
        $image = imagecreatefromjpeg($origem);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, 160, 120, $size[0], $size[1]);
        imagejpeg($image_p, $origem, 50);
    }

}
