<?php

class Service {

  // retourne un tableau de chaque parametre GET
  public static function getArrayGet($get)
  {
    $paramArray = array();
    $paramArray1 = array();
    $tabUrl = parse_url ( $get) ;
    $listparam = explode ( "&" , $tabUrl [ 'query' ] );
    $nb_param = count ( $listparam );

    for ( $i=0 ; $i<$nb_param ; $i++)  {
      $param = explode ( '=' , $listparam[$i] ) ;
      $paramname = $param[0];
      $paramvalue = $param[1];
      $paramAr = array(
            $paramname => $paramvalue
      );
      array_push($paramArray1, $paramAr);
    }

    return $paramArray1;
  }

}
