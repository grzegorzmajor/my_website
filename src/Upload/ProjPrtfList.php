<?php
declare(strict_types=1);
namespace App\Upload;

class ProjPrtfList {
    public function __construct(
        private array $projects = []        
    ){}

    public function addProj(ProjPrtf $proj):void {
        $this->projects[]=$proj;        
    }

    public function projects():array {
        return $this->projects;
    }

    public function remove(string $projectTitle){
        $count=count($this->projects);
        for ($i=0;$i<$count;$i++){            
            if ($this->projects[$i]->title() === $projectTitle) {
                unset($this->projects[$i]);                                
                break;
            }
        }
        $this->projects = array_values($this->projects);
    }

}