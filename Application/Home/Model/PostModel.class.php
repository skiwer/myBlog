<?php
namespace Home\Model;
use Think\Model;
class PostModel extends Model {
     protected $tableName = 'article';
     
     /**
     * 获取文章概要
     * @return array 概要信息的数组
     * */
     public function add_article($article){
        if($this->add($article)){
            return true;
        }
        return false;
     }
}