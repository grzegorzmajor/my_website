<?php

declare(strict_types=1);

namespace App\DataBase;


use App\DataBase\dataFile;


class dataBase extends dataFile
{
    public function __construct(
        private string $path
    ) {
        parent::__construct($path);
    }
    //------------------------------------------------------------------------------------------------------------------
    //  ABOUT ME
    //------------------------------------------------------------------------------------------------------------------

    public function createTableAboutMe()
    {
        $this->openFile();
        $sqlCreate = "CREATE TABLE IF NOT EXISTS ABOUTME (Id INTEGER PRIMARY KEY AUTOINCREMENT, Title TEXT NOT NULL, Descr TEXT NOT NULL, Poz INTEGER NOT NULL); ";
        $this->exec($sqlCreate);
        $this->closeFile();
    }
    public function addAboutMe($title, $descr, $poz): void
    {
        $this->openFile();
        $this->createTableAboutMe();
        $sqlInsert = 'INSERT INTO ABOUTME (Title,Descr,Poz) VALUES ("' . $title . '","' . $descr . '","' . $poz . '");';
        // echo $sqlInsert;
        $ret = $this->query($sqlInsert);
        $this->closeFile();
    }
    public function updateAboutMe($id, $title, $descr, $poz): void
    {
        $this->openFile();
        $sqlInsert = 'UPDATE ABOUTME SET Title = ' . "'" . $title . "'" . ',Descr = ' . "'" . $descr . "'" . ',Poz = ' . "'" . $poz . "' WHERE Id = $id ;";
        print_r($sqlInsert);
        $this->query($sqlInsert);
        $this->closeFile();
    }

    public function delAboutMe($id): void
    {
        $this->openFile();
        $sqlDelete = "DELETE FROM ABOUTME WHERE Id=" . $id . ";";
        $this->query($sqlDelete);
        $this->closeFile();
    }
    public function getRowTitleAboutMe($id): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT Title FROM ABOUTME WHERE Id=$id;");
        $row = $ret->fetchArray(SQLITE3_ASSOC);

        $this->closeFile();
        return $row['Title'];
    }
    public function getRowDescriptionAboutMe($id): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT Descr FROM ABOUTME WHERE Id=$id;");
        $row = $ret->fetchArray(SQLITE3_ASSOC);

        $this->closeFile();
        return $row['Descr'];
    }
    public function getRowPozAboutMe($id): int
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT Poz FROM ABOUTME WHERE Id=$id;");
        $row = $ret->fetchArray(SQLITE3_ASSOC);

        $this->closeFile();
        return $row['Poz'];
    }

    public function getAboutMeLeft(): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT * FROM ABOUTME;");


        $kod = '';
        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            if ($row['Poz'] == "0") {
                $kod = $kod . '<article class="aboutMeLeft">' . "\n";
                $kod = $kod . '<h2>' . $row['Title'];
                if (isset($_SESSION["login"])) {
                    $kod = $kod . "<a href=" . '"/?action=delAboutMe&id=' . $row['Id'] . '"' . 'class="aboutMe-action"><span class="material-symbols-outlined" alt="USUŃ">delete_forever</span></a>';
                    $kod = $kod . "<a href=" . '"/?action=switchAboutMeToRight&id=' . $row['Id'] . '"' . 'class="aboutMe-action"> <span class="material-symbols-outlined">chevron_right</span></a>';
                    $kod = $kod . "<a href=" . '"/?action=editAboutMe&id=' . $row['Id'] . '"' . 'class="aboutMe-action"><span class="material-symbols-outlined">edit_square</span></a>';
                }
                $kod = $kod . '</h2><div class="aboutMe-div">' . "\n";
                $kod = $kod . '<p class="aboutMe-p">' . "\n";
                // str_replace('""','"',$row['Descr']);  
                $kod = $kod . str_replace('""', '"', $row['Descr']) . "</p></div>\n";
                $kod = $kod . "</article>\n";
            }
        }

        $this->closeFile();
        return $kod;
    }
    public function getAboutMeRight(): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT * FROM ABOUTME;");


        $kod = '';
        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            if ($row['Poz'] == "1") {
                $kod = $kod . '<article class="aboutMeRight">' . "\n";
                $kod = $kod . '<h2>' . $row['Title'];
                if (isset($_SESSION["login"])) {
                    $kod = $kod . "<a href=" . '"/?action=delAboutMe&id=' . $row['Id'] . '"' . 'class="aboutMe-action"><span class="material-symbols-outlined">delete_forever</span></a>';
                    $kod = $kod . "<a href=" . '"/?action=switchAboutMeToLeft&id=' . $row['Id'] . '"' . 'class="aboutMe-action"> <span class="material-symbols-outlined">chevron_left</span></a>';
                    $kod = $kod . "<a href=" . '"/?action=editAboutMe&id=' . $row['Id'] . '"' . 'class="aboutMe-action"><span class="material-symbols-outlined">edit_square</span></a>';
                }
                $kod = $kod . '</h2><div class="aboutMe-div">' . "\n";
                $kod = $kod . '<p class="aboutMe-p">' . "\n";
                // str_replace('""','"',$row['Descr']);  
                $kod = $kod . str_replace('""', '"', $row['Descr']) . "</p></div>\n";
                $kod = $kod . "</article>\n";
            }
        }
        $this->closeFile();
        return $kod;
    }
    public function switchAboutMeToLeft($id)
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $sqlUpdate = "UPDATE ABOUTME SET Poz = '0' WHERE Id = $id;";
        $this->query($sqlUpdate);
        $this->closeFile();
    }
    public function switchAboutMeToRight($id)
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $sqlUpdate = "UPDATE ABOUTME SET Poz = '1' WHERE Id = $id;";
        $this->query($sqlUpdate);
        $this->closeFile();
    }

    //------------------------------------------------------------------------------------------------------------------
    //  PORTFOLIO
    //------------------------------------------------------------------------------------------------------------------


    public function getRowTitlePrtf($id): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT Title FROM PORTFOLIO WHERE Id=$id;");
        $row = $ret->fetchArray(SQLITE3_ASSOC);

        $this->closeFile();
        return $row['Title'];
    }
    public function getRowDescriptionPrtf($id): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT Descr FROM PORTFOLIO WHERE Id=$id;");
        $row = $ret->fetchArray(SQLITE3_ASSOC);

        $this->closeFile();
        return $row['Descr'];
    }
    public function getRowProjPathPrtf($id): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT ProjPath FROM PORTFOLIO WHERE Id=$id;");
        $row = $ret->fetchArray(SQLITE3_ASSOC);

        $this->closeFile();
        return $row['ProjPath'];
    }
    public function getRowImagePathPrtf($id): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT ImagePath FROM PORTFOLIO WHERE Id=$id;");
        $row = $ret->fetchArray(SQLITE3_ASSOC);

        $this->closeFile();
        return $row['ImagePath'];
    }

    public function switchPrtfUp($id)
    {
        $this->openFile();
        if ($id > 0) {
            $id2 = $id + 1;
            if (!isset($_SESSION)) session_start();
            $this->query("UPDATE PORTFOLIO SET Id = " . '"' . "-1" . '"' . " WHERE Id = $id ;");
            $this->query("UPDATE PORTFOLIO SET Id = " . '"' . "-2" . '"' . " WHERE Id = $id2 ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id2 WHERE Id = " . '"' . "-1" . '"' . " ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id WHERE Id =  " . '"' . "-2" . '"' . " ;");
        }

        $this->closeFile();
    }
    public function switchPrtfDown($id)
    {
        $this->openFile();
        if ($id > 1) {
            $id2 = $id - 1;
            if (!isset($_SESSION)) session_start();
            $this->query("UPDATE PORTFOLIO SET Id = " . '"' . "-1" . '"' . " WHERE Id = $id ;");
            $this->query("UPDATE PORTFOLIO SET Id = " . '"' . "-2" . '"' . " WHERE Id = $id2 ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id2 WHERE Id = " . '"' . "-1" . '"' . " ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id WHERE Id =  " . '"' . "-2" . '"' . " ;");
        }

        $this->closeFile();
    }

    public function createTablePrtf()
    {
        $this->openFile();
        $sqlCreate = "CREATE TABLE IF NOT EXISTS PORTFOLIO (Id INTEGER PRIMARY KEY AUTOINCREMENT, Title TEXT NOT NULL, Descr TEXT NOT NULL, ImagePath TEXT NOT NULL, ProjPath TEXT NOT NULL); ";
        $this->exec($sqlCreate);
        $this->closeFile();
    }

    public function getPrtf(): string
    {
        $this->openFile();
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT * FROM PORTFOLIO;");


        $kod = '';
        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $kod = $kod . '<article class="article">' . "\n";
            $kod = $kod . '<h2>' . $row['Title'];
            if (isset($_SESSION["login"])) {
                $kod = $kod . "<a href=" . '"/?action=delPrtf&id=' . $row['Id'] . '"' . 'class="article-action"><span class="material-symbols-outlined">delete_forever</span></a>';
                $kod = $kod . "<a href=" . '"/?action=switchPrtfUp&id=' . $row['Id'] . '"' . 'class="article-action"><span class="material-symbols-outlined">arrow_drop_down</span></a>';
                $kod = $kod . "<a href=" . '"/?action=switchPrtfDown&id=' . $row['Id'] . '"' . 'class="article-action"><span class="material-symbols-outlined">arrow_drop_up</span></a>';
                $kod = $kod . "<a href=" . '"/?action=editPrtf&id=' . $row['Id'] . '"' . 'class="article-action"><span class="material-symbols-outlined">edit_square</span></a>';
            }
            $kod = $kod . '</h2><div class="article-div">' . "\n";
            if ($row['ImagePath'] != "") $kod = $kod . '<img class="article-image" src="' . $row['ImagePath'] . '" alt="">';
            $kod = $kod . '<p class="article-p">' . "\n";
            // str_replace('""','"',$row['Descr']);            
            $kod = $kod . str_replace('""', '"', $row['Descr']) . "</p>";
            if ($row['ProjPath'] != "") $kod = $kod . "<a href=" . '"' . $row['ProjPath'] . '"' . ">" . $row['ProjPath'] . "</a>";
            $kod = $kod . "</div>\n";
            //$row['ProjPath'] - ew adres do projektu 
            $kod = $kod . "</article>\n";
        }
        $this->closeFile();
        return $kod;
    }
    public function updateFotoPrtf($id, $fotoPath): void
    {
        $this->openFile();
        $sqlPath = "SELECT ImagePath FROM PORTFOLIO WHERE Id=" . $id . ";";
        $path = $this->query($sqlPath);
        $array = $path->fetchArray(SQLITE3_ASSOC);
        //print_r($array['ImagePath']);
        if ($array['ImagePath'] != "") unlink($array['ImagePath']);
        $sqlInsert = 'UPDATE PORTFOLIO SET ImagePath = ' . '"' . $fotoPath . '"' . " WHERE Id = $id ;";
        // print_r($sqlInsert);
        $this->query($sqlInsert);
        $this->closeFile();
    }
    public function updatePrtf($id, $title, $descr, $projPath): void
    {
        $this->openFile();
        $sqlInsert = 'UPDATE PORTFOLIO SET Title = ' . "'" . $title . "'" . ',Descr = ' . "'" . $descr . "'" . ',ProjPath = ' . "'" . $projPath . "' WHERE Id = $id ;";
        // print_r($sqlInsert);
        $this->query($sqlInsert);
        $this->closeFile();
    }
    public function addPrtf($title, $descr, $imagePath, $projPath): void
    {
        $this->openFile();
        $this->createTablePrtf();
        $sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("' . $title . '","' . $descr . '","' . $imagePath . '","' . $projPath . '");';
        $ret = $this->query($sqlInsert);
        $this->closeFile();
    }

    public function delPrtf($id): void
    {
        $this->openFile();
        $sqlPath = "SELECT ImagePath FROM PORTFOLIO WHERE Id=" . $id . ";";
        $path = $this->query($sqlPath);
        $array = $path->fetchArray(SQLITE3_ASSOC);
        //print_r($array['ImagePath']);
        if ($array['ImagePath'] != "") unlink($array['ImagePath']);
        $sqlDelete = "DELETE FROM PORTFOLIO WHERE Id=" . $id . ";";
        $this->query($sqlDelete);
        $this->closeFile();
    }
}
//------------- pomoc dla autora tego cuda ;)
// obsługa wszystkich błędów:
   //$db = new MyDB();
   //if(!$db) {
   //   echo $db->lastErrorMsg();
   //} else {
   //   echo "Opened database successfully\n";
   //}