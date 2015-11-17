<?php 

// ----------------------------------------------
//  Consstructor, Destructor
// ----------------------------------------------
// Shows how to create constructor and destructor and etc..
// 
// 

class Classname {

  function __construct($param)  {
    echo "Constructor called with parameter ". $param . "<br />";
  }

// ----------------------------------------------
//  $this pointer
// ----------------------------------------------
// Shows how to create constructor and destructor and etc..
// 
// 

  public $attribute;
  function operation($param) { 
    $this->attribute = $param;
    echo $this->attribute;
  }


// ----------------------------------------------
//  $this->$properties access functions
// ----------------------------------------------
// Implemented via __get and __set methods
// 
//  remember, only the inaccessible method/property will go through the magic method, and it is 5 times slower.
  private $private_attribute;
  function __get($name) {
    return $this->$name;
  }

  function __set($name, $value) {
    echo "Visiting __set" . "\$name = " . $name . "\$value = " . $value . "\n";
    $this->$name = $value;
  }

  // accessor can have more sophisticated code 
  /*
  function __set($name, $value) {
    if (($name == "private_attribute") && ($value >= 0) && ($value <= 100)) {
      $this->attribute = $value;
    }
  }*/

// ----------------------------------------------
//  __destruct
// ----------------------------------------------
// called when the object is deinitialized.
// 

}

// ----------------------------------------------
//  Inheritance, override
// ----------------------------------------------
// how to define inheritance and how to use override
// 
// 
class A 
{
  public $attribute = "default value";
  public function operation() {
    echo "Someting <br />";
    echo "the value of \$attribute is " . $this->attribute . "<br />";
  }
}

class B extends A
{
  public $attribute = "different value";

  public function operation()
  {
    echo "Someting <br />";
    echo "the value of \$attribute is " . $this->attribute . "<br />";
  }
}


// ----------------------------------------------
//  final prefent a class/method from being override/inherited
// ----------------------------------------------
// 

class FinalAMethod { 
  public $attribute = "default value";
  final function operation() {
    echo "Someting <br />";
    echo "the value of \$attribute is " . $this->attribute . "<br />";
  }

}

final class FinalA { 

}


// ----------------------------------------------
//  interface - define behavior/contract
// ----------------------------------------------
// 

interface Displayable {
  function display();
}

class WebPage implements Displayable {
  function display() {

  }
}

// ----------------------------------------------
//  per-class constants
// ----------------------------------------------
// access with ClassName:: operator

class Math {
  const pi = 3.14159;

// ----------------------------------------------
//  static method
// ----------------------------------------------
// analogy to the per-class constants

  static function squared($input) { 
    return $input * $input;
  }
}


// -- test creating of the instance of ClassName
$a = new Classname("First");
$a = new Classname("Second");
$a = new Classname("Third");


$a->attribute = "value";
echo $a->attribute;

$a->private_attribute = 5;
echo $a->private_attribute;


$a = new A();
$a->operation();

$b = new B();
$b -> operation();


// ----------------------------------------------
//  reflection - check types and instanceof
// ----------------------------------------------
// high effecient instanceof methods
//
// - note on how to convert a boolean to string
echo "{\$b instanceof B}" . ['false','true'][($b instanceof B)] . "\n";
echo "{\$b instanceof A}" . ['false','true'][($b instanceof A)] . "\n";
echo "{\$b instanceof Displayable}" . ['false','true'][($b instanceof Displayable)] . "\n";


// ----------------------------------------------
//  type hint -use of instanceof
// ----------------------------------------------
// - uncomment the statements to uncover the error.
/*function check_hint(B $something) {

}

check_hint($a);
*/


// ----------------------------------------------
//  late static binding - static can be late.
// ----------------------------------------------
// 

class AStatic {
  public static function who() {
    echo __CLASS__;
  }

  public static function test() {
    static::who(); // Here comes Late static Bindings
  }
}

class BStatic extends AStatic {
  public static function who() {
    echo __CLASS__;
  }
}

BStatic::test();
//AStatic::test();



// ----------------------------------------------
//  clone - clone is a keyword
// ----------------------------------------------
// NOTE clone method special in PHP
class Cloneable
{
  public static $AutoId = 0;
  public $Id;
  public $Value;

  public function __construct($value) {
    $this->Id = self::$AutoId;
    self::$AutoId++;
    echo "AutoId " . self::$AutoId;
    $this->Value = $value;
  }

  // check out the manual on how to make a clone
  // instead of return a new instance, 
  // the __clone method seems to be something
  // parallel to the __construct method 
  public function __clone() {
    echo "cloning";
    // return new Cloneable($this->Value);
    $this->Id = ++self::$AutoId;
  }
}

$a = new Cloneable("hello");
$b = new Cloneable("world");
echo "a.id =" .$a->Id . "\n";
echo "b.id =" .$b->Id . "\n";
$c = clone $b;
echo "c.id =" .$c->Id . "\n";
$c = new Cloneable("world");
echo "c.id =" .$c->Id . "\n";

// ----------------------------------------------
//  abstract class
// ----------------------------------------------
// abstract keyword

abstract class AbstractA 
{
  abstract function operationX($param1, $param2);
}



// ----------------------------------------------
//  __call() - callable
// ----------------------------------------------
// make an object callable

class CallOverload
{
  public function __call($method, $p) {
    if ($method == "display") {
      if (is_object($p[0])) {
        $this->displayObject($p[0]);
      } elseif (is_array($p[0])) { 
        $this->displayArray($p[0]);
      } else { 
        $this->displayScalar($p[0]);
      }
    }
  }

  public function displayObject($p) {
    echo strval($p);
  }

  public function displayArray($p) {
    foreach ($p as $key) {
      echo $key;
    }
  }

  public function displayScalar($p) { 
    echo $p;
  }
}

$ov = new CallOverload();
$ov -> display(array(1, 2, 3));
$ov -> display('cat');


// ----------------------------------------------
//  __autoload() - 
// ----------------------------------------------
// can be used to load a class which is not yet declared
function __autoload($name) {
  echo "Loading " . $name . ".php";
  include_once $name . ".php";
}


$autoloadClass = new AutoLoadClass();


echo " Math::pi = " . Math::pi . "\n";
echo " Math::squared(8) = " . Math::squared(8) . "\n";



// ----------------------------------------------
//  Iterator and IteratorAggregate
// ----------------------------------------------
// can be thought of Enumerable and Enumerator
// check the Iterator.php for details


// ----------------------------------------------
//  __toString() function
// ----------------------------------------------
// how a class be stringized
class Printable
{
  public $testone;
  public $testtwo;
  public function __toString()
  {
    return (var_export($this, TRUE)); // var_export print all properties about one object.
  }
}

$p = new Printable;
echo $p;



// ----------------------------------------------
//  ReflectionClass - reflection API
// ----------------------------------------------
// check how you can use the class via reflection.php

?>