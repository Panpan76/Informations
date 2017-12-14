# Informations
## Create your own annotations and use it

------------------

If you have an object, like an Entity, you can easy create any annotation you want on it.

```php
<?
class User{
  /**
   * @MyCustomAnnotation(customKey="customValue")
   */
  private $login;
}
```
> Note :
>
> You can use whatever you want instead of 'MyCustomAnnotation', 'customKey' and 'customValue'

Now, you have to handle this annotation in a class that gives you all the information about a property/method/class.

This class should extends `Informations\PropertyAnnotations` for the properties, `Informations\MethodAnnotations` for the methods, `Informations\MethodAnnotations` for the classes, or you can make a class that extends `Informations\Annotations` if the annotation you will use can be used for a property, a method and a class.

For the example, we will create a class that extends `Informations\PropertyAnnotations` and use the annotation we created just before.

```php
<?
class MyAnnotation extends Informations\PropertyAnnotations{
  private $customKey;

  public function setMyCustomAnnotationCustomKey($customValue){
    $this->customKey = $customValue;
  }
  public function getMyCustomAnnotationCustomKey(){
    return $this->customKey;
  }
}
```
> Note
>
> The only imposed thing is the name of the setter, it have to be of the form : `set`+`MyCustomAnnotation`+`customKey`
>
> `MyCustomAnnotation` -> the "prefixe" of the annotation, you can use what you want
>
> `customKey` -> here, it must start with a uppercase

**Last step** : use this class as the propertyAnnotationsClass for the `Informations\InformationsClass`.

You just have to do :
```php
<?
Informations\InformationsClass::setPropertyAnnotationsClass('MyAnnotation');
```

That's all ! You're ready to use it !
