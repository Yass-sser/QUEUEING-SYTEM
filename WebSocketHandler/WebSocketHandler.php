<?php
namespace WebSocketHandler;
require dirname(__DIR__) . '/vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketHandler implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
       
        // Broadcast this message to all connected clients (the index page).
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Handle when a connection is closed
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        // Handle errors
        $conn->close();


    }
}
?>
