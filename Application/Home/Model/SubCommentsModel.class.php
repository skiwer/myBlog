<?php
    namespace Home\Model;
    use Think\Model;
    class SubCommentsModel extends Model {

        protected $tableName = "sub_comments";

        public function getSubComments($id){
            if(!empty($id)){
                return $this->where("common_ancestor=".$id)->select();
            }
        }

        public function getSubComment($id){
            if(!empty($id)){
                return $this->where("id=".$id)->field('common_ancestor,u_id_from,u_nickname_from,figure_from,is_from_main')->find();
            }
        }

        public function addSubComment($data){
            if(!empty($data)){
                $id = $this->add($data);
                $date = $this->where('id='.$id)->getField('date');
                return array(
                    'id'=>$id,
                    'time'=>$date
                );
            }
        }
    }
?>