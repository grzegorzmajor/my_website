<?php

declare(strict_types=1);

namespace App\DataBase;

use SQLite3;
use App\DataBase\dataFile;

class loginDB extends dataFile
{
    public function __construct()
    {
        parent::__construct(APP_DIR . '/../data/login.db');
    }
    private function queryDB(string $login, string $pass): bool
    {
        $this->openFile();
        $query = "SELECT pass,enc FROM USERS WHERE login='$login';";
        $result = $this->query($query);
        $array = $result->fetchArray(SQLITE3_ASSOC);
        // print_r($result); echo "|\n";
        // print_r(gettype($result)); echo "|\n";

        // print_r($result->fetchArray()); echo "|\n";
        // echo "|\n";
        // print_r($array);
        if (($pass == "")) {
            return false;
            exit;
        } else {
            if (!$array) {
                return false;
                exit;
            } else {
                if ($array['enc'] == 1) {
                    //tutaj jest miejsce mna hashowane hasla w przyszlosci 
                } else {
                    if (!$result) {
                        return false;
                    } else {
                        if ($array['pass'] == $pass) return true;
                        else return false;
                    }
                }
            }
        }
        $this->closeFile();
        return false;
    }
    public function checkLog(string $user, string $pass): bool
    {
        // korzysta z funkcji prywatnej ktora odpytuje baze
        $this->openFile();
        $result = $this->queryDB($user, $pass);
        $this->closeFile();
        return $result;
        // true jesli poprawne logowanie
    }
}
