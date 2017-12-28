<?php
class Curl{
    public static function post($url, $param = array(), $header = array(), $ssl = 0, $format = 'json',$log=1)
    {
         $ch = curl_init();
         if (is_array($param)) {
            $urlparam = http_build_query($param);
         } else if (is_string($param)) { //json字符串
            $urlparam = $param;
         }
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_TIMEOUT, 120); //设置超时时间
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //返回原生的（Raw）输出
         curl_setopt($ch, CURLOPT_POST, 1); //POST
         curl_setopt($ch, CURLOPT_POSTFIELDS, $urlparam); //post数据
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
         if ($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true); //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
        }

        $data = curl_exec($ch);
        if ($format == 'json') {
            $data = json_decode($data, true);
         }

        if($log){
            if($format=='html'){
                self::_logCurlInfo($ch,$param,'');
            }else{
                self::_logCurlInfo($ch,$param,$data);
             }
         }
         curl_close($ch);
         return $data;
        return ;
    }


    // /**
    //  * 请求信息记录日志
    //  * @param $ch       curl句柄
    //  * @param $request  请求参数
    //  * @param $response 响应结果
    //  */
    private static function _logCurlInfo($ch,$request,$response)
    {
        $file = "/var/www/log/new_nagrand/update_cimp_".date("Y-m-d").".log";
        // $file = "D:/test.log";
        $info = curl_getinfo($ch);
        $resultFormat =  "耗时:[%s] 返回状态:[%s] 请求的url[%s] 请求参数:[%s] 响应结果:[%s] 大小:[%s]kb 速度:[%s]kb/s";
        $resultLogMsg =  sprintf($resultFormat,$info['total_time'],$info['http_code'],$info['url'],var_export($request,true),var_export($response,true),$info['size_download']/1024,$info['speed_download']/1024);
        file_put_contents($file, $resultLogMsg,FILE_APPEND);

    }
}