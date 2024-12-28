# Механизм наблюдателей вызова методов
Реализовал трейт Observable при добавлении которого у класса появляется реализация этого интерфейса:
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