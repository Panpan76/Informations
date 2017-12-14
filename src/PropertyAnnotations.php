<?php

namespace Informations;

use Informations\Annotations;

class PropertyAnnotations extends Annotations{

  // Forms
  private $form_displayName;
  private $form_inputName;
  private $form_type;

  // DataBase
  private $dataBase_fieldName;
  private $dataBase_type;
  private $dataBase_isAutoIncrement = false;
  private $dataBase_isNullable = false;
  private $dataBase_isUnique = false;
  private $dataBase_isAssociation = false;



  // Forms
  public function setFormDisplayName($form_displayName){ $this->form_displayName = $form_displayName; }
  public function getFormDisplayName(){ return $this->form_displayName; }
  public function setFormInputName($form_inputName){ $this->form_inputName = $form_inputName; }
  public function getFormInputName(){ return $this->form_inputName; }
  public function setFormType($form_type){ $this->form_type = $form_type; }
  public function getFormType(){ return $this->form_type; }


  // DataBase
  public function setDataBaseFieldName($dataBase_fieldName){ $this->dataBase_fieldName = $dataBase_fieldName; }
  public function getDataBaseFieldName(){ return $this->dataBase_fieldName; }
  public function setDataBaseType($dataBase_type){ $this->dataBase_type = $dataBase_type; }
  public function getDataBaseType(){ return $this->dataBase_type; }
  public function setDataBaseIsAutoIncrement($dataBase_isAutoIncrement){ $this->dataBase_isAutoIncrement = (boolean)$dataBase_isAutoIncrement; }
  public function getDataBaseIsAutoIncrement(){ return $this->dataBase_isAutoIncrement; }
  public function setDataBaseIsNullable($dataBase_isNullable){ $this->dataBase_isNullable = (boolean)$dataBase_isNullable; }
  public function getDataBaseIsNullable(){ return $this->dataBase_isNullable; }
  public function setDataBaseIsUnique($dataBase_isUnique){ $this->dataBase_isUnique = (boolean)$dataBase_isUnique; }
  public function getDataBaseIsUnique(){ return $this->dataBase_isUnique; }
  public function setDataBaseIsAssociation($dataBase_isAssociation){ $this->dataBase_isAssociation = (boolean)$dataBase_isAssociation; }
  public function getDataBaseIsAssociation(){ return $this->dataBase_isAssociation; }
}
