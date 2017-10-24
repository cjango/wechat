<?php
// +------------------------------------------------+
// |http://www.cjango.com                           |
// +------------------------------------------------+
// | 修复BUG不是一朝一夕的事情，等我喝醉了再说吧！  |
// +------------------------------------------------+
// | Author: 小陈叔叔 <Jason.Chen>                  |
// +------------------------------------------------+
namespace cjango\Wechat;

use cjango\Wechat;

/**
 * 微信分享
 */
class Share extends Wechat
{

    public static function config($ticket, $url = '')
    {
        if (empty($url)) {
            $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        $signArr = [
            'timestamp'    => time(),
            'noncestr'     => uniqid(),
            'jsapi_ticket' => $ticket,
            'url'          => $url,
        ];

        ksort($signArr);
        $signature = sha1(urldecode(http_build_query($signArr)));

        return [
            'appId'     => parent::$config['appid'],
            'timestamp' => $signArr['timestamp'],
            'nonceStr'  => $signArr['noncestr'],
            'signature' => $signature,
        ];
    }
}
