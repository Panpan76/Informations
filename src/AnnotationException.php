<?php

namespace Informations;

class AnnotationException extends \Exception{

  const NOT_GOOD_INSTANCE   = 0;
  const NOT_CONFIGURED      = 1;
  const METHOD_NOT_EXISTING = 2;

  public function __construct($description, $code){
    $this->description  = $description;
    $this->code         = $code;

    switch($this->code){
      case self::NOT_GOOD_INSTANCE:
        $this->title  = "Not good instance";
        $this->type   = "E";
        break;

      case self::NOT_CONFIGURED:
        $this->title  = "Not configured";
        $this->type   = "E";
        break;

      case self::METHOD_NOT_EXISTING:
        $this->title  = "Method not existing";
        $this->type   = "W";
        break;
    }

    // parent::__construct($this->title, $this->description, $this->type, $this->code);
  }
}
