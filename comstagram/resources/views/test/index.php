<?php

use Illuminate\Support\Facades\Date;

class A
{
    function foo()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}

class B
{
    function bar()
    {
        A::foo();
    }
}

$a = new A();
$a->foo();

// A::foo();

// $b = new B();
// $b->bar();

// B::bar();
class SimpleClass
{
    public $var;
}

$instance = new SimpleClass();

// This can also be done with a variable:
$className = 'SimpleClass';
$instance = new $className(); // new SimpleClass()
$assigned   =  $instance;
$reference  = &$instance;

$instance->var = '$assigned will have this value <br>';

echo ('<br>$assigned->var:' . $assigned->var);
echo ('<br>$reference->var:' . $reference->var);

$instance = null; // $instance and $reference become null

// var_dump($instance);
// var_dump($reference);
// var_dump($assigned);

class Test
{
    static public function getNew()
    {
        return new static;
        // return new self;
    }
}

class Child extends Test
{
}

$obj1 = new Test();
$obj2 = new $obj1;
var_dump($obj1 !== $obj2);

$obj3 = Test::getNew();
var_dump($obj3 instanceof Test);

$obj4 = Child::getNew();
var_dump($obj4 instanceof Child);

echo  '<br>';
echo (new DateTime())->format('Y');

class Foo
{
    public $bar;

    public function __construct()
    {
        $this->bar = function () {
            return 42;
        };
    }
}

$obj = new Foo();
echo  '<br>';
echo ($obj->bar)(), PHP_EOL;
echo  '<br>';


class ClassName
{
}

echo ClassName::class;
echo  '<br>';


// As of PHP 8.0.0, this line:
$repository = null;
$result = $repository?->getUser(5)?->name;
echo '$result:', $result;
// Is equivalent to the following code block:
if (is_null($repository)) {
    $result = null;
} else {
    $user = $repository->getUser(5);
    if (is_null($user)) {
        $result = null;
    } else {
        $result = $user->name;
    }
}
$name = "홍길동";

echo "<br> $name";
echo '<br> $name';
