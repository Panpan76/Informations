<?php

namespace Informations;

use Informations\Annotations;

class ClassAnnotations extends Annotations{

  // DataBase
  private $dataBase_tableName;

  public function setDataBaseTableName($dataBase_tableName){ $this->dataBase_tableName = $dataBase_tableName; }
  public function getDataBaseTableName(){ return $this->dataBase_tableName; }
}
