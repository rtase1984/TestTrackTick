<?php
require_once('ElectronicItems.php');
require_once('ShoppingCart.php');
//create electronic items
$items[] = new TelevisionItem(1, 88.5,True, 2); //$id, $pprice,  $pwired, $cantExtras
$items[] = new TelevisionItem(2, 150.5,True, 2); //$id, $pprice,  $pwired, $cantExtras
$items[] = new MicrowaveItem(5, 205.00,True, 4); //$id, $pprice, $pwired, $cantExtras
$items[] = new MicrowaveItem(6, 350.50,True, 2); //$id, $pprice, $pwired, $cantExtras
$items[] = new TelevisionItem(3, 170.5,True, 2); //$id, $pprice, $pwired, $cantExtras
$items[] = new ConsoleItem(7, 287.5,True, 2); //$id, $pprice, $pwired, $cantExtras
$items[] = new ConsoleItem(8, 330.5,True, 2); //$id, $pprice, $pwired, $cantExtras
$items[] = new ExtraItem(11, "controller",True); //$id,  $ptype, $pwired
$items[] = new ExtraItem(21, "controller",False); //$id, $ptype, $pwired


$items[4]->maxExtras(5);  //Change TV3  maxExtra  to 5

//Add extras to electronic items with extras
$items[0]->addExtra($items[8]); //Add remote controller to TV1  
$items[0]->addExtra($items[8]); //Add remote controller to TV1
$items[1]->addExtra($items[8]); //Add remote controller to TV2

$items[5]->addExtra($items[8]);   
$items[5]->addExtra($items[8]);
$items[5]->addExtra($items[7]);
$items[5]->addExtra($items[7]);
//


//Add items to shopping cart
$cart= new ShoppingCart();
$cart->addItem($items[0], 1); //TV1
$cart->addItem($items[1], 1); //TV2

$cart->addItem($items[5], 1); //Console1

$cart->addItem($items[2], 1); //Microwave

?>
<?php
//echo $item->type;
//print_r($item->getExtraItem());
//print_r($item);




?>
        <table>
        <tr>
            <th>Id. Item</th>
            <th>Type</th>
            <th>Price</th>
            <th>Option</th>
        </tr>
        <?php
          foreach ($items as $item)
          {
        ?>
        <tr>
            <th><?=$item->id?></th>
            <th><?=$item->type?></th>
            <th><?=$item->price?></th>
            <th><?=''?></th>
        </tr>
        <?php
          }
        ?>
        </table>
        
        <table>
        <tr>
            <th colspan="4"><Strong>Sort electronics item in the store by price</Strong></th>
            
        </tr>
        <tr>
            <th>Id. Item</th>
            <th>Type</th>
            <th>Price</th>
            <th>Option</th>
        </tr>
        <?php
          $existencia=new ElectronicItems($items);
          $existenciaSorted=$existencia->getSortedItems($items);
          
          foreach ($existenciaSorted as $ord)
          {
        ?>
        <tr>
            <th><?=$ord->id?></th>
            <th><?=$ord->type?></th>
            <th><?=$ord->price?></th>
            <th><?=''?></th>
        </tr>
        <?php
          }
        ?>
        </table>
<?php
//Show shopping cart
echo "---Show shopping cart---"
?>

<table>
        <tr>
            <th>Id. Item</th>
            <th>Type</th>
            <th>Unit price</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
    <?php 
        $totalQty=0;
        foreach($cart->getItems() as $element){
        
        $totalQty+=$element->getQuantity();
        ?>
         <tr>
            <th><?=$element->getItem()->getId()?></th>
            <th><?php echo $element->getItem()->type; ?></th>
            <th><?=$element->getItem()->getPrice()?></th>
            <th><?=$element->getQuantity();?></th>
            <th><?=$element->getQuantity()*$element->getItem()->getPrice()?></th>
        </tr>
        <?php

    } ?>
        <tr>
            <th colspan="3">Total</th>
            <th><?=$totalQty?></th>
            <th><?=$cart->getTotalMoney()?></th>
        </tr>
<?php
?>

