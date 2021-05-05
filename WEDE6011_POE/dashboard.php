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
    </head>
    <body class = "dashboard_bgrd">
   
    <h1 class="offset-4 dash_heading">Extreme Diving Online Shop</h1> 
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

    <div class="form-group col-sm-12 row parent" style="margin-left:25px">
        <div class = "col-sm-8 mt-3 dash_subheading">
            <h4><?php echo "WELCOME USER:". " " ."<b>$session_UserN</b>". " " ."<b>$session_UserS</b>"; ?></h4>            
        </div>
        <input type = "submit" onclick="browse_Store('shopNow'); test('test');" name = "browse" class = "col-sm-2 mt-3 buttons sizingBrowse" value = "BROWSE/CLOSE STORE">&nbsp;
       
        <form action="index.php" method="post">
            <input type = "submit" name = "btnLogOut" class = "col-sm-2 mt-3 buttons sizingLogout" value = "LOG OUT">
        </form>      
    </div>    

    <?php

        //SELECT all from tbl_item
        $dive_listItems = $db_handle->executeSQL("SELECT * FROM tbl_item");
        $randAmount = "R";
        ?>

        <div id = "shopNow">
            <?php
            //If DB call not null 
            if(!empty($dive_listItems))
            {
                //For each row in tbl_item devide it into different key values 
                //and add it into HTML until loop is finished or in other words
                //until it reaches the end of tbl_item
                foreach ($dive_listItems as $key => $value) {
                ?>
                    <div class = "row item_group">
                        <!-- Item Description being echoed into the URL -->
                        <form method = "post" action = "dashboard.php?action=desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  

                        <!-- Add to cart button -->
                        <button class = "add_to_cart_btn float-right" type="submit" name = "btnAddItem">
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
                        <img class = "item_img" src="<?php echo $dive_listItems[$key]["ItemID"]; ?> ">

                        </form>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </body>
</html>

<?php

    if (isset($_POST['btnAddItem']))
    {
         //SELECT all from tbl_item
        $itemCheck = $db_handle->executeSQL("SELECT * FROM tbl_item");

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
                    $ItemID = $dive_listItems[$key]["ItemID"];
                    $Description = $dive_listItems[$key]["Description"];
                    $SellPrice = $dive_listItems[$key]["SellPrice"];   
                    
                    //Calling Bootstrap Modal
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#validationModal").modal("show");
                    });
                    </script>';   
                }
            }
        }      
    }
?>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="validationModal">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title">Cart Item</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">     
                    <img class = "cart_img_open" src="<?php echo $ItemID;?> ">    
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
