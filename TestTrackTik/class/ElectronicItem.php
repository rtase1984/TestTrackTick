<?php
trait maxExtras{
    /**
     * Update maxExtras value for the item
     *
     * @return void
     */
    public function maxExtras($maxExtras){
        $this->maxExtras=$maxExtras;
    }
     /**
     * Returns maxExtras value for the item
     *
     * @return int
     */
    public function getMaxExtras(): int{
        return $this->maxExtras;
    }
}
/*
*@class 
*/
class ElectronicItem
{
    public $id;

    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    private $type;
    
    public $wired;
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_EXTRA = 'extra';
    public static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE, self::ELECTRONIC_ITEM_TELEVISION,
        self::ELECTRONIC_ITEM_EXTRA
    );
    
    function getId() //
    {
        return $this->id;
    }
  
    function getWired()
    {
        return $this->wired;
    }
    function getPrice()
    {
        return $this->price;
    }

    function getType()
    {
        return $this->type;
    }
    function setId($id)
    {
        $this->id = $id;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }
    function setType($type)
    {
        $this->type = $type;
    }
    function setWired($wired)
    {
        $this->wired = $wired;
    }


}


class TelevisionItem extends ElectronicItem{
    protected int $maxExtras=4;
    private array $extraItems = [];
    
    private int $cantExtras;
    public function __construct($id, $price, $wired, $cantExtras)
    {
        $this->id=$id;
        $this->price=$price;
        $this->type=parent::$types[2];
        $this->wired=$wired;
        //$max=parent::$maxExtras;
        $this->maxExtras=PHP_INT_MAX;
        //if($cantExtras<$max)
        $this->cantExtras=$cantExtras;
        //else throw new Exception("The quantity of extras can't exced maximun");
        $this->extraItems=array();
    }

     use maxExtras; //Trait with functions referent to maxExtras


    public function addExtra($extraItem)
    {
        if(sizeof($this->extraItems) < $this->maxExtras)  //Verify if i can add more extras
            $this->extraItems[] = $extraItem; //Add extraItem to List
        else new Exception('This item do not have more than '.$this->maxExtras.'  extras.'); // If i have max extras for this item
    }
    public function getExtraItem(): int{
        return $this->maxExtras;
    }

}
/*
*
*
*
*/    
class ConsoleItem extends ElectronicItem{

    //private int $maxExtras;
    private array $extraItem = [];
    private int $cantExtras;
    private $maxExtras;
    public function __construct($id, $price, $wired, $cantExtras)
    {
        $this->id=$id;
        $this->price=$price;
        $this->type=parent::$types[0];
        $this->wired=$wired;
        $this->maxExtras=4;
        if($cantExtras<$this->maxExtras)
           $this->cantExtras=$cantExtras;
        else throw new Exception("The quantity of extras can't exced ".$this->maxExtras );
        $this->extraItem=array();
    }

    public function Extra($item)
	{
		$this->extras[]=$item;
		return true;
	}

    public function addExtra($extraItem)
    {
        if(sizeof($this->extraItem) < $this->maxExtras)  //Verify if i can add more extras
            $this->extraItem[] = $extraItem; //Add extraItem to List
        else new Exception('This item do not have more extras.'); // If i have max extras for this item
    }
    use maxExtras; //Trait with functions referent to maxExtras
}

class MicrowaveItem extends ElectronicItem{
    //private $maxExtras;
    public function __construct($id, $price, $wired)
    {
        $this->id=$id;
        $this->price=$price;
        $this->type=parent::$types[1];
        $this->wired=$wired;
    }
}
/*Class for extra item */

class ExtraItem extends ElectronicItem{
    public function __construct($id, $type, $wired)
    {
        $this->id=$id;
        /* price Initially 0.00 because this item is complementary
        *  if some person need to buy only controller without another item
        *  this value can change 
        */
        $this->price=0.00; 
                           
        $this->type=$type;
        $this->wired=$wired;
    }

}

