<?php
    namespace Home\Model;
    use Think\Model;
    class AdminModel extends Model {
        protected $tableName = 'admin';
        public function adminJudge($uid){
            if(!empty($uid)){
                $result = $this->where('uid="'.$uid.'"')->find();
            }
        }
    }
?>