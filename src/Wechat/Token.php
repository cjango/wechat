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
 * ACCESS TOKEN获取
 */
class Token extends Wechat
{

    /**
     * 接口名称与URL映射
     * @var array
     */
    protected static $url = [
        'access_token' => 'https://api.weixin.qq.com/cgi-bin/token', // 获取ACCESS_TOKEN
        'jsapi_ticket' => 'https://api.weixin.qq.com/cgi-bin/ticket/getticket', // JSAPI_TICKET获取地址
    ];

    /**
     * 获取ACCESS_TOKEN
     * @return [type] [description]
     */
    public static function get()
    {
        $params = [
            'appid'      => parent::$config['appid'],
            'secret'     => parent::$config['secret'],
            'grant_type' => 'client_credential',
        ];
        $result = Utils::api(self::$url['access_token'], $params);
        if ($result) {
            return $result['access_token'];
        } else {
            return false;
        }
    }

    /**
     * 获取JSAPI_TICKET
     * @return [type] [description]
     */
    public static function ticket()
    {
        $params = [
            'access_token' => parent::$config['access_token'],
            'type'         => 'jsapi',
        ];
        $result = Utils::http(self::$url['jsapi_ticket'], $params);
        if ($result) {
            $result = json_decode($result, true);
            return $result['ticket'];
        } else {
            return false;
        }
    }
}
