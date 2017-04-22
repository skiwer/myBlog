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
         return $this->where('has_deleted=0')->order('date DESC')->select();
     }

     public function findArticleDetail($id){
         return $this->where('has_deleted=0 AND id='.$id)->find();
     }
}