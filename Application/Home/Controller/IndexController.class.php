<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		$outline_obj = new \Home\Model\ArticleModel('Outline','','DB_DSN');
		$articleOutlines = $outline_obj->findArticleOutlines();
		if($articleOutlines){
			$this->assign('outlines',$articleOutlines);
			$this->display('index');
		}else{
			$this->jump('mysql error',U('Index/index'));
		}
		
	}
	protected function jump($msg,$url){
		echo "<script language='javascript'>
		alert(\"$msg\");
		window.location.href=\"$url\";
		</script>";
	}
}