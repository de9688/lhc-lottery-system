<?php
// 数据库配置
$host = 'localhost';
$username = 'pc28'; // 数据库用户名
$password = 'L3cAjELH64K5TFw2'; // 数据库密码
$database = 'pc28'; // 数据库名称
$port = 3306; // 数据库端口

// 系统配置
$config = [
    'site_name' => '六合彩彩票系统',
    'site_url' => 'http://yourdomain.com',
    'admin_path' => 'Agent',
    'timezone' => 'Asia/Shanghai',
    'debug' => false
];

// 连接数据库
db_connect($host, $username, $password, $database, $port);

// 设置时区
date_default_timezone_set($config['timezone']);

// 会话配置
session_start();
