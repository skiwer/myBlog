<?php
    namespace Home\Model;
    use Think\Model;
    class CommentsModel extends Model {
        protected $tableName = 'comments';
        public function add_comment($uid,$nickname,$comment,$figureurl,$id){
            if(!empty($uid)&&!empty($nickname)&&!empty($figureurl)&&!empty($comment)&&!empty($id)){
                $data = array(
                    'article_id'=>$id,
                    'u_id'=>$uid,
                    'u_nickname'=>$nickname,
                    'comment'=>$comment,
                    'figure_url'=>$figureurl
                );
                $id = $this->add($data);
                $date = $this->where('id='.intval($id))->getField('date');
                return array(
                    'id'=>$id,
                    'time'=>$date
                );
            }
        }

        public function getComments($id){
            if(!empty($id)){
                return $this->where("article_id=".$id)->order("date desc")->select();
            }
        }

        public function getMainComment($id){
            if(!empty($id)){
                return $this->where("id=".$id)->field('u_id,u_nickname,figure_url')->find();
            }
        }
    }
?>