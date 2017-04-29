<?php
namespace Home\Model;
use Think\Model;
class ArticleModel extends Model {
     protected $tableName = 'article';
     
     /**
     * 获取文章概要
     * @return array 概要信息的数组
     * */
     public function findArticleOutlines(){
        $outline = $this->where('has_deleted=0')->order('date DESC')->select();
        return $outline;
     }

     public function findArticleDetail($id){
         return $this->where('has_deleted=0 AND id='.$id)->find();
     }


     public function addLikeNumber($id){
        $this->where('id='.$id)->setInc('like_number');
     }

     public function cutLikeNumber($id){
        $this->where('id='.$id)->setDec('like_number');
     }

     public function getLikeNumber($id){
         $likeNumber = $this->where("id=".$id)->getField('like_number');
         return $likeNumber;
     }


     public function addCommentNumber($id){
         if(!empty($id)){
             $this->where('id='.$id)->setInc('comment_number');
         }
     }

     public function getCommentNumber($id){
         if(!empty($id)){
             return $this->where('id='.$id)->getField('comment_number');
         }
     }

     public function addPageView($id){
         if(!empty($id)){
             $this->where('id='.intval($id))->setInc('view_number');
         }
     }

     public function getPageView($id){
         if(!empty($id)){
             return $this->where('id='.intval($id))->getField('view_number');
         }
     }
}