<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {
	public function index(){
		if(isset($_SESSION["uid"])){
			if($_SESSION["isadmin"]){
				$this->assign('nickname',$_SESSION["nickname"]);
				$this->assign('isadmin',$_SESSION["isadmin"]);
				$this->display('post');
			}
		}	
	}
	public function post(){
		if(isset($_SESSION["uid"])){
			if($_SESSION["isadmin"]){
				
				if($_POST["title"]&&$_POST['tag']&&$_POST['outline']&&$_POST['markdownContent']&&$_POST['content']){
					$post_obj = new \Home\Model\PostModel('Post','','DB_DSN');
					$article = array();
					$article['title'] =  $_POST['title'];
					$article['tag'] =  $_POST['tag'];
					$article['outline'] =  $_POST['outline'];
					$article['content'] =  $_POST['markdownContent'];
					if($post_obj->add_article($article)){
						$this->ajaxReturn(true);
					}else{
						$this->ajaxReturn(false);
					}
				}
			}
		}
		
	}

	protected function jump($msg,$url){
		echo "<script language='javascript'>
		alert(\"$msg\");
		window.location.href=\"$url\";
		</script>";
	}
}