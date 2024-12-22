<?php

namespace App\Services;

class Arrays
{
    private array $arr;

    public function __construct($arr = [])
    {
        $this->arr = $arr;
    }

    public function setRandomArray(int $size)
    {
        $this->arr = [];
        mt_srand(12345);

        for ($j = 0; $j < $size; $j++) {
            $this->arr[$j] = mt_rand(0, $size * 100 -1);
        }
    }

    public function setSorted(int $size)
    {
        $this->arr = [];
        for ($j = 0; $j < $size; $j++) {
            $this->arr[$j] = $j+1;
        }
    }

    public function getArr(): array
    {
        return $this->arr;
    }
}