<?php
    namespace Home\Controller;
    use Think\Controller;

    class TagController extends Controller{

        private $tagId;
        private $tag;

        public function show($id = 1){

            $hasTag = $this->validateTag($id);
            if(!$hasTag){
                echo "不存在的标签";
                return;
            }

            $this->tagId = $id;
            $this->tag   = $hasTag;

            if(isset($_SESSION["nickname"])){

                $nickName  = $_SESSION["nickname"];
                $figureUrl = $_SESSION["figureurl"];
                $openId    = $_SESSION["uid"];
                $isAdmin   = $_SESSION["isadmin"];

            }

            $this->displayInfo($nickName,$figureUrl,$openId,$isAdmin);
        }



        protected function validateTag($id){
            $tagObj = new \Home\Model\TagsModel('Tags','','DB_DSN');
            $tagContent = $tagObj->getTag(intval($id));
            if(empty($tagContent)){
                return false;
            }
            return $tagContent;
        }



        protected function displayInfo($nickName,$figureUrl,$uid,$isAdmin){
           
            
            $outline_obj     = new \Home\Model\ArticleModel('Article','','DB_DSN');
            $articleOutlines = $outline_obj->getArticleByTag($this->tagId);

            if( count($articleOutlines) == 0 ){
                echo "该标签暂无文章";
                return;
            }

            $tagsObj = new \Home\Model\TagsModel('Tags','','DB_DSN');
            //查找每篇文章对应的标签
            if(!empty($articleOutlines)){
                foreach($articleOutlines as $k=>$v){
                    $singleArticleTag      = $articleOutlines[$k]['tag'];
                    $singleArticleTagArray = explode(",",$singleArticleTag);
                    
                    $singleTagArray        = array();

                    foreach($singleArticleTagArray as $key => $value){
                        $singleTagArray[$value] = $tagsObj->getTag(intval($value));
                    }

                    $articleOutlines[$k]['tag'] = $singleTagArray;

                }
            }
            


            //查找所有标签
            $tagsArray = $tagsObj->findTags();


            //对每篇文章判断当前用户是否点过赞
            if(!empty($nickName)&&!empty($figureUrl)&&!empty($uid)){
                $articleLikeObj = new \Home\Model\ArticleLikeModel('ArticleLike','','DB_DSN');
                $likedIds       = $articleLikeObj->getLikedIds($uid);
                foreach($articleOutlines as $k => $v){
                    if(in_array($v["id"],$likedIds)){
                        $articleOutlines[$k]["liked"] = true;
                    }else{
                        $articleOutlines[$k]["liked"] = false;
                    }
                }
            }

            //在主页显示所有文章
            if($articleOutlines){
                $this->assign('nickname',$nickName);
                $this->assign('figure',$figureUrl);
                $this->assign('outlines',$articleOutlines);
                $this->assign('tag',$this->tag);
                $this->assign('tags',$tagsArray);
                $this->assign('isadmin',$isAdmin);
                $this->display('index');
            }else{
                $this->jump('something go in a wrong way',U('Index/index'));
            }
        }



    }
?>