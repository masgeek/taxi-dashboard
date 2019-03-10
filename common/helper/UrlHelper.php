<?php
/**
 * Created by PhpStorm.
 * User: smbar
 * Date: 09-Aug-18
 * Time: 1:12 PM
 */

namespace common\helper;
class UrlHelper
{
    public static function getBaseUrl($dir = __DIR__, $replacement = 'common/helper/')
    {

        $root = "";
        $dir = str_replace('\\', '/', realpath($dir));

        //HTTPS or HTTP
        $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';

        //HOST
        $root .= '://' . $_SERVER['HTTP_HOST'];

        //ALIAS
        if (!empty($_SERVER['CONTEXT_PREFIX'])) {
            $root .= $_SERVER['CONTEXT_PREFIX'];
            $root .= substr($dir, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT']));
        } else {
            $root .= substr($dir, strlen($_SERVER['DOCUMENT_ROOT']));
        }

        $root .= '/';

        return str_replace('common/helper/', '', $root);
    }
}