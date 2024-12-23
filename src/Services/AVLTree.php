<?php

namespace App\Services;

class AVLTree {
    private ?Node $root = null;
    private int $cmp = 0;
    private int $asg = 0;
    private int $size = 0;

    private function smallLeftRotation(?Node $x): ?Node {
        $this->asg++;
        $y = $x->right;
        $x->right = $y->left;
        $y->left = $x;
        return $y;
    }

    private function smallRightRotation(?Node $y): ?Node {
        $this->asg++;
        $x = $y->left;
        $y->left = $x->right;
        $x->right = $y;
        return $x;
    }

    private function bigLeftRotation(?Node $z): ?Node {
        $z->right = $this->smallRightRotation($z->right);
        return $this->smallLeftRotation($z);
    }

    private function bigRightRotation(?Node $z): ?Node {
        $z->left = $this->smallLeftRotation($z->left);
        return $this->smallRightRotation($z);
    }

    public function insert(int $x): void {
        $this->root = $this->insertNode($this->root, $x);
    }

    private function insertNode(?Node $node, int $x): Node {
        if ($node === null) {
            $this->asg++;
            return new Node($x);
        }

        $this->cmp++;
        if ($x < $node->value) {
            $node->left = $this->insertNode($node->left, $x);
        } elseif ($x > $node->value) {
            $node->right = $this->insertNode($node->right, $x);
        }

        return $this->rebalance($node);
    }

    public function search(int $x): bool
    {
        return $this->searchNode($this->root, $x);
    }

    public function remove(int $x): void {
        $this->root = $this->removeNode($this->root, $x);
    }

    private function removeNode(?Node $node, int $x): ?Node {
        if ($node === null) {
            return null;
        }

        $this->cmp++;
        if ($x < $node->value) {
            $node->left = $this->removeNode($node->left, $x);
        } elseif ($x > $node->value) {
            $node->right = $this->removeNode($node->right, $x);
        } else {
            if ($node->left === null) {
                $this->asg++;
                return $node->right;
            } elseif ($node->right === null) {
                $this->asg++;
                return $node->left;
            }

            $minRight = $this->getMin($node->right);
            $node->value = $minRight->value;
            $node->right = $this->removeNode($node->right, $minRight->value);
        }

        return $this->rebalance($node);
    }

    private function getMin(?Node $node): ?Node {
        while ($node->left !== null) {
            $node = $node->left;
        }
        return $node;
    }

    private function rebalance(?Node $node): ?Node {
        if ($node === null) {
            return null;
        }

        $balance = $this->getBalance($node);

        if ($balance > 1) {
            if ($this->getBalance($node->left) < 0) {
                $node = $this->bigRightRotation($node);
            } else {
                $node = $this->smallRightRotation($node);
            }
        }

        if ($balance < -1) {
            if ($this->getBalance($node->right) > 0) {
                $node = $this->bigLeftRotation($node);
            } else {
                $node = $this->smallLeftRotation($node);
            }
        }

        return $node;
    }

    private function getBalance(?Node $node): int {
        if ($node === null) {
            return 0;
        }
        return $this->getHeight($node->left) - $this->getHeight($node->right);
    }

    private function getHeight(?Node $node): int {
        if ($node === null) {
            return 0;
        }
        return max($this->getHeight($node->left), $this->getHeight($node->right)) + 1;
    }

    public function setSize($size)
    {
        $this->size = $size;

    }

    public function setCmpZero()
    {
        $this->cmp = 0;

    }
    public function setAsgZero()
    {
        $this->asg = 0;

    }

    public function toString($ms)
    {
        echo "Длинна массива: " . $this->size . "\tms: " . $ms .
            "\tСравнений (cmp): " . $this->cmp .
            "\tОбменов (asg): " . $this->asg . PHP_EOL;
    }

    private function searchNode(?Node $node, int $x): bool
    {
        $this->cmp++;
        if ($node === null) {
            return false;
        }

        $this->cmp++;
        if ($x === $node->value) {
            return true;
        }

        $this->cmp++;
        return $x < $node->value
            ? $this->searchNode($node->left, $x)
            : $this->searchNode($node->right, $x);

    }

    // Проверка на построение дерева
    private function printTreeNode(?Node $node, string $prefix, bool $isLeft): void {
        if ($node === null) {
            echo $prefix . ($isLeft ? "├── " : "└── ") . "null\n";
            return;
        }

        echo $prefix . ($isLeft ? "├── " : "└── ") . $node->value . "\n";

        $this->printTreeNode($node->left, $prefix . ($isLeft ? "│   " : "    "), true);
        $this->printTreeNode($node->right, $prefix . ($isLeft ? "│   " : "    "), false);
    }
}