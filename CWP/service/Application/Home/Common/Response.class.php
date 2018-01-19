<?php
/* 生成json格式，json_encode编码*/
namespace Home\Common;

class Response
{
    public static function json($code = '', $message = '', $date = array())
    {
        $result = array(
            'code' => urlencode($code),
            'message' => urlencode($message),
            'content' => self::encodeArray($date)
        );
        exit(urldecode(json_encode($result)));
    }

    public static function encodeArray($arr = array())
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $arr[$key] = self::encodeArray($value);
            } else {
                $arr[$key] = urlencode($value);
            }
        }
        return $arr;
    }

}