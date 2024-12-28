<?php

namespace app\Traits;

use app\Interfaces\IObserver;

trait Observable
{
    private array $observers = [];
    private array $methodObservers = [];

    public function attach(IObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    public function attachToMethod(string $method, IObserver $observer): void
    {
        $this->methodObservers[$method][] = $observer;
    }

    public function detach(IObserver $observer): void
    {
        $key = array_search($observer, $this->observers);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function detachFromMethod(string $method, IObserver $observer): void
    {
        if (isset($this->methodObservers[$method])) {
            $key = array_search($observer, $this->methodObservers[$method]);
            if ($key !== false) {
                unset($this->methodObservers[$method][$key]);
            }
        }
    }

    public function __call(string $name, array $args)
    {
        if (method_exists($this, $name)) {
            call_user_func_array([$this, $name], $args);
            $this->notifyObservers($name);
        } else {
            echo "функции не существует";
        }
    }

    private function notifyObservers(string $method = null): void
    {
        foreach ($this->observers as $observer) {
            $observer->onUpdate();
        }

        if ($method !== null && isset($this->methodObservers[$method])) {
            foreach ($this->methodObservers[$method] as $observer) {
                $observer->onUpdate();
            }
        }
    }
}
