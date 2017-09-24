<?php

namespace DNode;

use Evenement\EventEmitter;
use React\Stream\ReadableStreamInterface;
use React\Stream\WritableStreamInterface;
use React\Stream\Util;

class ReadableStream extends EventEmitter implements ReadableStreamInterface
{
    protected $closed = false;

    public function isReadable()
    {
        return !$this->closed;
    }

    public function pause()
    {
    }

    public function resume()
    {
    }

    public function pipe(WritableStreamInterface $dest, array $options = array())
    {
        Util::pipe($this, $dest, $options);

        return $dest;
    }

    public function close()
    {
        if ($this->closed) {
            return;
        }

        $this->closed = true;
        $this->emit('end', array($this));
        $this->emit('close', array($this));
        $this->removeAllListeners();
    }
}
