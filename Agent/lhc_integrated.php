<?php
// 六合彩整合开奖系统
// 联系方式：@aade9688 (Telegram)

include dirname(dirname(__FILE__)) . "/Public/config.php";

// 添加日志记录函数
function lhc_log($message, $type = 'info') {
    $log_file = dirname(dirname(__FILE__)) . "/log/lhc_kaijiang_" . date('Y-m-d') . ".log";
    $log_dir = dirname($log_file);
    
    // 确保日志目录存在
    if (!file_exists($log_dir)) {
        mkdir($log_dir, 0755, true);
    }
    
    $log_message = "[" . date('Y-m-d H:i:s') . "] [" . strtoupper($type) . "] " . $message . PHP_EOL;
    file_put_contents($log_file, $log_message, FILE_APPEND);
}

// 验证号码函数
function validate_lhc_numbers($numbers, $format = 'single') {
    if ($format === 'single') {
        // 单个号码验证 (1-49之间)
        $number = intval($numbers);
        if ($number < 1 || $number > 49) {
            return ['valid' => false, 'message' => '开奖号码必须在1-49之间'];
        }
        return ['valid' => true, 'number' => $number];
    } else {
        // 多个号码验证 (7个不重复的1-49之间的号码)
        $number_array = explode(',', $numbers);
        
        // 验证是否有7个号码
        if (count($number_array) != 7) {
            return ['valid' => false, 'message' => '必须提供7个号码'];
        }
        
        // 验证每个号码是否都在1-49之间
        $validated_numbers = [];
        foreach ($number_array as $num) {
            $num = intval(trim($num));
            if ($num < 1 || $num > 49) {
                return ['valid' => false, 'message' => '所有开奖号码必须在1-49之间'];
            }
            $validated_numbers[] = $num;
        }
        
        // 验证是否有重复号码
        if (count($validated_numbers) !== count(array_unique($validated_numbers))) {
            return ['valid' => false, 'message' => '开奖号码不能重复'];
        }
        
        return ['valid' => true, 'numbers' => $validated_numbers];
    }
}

// 直接调用结算函数
function settle_lottery($type, $code, $term) {
    try {
        // 使用参数调用jiesuan.php
        $url = dirname(dirname(__FILE__)) . "/caiji/jiesuan.php?type={$type}&code={$code}&term={$term}";
        
        // 记录结算开始
        lhc_log("开始结算 - 类型:{$type} 期号:{$term} 开奖号码:{$code}", "info");
        
        // 使用PHP内部方法调用结算脚本
        $result = file_get_contents($url);
        
        // 记录结算结果
        lhc_log("结算完成 - 期号:{$term}", "info");
        
        return true;
    } catch (Exception $e) {
        // 记录结算错误
        lhc_log("结算失败 - 期号:{$term}, 错误: " . $e->getMessage(), "error");
        return false;
    }
}

// 验证登录
if($_SESSION['agent_user'] != "" && $_SESSION['agent_pass'] != "" && $_SESSION['agent_room'] != ""){
    $sql = get_query_vals('fn_room', '*', array('roomid' => $_SESSION['agent_room']));
    if($_SESSION['agent_user'] != $sql['roomadmin'] || $_SESSION['agent_pass'] != $sql['roompass']){
        $_SESSION['agent_user'] = "";
        $_SESSION['agent_pass'] = "";
        $_SESSION['agent_room'] = "";
        echo '<script>top.location.href="login.php";</script>';
        exit();
    }
}else{
    $_SESSION['agent_user'] = "";
    $_SESSION['agent_pass'] = "";
    $_SESSION['agent_room'] = "";
    echo '<script>top.location.href="login.php";</script>';
    exit();
}

$version = get_query_val('fn_room', 'version', array('roomid' => $_SESSION['agent_room']));
$page = '六合彩开奖管理中心';
$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'countdown';

// 获取当前期号
$current_term = get_query_val('fn_lottery9', 'current_term', array('roomid' => $_SESSION['agent_room']));
// 获取倒计时
$fengtime = get_query_val('fn_lottery9', 'fengtime', array('roomid' => $_SESSION['agent_room']));

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 处理各种表单逻辑...
}

?>
<!-- HTML界面部分省略 -->