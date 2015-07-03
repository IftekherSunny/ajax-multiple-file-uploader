<?php
function isAjax()
{
    $headers = apache_request_headers();
    $is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');
    return $is_ajax ? true : false;
}
