<?php
return array(
	'DB_DSN' => 'mysql://root:111111@localhost:3306/myblog',
    'QQ_AUTH' => array(
        'APP_ID' => '1XDXXXXX', //你的QQ互联APPID
        'APP_KEY'=> '2XXXXXXXXXXXXXXXXXXXXX',
        'SCOPE' => 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol',
        'CALLBACK' => 'http://www.baidu.com/user/oauth/callback/type/qq.html',
    ),
);