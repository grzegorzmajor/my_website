<?php
declare(strict_types=1);
namespace App;

use App\DataBase\dataBase;
use App\DataBase\loginDB;
class Controller {
    private View $view;
    private dataBase $dataBase;
   //private FileRepository $repository;
   


    public function __construct (
        private Request $request,        
    ) {
        $this->view = new View($this->request->action());
        $this->prtfDB = new dataBase('prtf.db');       
    }
    
    public function process():void {
        $action = $this->request->action();     

        if (!method_exists($this,$action)) { //jeżeli moteda o nazwie zapisanej w $action nie istnieje to
            $this->indx(); //wywołujemy konkretną motodę zapisaną tu.             
            exit;
        }
        $this->$action(); //wywołuje metode o nazwie  w parametrze action - czyli do wartosci z param $action dokleja () i wywołuje jako metode
                          //można w ten sposob w zmiennej przekazywac nazwy metod.
    }

    // metody obsługujące konkretne akcje. 
    private function indx():void{
        $this->view->render('indx',['aboutMeLeft'=>$this->prtfDB->getAboutMeLeft(),'aboutMeRight'=>$this->prtfDB->getAboutMeRight()]);
    }

    private function prtf():void{
        $this->view->render('prtf',['portfolio'=>$this->prtfDB->getPrtf()]);
    }
    private function myLearning():void {
        $this->view->render('myLearning');        
    }
    private function linki():void{
        header('Location: /?action=uc');
        exit;
    }
    private function addPrtf():void{
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            if ($this->request->isPost()) {
                $filesdata = $this->request->filesData();
                if ($filesdata["file"]["error"]=== UPLOAD_ERR_OK) {
                    // print_r($filesdata);
                    $tmp_name = $filesdata["file"]["tmp_name"];                                    
                    $name = $filesdata["file"]["name"];                                
                    $size = strlen($name);
                    // if ($tmp_name =="") echo 'dupa'; else echo $tmp_name;
                    $name = uniqid(more_entropy: true).$name[$size-4].$name[$size-3].$name[$size-2].$name[$size-1];
                    //echo "\n".APP_DIR . '/uploadsPrtf/'.$name;                
                    $noFile=!move_uploaded_file($tmp_name, APP_DIR . '/uploadsPrtf/'.$name);                    
                    if (!$noFile) {
                        $name="uploadsPrtf/".$name;
                    } else $name="";
                } else $name="";
                $data = $this->request->postData();
                $desc=$data["description"];
                $desc=str_replace('"','""',$desc);
                $this->prtfDB->addPrtf($data["title"],$desc,$name,$data["link"]);
                exit(header('Location: /?action=prtf'));
                // exit; 
            }               
        // $this->view->render('panel');
        }
    }
    private function updateFotoPrtf():void {
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            if ($this->request->isPost()) {
                $filesdata = $this->request->filesData();
                if ($filesdata["file"]["error"]=== UPLOAD_ERR_OK) {
                    // print_r($filesdata);
                    $tmp_name = $filesdata["file"]["tmp_name"];                                    
                    $name = $filesdata["file"]["name"];                                
                    $size = strlen($name);
                    // if ($tmp_name =="") echo 'dupa'; else echo $tmp_name;
                    $name = uniqid(more_entropy: true).$name[$size-4].$name[$size-3].$name[$size-2].$name[$size-1];
                    //echo "\n".APP_DIR . '/uploadsPrtf/'.$name;                
                    $noFile=!move_uploaded_file($tmp_name, APP_DIR . '/uploadsPrtf/'.$name);                    
                    if (!$noFile) {
                        $name="uploadsPrtf/".$name;
                    } else $name="";
                } else $name="";
                $id=$this->request->ID();                
                $this->prtfDB->updateFotoPrtf($id,$name);
                header('Location: /?action=prtf');
                exit;
            }
        }
    }
    private function updatePrtf():void {
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            if ($this->request->isPost()) {                            
                $data=$this->request->postData();
                $desc=str_replace('"','""',$data["description"]);
                $id=$this->request->ID();
                $this->prtfDB->updatePrtf($id,$data["title"],$desc,$data["link"]);
                // $this->prtfDB->addAboutMe($data["title"],$desc,$data["poz"]);
                header('Location: /?action=prtf');
                exit; 
            }               
        // $this->view->render('panel');
        }
    }

    private function addAboutMe():void{
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            if ($this->request->isPost()) {                            
                $data=$this->request->postData();
                $desc=str_replace('"','""',$data["description"]);
                $this->prtfDB->addAboutMe($data["title"],$desc,$data["poz"]);
                header('Location: /?action=indx');
                exit; 
            }               
        $this->view->render('panel');
        }
    }
    private function editPrtf():void {
        $editId = $this->request->id();
        $this->view->render('editPrtf',['title'=>$this->prtfDB->getRowTitlePrtf($editId),
                                        'descr'=>$this->prtfDB->getRowDescriptionPrtf($editId),
                                        'imagePath'=>$this->prtfDB->getRowImagePathPrtf($editId),
                                        'projPath'=>$this->prtfDB->getRowProjPathPrtf($editId)]);
    }

    private function uc():void{
        if (!isset($_SESSION)) session_start();
        $this->view->render('uc');
    }

    private function delprtf():void{        
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            $deleteId = $this->request->id();
            $this->prtfDB->delPrtf($deleteId);
            header('Location: /?action=prtf');
        }
    }
    private function delAboutMe():void{        
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            $deleteId = $this->request->id();
            $this->prtfDB->delAboutMe($deleteId);
            header('Location: /?action=indx');
        }
    }
    private function switchAboutMeToLeft():void{        
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            $Id = $this->request->id();
            $this->prtfDB->switchAboutMeToLeft($Id);
            header('Location: /?action=indx');
        }
    }
    private function switchAboutMeToRight():void{        
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            $Id = $this->request->id();
            $this->prtfDB->switchAboutMeToRight($Id);
            header('Location: /?action=indx');
        }
    }
    private function switchPrtfUp():void{
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            $Id = $this->request->id();
            $this->prtfDB->switchPrtfUp($Id);
            header('Location: /?action=prtf');
        }
        
    }
    private function switchPrtfDown():void{
        if (!isset($_SESSION)) session_start();
        if ( isset($_SESSION["login"]) ) {
            $Id = $this->request->id();
            $this->prtfDB->switchPrtfDown($Id);
            header('Location: /?action=prtf');
        }
    }
    private function login():void{
        if (!isset($_SESSION)) session_start();        
        $loginDB = new loginDB();
        if ($this->request->isPost()) {     
            $data = $this->request->postData();
            $result = $loginDB->checkLog($data["login"],$data["password"]);
            unset($loginDB);

            if ($result){                         
                $_SESSION["login"] = $data["login"];
                header('Location: /?action=login'.SID);
            } else {
                if (isset($_SESSION)) session_destroy();
                header('Location: /?action=login&error=1');                
            }
            exit;
        }  
        if ( (session_status() == PHP_SESSION_ACTIVE) && isset($_SESSION["login"]) ) {                      
            $this->view->render('panel');
            exit;
        }
        if ( !isset($_SESSION["login"]) ) {            
            $this->view->render('login',[],0);
            exit;
        } 

    }


    // pierwsze prymitywne logowanie zanim stworzylem obsługe tego w bazie
    // private function login():void{
    //     if (!isset($_SESSION)) session_start();        
    //     $password = 'kura';
    //     $user = 'user';
    //     if ($this->request->isPost()) {     
    //         $data = $this->request->postData();
    //         if ($data["login"]==$user && $data["password"]==$password ){                         
    //             $_SESSION["login"] = $user;
    //             header('Location: /?action=login'.SID);
    //         } else {
    //             if (isset($_SESSION)) session_destroy();
    //             header('Location: /?action=login&error=1');                
    //         }
    //         exit;
    //     }  
    //     if ( (session_status() == PHP_SESSION_ACTIVE) && isset($_SESSION["login"]) ) {                      
    //         $this->view->render('panel');
    //         exit;
    //     }
    //     if ( !isset($_SESSION["login"]) ) {            
    //         $this->view->render('login',[],0);
    //         exit;
    //     } 

    // }


    private function logout():void {
        if (!isset($_SESSION)) session_start();
        session_destroy();
        header('Location: /?action=login');
    }

}