<?php
   namespace Home\Model;
   use Think\Model;
   class UserAddressModel extends Model{
       public function addUserAddress($ip,$address){
           $data = array(
               'ip'=>$ip,
               'address_json'=>$address
           );
           $this->add($data);
       }
   }
?>  