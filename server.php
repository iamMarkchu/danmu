<?php
$ws = new swoole_websocket_server("127.0.0.1", 9502);
$ws->on('open', function($server, $request) {
    // echo $request->fd. ' connected!';
});
$ws->on('message', function ($server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    foreach($server->connections as $fd){
    //如果是某个客户端，自己发的则加上isnew属性，否则不加
      if($fd !== $frame->fd)
        $server->push($fd, "{$frame->data}");
    }
});

$ws->on('close', function ($server, $fd) {
    echo "client {$fd} closed\n";
});

$ws->start();
