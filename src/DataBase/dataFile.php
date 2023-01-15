<?php

declare(strict_types=1);

namespace App\DataBase;

use SQLite3;

class dataFile extends SQLite3
{
    public function __construct(
        private string $path
    ) {
        $this->path = APP_DIR . '/../data/' . $path;
    }

    public function openFile()
    {
        return $this->open($this->path);
    }
    public function  closeFile()
    {
        return $this->close();
    }
}
