<?php 
class AdminGiaodienController
{
   public $modelgiaodien;

//    public function __construct(){
//       $this->modelgiaodien = new AdminGiaodien();
//    }

   public function listBanner(){
    require_once '../views/qlgiaodien/listbaner.php';
   }
}