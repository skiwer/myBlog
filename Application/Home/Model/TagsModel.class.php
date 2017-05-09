<?php
   namespace Home\Model;
   use Think\Model;
   class TagsModel extends Model{

       protected $tableName = 'tags';
       
       function getTag($id){
           if(!empty($id)){
            return $this->where('id='.$id)->getField('content');
           }
           
       }

       function findTags(){
           return $this->select();
       }
   }

?>