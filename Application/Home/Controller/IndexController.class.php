<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){

		//若请求中带有code和state参数，判断参数是否正确
		if($_GET["code"]&&$_GET["state"]){
			session_start();
			if(!isset($_SESSION["nickname"])){

				$qqLogin = new \Org\Util\Qqconnect();

				$info = $qqLogin->getUsrinfo();
				$openId = $info["id"];

				$userinfo = json_decode($info["info"],true);
				//nick name
				$nickName = $userinfo["nickname"];
				//figure url
				$figureUrl = $userinfo["figureurl_qq_2"];

				$_SESSION["uid"] = $openId;
				$_SESSION["nickname"] = $nickName;
				$_SESSION["figureurl"] = $figureUrl;

				if($this->isAdmin($openId)){
					$isAdmin = true;
				}else{
					$isAdmin = false;
				}
				$_SESSION["isadmin"] = $isAdmin;
			}else{
				$openId = $_SESSION["uid"];
				$nickName = $_SESSION["nickname"];
				$figureUrl = $_SESSION["figureurl"];
				$isAdmin = $_SESSION["isadmin"];
			}
			// return;

			// $url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=101398404&client_secret=949cf1f443597224e0e3cd77d64437ff&code=".$code."&redirect_uri=http://localhost:8080/index.php";
			// //access_token
			// $accessToken = explode("&",explode("access_token=",$this->curl_get_data($url))[1])[0];
			// $url = "https://graph.qq.com/oauth2.0/me?access_token=".$accessToken;
			// //openid
			// $userId = $this->curl_get_data($url);
			// $openId = explode('"}',explode('"openid":"',$userId)[1])[0];
			// $url = "https://graph.qq.com/user/get_user_info?access_token=".$accessToken."&oauth_consumer_key=101398404&openid=".$openId;
			// $userinfo = json_decode($this->curl_get_data($url),true);
			// //nick name
			// $nickName = $userinfo["nickname"];
			// //figure url
			// $figureUrl = $userinfo["figureurl_qq_2"];
			// setcookie("user",base64_encode($openId),time()+3600);
			// setcookie("nickname",base64_encode($nickName),time()+3600);
			// setcookie("figure",base64_encode($figureUrl),time()+3600);
		}else{
			//根据session判断用户是否已登录
			session_start();
			if(isset($_SESSION["nickname"])){
				$nickName = $_SESSION["nickname"];
				$figureUrl = $_SESSION["figureurl"];
				$openId = $_SESSION["uid"];
				$isAdmin = $_SESSION["isadmin"];
			}
		}
		$addressObj = new \Org\Util\GetAddress();
		$ip = $addressObj->GetIp();
		$addressArray = $addressObj->GetIpLookup($ip);
		$addressJson = $addressArray['country'].$addressArray['province'].$addressArray['city'];
		$userAddressObj = new \Home\Model\UserAddressModel('UserAddress','','DB_DSN');
		$userAddressObj->addUserAddress($ip,$addressJson);
		$this->show($nickName,$figureUrl,$openId,$isAdmin);
		
	}
	//显示主页内容
	protected function show($nickName,$figureUrl,$uid,$isAdmin){

		$outline_obj = new \Home\Model\ArticleModel('Article','','DB_DSN');
		$articleOutlines = $outline_obj->findArticleOutlines();
		if(!empty($nickName)&&!empty($figureUrl)&&!empty($uid)){
			$articleLikeObj = new \Home\Model\ArticleLikeModel('ArticleLike','','DB_DSN');
			$likedIds = $articleLikeObj->getLikedIds($uid);
			foreach($articleOutlines as $k => $v){
                if(in_array($v["id"],$likedIds)){
                    $articleOutlines[$k]["liked"] = true;
                }else{
                    $articleOutlines[$k]["liked"] = false;
                }
            }
		}
		if($articleOutlines){
			$this->assign('nickname',$nickName);
			$this->assign('figure',$figureUrl);
			$this->assign('outlines',$articleOutlines);
			$this->assign('isadmin',$isAdmin);
			$this->display('index');
		}else{
			$this->jump('mysql error',U('Index/index'));
		}
	}
	
	protected function isAdmin($uid){
		$adminObj = new \Home\Model\AdminModel('Admin','','DB_DSN');
		$isAdmin = $adminObj->adminJudge($uid);
		if(empty($uid)){
			return false;
		}
		return true;
	}

	public function hasloged(){
		if(isset($_SESSION['nickname'])){
			$this->ajaxReturn($_SESSION['figureurl']);
		}else{
			$this->ajaxReturn(false);
		}
	}
	//处理登录请求
	public function login(){
    	$qqLogin = new \Org\Util\Qqconnect();
    	$qqLogin->getAuthCode();
	}

	//处理登出请求
	public function logout(){
		session_start();
		if(isset($_SESSION["nickname"])){
			$_SESSION = array();
			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(), '', time()-42000, '/');
			}
			session_destroy();
		}
		$this->index();
	}

	public function like(){
		if(isset($_POST["id"])){
			$id = intval($_POST["id"]);
			session_start();
			if(isset($_SESSION["nickname"])){

				$articleLikeObj = new \Home\Model\ArticleLikeModel('ArticleLike','','DB_DSN');
				$articleObj = new  \Home\Model\ArticleModel('Article','','DB_DSN');

				$hasliked = $articleLikeObj->hasliked($id,$_SESSION["uid"]);

				if(!empty($hasliked)){

					$articleLikeObj->cancel_like($id,$_SESSION["uid"]);
					
					$articleObj->cutLikeNumber($id);
					$liked = true;
					
				}else{
					$articleLikeObj->add_like($id,$_SESSION["nickname"],$_SESSION["uid"]);

					$articleObj->addLikeNumber($id);
					$liked = false;
				}
				$likeNumber = $articleObj->getLikeNumber($id);
				$data = array(
						"loged"=>true,
						"number"=>$likeNumber,
						"liked"=>$liked
				);
				$this->ajaxReturn(json_encode($data));
			}else{
				$data = array(
					"loged"=>false
				);
				$this->ajaxReturn(json_encode($data));
			}
		}
	}
	//用于发生错误时的页面跳转
	protected function jump($msg,$url){
		echo "<script language='javascript'>
		alert(\"$msg\");
		window.location.href=\"$url\";
		</script>";
	}

	//使用curl获取返回数据
	protected function curl_get_data($url){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$output = curl_exec($ch);
		curl_close();
		return $output;
	} 
}