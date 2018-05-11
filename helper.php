<?php

/*
在实际开发工作中,我们进行http数据请求传输时,有时候会用到Base64的编码格式,对参数进行重新编发.

而Base64是将二进制转码成可见字符,从而方便我们在进行http请求时进行传输，但是Base64转码时会生成“+”，“/”，“=”符号,这些是被URL进行转码的特殊字符，这样就会导致两方面数据不一致,导致我们发送数据请求时,无法跟后台接口正确对接。

因此我需要在发送前将“+”，“/”，“=”替换成URL不会转码的字符，接收到数据后，再将这些字符替换回去，再进行解码。

@link https://www.jianshu.com/p/014718b034c7 thanks very much
*/

/**
 * URL base64编码
 * '+' -> '-'
 * '/' -> '_'
 * '=' -> ''
 * @param unknown $string
 */
function urlsafe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

/**
 * URL base64解码
 * '-' -> '+'
 * '_' -> '/'
 * 字符串长度%4的余数，补'='
 * @param unknown $string
 */
function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}