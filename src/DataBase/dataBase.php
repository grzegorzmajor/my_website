<?php
declare(strict_types=1);
namespace App\DataBase;

use SQLite3;

class dataBase extends SQLite3  {    
    public function __construct(
        private string $path
    ){
        $this->path= APP_DIR . '/../data/'.$this->path;
        $this->open($this->path);
    }
    public function __destruct(){
        $this->close();
    }
//------------------------------------------------------------------------------------------------------------------
//  ABOUT ME
//------------------------------------------------------------------------------------------------------------------

    public function createTableAboutMe(){
        $sqlCreate = "CREATE TABLE IF NOT EXISTS ABOUTME (Id INTEGER PRIMARY KEY AUTOINCREMENT, Title TEXT NOT NULL, Descr TEXT NOT NULL, Poz INTEGER NOT NULL); ";
        $this->exec($sqlCreate);
    }
    public function addAboutMe($title, $descr, $poz):void{
        $this->createTableAboutMe();
        $sqlInsert = 'INSERT INTO ABOUTME (Title,Descr,Poz) VALUES ("'.$title.'","'.$descr.'","'.$poz.'");';                                            
        // echo $sqlInsert;
        $ret = $this->query($sqlInsert);
    }
    public function delAboutMe($id):void{
        $sqlDelete = "DELETE FROM ABOUTME WHERE Id=".$id.";";
        $this->query($sqlDelete);
    }
    
    public function getAboutMeLeft():string {
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT * FROM ABOUTME;");
        $kod ='';
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
            if ($row['Poz']=="0") {
                $kod=$kod.'<article class="aboutMeLeft">'."\n";            
                $kod=$kod.'<h2>'.$row['Title'];
                if ( isset($_SESSION["login"]) ) {
                    $kod=$kod."<a href=".'"/?action=delAboutMe&id='.$row['Id'].'"'.'class="aboutMe-action"><span class="material-symbols-outlined" alt="USUŃ">delete_forever</span></a>';
                    $kod=$kod."<a href=".'"/?action=switchAboutMeToRight&id='.$row['Id'].'"'.'class="aboutMe-action"> <span class="material-symbols-outlined">chevron_right</span></a>';
                    $kod=$kod."<a href=".'"/?action=editAboutMe&id='.$row['Id'].'"'.'class="aboutMe-action"><span class="material-symbols-outlined">edit_square</span></a>';
                }
                $kod=$kod.'</h2><div class="aboutMe-div">'."\n";
                $kod=$kod.'<p class="aboutMe-p">'."\n";
                str_replace('""','"',$row['Descr']);  
                $kod=$kod.$row['Descr']."</p></div>\n";
                $kod=$kod."</article>\n";
            }
        }
        return $kod;
    }
    public function getAboutMeRight():string{
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT * FROM ABOUTME;");
        $kod ='';
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {           
            if ($row['Poz']=="1") {
                $kod=$kod.'<article class="aboutMeRight">'."\n";
                $kod=$kod.'<h2>'.$row['Title'];
                if ( isset($_SESSION["login"]) ) {
                    $kod=$kod."<a href=".'"/?action=delAboutMe&id='.$row['Id'].'"'.'class="aboutMe-action"><span class="material-symbols-outlined">delete_forever</span></a>';
                    $kod=$kod."<a href=".'"/?action=switchAboutMeToLeft&id='.$row['Id'].'"'.'class="aboutMe-action"> <span class="material-symbols-outlined">chevron_left</span></a>';
                    $kod=$kod."<a href=".'"/?action=editAboutMe&id='.$row['Id'].'"'.'class="aboutMe-action"><span class="material-symbols-outlined">edit_square</span></a>';
                }
                $kod=$kod.'</h2><div class="aboutMe-div">'."\n";
                $kod=$kod.'<p class="aboutMe-p">'."\n";
                str_replace('""','"',$row['Descr']);  
                $kod=$kod.$row['Descr']."</p></div>\n";
                $kod=$kod."</article>\n";
            }
        }
        return $kod;
    }
    public function switchAboutMeToLeft($id) {
        if (!isset($_SESSION)) session_start();
        $sqlUpdate="UPDATE ABOUTME SET Poz = '0' WHERE Id = $id;";
        $this->query($sqlUpdate);
    }
    public function switchAboutMeToRight($id) {
        if (!isset($_SESSION)) session_start();
        $sqlUpdate="UPDATE ABOUTME SET Poz = '1' WHERE Id = $id;";
        $this->query($sqlUpdate);
    }

//------------------------------------------------------------------------------------------------------------------
//  PORTFOLIO
//------------------------------------------------------------------------------------------------------------------


    public function getRowTitlePrtf($id):string {
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT Title FROM PORTFOLIO WHERE Id=$id;");
        $row=$ret->fetchArray(SQLITE3_ASSOC);
        return $row['Title'];
    }
    public function getRowDescriptionPrtf($id):string {
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT Descr FROM PORTFOLIO WHERE Id=$id;");
        $row=$ret->fetchArray(SQLITE3_ASSOC);
        return $row['Descr'];
    }
    public function getRowProjPathPrtf($id):string {
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT ProjPath FROM PORTFOLIO WHERE Id=$id;");
        $row=$ret->fetchArray(SQLITE3_ASSOC);
        return $row['ProjPath'];
    }
    public function getRowImagePathPrtf($id):string {
        if (!isset($_SESSION)) session_start();
        //$sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");'; 
        $ret = $this->query("SELECT ImagePath FROM PORTFOLIO WHERE Id=$id;");
        $row=$ret->fetchArray(SQLITE3_ASSOC);
        return $row['ImagePath'];
    }

    public function switchPrtfUp($id) {
        if ($id>0) {
            $id2=$id+1;
            if (!isset($_SESSION)) session_start();            
            $this->query("UPDATE PORTFOLIO SET Id = ".'"'."-1".'"'." WHERE Id = $id ;");
            $this->query("UPDATE PORTFOLIO SET Id = ".'"'."-2".'"'." WHERE Id = $id2 ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id2 WHERE Id = ".'"'."-1".'"'." ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id WHERE Id =  ".'"'."-2".'"'." ;");
        }
    }
    public function switchPrtfDown($id) {
        if ($id>1) {
            $id2=$id-1;
            if (!isset($_SESSION)) session_start();            
            $this->query("UPDATE PORTFOLIO SET Id = ".'"'."-1".'"'." WHERE Id = $id ;");
            $this->query("UPDATE PORTFOLIO SET Id = ".'"'."-2".'"'." WHERE Id = $id2 ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id2 WHERE Id = ".'"'."-1".'"'." ;");
            $this->query("UPDATE PORTFOLIO SET Id = $id WHERE Id =  ".'"'."-2".'"'." ;");
        }
    }

    public function createTablePrtf(){
        $sqlCreate = "CREATE TABLE IF NOT EXISTS PORTFOLIO (Id INTEGER PRIMARY KEY AUTOINCREMENT, Title TEXT NOT NULL, Descr TEXT NOT NULL, ImagePath TEXT NOT NULL, ProjPath TEXT NOT NULL); ";
        $this->exec($sqlCreate);
    }

    public function getPrtf():string{
        if (!isset($_SESSION)) session_start();
        $ret = $this->query("SELECT * FROM PORTFOLIO;");
        $kod ='';
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
            $kod=$kod.'<article class="article">'."\n";
            $kod=$kod.'<h2>'.$row['Title'];
            if ( isset($_SESSION["login"]) ) {
                $kod=$kod."<a href=".'"/?action=delPrtf&id='.$row['Id'].'"'.'class="article-action"><span class="material-symbols-outlined">delete_forever</span></a>';
                $kod=$kod."<a href=".'"/?action=switchPrtfUp&id='.$row['Id'].'"'.'class="article-action"><span class="material-symbols-outlined">arrow_drop_down</span></a>';
                $kod=$kod."<a href=".'"/?action=switchPrtfDown&id='.$row['Id'].'"'.'class="article-action"><span class="material-symbols-outlined">arrow_drop_up</span></a>';
                $kod=$kod."<a href=".'"/?action=editPrtf&id='.$row['Id'].'"'.'class="article-action"><span class="material-symbols-outlined">edit_square</span></a>';
            }
            $kod=$kod.'</h2><div class="article-div">'."\n";
            if ($row['ImagePath']!="") $kod=$kod.'<img class="article-image" src="'.$row['ImagePath'].'" alt="">';
            $kod=$kod.'<p class="article-p">'."\n";
            str_replace('""','"',$row['Descr']);            
            $kod=$kod.$row['Descr']."</p>";
            if ($row['ProjPath']!="") $kod=$kod."<a href=".'"'.$row['ProjPath'].'"'.">".$row['ProjPath']."</a>";
            $kod=$kod."</div>\n";
            //$row['ProjPath'] - ew adres do projektu 
            $kod=$kod."</article>\n";
        }
        return $kod;
    }
    public function updateFotoPrtf($id, $fotoPath):void{
        $sqlPath = "SELECT ImagePath FROM PORTFOLIO WHERE Id=".$id.";";
        $path = $this->query($sqlPath);
        $array = $path->fetchArray();
        //print_r($array['ImagePath']);
        if ($array['ImagePath']!="") unlink($array['ImagePath']);        
        $sqlInsert = 'UPDATE PORTFOLIO SET ImagePath = '.'"'.$fotoPath.'"'." WHERE Id = $id ;";
        // print_r($sqlInsert);
        $this->query($sqlInsert);
    }
    public function updatePrtf($id, $title, $descr, $projPath):void{
        $sqlInsert = 'UPDATE PORTFOLIO SET Title = '."'".$title."'".',Descr = '."'".$descr."'".',ProjPath = '."'".$projPath."' WHERE Id = $id ;";
        // print_r($sqlInsert);
        $this->query($sqlInsert);
    }
    public function addPrtf($title, $descr, $imagePath, $projPath):void{
        $this->createTablePrtf();      
        $sqlInsert = 'INSERT INTO PORTFOLIO (Title,Descr,ImagePath,ProjPath) VALUES ("'.$title.'","'.$descr.'","'.$imagePath.'","'.$projPath.'");';                                            
        $ret = $this->query($sqlInsert);
    }

    public function delPrtf($id):void{
        $sqlPath = "SELECT ImagePath FROM PORTFOLIO WHERE Id=".$id.";";
        $path = $this->query($sqlPath);
        $array = $path->fetchArray();
        //print_r($array['ImagePath']);
        if ($array['ImagePath']!="") unlink($array['ImagePath']);
        $sqlDelete = "DELETE FROM PORTFOLIO WHERE Id=".$id.";";
        $this->query($sqlDelete);
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