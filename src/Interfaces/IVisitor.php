<?php

namespace app\Interfaces;

interface IVisitor
{
    public function attach(IObserver $observer): void;
    public function detach(IObserver $observer): void;

    public function attachToMethod(string $method, IObserver $observer): void;
    public function detachFromMethod(string $method, IObserver $observer): void;
}