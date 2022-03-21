<?php

namespace MyApp;

class Foo
{
    private $type;

    public function sum($a, $b)
    {
        return $a + $b;
    }

    public function returnTrue()
    {
        return true;
    }

    public function returnNull()
    {
        return null;
    }

    public function __construct($type = null)
    {
        $this->type = $type;
    }

    public function getStatus()
    {
        if ($this->type === 1) {
            return 'one';
        }
        if ($this->type === 2) {
            return 'second';
        }
        if ($this->type === 3) {
            return 'third';
        }
        return 'Another';
    }
}