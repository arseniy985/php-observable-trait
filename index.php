<?php


use app\Traits\Observable;
use app\Interfaces\IObserver;
use app\Interfaces\IVisitor;

require_once 'vendor/autoload.php';

class TestObserver implements IObserver
{
    public function onUpdate(): void {
        echo self::class . ' отработал';
    }
}

class TestVisitor implements IVisitor
{
    use Observable;
    protected function test(): void
    {
        echo self::class . '->test()' . PHP_EOL;
    }
}

$visitor = new TestVisitor();
$visitor->attach(new TestObserver());

$visitor->test();