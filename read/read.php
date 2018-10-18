<?php


class read
{

  public $db;

  public function getInclude()
  {
    /*header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");*/
   include_once '../Model/product.php';
   include_once '../config/database.php';
   include_once '../read/read.php';
   include_once '../service/service.php';
  }


  public function getDb()
  {
    $database = new Database();
    $this->db = $database->getConnection();

    return $this->db;
  }


  public function getJSon()
  {
    $this->getInclude();
    //new obj
    $product = new Product($this->getDb());
    $product->select();

    $paramArray = Service::getArrayGet($_SERVER['REQUEST_URI']);
    $product->where($paramArray);
    $stmt =$product->exec();
    $num = $stmt->rowCount();

    // if result
    if($num>0){
        // products array
        $products_arr=array();
        $products_arr["records"]=array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $product_item=array(
                "id" => $id,
                "name" => $name,
                "description" => html_entity_decode($description),
                "price" => $price
            );
            array_push($products_arr["records"], $product_item);
        }
        // set response code - 200 OK
        http_response_code(200);
        // show products data in json format
        echo json_encode($products_arr);
    }

    else{
        // set response code - 404 Not found
        http_response_code(404);
        // tell the user no products found
        echo json_encode(
            array("message" => "No products found.")
        );
    }
  }
}

$read = new Read;
$read->getJson();

 ?>
