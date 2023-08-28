<?php

declare(strict_types=1);

namespace server\controller;

use server\controller\Action;

class Dispatcher
{
    private $root;

    final public function __construct(string $root)
    {
        $this->root = $root;
    }
    public function init()
    {
        // Action実行
        $action = new Action($this->root);
        $action->init();
    }
}
