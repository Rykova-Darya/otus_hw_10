<?php

namespace App\Command;

use App\Services\Arrays;
use App\Services\BinarySearchTree;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'Trees',
    description: 'Add a short description for your command',
)]
class TreesCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $n = 1000000;

        //неотсортированный массив
        $start = (int) (microtime(true) * 1000);
        $treeRandom = new BinarySearchTree();
        $arrRandom = new Arrays();
        $treeRandom->setSize($n);
        $arrRandom->setRandomArray($n);
        $elems = $arrRandom->getArr();
        $randomNumbers = array_rand($elems, $n / 10);
        //вставка
        $treeRandom->setCmpZero();
        $treeRandom->setAsgZero();
        foreach ($elems as $elem) {
            $treeRandom->insert($elem);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $treeRandom->toString($end);
        //Поиск
        $treeRandom->setCmpZero();
        $treeRandom->setAsgZero();
        $treeRandom->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $treeRandom->search($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $treeRandom->toString($end);
        //Удаление
        $treeRandom->setCmpZero();
        $treeRandom->setAsgZero();
        $treeRandom->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $treeRandom->remove($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $treeRandom->toString($end);

        //отсортированный массив
        $start = (int) (microtime(true) * 1000);
        $treeSorted = new BinarySearchTree();
        $arrSorted = new Arrays();
        $treeSorted->setSize($n);
        $arrSorted->setSorted($n);
        $elems = $arrSorted->getArr();
        //вставка
        $treeSorted->setCmpZero();
        $treeSorted->setAsgZero();
        foreach ($elems as $elem) {
            $treeSorted->insert($elem);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $treeSorted->toString($end);
        //Поиск
        $treeSorted->setCmpZero();
        $treeSorted->setAsgZero();
        $treeSorted->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $treeSorted->search($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $treeSorted->toString($end);
        //Удаление
        $treeSorted->setCmpZero();
        $treeSorted->setAsgZero();
        $treeSorted->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $treeSorted->remove($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $treeSorted->toString($end);
        return Command::SUCCESS;
    }
}
