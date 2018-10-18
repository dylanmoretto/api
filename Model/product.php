<?php
class Product
{

  private $db;
  private $tableName = "product";

  public $select;
  public $where;
  public $query;
  public $price;


  public function __construct($db)
  {
    $this->db = $db;
  }


  function select()
  {
      $this->select = "SELECT  * FROM " . $this->tableName;

      return $this->select;
  }


  function where($cond)
  {
    var_dump($cond);
    $this->where = " WHERE ";
    foreach ($cond as $key=>$value){
      foreach ($value as $k=>$val){
        $this->where = $this->where . $k . "=" . $val ." AND ";
      }
    }
    // del the last "AND"
    $this->where = substr($this->where, 0, -4);

    return $this->where;
  }


  function exec()
  {
    $this->query = $this->select . $this->where;
    $stmt = $this->db->prepare($this->query);
    $stmt->execute();

    return $stmt;
  }

} ?>
