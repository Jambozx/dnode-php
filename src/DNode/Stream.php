<?php
namespace DNode;
use React\Stream\CompositeStream;

class Stream
{
    private $dnode;

    private $client;

	/**
     * @return CompositeStream
     */
    public function getStream()
    {
        static $stream=null;
        if($stream)
            return $stream;
        $input = new InputStream($this->client);
        $output = new OutputStream($this->client);
        return ($stream=new CompositeStream($output, $input));
    }

    public function __construct(DNode $dnode, Session $client, $onReady)
    {
        $this->dnode = $dnode;
        $this->client = $client;

        foreach ($this->dnode->stack as $middleware) {
            call_user_func($middleware, array($client->instance, $client->remote, $client));
        }

        if ($onReady) {
            $client->on('ready', function () use ($client, $onReady) {
                call_user_func($onReady, $client->remote, $client);
            });
        }
    }
}
