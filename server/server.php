<?php
use Workerman\Worker;
use PHPSocketIO\SocketIO;
require_once __DIR__ . '/vendor/autoload.php';

//If you need port number
$port = 8081;
$io = new SocketIO($port);

$io->on('connection', function ($socket) use ($io) {
    echo "\n User connected";
    $socket->on('chat message', function ($msg) use ($io) {
        $io->emit('chat message', "Response from server: ". $msg);
        echo "\n chat message: " . $msg;
    });

    $socket->on('disconnect', function ()  use ($io){
        echo "\n Socket Disconnected";
        $io->emit("User disconnected");
    });
});

Worker::runAll();