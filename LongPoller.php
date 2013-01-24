<?php

abstract class LongPoller {

    // 1s 检查一次
    protected $sleepTime = 1;
    // 超时时间，秒数
    protected $timeoutTime = 50;
    protected $result = '';

    function __construct() {
    }

    function setTimeout($timeout) {
        $this->timeoutTime = $timeout;
    }

    function setSleep($sleep) {
        $this->sleepTime = $sleepTime;
    }

    public function run() {
        $data = NULL;
        $timeout = 0;

        set_time_limit($this->timeoutTime + $this->sleepTime + 15);

        while($data == NULL && $timeout < $this->timeoutTime) {
            $data = $this->loadData();
            $this->result = $data;
            if($data == NULL){

                //flush to notify php still alive
                flush();

                //Wait for new Messages
                sleep($this->sleepTime);
                $timeout += $this->sleepTime;
            }else{
                echo $this->success();
                flush();
                exit();
            }
        }

        // timeout
        echo $this->error();
        exit();
    }

    protected abstract function loadData();

    function success(){
        $arr = array('code'=>"0", 'data'=>$this->result);
        return json_encode($arr);
    }

    function error(){
        $arr = array('code'=>"1");
        return json_encode($arr);
    }

}
?>