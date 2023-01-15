<?php

declare(strict_types=1);

namespace App\DataBase;

use App\DataBase\dataFile;

class loginDB extends dataFile
{
    public function __construct()
    {
        parent::__construct('login.db');
    }

    private function checkPass(string $pass, array $arrayDB)
    {
        if ($arrayDB['enc'] == 1) {
            //tutaj jest miejsce mna hashowane hasla w przyszlosci 
        } else {
            if ($arrayDB['pass'] == $pass) return true;
            else return false;
        }
        return false;
    }

    private function queryDB(string $login, string $pass): bool
    {
        if ($login == '' || $pass == '') return false;

        $this->openFile();
        $query = "SELECT pass,enc FROM USERS WHERE login='$login';";
        $result = $this->query($query);
        if (!$result) {
            $this->closeFile();
            return false;
        } else {
            $array = $result->fetchArray(SQLITE3_ASSOC);
            $this->closeFile();
            return $this->checkPass($pass, $array);
        }
        $this->closeFile();
        return false;
    }

    public function checkLog(string $user, string $pass): bool
    {
        $result = $this->queryDB($user, $pass);
        return $result;
    }
}
