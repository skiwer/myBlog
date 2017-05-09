<?php
namespace Home\Controller;
use Think\Controller;
class ShowArticleController extends Controller {
	public function show($id = 1){
		$id = intval($id);
		$showDetailObj = new \Home\Model\ArticleModel('Article','','DB_DSN');
		$articleDetail = $showDetailObj->findArticleDetail($id);

		$tagIdArr = explode(',',$articleDetail['tag']);
		$tagsObj = new \Home\Model\TagsModel('Tags','','DB_DSN');

		$tagArr = array();
		foreach($tagIdArr as $k => $v){
			$tagArr[$v] = $tagsObj->getTag(intval($v));
		}
		$articleDetail['tag'] = $tagArr;
		
		$commentObj = new \Home\Model\CommentsModel('Comments','','DB_DSN');
		$comments = $commentObj->getComments($id);
		$subCommentObj = new \Home\Model\SubCommentsModel('SubComments','','DB_DSN');
		foreach($comments as $k => $v){
			$subComments = $subCommentObj->getSubComments(intval($v["id"]));
			$comments[$k]["subComments"] = $subComments;
		}

		if($articleDetail){
			if(isset($_SESSION["nickname"])&&isset($_SESSION["figureurl"])){
				$nickName = $_SESSION["nickname"];
				$figureUrl = $_SESSION["figureurl"];
			}
			
			if($_SESSION["isadmin"]){
				$isAdmin = $_SESSION["isadmin"];
			}
			$this->assign('isadmin',$isAdmin);

			$this->assign('nickname',$nickName);
			$this->assign('figure',$figureUrl);
			$this->assign("detail",$articleDetail);
			$this->assign("comments",$comments);
			$this->display("show");
		}else{
			$this->jump('mysql error',U('Index/index'));
		}
	}

	//主评论
	public function maincomment(){
		if(isset($_SESSION["nickname"])){
			$nickname = $_SESSION["nickname"];
			$uid = $_SESSION["uid"];
			
			if($_POST["comment"]&&$_POST["id"]){
				$comment = strip_tags(htmlspecialchars($_POST['comment']));
				$id = intval($_POST["id"]);

				$commentObj = new \Home\Model\CommentsModel('Comments','','DB_DSN');
				$figureurl = $_SESSION['figureurl'];
				$insertCommentData = $commentObj->add_comment($uid,$nickname,$comment,$figureurl,$id);
				$time = $insertCommentData["time"];
				$insertId = $insertCommentData["id"];

				$sequence = $commentObj->getMainCommentNumber($id);

				$articleObj = new \Home\Model\ArticleModel('Article','','DB_DSN');
				$articleObj->addCommentNumber($id);
				$number = $articleObj->getCommentNumber($id);
				
				$data = array(
					'isOk'=>true,
					'figureurl'=>$figureurl,
					'nickname'=>$nickname,
					'time'=>$time,
					'comment'=>$comment,
					'number'=>$number,
					'seq'=>$sequence,
					'id'=>$insertId
				);
			}
		}else{
			$data = array(
				'isOk'=>false
			);
		}
		$this->ajaxReturn(json_encode($data));
	}


	//subcomment
	public function subcomment(){
		if(isset($_SESSION["nickname"])){
			$nickname = $_SESSION["nickname"];
			$uid = $_SESSION["uid"];
			$figureurl = $_SESSION["figureurl"];
			if($_POST["comment"]&&$_POST["id"]&&$_POST["articleid"]){

				$id = $_POST["id"];
				$articleId = $_POST["articleid"];
				$comment = strip_tags(htmlspecialchars($_POST['comment']));;
				$subCommentObj = new \Home\Model\SubCommentsModel('SubComments','','DB_DSN');
				//回复主评论
				if(strpos($id,"from") === false){
					$commentObj = new \Home\Model\CommentsModel('Comments','','DB_DSN');
					$mainId = intval(explode('-',$id)[1]);
					$mainCommentData = $commentObj->getMainComment($mainId);
					$insertSubComment = array(
						'is_from_main'=>1,
						'common_ancestor'=>$mainId,
						'parent_id'=>$mainId,
						'u_id_from'=>$uid,
						'u_id_to'=>$mainCommentData["u_id"],
						'u_nickname_from'=>$nickname,
						'u_nickname_to'=>$mainCommentData["u_nickname"],
						'figure_from'=>$figureurl,
						'figure_to'=>$mainCommentData["figure_url"],
						'comment'=>$comment
					);
				}else{
					$subId = intval(explode('-',$id)[1]);
					$subCommentData = $subCommentObj->getSubComment($subId);
					$insertSubComment = array(
						'is_from_main'=>0,
						'parent_id'=>$subId,
						'common_ancestor'=>$subCommentData['common_ancestor'],
						'u_id_from'=>$uid,
						'u_id_to'=>$subCommentData["u_id_from"],
						'u_nickname_from'=>$nickname,
						'u_nickname_to'=>$subCommentData["u_nickname_from"],
						'figure_from'=>$figureurl,
						'figure_to'=>$subCommentData["figure_from"],
						'comment'=>$comment
					);
				}
				$data = $subCommentObj->addSubComment($insertSubComment);

				$time = $data["time"];
				$insertId = $data["id"];

				
				$articleObj = new \Home\Model\ArticleModel('Article','','DB_DSN');
				$articleObj->addCommentNumber($articleId);
				$number = $articleObj->getCommentNumber($articleId);
				$status = true;
				$returnData = array(
					'isOk'=>true,
					'u_nickname_from'=>$nickname,
					'u_nickname_to'=>$insertSubComment["u_nickname_to"],
					'figure_from'=>$figureurl,
					'figure_to'=>$insertSubComment["figure_to"],
					'time'=>$time,
					'comment'=>$comment,
					'number'=>$number,
					'id'=>$insertId,
					'is_from_main'=>$insertSubComment["is_from_main"]
				);
			}
		}else{
			$returnData = array(
				'isOk'=>false
			);
		}
		$this->ajaxReturn(json_encode($returnData));
	}
	
	public function addpageview(){
		if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$articleObj = new \Home\Model\ArticleModel('Article','','DB_DSN');
			$articleObj->addPageView($id);
			$viewNumber = $articleObj->getPageView($id);
			$returnData = array(
				"isOk" => true,
				'viewNumber' => $viewNumber
			);
		}else{
			$returnData = array(
				"isOk" => false
			);
		}
		$this->ajaxReturn(json_encode($returnData));
	}

	protected function jump($msg,$url){
		echo "<script language='javascript'>
		alert(\"$msg\");
		window.location.href=\"$url\";
		</script>";
	}
}