<?php
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on("connect", function($cli) {
    $data = [
        'route' => 'index/test',
        'data' => 'hello'
    ];
    echo 'send ' . json_encode($data);
    $cli->send(json_encode($data) . "\n");
});
$client->on("receive", function($cli, $data){
    echo "received: {$data}\n";
});
$client->on("error", function($cli){
    echo "connect failed\n";
});
$client->on("close", function($cli){
    echo "connection close\n";
});
$client->connect("127.0.0.1", 9503, 0.5);
