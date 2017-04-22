<?php
namespace Home\Controller;
use Think\Controller;
class ShowArticleController extends Controller {
	public function show($id = 1){
		$showDetailObj = new \Home\Model\ArticleModel('Outline','','DB_DSN');
		$articleDetail = $showDetailObj->findArticleDetail($id);
		if($articleDetail){
			$this->assign("detail",$articleDetail);
			$this->display("show");
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