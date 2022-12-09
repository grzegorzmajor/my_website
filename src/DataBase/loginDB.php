<?php
declare(strict_types=1);
namespace App\DataBase;

use SQLite3;

class loginDB extends SQLite3  {    
    private string $path;
    public function __construct(){
        $this->path= APP_DIR . '/../data/login.db';
        $this->open($this->path);
    }
    public function __destruct(){
        $this->close();
    }
    private function queryDB(string $login,string $pass):bool  {
        $query= "SELECT pass,enc FROM USERS WHERE login='$login';";
        $result=$this->query($query);
        $array=$result->fetchArray(SQLITE3_ASSOC);
        // print_r($result); echo "|\n";
        // print_r(gettype($result)); echo "|\n";
        
        // print_r($result->fetchArray()); echo "|\n";
        // echo "|\n";
        // print_r($array);
        if (($pass=="")) {
            return false; 
            exit;
        } else {
            if (!$array) {
                return false;
                exit;
            } else {
                if ($array['enc']==1) {
                    //tutaj jest miejsce mna hashowane hasla w przyszlosci 
                } else {
                    if (!$result) { return false; } else {
                        if ($array['pass']==$pass) return true; else return false; 
                    }
                }

            }
        }
        return false;
    }
    public function checkLog(string $user, string $pass):bool{
        // korzysta z funkcji prywatnej ktora odpytuje baze
        $result = $this->queryDB($user,$pass);
        return $result;
        // true jesli poprawne logowanie
    }
}