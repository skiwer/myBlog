<?php
namespace Home\Model;
use Think\Model;
class ArticleLikeModel extends Model {
    protected $tableName = 'article_like';
    public function getLikedIds($uid){
        if(!empty($uid)){
            $likedIds = $this->where('uid="'.$uid.'"')->getField("article_id",true);
            return $likedIds;
        }
    }
    public function hasliked($id,$uid){
        if(!empty($id)&&!empty($uid)){
            $likedArticle = $this->where('uid="'.$uid.'" and article_id='.$id)->find();
            return $likedArticle;
        }
    }

    public function add_like($id,$nickname,$uid){
        if(!empty($id)&&!empty($nickname)&&!empty($uid)){
            $likeRecord = array(
                'u_nickname'=>$nickname,
                'article_id'=>$id,
                'uid'=>$uid
            );
            $this->add($likeRecord);
        }
    }
    public function cancel_like($id,$uid){
        if(!empty($id)&&!empty($uid)){
            $this->where('uid="'.$uid.'" and article_id='.$id)->delete();
        } 
     }
}