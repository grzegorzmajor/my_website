<?php
declare(strict_types=1);
namespace App;

class View {   
    public function __construct(
        private string $action
    ){
    }

    public function render(string $tmplt, array $dataList = []):void {
        include_once __DIR__ . "/../views/layout.php";    
    }
}