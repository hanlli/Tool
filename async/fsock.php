<?php
/**
 * Created by PhpStorm.
 * User: hanli
 * Date: 2017/12/18
 * Time: 14:05
 */
ignore_user_abort(true); // 忽略客户端断开
set_time_limit(0); // 设置执行不超时
for($i=0;$i<1;$i++){
    $fp = 'D:/sock.log';
    $contents = $i."\t".date("Y-m-d H:i:s",time()).PHP_EOL;

    file_put_contents($fp,$contents,FILE_APPEND|LOCK_EX);
}