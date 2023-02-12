<?php 

class Cart {

  protected $items = array();

  public function addItem($item_id)
  {
    array_push($this->items, $item_id);
  }

  public function getItems()
  {
    return $this->items;
  }
  
}

?>