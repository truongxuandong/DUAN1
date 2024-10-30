<?php 
class Auth{
    public $isLogin;
    public $userInfor;
   public function __construct(){
    $this->isLogin=isset($_SESSION['user_info']);
    if($this->isLogin){
        $this->userInfor=$_SESSION['user_infor'];
    }
   }
}