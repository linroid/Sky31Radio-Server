<?php
/**
 * Created by PhpStorm.
 * User: linroid
 * Date: 11/21/14
 * Time: 2:47 PM
 */

/**
 * @param string $path
 * @return string
 */
function admin($path = ''){
    return url('/admin/'.$path);
}
function option($key, $default=''){
    static $options;
    if(!$options){
        $options = Option::lists('value', 'key');
    }
    return isset($options[$key]) ? $options[$key] : $default;
}