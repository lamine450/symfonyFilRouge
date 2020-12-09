<?php
namespace App\service;


class mesService
{
    public function putData($contentRequest)
    {
/**Le tableau qui contiendra les données */
        $mesService= [];
        /**eclatons la chaine */
        $data= preg_split("/form-data;/",$contentRequest);
        /**on supprime le premier élément du  tableau */
        unset($data[0]);
        unset($data[1]);
        foreach ($data as $item)
        {
          $data2=preg_split("/\r\n/",$item);
          array_pop($data2);
          array_pop($data2);
          $key=explode( '"',$data2[0]);
          $key= $key[1];
          $mesService[$key]= end($data2);
        }
       return $mesService;
    }

}
