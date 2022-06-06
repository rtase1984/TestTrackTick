<?php 
require_once('electronicItem.php');
// The ShoppingCart class should implement Iterator so that you can loop through the cart's contents.
// The ShoppingCart class should implement Countable so that you can use count() on a cart instance.
// The only assumption about cart items is that they have a public getId() method.
class ShoppingCart implements Iterator, Countable {

    private array $items = [];
	// Array stores the list of items in the cart:

	// For tracking iterations:
	protected int $position = 0;

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
	// Returns a Boolean indicating if the cart is empty:
	public function isEmpty() {
		return (empty($this->items));
	}

	// Adds a new item to the cart:
	public function addItem(ElectronicItem $item, int $quantity) {
	
		$cartItem=$this->findCartItem($item->getId());
		if($cartItem===null){
			$cartItem = new CartItem($item, 0);
            $this->items[$item->getId()] = $cartItem;
		}       
        $cartItem->increaseQuantity($quantity);
		// Need the item id:	
	} // End of addItem() method.
    
	public function findCartItem(int $id){
		return $this->items[$id] ?? null;   
			
	}
	
	public function getTotalProducts(){
		$sum=0;
		foreach($this->items as $item){
			$sum+=$item->getQuantity();
		}
		return $sum;
	}

	public function getTotalMoney(){
		$sumMoney=0;
		foreach($this->items as $item){
			$sumMoney+=$item->getQuantity()* $item->getItem()->getPrice();
		}
		return $sumMoney;
	}



	public function updateItem(ElectronicItem $item, $qty) {

		// Need the unique item id:
		$id = $item->getId();

		// Delete or update accordingly:
		if ($qty === 0) {
			$this->deleteItem($item);
		} elseif ( ($qty > 0) && ($qty != $this->items[$id]['qty'])) {
			$this->items[$id]['qty'] = $qty;
		}

	} // End of updateItem() method.

	// Removes an item from the cart:
	public function deleteItem(ElectronicItem $item) {

		// Need the unique item id:
		$id = $item->getId();

		// Remove it:
		if (isset($this->items[$id])) {
			unset($this->items[$id]);
	
			// Remove the stored id, too:
			$index = array_search($id, $this->ids);
			unset($this->ids[$index]);

			// Recreate that array to prevent holes:
			$this->ids = array_values($this->ids);
	
		}
		
	} // End of deleteItem() method.
	
	// Required by Iterator; returns the current value:
	public function current() {
	
		// Get the index for the current position:
		$index = $this->ids[$this->position];
	
		// Return the item:
	    return $this->items[$index];

	} // End of current() method.

	// Required by Iterator; returns the current key:
	public function key() {
	    return $this->position;
	}

	// Required by Iterator; increments the position:
	public function next(): void{
	    $this->position++;
	}

	// Required by Iterator; returns the position to the first spot:
	public function rewind():void {
	    $this->position = 0;
	}

	// Required by Iterator; returns a Boolean indiating if a value is indexed at this position:
	public function valid(): bool {
		return (isset($this->ids[$this->position]));
	}
	
	// Required by Countable:
	public function count() : int {
		return count($this->items);
	}
	public function show(){
        foreach($this->items as $item){
			echo "Type: ".$item->getItem()->type." Qty: ".$item->getQuantity()." Price: ".$item->getItem()->getPrice().PHP_EOL;
		}
	}

} // End of ShoppingCart class.

//
class CartItem{

	private ElectronicItem $item;

	private int $quantity;

	public function __construct($item, $quantity){
       $this->item=$item;
	   $this->quantity=$quantity;
	}

	public function getItem(){
		return $this->item;
	}

	public function setItem($item){
        $this->item=$item;
	}
    
	public function getQuantity(){
		return $this->quantity;
	}

	public function setQuantity($quantity){
        $this->quantity=$quantity;
	}

	public function increaseQuantity($newQuantity=1){
       $this->quantity+=$newQuantity;
	}

	public function decreaseQuantity($newQuantity=1){
       if($this->getQuantity()-$newQuantity<1){
		   throw new Exception(message: "Item quantity can not be less than 1");
	   }
	   $this->quantity-=$newQuantity;
	}

}