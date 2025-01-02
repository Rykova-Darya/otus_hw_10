<?php

namespace App\Command;

use App\Services\Arrays;
use App\Services\AVLTree;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'AVLTrees',
    description: 'Add a short description for your command',
)]
class AVLTreesCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $n = 10600;

        //неотсортированный массив
        $start = (int) (microtime(true) * 1000);
        $AVLRandom = new AVLTree();
        $arrRandom = new Arrays();
        $AVLRandom->setSize($n);
        $arrRandom->setRandomArray($n);
        $elems = $arrRandom->getArr();
        $randomElems = $elems;
        shuffle($randomElems);
        $randomNumbers = array_slice($randomElems, 0, $n / 10);
        //вставка
        $AVLRandom->setCmpZero();
        $AVLRandom->setAsgZero();
        foreach ($elems as $elem) {
            $AVLRandom->insert($elem);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $AVLRandom->toString($end);
        //Поиск
        $AVLRandom->setCmpZero();
        $AVLRandom->setAsgZero();
//        $treeRandom->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $AVLRandom->search($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $AVLRandom->toString($end);
        //Удаление
        $AVLRandom->setCmpZero();
        $AVLRandom->setAsgZero();
//        $treeRandom->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $AVLRandom->remove($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $AVLRandom->toString($end);
        echo '==================';
        //отсортированный массив
        $start = (int) (microtime(true) * 1000);
        $AVLSorted = new AVLTree();
        $arrSorted = new Arrays();
        $AVLSorted->setSize($n);
        $arrSorted->setSorted($n);
        $elems = $arrSorted->getArr();
        $randomElems = $elems;
        shuffle($randomElems);
        $randomNumbers = array_slice($randomElems, 0, $n / 10);
        //вставка
        $AVLSorted->setCmpZero();
        $AVLSorted->setAsgZero();
        foreach ($elems as $elem) {
            $AVLSorted->insert($elem);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $AVLSorted->toString($end);
        //Поиск
        $AVLSorted->setCmpZero();
        $AVLSorted->setAsgZero();
//        $treeSorted->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $AVLSorted->search($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $AVLSorted->toString($end);
        //Удаление
        $AVLSorted->setCmpZero();
        $AVLSorted->setAsgZero();
//        $treeSorted->setSize($n / 10);
        $start = (int) (microtime(true) * 1000);
        foreach ($randomNumbers as $num) {
            $AVLSorted->remove($num);
        }
        $end = (int) (microtime(true) * 1000) - $start;
        $AVLSorted->toString($end);
        return Command::SUCCESS;
    }
}
