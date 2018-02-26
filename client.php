<?php
$http = new swoole_http_server("127.0.0.1", 9501);
$http->on('request', function($request, $response) {
    $request_uri = $request->server['request_uri'];
    if($request_uri == '/')
    {
        $file_name = './client.html';
    }else{
        if(file_exists('.'. $request_uri))
        {
            $file_name = '.'. $request_uri;
        }
    }
    $response->end(file_get_contents($file_name));
});
$http->start();
