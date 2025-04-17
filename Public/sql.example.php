<?php
// 数据库相关操作函数

// 数据库连接函数
function db_connect($host, $name, $pass, $dbname, $port = 3306) {
    $db = new mysqli($host, $name, $pass, $dbname, $port);
    if ($db->connect_errno) {
        errorc__("系统出现错误,请将错误编码告知管理员,错误编码:[" . sql_write_log(array('数据库链接出错', $db->connect_errno, $db->connect_error)) . "]");
    }
    $GLOBALS['D'] = $db;
    $GLOBALS['dbcontent'] = true;
    db_query("set time_zone = '+8:00';");
    db_query("SET NAMES UTF8");
}

// 数据库查询函数
function db_query($sqlstr, $is = false) {
    if ($GLOBALS['dbcontent'] !== true) db_connect();
    $db = $GLOBALS['D'];
    $queryr = $db->query($sqlstr);
    $GLOBALS['db_query_'] = $queryr;
    $GLOBALS['D'] = $db;
    if (!$queryr || $db->errno > 0) {
        $sqlerrorid = sql_write_log(array('语句执行出错', $db->errno, $db->error, $sqlstr));
    }
    if (!$is && !empty($sqlerrorid)) {
        errorc__("系统出现错误,请将错误编码告知管理员,错误编码:[{$sqlerrorid}]");
    }
    return $queryr;
}

// 其他数据库函数...
