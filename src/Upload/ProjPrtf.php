<?php
declare(strict_types=1);
namespace App\Upload;

class ProjPrtf {
    public function __construct(
        private string $title,
        private string $description,
        private string $path
    ){}  

    public function title():string {
        
        return $this->title;
    }
    public function description():string {
        
        return $this->description;
    }
    public function path():string {
        
        return $this->path;
    }

}


