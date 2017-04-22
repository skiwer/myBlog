<?php
namespace Home\Controller;
use Think\Controller;
class PostController extends Controller {
	public function index(){
		$this->display('post');
	}
	public function post(){
		if($_POST['title']&&$_POST['tag']&&$_POST['outline']&&$_POST['content']){
			$post_obj = new \Home\Model\PostModel('Post','','DB_DSN');
			$article = array();
			$article['title'] =  $_POST['title'];
			$article['tag'] =  $_POST['tag'];
			$article['outline'] =  $_POST['outline'];
			$article['content'] =  $_POST['content'];
			if($post_obj->add_article($article)){
				$this->jump('添加成功',U('Index/index'));
			}else{
				$this->jump('添加失败',U('Post/index'));
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