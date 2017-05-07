<?php
namespace Org\Util;
class GetAddress{
    public function GetIp(){  
           
      $unknown = 'unknown';
      if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
         $ip = $_SERVER['REMOTE_ADDR'];
      }
      /**
       * 处理多层代理的情况
       * 或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
       */
      if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip));
      return $ip;
   

    }
    public function GetIpLookup($ip = ''){  
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
        if(empty($res)){ return false; }  
        $jsonMatches = array();  
        preg_match('#\{.+?\}#', $res, $jsonMatches);  
        if(!isset($jsonMatches[0])){ return false; }  
        $json = json_decode($jsonMatches[0], true);  
        if(isset($json['ret']) && $json['ret'] == 1){  
            $json['ip'] = $ip;  
            unset($json['ret']);  
        }else{  
            return false;  
        }  
        return $json;  
    }
}
?>
