<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php
session_start();
//Establishing DB Connection
require_once("DBConn.php");
//Calling DBScriptExecution Class
$db_handle = new DBScriptExecution();

//Passed Logged in Session User
$session_UserN = $_SESSION['loggedUserN'];
$session_UserS = $_SESSION['loggedUserS'];  
$session_UserID = $_SESSION['loggedUserID'];  

//Including shopping cart function cases
include("aShopCart.php");

?>

<!-- Responsive registration page HTML -->
<html>
    <head> 
        <title>Extreme Diving Dashboard</title>
         <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="stylesheet.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
        <!-- (Ajax.googleapis.com. 2021) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>   
        <!-- (fontawesome.com. 2021.) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">     
    </head>
    <body class = "dashboard_bgrd">
   
    <div class="row col-sm-12">
        <h1 class="offset-4 dash_heading col-sm-7">Extreme Diving Online Shop</h1> 
        <form action="myProfile.php?" method="post">
            <button title="View Profile" type = "submit" name = "btnProfile" class="profile_icon mt-3 fa-lg"><i class="fa fa-user"></i></button>
        </form>   
    </div>
 

    <div class="form-group col-sm-12 row parent" style="margin-left:60px">
        <div class = "col-sm-6 mt-3 dash_subheading">
        <?php
             //SELECT all from tbl_User
             $loggedInUser = $db_handle->executeSQL("SELECT * FROM tbl_User WHERE UserID = $session_UserID");
    
             //If DB call not null 
             if(!empty($loggedInUser))
             {
                 foreach ($loggedInUser as $key => $value) 
                 {?>
                 <!-- Display logged in user -->
                       <h4><b><?php
                             echo "WELCOME USER:  "; ?></b><b><?php 
                             echo $loggedInUser[$key]["FName"];
                             echo "   "; 
                             echo $loggedInUser[$key]["LName"]; 
                        ?></b> </h4> 
                 <?php
                 }
             }?>                     
        </div>
        <input type = "submit" onclick="browse_Store('shopNow'); show_Cart('showCart'); browse_StoreHeading('heading'); show_History('history'); 
        show_historyHeading('history-heading'), showHistoryBtn('history-btn')" 
        name = "browse" class ="mt-3 buttons sizingBrowse" value = "BROWSE/CLOSE STORE">&nbsp;
       
        <form action="" method="post">
            <button type = "submit" name = "btnLogOut" class ="mt-3 buttons sizingLogout">LOG OUT</button>
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

        <!-- Browse Store -->
        <script>
            function browse_Store(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'none')
                e.style.display = 'block';
            else
                e.style.display = 'none';
            }
        </script>

        <script>
            function browse_StoreHeading(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'none')
                e.style.display = 'block';
            else
                e.style.display = 'none';
            }
        </script>

        <!-- Hide Cart Items -->
        <script>
            function show_Cart(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'none')
                e.style.display = 'block';
            else
                e.style.display = 'none';
            }
        </script>

        <!-- Hide History Items -->
        <script>
            function show_History(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'none')
                e.style.display = 'block';
            else
                e.style.display = 'none';
            }
        </script>

        <script>
            function show_historyHeading(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'none')
                e.style.display = 'block';
            else
                e.style.display = 'none';
            }
        </script>

        <script>
            function showHistoryBtn(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'none')
                e.style.display = 'block';
            else
                e.style.display = 'none';
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

    <div id = "showCart">
    <div class="row-spacing"></div>

    <!-- Responsive UI for Shopping Cart -->
    <h1 class="offset-5 dash_heading">My Shop Cart</h1> 
        <div class="cart_container">
            <label class="txt-heading col-sm-8 mt-3"><b>MY DIVE ITEMS:</b></label>            
            <a class="btnEmpty" href="myShop.php?action=clear-cart">Cancel Order</a>           
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
                    $item_price = $item["Quantity"] * $item["SellPrice"];
                    ?>
                    <!-- Fetching data and inserting into cart -->
                            <tr>
                            <td class="system_text_color"><img class="cart-item-image" src="<?php echo $item["ItemImg"]; ?>" />
                            <?php echo $item["Description"]; ?></td>
                            <td class="cart_code"><?php echo $item["ItemID"]; ?></td>
                            
                            <td class="cart_quantity"><?php echo $item["Quantity"]; ?></td>
                            <td class="cart_price"><?php echo "R ".$item["SellPrice"]; ?></td>

                            <td class="system_text_color"><a href="myShop.php?action=remove&desc=<?php echo $item["Description"]; ?>" >
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
                    <form method = "post" action = "">  
                        <button class = "btnCheckout" title="Purchase Now" type="submit" name = "btnCheckout">Checkout</button>
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
<h1 id="heading" class="offset-5 dash_heading">My Dive Shop</h1> 

        <div class="row" id = "shopNow" style="margin-left:110px">
            <?php
                 $dive_listItems = $db_handle->executeSQL("SELECT * FROM tbl_item WHERE IsDeleted = 0 ORDER BY SellPrice ASC");
                 $randAmount = "R";
            //If DB call not null 
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
                                <form method = "post" action = "myShop.php?action=cart&desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  

                                <!-- Add to cart button -->
                                <button title="Add To Cart" class = "add_to_cart_btn float-right" type="submit">
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

                                <form method = "post" action = "myShop.php?action=desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  
                                <!-- View button -->
                                <button title="View Item" class = "add_to_cart_btn float-right" type="submit" name = "btnViewItem">
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
                                <form method = "post" action = "myShop.php?action=cart&desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  

                                <!-- Add to cart button -->
                                <button title="Add To Cart" style="opacity:0.5" class = "add_to_cart_btn float-right" type="submit" disabled>
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
                                    <input style="opacity:0.5" type="number" class="item_quantity cart_Font" step="1" disabled readonly
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                    name="Quantity" value="1" size="2" min="1" />
                                </div>

                                </form>

                                <form method = "post" action = "myShop.php?action=desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  
                                <!-- View button -->
                                <button title="View Item" style="opacity:0.5" class = "add_to_cart_btn float-right" type="submit" name = "btnViewItem" disabled>
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
        
        <?php
        //Getting history data
            $historyItems = $db_handle->executeSQL("SELECT u.Email, o.OrderID, i.ItemImg, i.Description, i.ItemID,
             oi.Quantity, oi.SellPrice, oi.PurchaseDate FROM tbl_user u 
             INNER JOIN tbl_order o ON o.UserID = u.UserID 
             INNER JOIN tbl_orderitem oi ON oi.OrderID = o.OrderID 
             INNER JOIN tbl_item i ON i.ItemID = oi.ItemID 
             WHERE u.UserID = $session_UserID");
        ?>

        <?php
        if (!empty($historyItems))
        {?>

        <!-- Responsive History table with user purchases -->
        <h1 id="history-heading" class="offset-4 dash_heading mt-5">Purchase Order History</h1> 
        <div id="history-btn" class="offset-4">
          <input type = "submit" onclick="show_Cart('history')" name = "viewCart" class ="mt-3 buttons sizingOpenClose" value = "DRAW PURCHASE HISTORY">
        </div>
        
        <table id="history" class="tbl-cart cart_container_history" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th class="cart_item__history">Item Description</th>
                    <th class="cart_code_history">Item Code</th>
                    <th class="cart_email__history">User Email</th>
                    <th class="cart_quantity__history">Quantity</th>
                    <th class="cart_price__history">Price</th>
                    <th class="cart_orderid__history">Order ID</th>
                    <th class="cart_date__history">Purchase Date</th>
                </tr>	
            <?php		
                foreach ($historyItems as $key => $value){
                    ?>
                    <!-- Inserting data into UI -->
                        <tr>
                        <td class="system_text_color cart_item__history"><img class="cart-item-image" src="<?php echo $historyItems[$key]["ItemImg"]; ?>" />
                        <?php echo $historyItems[$key]["Description"]; ?></td>

                        <td class="cart_code_history"><?php echo $historyItems[$key]["ItemID"]; ?></td>
                        <td class="cart_email__history"><?php echo $historyItems[$key]["Email"]; ?></td>
                            
                        <td class="cart_quantity__history"><?php echo $historyItems[$key]["Quantity"]; ?></td>
                        <td class="cart_price__history"><?php echo "R ".$historyItems[$key]["SellPrice"]; ?></td>
 
                        <td class="system_text_color cart_orderid__history"><?php echo $historyItems[$key]["OrderID"]; ?></td>       

                        <td class="cart_date__history"><?php echo $historyItems[$key]["PurchaseDate"]; ?></td>            

                        </tr>
                        <?php
                }
                ?>
            </tbody>
        </table>	
        <div class="row-spacing"></div>
        <?php 
        }
        ?>
    </body>
</html>

<?php   

    if (isset($_POST['btnLogOut']))
    {
        echo '<script type="text/javascript">
        $(document).ready(function(){
            $("#logOut").modal("show");
        });
        </script>';  
    }

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
        if(isset($_SESSION["myShoppingCart"])) 
        {
            $GenerateOrderID = rand(31, 1000000);

            //Inserting purchased item into DB
            $insertOrder = "INSERT INTO tbl_Order (OrderID ,UserID) 
                VALUES ('$GenerateOrderID', '$session_UserID')";

                if(!empty($insertOrder))
                {
                    //Executing insert query
                    $db_handle->executeInsert($insertOrder);
                }

            foreach ($_SESSION["myShoppingCart"] as $item){            
                //Get Data
                $ItemID = $item["ItemID"];
                $Quantity = $item["Quantity"];
                $ItemPrice = $item["Quantity"] * $item["SellPrice"];  
                $PurchaseDate = date('Y/m/d');
                $GenerateID = rand(31, 1000000);
                
                //Inserting purchased item into DB with tbl_Order ID as foreign key
                $insertOrderItem = "INSERT INTO tbl_OrderItem (OrderItemID ,OrderID, ItemID, Quantity, SellPrice, PurchaseDate) 
                VALUES ('$GenerateID', '$GenerateOrderID', '$ItemID', '$Quantity', '$ItemPrice', '$PurchaseDate')";

                $dbQuantity = $db_handle->executeSQL("SELECT Quantity FROM tbl_item WHERE ItemID = '" . $ItemID . "'"); 
               
                if(!empty($dbQuantity))
                {    
                    foreach ($dbQuantity as $key => $value) {
                        $dbQuantityValue = $dbQuantity[$key]["Quantity"];
                    }
                }                             

                $newStockQuantity = $dbQuantityValue - $Quantity;

                if($newStockQuantity >= 0)
                {
                    //Inserting purchased item into DB with tbl_Order ID as foreign key
                    $sqlLessenQuantity = "UPDATE tbl_item SET Quantity='$newStockQuantity' WHERE ItemID = '" . $ItemID . "'"; 
                }                       

                if(!empty($insertOrderItem) && !empty($sqlLessenQuantity))
                {    
                    //Executing insert queries                
                    $db_handle->executeInsert($insertOrderItem);
                    $db_handle->executeUpdate($sqlLessenQuantity);
                    //Calling Bootstrap Modal
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#checkout").modal("show");
                    });
                    </script>';  
                }  
                else {
                    //Calling Bootstrap Modal
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#errorModal").modal("show");
                    });
                    </script>';   
                }          
            }
        }
        else {
            //Calling Bootstrap Modal
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#errorModal").modal("show");
            });
            </script>';   
        }        
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
                        <div><?php echo "<b>$Description</b>"; ?></div>
                        <div><?php echo "<u>$randAmount</u>". "" ."<u>$SellPrice</u>"; ?></div>      
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
                    <h5 class="modal-title">Order Placed</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">   
                <!-- (base64-images. 2021.) -->
                    <img class="shopping_cart_icon" src="data:image/png;base64,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" alt="Order Placed" /></a></td>  
                    <div style="text-align:center"><h5><b>Your order has been placed successful.</b></h5></div></br>
                    <?php
                    //Getting item purchase details (Address & OrderNumber)
                        $deliveryAddress = $db_handle->executeSQL("SELECT DeliveryAddress FROM tbl_User WHERE UserID = $session_UserID");
                    ?>
                        <?php
                            if (!empty($deliveryAddress))
                            {?> 
                                <?php		
                                foreach ($deliveryAddress as $key => $value){
                                    ?>
                                    
                                    <div style="text-align:center">
                                        <b><?php
                                        echo "Delivery Address:  "; ?></b></br><u><?php 
                                        echo $deliveryAddress[$key]["DeliveryAddress"]; ?></u></br></br><?php 
                                        ?>
                                    </div>  
                                    <?php
                                }
                                ?>
                                <div style="text-align:center">
                                    <b><?php
                                    echo "Your Tracking and Order Number:  "; ?></b></br><u><?php 
                                    echo $GenerateOrderID; 
                                    ?></u>
                                </div>
                            <?php
                            }                                              
                    
                    ?>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>

<?php   
    //Refresh Page
    echo '<script type="text/javascript">
    $(document).on( "click", "#close", function() {
        location.href = "http://localhost/WEDE6011_POE/myShop.php?action=clear-cart";
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
                    <h5 class="modal-title">Item Message</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">  
                   <div style="text-align:center">
                   <!-- (flaticon.com. 2021.) -->
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

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="errorModal">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title">Error Placing Order</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">  
                   <img class="shopping_cart_icon" style="margin-bottom:10px" src="https://cdn0.iconfinder.com/data/icons/shift-free/32/Error-512.png" alt="Error" /></a></td>  
                   <div style="text-align:center">There was an error placing your order. Please try again later.</div>
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
    <div class="modal" id="logOut">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title">Continue logging out?</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">  
                  <div style="text-align:center">
                  <!-- (pinimg.com. 2021.) -->
                  <img class="shopping_cart_icon" style="margin-bottom:10px" src="https://i.pinimg.com/originals/24/2d/c2/242dc2fd066c6c8e36eff57b81275619.png" alt="Logout?" /></a></td>
                      <?php                         
                        if(!empty($_SESSION["myShoppingCart"]))
                        {
                            echo "Continue logging out? All cart items added will be cleared for a safer online shopping experience."; 
                        }      
                        else
                        {
                            echo "Are you sure you want to log out?"; 
                        }  
                        ?>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="logout" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
</html>

<?php   
    //Log Out
    echo '<script type="text/javascript">
    $(document).on( "click", "#logout", function() {
        location.href = "http://localhost/WEDE6011_POE/index.php";
    });
    </script>';  
?>