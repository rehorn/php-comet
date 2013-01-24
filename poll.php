<?php

require 'LongPoller.php';

// 类的继承
class Poll extends LongPoller {
    
    // 生成随机数
    // 实际项目可以替换成数据库查询
    function loadData(){
        $rand = rand(1,999);      
        if($rand <= 15){      
            return $rand;
        }
        return NULL;
    }

}

$poller = new Poll();
$poller->run();

?>
