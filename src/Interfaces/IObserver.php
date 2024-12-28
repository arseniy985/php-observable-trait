<?php

namespace app\Interfaces;

interface IObserver
{
    public function onUpdate(): void;
}