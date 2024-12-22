<?php

namespace App\Services;

class BinarySearchTree
{
    private ?Node $root = null;
    private int $cmp = 0;
    private int $asg = 0;

    private int $size = 0;

    public function insert(int $x): void
    {
        $this->root = $this->insertNode($this->root, $x);
    }

    public function search(int $x): bool
    {
        return $this->searchNode($this->root, $x);
    }

    public function remove(int $x): void
    {
        $this->root = $this->removeNode($this->root, $x);
    }

    public function setCmpZero()
    {
        $this->cmp = 0;

    }
    public function setAsgZero()
    {
        $this->asg = 0;

    }

    public function setSize($size)
    {
        $this->size = $size;

    }

    private function insertNode(?Node $node, int $x): Node
    {
        $this->cmp++;
        if ($node === null) {
            $this->asg++;
            return new Node($x);
        }

        if ($x < $node->value) {
            $this->cmp++;
            $node->left = $this->insertNode($node->left, $x);
            $this->asg++;
        } elseif ($x > $node->value) {
            $this->cmp++;
            $node->right = $this->insertNode($node->right, $x);
            $this->asg++;
        }
        return $node;
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

    private function removeNode(?Node $node, int $x): ?Node
    {
        $this->cmp++;
        if ($node === null) {
            return null;
        }

        if ($x < $node->value) {
            $this->cmp++;
            $node->left = $this->removeNode($node->left, $x);
            $this->asg++;
        } elseif ($x > $node->value) {
            $this->cmp++;
            $node->right = $this->removeNode($node->right, $x);
            $this->asg++;
        } else {
            // у узла нет дочерних элементов
            $this->cmp++;
            if ($node->left === null && $node->right === null) {
                return null;
            }
            // у узла только один дочерний элемент
            $this->cmp++;
            if ($node->left === null) {
                return $node->right;
            }
            $this->cmp++;
            if ($node->right === null) {
                return $node->left;
            }
            // у узла два дочерних элемента
            $minValue = $this->findMin($node->right);
            $node->value = $minValue;
            $this->asg++;
            $node->right =$this->removeNode($node->right, $minValue);
            $this->asg++;
        }
        return $node;
    }

    private function findMin(Node $node): int
    {
        while ($node->left !== null) {
            $this->cmp++;
            $node = $node->left;
            $this->asg++;
        }
        return $node->value;
    }

    // Визуализация дерева для отладки
    public function printStructuredTree(): void {
        $this->printNode($this->root, "", true);
    }

    public function toString($ms)
    {
        echo "Длинна массива: " . $this->size . "\tms: " . $ms .
            "\tСравнений (cmp): " . $this->cmp .
            "\tОбменов (asg): " . $this->asg . PHP_EOL;
    }
    private function printNode(?Node $node, string $prefix, bool $isLeft): void {
        if ($node !== null) {
            echo $prefix . ($isLeft ? "├── " : "└── ") . $node->value . "\n";
            $this->printNode($node->left, $prefix . ($isLeft ? "│   " : "    "), true);
            $this->printNode($node->right, $prefix . ($isLeft ? "│   " : "    "), false);
        }
    }

}