<?php

namespace Informations;

use ReflectionClass;
use Informations\ClassAnnotations;
use Informations\MethodAnnotations;
use Informations\PropertyAnnotations;

use Informations\AnnotationException;


class InformationsClass{
  private $namespace;
  private $name;

  private $parent;

  private $interfaces;

  private $class;
  private $methods;
  private $properties;


  private static $propertyAnnotationsClass;
  private static $isPropertyAnnotationsInit = false;
  private static $methodAnnotationsClass;
  private static $isMethodAnnotationsInit = false;
  private static $classAnnotationsClass;
  private static $isClassAnnotationsInit = false;

  public function __construct($class){
    $infos = new ReflectionClass($class);
    $this->namespace  = $infos->getNamespaceName();
    $this->name       = trim(str_replace($this->namespace, '', $infos->getName()), '\\');
    if($parent = $infos->getParentClass()){
      $this->parent   = new InformationsClass($parent->getName());
    }
    $this->interfaces = $infos->getInterfaces();


    if(!empty($annotations = $infos->getDocComment())){
      if(!self::$isClassAnnotationsInit){
        throw new AnnotationException("You must configure the class by calling 'setClassAnnotationsClass' before use it", AnnotationException::NOT_CONFIGURED);
      }

      $c = new self::$classAnnotationsClass();

      $lines = preg_split('/\n/', $annotations);
      foreach($lines as $line){
        $this->parse($line, $c);
      }
      $this->class = $c;
      unset($c);
    }


    if(!self::$isMethodAnnotationsInit){
      throw new AnnotationException("You must configure the class by calling 'setMethodAnnotationsClass' before use it", AnnotationException::NOT_CONFIGURED);
    }
    $this->methods = array();
    foreach($infos->getMethods() as $method){
      $m = new self::$methodAnnotationsClass();

      if(!empty($annotations = $method->getDocComment())){
        $lines = preg_split('/\n/', $annotations);
        foreach($lines as $line){
          $this->parse($line, $m);
        }
      }
      $this->methods[$method->getName()] = $m;
      unset($m);
    }


    if(!self::$isPropertyAnnotationsInit){
      throw new AnnotationException("You must configure the class by calling 'setPropertyAnnotationsClass' before use it", AnnotationException::NOT_CONFIGURED);
    }
    $this->properties = array();
    foreach($infos->getProperties() as $property){
      $p = new self::$propertyAnnotationsClass();

      if(!empty($annotations = $property->getDocComment())){
        $lines = preg_split('/\n/', $annotations);
        foreach($lines as $line){
          $this->parse($line, $p);
        }
      }
      $this->properties[$property->getName()] = $p;
      unset($p);
    }
  }


  private function parse($annotation, $element){
    if(preg_match('/@(.*)\(/U', $annotation, $match)){
      $prefixe = $match[1];
      if(preg_match("/@(.*)\((.*)=\"(.*)\"\)/", $annotation, $matches)){
        $prefixe = $match[1];
        $method = "set$prefixe".ucfirst($matches[2]);
        try{
          if(!method_exists($element, $method)){
            throw new AnnotationException("The class '".get_class($element)."' do not have a method called '$method'", AnnotationException::METHOD_NOT_EXISTING);
          }
          $element->$method($matches[3]);
        }catch(AnnotationException $e){}
      }
    }
  }

  public static function setPropertyAnnotationsClass($propertyAnnotationsClass){
    if(!is_object($propertyAnnotationsClass)){
      $propertyAnnotationsClass = new $propertyAnnotationsClass();
    }
    if(!is_a($propertyAnnotationsClass, 'Informations\Annotations')){
      throw new AnnotationException("The given object is not an instance of 'Informations\Annotations'", AnnotationException::NOT_GOOD_INSTANCE);
    }
    self::$isPropertyAnnotationsInit = true;
    self::$propertyAnnotationsClass = $propertyAnnotationsClass;
  }
  public static function setMethodAnnotationsClass($methodAnnotationsClass){
    if(!is_object($methodAnnotationsClass)){
      $methodAnnotationsClass = new $methodAnnotationsClass();
    }
    if(!is_a($methodAnnotationsClass, 'Informations\Annotations')){
      throw new AnnotationException("The given object is not an instance of 'Informations\Annotations'", AnnotationException::NOT_GOOD_INSTANCE);
    }
    self::$isMethodAnnotationsInit = true;
    self::$methodAnnotationsClass = $methodAnnotationsClass;
  }
  public static function setClassAnnotationsClass($classAnnotationsClass){
    if(!is_object($classAnnotationsClass)){
      $classAnnotationsClass = new $classAnnotationsClass();
    }
    if(!is_a($classAnnotationsClass, 'Informations\Annotations')){
      throw new AnnotationException("The given object is not an instance of 'Informations\Annotations'", AnnotationException::NOT_GOOD_INSTANCE);
    }
    self::$isClassAnnotationsInit = true;
    self::$classAnnotationsClass = $classAnnotationsClass;
  }




  public function getProperties(){
    return $this->properties;
  }
  public function getMethods(){
    return $this->methods;
  }

  public function getNamespace(){
    return $this->namespace;
  }
  public function getName(){
    return $this->name;
  }
  public function getParent(){
    return $this->parent;
  }
  public function getInterfaces(){
    return $this->interfaces;
  }
  public function getClass(){
    return $this->class;
  }
}
