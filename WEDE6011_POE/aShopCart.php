<?php
//Checking if URL action not empty
if(!empty($_GET["action"])) 
{
    //Getting action Description from URL
    switch($_GET["action"]) {
        
        //If case is cart then add item to cart
        case "cart":
            if(!empty($_POST["Quantity"])) 
            {
                //Calling item from DB where description is in URL
                $dbProductDesc = $db_handle->executeSQL("SELECT * FROM tbl_item WHERE Description='" . $_GET["desc"] . "'");
                //Load array $cartItemsArr
                $cartItemsArr = array($dbProductDesc[0]["Description"]=>array('Description'=>$dbProductDesc[0]["Description"], 'ItemID'=>$dbProductDesc[0]["ItemID"], 
                'Quantity'=>$_POST["Quantity"], 'SellPrice'=>$dbProductDesc[0]["SellPrice"], 'ItemImg'=>$dbProductDesc[0]["ItemImg"]));

                $stockAfterPurchase = $dbProductDesc[0]["Quantity"] - $_POST["Quantity"];
                $availableStock = $dbProductDesc[0]["Quantity"];
                $minStock = 0;
                
                if(!empty($_SESSION["myShoppingCart"])) 
                {
                    //Populating array with necessary data input from user
                    if(in_array($dbProductDesc[0]["Description"],array_keys($_SESSION["myShoppingCart"]))) 
                    {
                        foreach($_SESSION["myShoppingCart"] as $key => $value) 
                        { 
                            if($dbProductDesc[0]["Description"] == $key && $stockAfterPurchase >= $minStock) 
                            {  
                                if(empty($_SESSION["myShoppingCart"][$key]["Quantity"])) 
                                {                                
                                    $_SESSION["myShoppingCart"][$key]["Quantity"] = 0;       
                                }
                                else {
                                    //Calling Bootstrap Modal
                                    $showModal = "true";	 
                                }
                            }
                            else {
                                 //Calling Bootstrap Modal
                                 $showModal = "true";	 
                            }
                        }
                    } 
                    else if($stockAfterPurchase >= $minStock){
                        //Merge array with sessions
                        $_SESSION["myShoppingCart"] = array_merge($_SESSION["myShoppingCart"],$cartItemsArr);
                    }
                    else {
                        //Calling Bootstrap Modal
                        $showModal = "true";	
                   }
                } 
                else if($stockAfterPurchase >= $minStock) {
                    $_SESSION["myShoppingCart"] = $cartItemsArr;
                }
                else {
                    //Calling Bootstrap Modal
                    $showModal = "true";	 
                }
            }
        break;

        //If case is remove then remove item from cart
        case "remove":
            if(!empty($_SESSION["myShoppingCart"])) 
            {
                foreach($_SESSION["myShoppingCart"] as $key => $value) {
                    if($_GET["desc"] == $key)
                    {
                        unset($_SESSION["myShoppingCart"][$key]);			
                    }
                            	
                    if(empty($_SESSION["myShoppingCart"]))
                    {
                        unset($_SESSION["myShoppingCart"]);
                    }                            
                }
            }
        break;

         //If case is clear-cart then clear cart
        case "clear-cart":
            //Reset Session(clear array)
            unset($_SESSION["myShoppingCart"]);  
        break;	
    }
}
?>