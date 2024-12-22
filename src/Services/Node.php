<?php

namespace App\Services;

class Node
{
    public int $value;
    public ?Node $left;
    public ?Node $right;

    public function __construct(int $value)
    {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}