<?php
App::uses('AppHelper', 'View/Helper');

class UtilsHelper extends AppHelper {
   
   /**
    * sorting_sign function.
    * Permet de retourner un signe ascendant, descendant ou les deux en fonction 
    * du tri actuellement appliqué par le paginateur.
    * 
    * @access public
    * @param string $column Le nom de la propriété du modèle à tester
    * @param mixed $sortKey Utilisé pour transmettre $this->Paginator->sortKey()
    * @param mixed $sortDir Utilisé pour transmettre $this->Paginator->sortDir()
    * @return void
    */
   public function sorting_sign($column, $sortKey, $sortDir){
        if($column == $sortKey){
            if($sortDir == 'asc'){
                echo '<i class="icon-sort-up"></i> ';
            }
            elseif($sortDir == 'desc'){
                echo '<i class="icon-sort-down"></i> ';
            }
        }else{
            echo '<i class="icon-sort"></i> ';
        }
    }
}