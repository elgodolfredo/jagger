<?php

    namespace Jagger\Model;

    class Photo extends \Illuminate\Database\Eloquent\Model
    {

        protected $fillable = array('title', 'file');
        public $timestamps  = false;



        public function uploadFile($file)
        {
            $filename = $file['name'];
            $originalQualityDir = $this->getOriginalQualityDir();
            $newFilename = $this->getRandomFilename($file['name']);
            $originalQualityFilepath = "$originalQualityDir/$newFilename";
            $this->moveFile($file['tmp_name'], $originalQualityFilepath);
            $lowQualityDir = $this->getLowQualityDir();
            $lowQualityFilepath = "$lowQualityDir/$newFilename";
            $this->createLowQualityPhoto($originalQualityFilepath, $lowQualityFilepath);
            $this->file = $originalQualityFilepath;
        }

        public function createLowQualityPhoto($filepath, $lowQualityFilepath)
        {
            $info = getimagesize($filepath);
            if ($info['mime'] == 'image/jpeg')
                $image = imagecreatefromjpeg($filepath);
            elseif ($info['mime'] == 'image/gif') 
                $image = imagecreatefromgif($filepath);
            elseif ($info['mime'] == 'image/png') 
                $image = imagecreatefrompng($filepath);
            $quality = 70;
            imagejpeg($image, $lowQualityFilepath, $quality);
        }

        public function getUrlSrc()
        {
            return $this->file;
        }

        public function getRandomFilename($file)
        {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            return uniqid() . "." . $ext;
        }

        public function getOriginalQualityDir()
        {
            return 'images/original';
        }

        public function getLowQualityDir()
        {
            return 'images/low';
        }

        public function moveFile($filename, $destination)
        {
            move_uploaded_file($filename, $destination);
        }


    }

?>