<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php 
session_start();
//Establishing DB Connection
require_once("DBConn.php");
//Calling DBScriptExecution Class
$db_handle = new DBScriptExecution();

//Including shopping cart function cases
include("aShopCart.php");

?>

<!-- Responsive registration page HTML -->
<html>
    <head>
        <title>ED Browse My Shop</title>
         <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="stylesheet.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
        <!-- (Ajax.googleapis.com. 2021) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>        
    </head>
    <body class = "dashboard_bgrd">
   
    <h1 class="offset-4 dash_heading">Extreme Diving Online Shop</h1> 

  
    <div class="form-group col-sm-12 row parent">
        <div class="col-sm-10"></div>
        <form action="registration.php" method="post">           
            <input type = "submit" name = "btnSignUp" class ="mt-3 buttons" value = "SIGN UP">&nbsp&nbsp&nbsp
        </form>                    
        <form action="landingPage.php" method="post">           
            <input type = "submit" name = "btnLogOut" class ="mt-3 buttons" value = "BACK TO HOME">
        </form>      
    </div>  


    <!-- (I.ytimg.com. 2021) -->
    <img class="slideshow browse_storeImg" src="https://i.ytimg.com/vi/GTWZiUH3uBY/maxresdefault.jpg">
    <!-- (garmin.com. 2021) -->
    <img class="slideshow browse_storeImg" src="https://www.garmin.com.hk/minisite/descent/descent-mk1/images/descent-share-image.jpg">
    <!-- (shopify.com. 2021) -->
    <img class="slideshow browse_storeImg" src="https://cdn.shopify.com/s/files/1/0283/6108/articles/blog-feature-garmin-descent-mk2_972x511_crop_left.progressive.jpg">

        <!-- Advert Slideshow -->
        <!-- (W3schools.com. 2021) -->
        <script>
            var index = 0;
            slide();
            
            function slide() {
            var i;
            var x = document.getElementsByClassName("slideshow");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            index++;
            if (index > x.length) {index = 1}    
            x[index-1].style.display = "block";  
            setTimeout(slide, 4000);
            }
        </script>

        <!--Stop Page Scroll on Refresh-->
        <script>
             document.addEventListener("DOMContentLoaded", function(event) { 
                 var scrollpos = localStorage.getItem('position');
                 if (scrollpos) window.scrollTo(0, scrollpos);
             });

             window.onbeforeunload = function(e) {
             localStorage.setItem('position', window.scrollY);
             };
        </script>      

    <div>
    <div class="row-spacing"></div>
    <!-- Responsive UI for Shopping Cart -->
    <h1 class="offset-5 dash_heading">My Shop Cart</h1> 

        <div class="cart_container">
            <label class="txt-heading col-sm-8 mt-3"><b>MY DIVE ITEMS:</b></label>            
            <a class="btnEmpty" href="browse.php?action=clear-cart">Cancel Order</a>           
        </div>      

        <?php
            if(isset($_SESSION["myShoppingCart"])){
                $myItemsQuantity = 0;
                $myItemsPrice = 0;
            ?>	

        <table class="tbl-cart cart_container" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th class="cart_desc">Item Description</th>
                    <th class="cart_code">Item Code</th>
                    <th class="cart_quantity">Quantity</th>
                    <th class="cart_price">Price</th>
                    <th class="cart_remove"></th>
                </tr>	
            <?php		
                foreach ($_SESSION["myShoppingCart"] as $item){
                    $item_price = $item["Quantity"]*$item["SellPrice"];
                    ?>
                    <!-- Fetching data and inserting into cart -->
                            <tr>
                            <td class="system_text_color"><img class="cart-item-image" src="<?php echo $item["ItemImg"]; ?>" />
                            <?php echo $item["Description"]; ?></td>
                            <td class="cart_code"><?php echo $item["ItemID"]; ?></td>
                            
                            <td class="cart_quantity"><?php echo $item["Quantity"]; ?></td>
                            <td class="cart_price"><?php echo "R ".$item["SellPrice"]; ?></td>

                            <td class="system_text_color"><a href="browse.php?action=remove&desc=<?php echo $item["Description"]; ?>" >
                            <!-- (wikimedia.org. 2021.) -->
                            <img class="btnRemoveAction" src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Icons8_flat_delete_generic.svg/723px-Icons8_flat_delete_generic.svg.png" alt="Remove Item" /></a></td>

                            </tr>
                            <?php
                            $myItemsQuantity += $item["Quantity"];
                            $myItemsPrice += ($item["SellPrice"]*$item["Quantity"]);
                    }
                    ?>

            <tr>
            <!-- Display total amounts -->
                <td colspan="2" align="right" class="system_text_color"><strong><u>Total:</u></strong></td>
                <td align="right" class="system_text_color"><strong><u><?php echo $myItemsQuantity; ?></u></strong></td>
                <td align="right" class="system_text_color"><strong><u><?php echo "R ".number_format($myItemsPrice, 2); ?></u></strong></td>
                
                <td>
                    <form method = "post" action = "browse.php?action=browse.php">  
                        <button class = "btnCheckout" type="submit" name = "btnCheckout">Checkout</button>
                    </form>
                </td>  
                                
            </tr>
            </tbody>
        </table>	

        <?php
            } 
            else {
            ?>
            <!-- (rypen.com. 2021.) -->
                <img class="shopping_cart_icon" src="https://www.rypen.com/assets/images/cart-empty.svg" alt="Empty Cart" /></a></td>
                <div class="cart_empty">Your Cart is Empty</div>               
            <?php 
            }
        ?>
    </div>
    
</div>
<div class="row-spacing"></div>
<h1 class="offset-5 dash_heading">My Dive Shop</h1> 
    <?php
        //SELECT all from tbl_item
        $dive_listItems = $db_handle->executeSQL("SELECT * FROM tbl_item WHERE IsDeleted = 0 ORDER BY SellPrice ASC");
        $randAmount = "R";
        ?>

        <div class="row" id = "shopNow" style="margin-left:110px">
            <?php
            if(!empty($dive_listItems))
            {
                //For each row in tbl_item devide it into different key values 
                //and add it into HTML until loop is finished or in other words
                //until it reaches the end of tbl_item
                foreach ($dive_listItems as $key => $value) 
                {
                        if($dive_listItems[$key]["Quantity"] > 0)
                        {
                        ?>
                            <div class = "row item_group">
                                <!-- Item Description being echoed into the URL -->
                                <form method = "post" action = "browse.php?action=cart&desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  

                                <!-- Add to cart button -->
                                <button class = "add_to_cart_btn float-right" type="submit">
                                    <!-- (iconfinder.com. 2021) -->
                                <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn4.iconfinder.com/data/icons/online-shopping-glyph-part-1/33/add_cart-512.png"></span>
                                </button>
                                
                                <?php
                                //Item Description
                                $Desc = $dive_listItems[$key]["Description"];
                                //Item Sell Price
                                $SellPrc = $dive_listItems[$key]["SellPrice"];
                                ?>
                                
                                <!-- Echo Item Description -->
                                <div class = "cart_Font"><?php echo "<b>$Desc</b>"; ?></h4></div>
                                <!-- Echo Sell Price with rand("R") variable -->
                                <div class = "cart_Font"><?php echo "<u>$randAmount</u>". "" ."<u>$SellPrc</u>"; ?></h4></div>    
                            
                                <!-- Item Image -->
                                <img style="margin-left:5px" class = "item_img" src="<?php echo $dive_listItems[$key]["ItemImg"]; ?> ">

                                <!-- Item Quantity -->
                                <div>
                                    <input type="number" class="item_quantity cart_Font" step="1"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                    name="Quantity" value="1" size="2" min="1" />
                                </div>

                                </form>

                                <form method = "post" action = "browse.php?action=desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  
                                <!-- View button -->
                                <button class = "add_to_cart_btn float-right" type="submit" name = "btnViewItem">
                                <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn2.iconfinder.com/data/icons/picol-vector/32/view-512.png"></span>
                                </button>       
                                </form>
                            </div>
                        <?php
                        }
                        else if($dive_listItems[$key]["Quantity"] <= 0)
                        { 
                        ?>
                            <div class = "row item_group_no_stock">

                                <!-- Item Description being echoed into the URL -->
                                <form method = "post" action = "browse.php?action=cart&desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  

                                <!-- Add to cart button -->
                                <button style="opacity:0.5" class = "add_to_cart_btn float-right" type="submit">
                                    <!-- (iconfinder.com. 2021) -->
                                <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn4.iconfinder.com/data/icons/online-shopping-glyph-part-1/33/add_cart-512.png"></span>
                                </button>
                                
                                <?php
                                //Item Description
                                $Desc = $dive_listItems[$key]["Description"];
                                //Item Sell Price
                                $SellPrc = $dive_listItems[$key]["SellPrice"];
                                ?>
                                
                                <!-- Echo Item Description -->
                                <div style="opacity:0.5" class = "cart_Font"><?php echo "<b>$Desc</b>"; ?></h4></div>
                                <!-- Echo Sell Price with rand("R") variable -->
                                <div style="opacity:0.5" class = "cart_Font"><?php echo "<u>$randAmount</u>". "" ."<u>$SellPrc</u>"; ?></h4></div>    
                            
                                <!-- Item Image -->
                                <div class="img_container">
                                    <img style="margin-left:5px; opacity:0.5" class = "item_img" src="<?php echo $dive_listItems[$key]["ItemImg"]; ?> ">
                                    <div class="centered"><h3>OUT OF STOCK</h3></div>
                                </div>

                                <!-- Item Quantity -->
                                <div>
                                    <input style="opacity:0.5" type="number" class="item_quantity cart_Font" step="1"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                    name="Quantity" value="1" size="2" min="1" />
                                </div>

                                </form>

                                <form method = "post" action = "browse.php?action=desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  
                                <!-- View button -->
                                <button style="opacity:0.5" class = "add_to_cart_btn float-right" type="submit" name = "btnViewItem">
                                <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn2.iconfinder.com/data/icons/picol-vector/32/view-512.png"></span>
                                </button>       
                                </form>
                            </div>
                        <?php
                        }


                }
            }
            ?>
        </div>
    </body>
</html>

<?php   

    if (isset($_POST['btnViewItem']))
    {
         //SELECT all from tbl_item
        $itemCheck = $db_handle->executeSQL("SELECT * FROM tbl_item ORDER BY SellPrice ASC");

         //If DB call not null 
        if(!empty($itemCheck))
        {
            //For each row in tbl_item devide it into different key values 
            //and add it into HTML until loop is finished or in other words
            //until it reaches the end of tbl_item
            foreach ($itemCheck as $key => $value) 
            {
                //Validating if the URL contains the description from the database
                if(stripos($_SERVER['REQUEST_URI'], $itemCheck[$key]["Description"]) !== false)
                //(PHP, C. and Nunez, S., 2021. Check if URL has certain string with PHP)
                {    
                    //Adding Database retrieved data into variables            
                    $ItemImg = $dive_listItems[$key]["ItemImg"];
                    $Description = $dive_listItems[$key]["Description"];
                    $SellPrice = $dive_listItems[$key]["SellPrice"];   
                    
                    //Calling Bootstrap Modal
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#itemView").modal("show");
                    });
                    </script>';   
                }
            }
        }      
    }

    if (isset($_POST['btnCheckout']))
    {
        unset($_SESSION["myShoppingCart"]);

        //Calling Bootstrap Modal
        echo '<script type="text/javascript">
        $(document).ready(function(){
            $("#checkout").modal("show");
            $e.preventDefault();
        });
        </script>';   
    }
?>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="itemView">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title">Cart Item</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">     
                    <img class = "cart_img_open" src="<?php echo $ItemImg;?> ">    
                    <div class = "cart_font_open">
                        <div><?php echo "<b>$Description</b>"; ?></h4></div>
                        <div><?php echo "<u>$randAmount</u>". "" ."<u>$SellPrice</u>"; ?></h4></div>      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="checkout">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title">Register to place your order!</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">   
                    <img class="shopping_cart_icon" src="https://www.freeiconspng.com/uploads/orange-error-icon-0.png" alt="Please Sign In" /></a></td>  
                    <div style="text-align:center">Please sign up and log in to continue placing your order.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn buttons" id="submit" name="btnSignUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</html>

<?php   
    //Navigating to Sign Up page
    echo '<script type="text/javascript">
    $(document).on( "click", "#submit", function() {
        window.location.replace("http://localhost/WEDE6011_POE/registration.php?");
    });
    </script>'; 
?>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="outOfStock">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title">Order Placed</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">  
                   <div style="text-align:center">
                   <img class="shopping_cart_icon" style="margin-bottom:10px" src="https://image.flaticon.com/icons/png/512/1201/1201867.png" alt="Item ?" /></a></td>  
                        <?php 
                        
                        if($availableStock > 1)
                        {
                            echo "There is only <b>$availableStock</b> items available for this purchase."; 
                        }      
                        if($availableStock < 1)
                        {
                            echo "No items in stock."; 
                        }    
                        if($availableStock == 1)
                        {
                            echo "There is only <b>$availableStock</b> item available for this purchase."; 
                        }                    
                        
                        ?></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>

<?php			
	if(!empty($showModal)) {
		// CALL MODAL HERE
		echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#outOfStock").modal("show");
			});
		</script>';
	} 
?>
