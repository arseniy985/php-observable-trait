# Механизм наблюдателей вызова методов
Реализовал трейт app\Traits\Observable при добавлении которого у класса появляется реализация этого интерфейса:
```php
interface IVisitor
{
    public function attach(IObserver $observer): void;
    public function detach(IObserver $observer): void;

    public function attachToMethod(string $method, IObserver $observer): void;
    public function detachFromMethod(string $method, IObserver $observer): void;
}
```
Теперь мы можем привязать любой класс имплементирующий интерфейс:
```php
interface IObserver
{
    public function onUpdate(): void;
}
```
## ВАЖНО!
Все методы, которые будут отслеживаться должны быть protected! Необходимо для видимости их из трейта.  
При этом для того чтобы они не отслеживались, они должны быть public

Пример в index.php
```php
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
//Выводит
//TestVisitor->test()
//TestObserver отработал
```
