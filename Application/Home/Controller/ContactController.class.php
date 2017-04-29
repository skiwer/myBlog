<?php
namespace Home\Controller;
use Think\Controller;
class ContactController extends Controller {
	public function index(){
		if(isset($_SESSION["nickname"])&&isset($_SESSION["figureurl"])){
				$nickName = $_SESSION["nickname"];
				$figureUrl = $_SESSION["figureurl"];
		}
		if($_SESSION["isadmin"]){
			$isAdmin = $_SESSION["isadmin"];
		}
		$this->assign('nickname',$nickName);
		$this->assign('figure',$figureUrl);
		$this->assign('isadmin',$isAdmin);
		$this->display('contact');
	}
}