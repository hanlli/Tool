<?php
/**
 * Created by PhpStorm.
 * User: eesee
 * des:异步执行类
 * Date: 2017/12/28
 * Time: 14:29
 */
class Async{
    function fputs_requst($url, $param=array(),$timeout =10){
        $urlParmas = parse_url($url);
        $host = $urlParmas['host'];
        $path = $urlParmas['path'];
        $port = isset($urlParmas['port'])? $urlParmas['port'] :80;
        $errno = 0;
        $errstr = '';

        $fp = fsockopen($host, $port, $errno, $errstr, $timeout);
        $query = isset($param)? http_build_query($param) : '';
        $out = "POST ".$path." HTTP/1.1\r\n";
        $out .= "host:".$host."\r\n";
        $out .= "content-length:".strlen($query)."\r\n";
        $out .= "content-type:application/x-www-form-urlencoded\r\n";
        $out .= "connection:close\r\n\r\n";
        $out .= $query;

        fputs($fp, $out);
        fclose($fp);
    }


    function  curl_requst($url, $param=array(),$timeout =1){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param)); //将数组转换为URL请求字符串
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
        curl_exec($ch);
        curl_close($ch);
    }
}

//demo
/*
 include("Async.class.php");
 $url = 'http://test.com/fsock.php';
$param = array(
'name'=>'raykaeso',
'job'=>'PHP Programmer'
);
$async = new  Async();
 $async->fputs_requst($url, $param);
echo date("Y-m-d H:i:s",time());*/