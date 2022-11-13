<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader  {
    private $file_dir;
    public function __construct($file_dir)
    {
         $this->file_dir=$file_dir;
    }

    public function uploading(UploadedFile $file){
       
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getstore(),$filename);
             return $filename;
    }

    private function getstore(){
      return  $this->file_dir;
    }


}

