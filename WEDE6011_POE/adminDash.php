<!-- Keegan Verwey -->
<!-- 19004753 --> 
<?php
session_set_cookie_params(3600,"/");
session_start();

//Taking console errors away
error_reporting(E_ALL ^ E_NOTICE);

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
        <title>ED Admin Dashboard</title>
         <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="stylesheet.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
        <!-- (Ajax.googleapis.com. 2021) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>        
    </head>
    <body class = "dashboard_bgrd">
   
    <h1 class="offset-4 dash_heading">ED Admin Dashboard</h1>

    <div class="form-group col-sm-12 row parent" style="margin-left:60px">

        <!-- Determining admin login or URL load HTML -->
        <?php if(!empty($session_UserN) && !empty($session_UserS))
        {?>
            <div class = "col-sm-9 mt-3 dash_subheading">
                <h4><?php echo "ADMIN USER:". " " ."<b>$session_UserN</b>". " " ."<b>$session_UserS</b>"; ?></h4>            
            </div>
        <?php
        }
        else {?>
            <div class = "col-sm-9 mt-3 dash_subheading">
                <h4><?php echo "The Dive Shop:" ?></h4>            
            </div>
        <?php
        }?>
       
        <form action="index.php?" method="post">
            <input type = "submit" name = "btnLogOut" class ="mt-3 buttons sizingLogout float-right" value = "LOG OUT">
        </form>      
    </div> 

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


    <!-- UI for filtering upon items -->
    <form id="filter" class="offset-3" action = "" method = "post"> 
        <input class="input_fields_filter" name = "txtSearch" placeholder="Enter search field..." type = "text" value="<?php if (isset($_POST['txtSearch'])) echo $_POST['txtSearch']; ?>"/>
        <button type="submit" title="Filter Items" id="submit" name = "btnSearch" class="btn_filter col-sm-12">FILTER ITEM</button>   
        <button type="submit" title="View All Items" id="submit" name = "btnFilterAll" class="btn_filter col-sm-12">VIEW ALL ITEMS</button>   
    </form>

    <?php
    //Filtering upon searchable item data or upon all item data
        if (isset($_POST['btnSearch']))
        {
            $Filter = $_POST['txtSearch'];
            if(!empty($Filter))
            {
                $Filter = str_replace(" ", "-", $Filter);

                $dive_listItems = $db_handle->executeSQL("SELECT * FROM tbl_item WHERE Description LIKE '$Filter' AND IsDeleted = 0");
                if(empty($dive_listItems))
                {?>
                <div class="row offset-3">
                <!-- (medium.com. 2021.) -->
                    <img class="img_filter" id="filterImg" src="https://miro.medium.com/max/1600/1*zRvYJWeLF5dcxM1G2hcEHA.jpeg" alt="No Items Found">
                </div>
               <?php }
            }
            else {
                $dive_listItems = $db_handle->executeSQL("SELECT * FROM tbl_item WHERE IsDeleted = 0 ORDER BY SellPrice ASC");
            }
        } 
        if (isset($_POST['btnFilterAll']))
        {
            $dive_listItems = $db_handle->executeSQL("SELECT * FROM tbl_item WHERE IsDeleted = 0 ORDER BY SellPrice ASC");
        } 
    ?>

    <?php
        $randAmount = "R";
        $sell = "(S) ";
        $cost = "(C) ";
        ?>

        <div class="row" style="margin-left:110px">
            <?php
            //If DB call not null 
            if(!empty($dive_listItems))
            {
                //For each row in tbl_item devide it into different key values 
                //and add it into HTML until loop is finished or in other words
                //until it reaches the end of tbl_item
                foreach ($dive_listItems as $key => $value) {
                    if($dive_listItems[$key]["Quantity"] > 0)
                    { ?>
                        <div class = "row item_group">
                            <!-- Item Description being echoed into the URL -->
                            <form method = "post" action = "adminDash.php?action=cart&desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  

                            <!-- Edit button -->
                            <button title="Edit Item" class = "add_to_cart_btn float-right" type="submit" name = "btnEditItem">
                                    <span aria-hidden="true"><img class = "add-cart-img" src="https://upload.wikimedia.org/wikipedia/en/thumb/8/8a/OOjs_UI_icon_edit-ltr-progressive.svg/1024px-OOjs_UI_icon_edit-ltr-progressive.svg.png"></span>
                            </button>      
                            
                            <?php
                            //Item Description
                            $Desc = $dive_listItems[$key]["Description"];
                            //Item Sell Price
                            $SellPrc = $dive_listItems[$key]["SellPrice"];
                            //Item Cost Price
                            $CostPrc = $dive_listItems[$key]["CostPrice"];
                            //Quantity
                            $Quantity = $dive_listItems[$key]["Quantity"];
                            ?>
                            
                            <!-- Echo Item Description -->
                            <div class = "cart_Font"><?php echo "<b>$Desc</b>"; ?></h4></div>
                            <!-- Echo Sell Price with rand("R") variable -->
                            <div class = "cart_Font"><?php echo "<u>$randAmount</u>". "" ."<u>$CostPrc</u>". "" ."<u>$cost</u>". "" ."<u>$randAmount</u>". "" ."<u>$SellPrc</u>". "" ."<u>$sell</u>"; ?></h4></div>    
                        
                            <!-- Item Image -->
                            <img style="margin-left:5px" class = "item_img" src="<?php echo $dive_listItems[$key]["ItemImg"]; ?> ">

                            <!--Soft Delete & Quantity-->
                            <!-- (iconfinder.com. 2021.) -->
                            <div style="margin-left:5px">
                                <div class = "cart_Font">       
                                    <button class = "add_to_cart_btn" title="Soft delete item and remove from shop" type="submit" name = "btnSoftDeleteItem">
                                        <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn0.iconfinder.com/data/icons/glyph-set-two/32/glyph-set-two-18-512.png"></span>
                                    </button>      
                                    <?php echo "<b>$Quantity</b>". "" ."<b>  In Stock</b>"; ?></h4>
                                </div>                          
                            </div>

                            </form>

                            <form method = "post" action = "adminDash.php?action=desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  
                            <!-- Delete button -->
                                <button class = "add_to_cart_btn" title="Delete item from shop and from all orders" type="submit" name = "btnDeleteItem">
                                    <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-coloricon-1/21/52-512.png"></span>
                                </button>        
                            </form>
                        </div>
                    <?php
                     }
                     else if($dive_listItems[$key]["Quantity"] <= 0)
                     { 
                     ?>
                         <div class = "row item_group">
                            <!-- Item Description being echoed into the URL -->
                            <form method = "post" action = "adminDash.php?action=cart&desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  

                            <!-- Edit button -->
                            <button title="Edit Item" class = "add_to_cart_btn float-right" type="submit" name = "btnEditItem">
                                    <span aria-hidden="true"><img class = "add-cart-img" src="https://upload.wikimedia.org/wikipedia/en/thumb/8/8a/OOjs_UI_icon_edit-ltr-progressive.svg/1024px-OOjs_UI_icon_edit-ltr-progressive.svg.png"></span>
                            </button>      
                            
                            <?php
                            //Item Description
                            $Desc = $dive_listItems[$key]["Description"];
                            //Item Sell Price
                            $SellPrc = $dive_listItems[$key]["SellPrice"];
                            //Item Cost Price
                            $CostPrc = $dive_listItems[$key]["CostPrice"];
                            //Quantity
                            $Quantity = $dive_listItems[$key]["Quantity"];
                            ?>
                            
                            <!-- Echo Item Description -->
                            <div class = "cart_Font"><?php echo "<b>$Desc</b>"; ?></h4></div>
                            <!-- Echo Sell Price with rand("R") variable -->
                            <div class = "cart_Font"><?php echo "<u>$randAmount</u>". "" ."<u>$CostPrc</u>". "" ."<u>$cost</u>". "" ."<u>$randAmount</u>". "" ."<u>$SellPrc</u>". "" ."<u>$sell</u>"; ?></h4></div>    
                        
                            <!-- Item Image -->
                            <div class="img_container">
                                <img style="margin-left:5px; opacity:0.5" class = "item_img" src="<?php echo $dive_listItems[$key]["ItemImg"]; ?> ">
                                <div class="centered"><h3>OUT OF STOCK</h3></div>
                            </div>

                           <!--Soft Delete & Quantity-->
                           <!-- (iconfinder.com. 2021.) -->
                           <div style="margin-left:5px">
                                <div class = "cart_Font">       
                                    <button class = "add_to_cart_btn" title="Soft delete item and remove from shop" type="submit" name = "btnSoftDeleteItem">
                                        <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn0.iconfinder.com/data/icons/glyph-set-two/32/glyph-set-two-18-512.png"></span>
                                    </button>      
                                    <?php echo "<b>$Quantity</b>". "" ."<b>  In Stock</b>"; ?></h4>
                                </div>                          
                            </div>

                            </form>

                            <form method = "post" action = "adminDash.php?action=desc=<?php echo $dive_listItems[$key]["Description"]; ?>">  
                            <!-- Delete button -->
                                    <button class = "add_to_cart_btn" title="Delete item from shop and from all orders" type="submit" name = "btnDeleteItem">
                                        <span aria-hidden="true"><img class = "add-cart-img" src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-coloricon-1/21/52-512.png"></span>
                                    </button>        
                            </form>
                        </div>
                     <?php
                     }
                }
            }
            ?>
        </div>

        <div class="row-spacing"></div>

        <h1 class="row offset-5 dash_heading">Edit Item</h1> 

        <!-- Check to see if an item is being edited -->
        <?php
            if(isset($_GET['desc']))
            {?>
                <div class="cart_container_admin_edit fade_shop_header">
                   <label class="txt-heading col-sm-8 mt-3"><b>Editing Item: <u><?php echo $_GET['desc']; ?></u> </b></label>              
                </div>      
        <?php
            }
            else { ?>
            <div class="cart_container_admin_edit fade_shop_header">
                <label class="txt-heading col-sm-8 mt-3"><b>Editing Item: <u>No Item Selected</u> </b></label>              
            </div>      
        <?php
            }
        ?>      

        <!-- Responsive table UI for editing an item -->
        <table id="edit" class="tbl-cart cart_container_admin_edit fade_shop_header" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th class="cart_desc_admin">Item Description</th>
                    <th class="cart_quantity_admin">Quantity</th>
                    <th class="cart_cost_admin">Cost Price</th>
                    <th class="cart_price_admin">Selling Price</th>
                    <th class="cart_remove_admin"></th>
                </tr>
                
                <tr>
                <form action = "" method = "post">

                    <?php
                        if(isset($_GET['desc']))
                        {?>
                            <td class="cart_desc_admin"><input name="txtDesc" type="text" placeholder="Please enter description"
                                value="<?php echo $_GET['desc']; ?>"/>
                            </td> 
                    <?php
                        }
                        else { ?>
                        <td class="cart_desc_admin"><input name="txtDesc" type="text" placeholder="Please enter description"
                            value="No Item Selected"/>
                        </td>
                    <?php
                        }
                    ?>
                            
                    <td class="cart_quantity_admin"><input type="number" step="1"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                        class="item_quantity cart_Font" name="txtQuantity" value="1" size="2" min="1"
                        value="<?php if (isset($_POST['txtQuantity'])) echo $_POST['txtQuantity']; ?>"/>
                    </td>

                    <td class="cart_cost_admin">R<input type="number" class="item_quantity cart_Font" 
                        name="txtCostPrice" value="1" size="2" min="1" step="0.01" 
                        value="<?php if (isset($_POST['txtCostPrice'])) echo $_POST['txtCostPrice']; ?>"/>
                    </td>

                    <td class="cart_price_admin">R<input type="number" class="item_quantity cart_Font" 
                        name="txtSellPrice" value="1" size="2" min="1" step="0.01"  
                        value="<?php if (isset($_POST['txtSellPrice'])) echo $_POST['txtSellPrice']; ?>"/>
                    </td> 

                    <td>
                        <button class = "btnEdit" type="submit" name = "btnSubmitEdit">Submit</button>
                    </td>
                </form>
                </tr>

                <tr>
                    <td colspan="2" align="right"></td>
                    <td align="right"></td>
                    <td align="right"></td>
                    <td align="right"></td>        
                </tr>
            </tbody>
        </table>	
        <div class="row-spacing"></div>
        
        <!-- Responsive table UI for adding an item -->
        <h1 class="offset-5 dash_heading">Add New Item</h1> 

        <table class="tbl-cart cart_container_admin_add" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th class="cart_upload_admin">Upload Image</th>
                    <th class="cart_desc_admin">Item Description</th>
                    <th class="cart_quantity_admin">Quantity</th>
                    <th class="cart_cost_admin">Cost Price</th>
                    <th class="cart_price_admin">Selling Price</th>
                    <th class="cart_remove_admin"></th>
                </tr>
                
                <tr>
                <form action = "adminDash.php" method = "post" enctype="multipart/form-data">

                    <td class="cart_upload_admin">
                        <input type="file" name="file" value="<?php if (isset($_POST['file'])) echo $_POST['file']; ?>">
                    </td>

                    <td class="cart_desc_admin"><input name="txtAddDesc" type="text" placeholder="Please enter description"
                        value="<?php if (isset($_POST['txtAddDesc'])) echo $_POST['txtAddDesc']; ?>"/>
                    </td> 
                            
                    <td class="cart_quantity_admin"><input type="number" step="1"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                        class="item_quantity cart_Font" name="txtQuantityAdd" value="1" size="2" min="1"
                        value="<?php if (isset($_POST['txtQuantityAdd'])) echo $_POST['txtQuantityAdd']; ?>"/>
                    </td>

                    <td class="cart_cost_admin">R<input type="number" class="item_quantity cart_Font" 
                        name="txtCostPriceAdd" value="1" size="2" min="1" step="0.01" 
                        value="<?php if (isset($_POST['txtCostPriceAdd'])) echo $_POST['txtCostPriceAdd']; ?>"/>
                    </td>

                    <td class="cart_price_admin">R<input type="number" class="item_quantity cart_Font" 
                        name="txtSellPriceAdd" value="1" size="2" min="1" step="0.01"  
                        value="<?php if (isset($_POST['txtSellPriceAdd'])) echo $_POST['txtSellPriceAdd']; ?>"/>
                    </td> 

                    <td class="cart_addBtn_admin">
                        <button class = "btnAddNewItem" type="submit" name = "btnAddNewItem">Add Item</button>
                    </td>
                </form>
                </tr>

                <tr>
                    <td colspan="2" align="right"></td>
                    <td align="right"></td>
                    <td align="right"></td>
                    <td align="right"></td>   
                    <td align="right"></td>        
                </tr>
            </tbody>
        </table>	

        	
        <div class="row-spacing"></div>
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

    if (isset($_POST['btnAddNewItem'])) 
    {
        //(11zon.com.)
        $AddDesc = $_POST['txtAddDesc'];
        $AddQuantity = $_POST['txtQuantityAdd'];
        $AddCost = $_POST['txtCostPriceAdd'];
        $AddSell = $_POST['txtSellPriceAdd'];


        //Checking if TABLE tbl_item exists
        $result = ("SELECT * FROM tbl_item WHERE Description= '$AddDesc'");    
        $res = mysqli_query($connectionString, $result);


        if($res)
        {
            $row = mysqli_num_rows($res);

            //Check to see if item exists in DB
            if ($row == 1)
            {
                $modalTitle = "Item Already Exists";
                $modalBody = "Please rename your item description, the item you are trying to add already exists.";
                echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#validationModal").modal("show");
                });
                </script>';  
            }
            //If item does not exist in DB
            else if($row == 0)
            {
                if(!empty($AddDesc) && !empty($AddQuantity) && !empty($AddCost) && !empty($AddSell))
                {
                    $statusMsg = '';
        
                    // File upload path
                    $targetDir = "SCUBA_images-list/";
                    $fileName = basename($_FILES["file"]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                    
                    if(!empty($_FILES["file"]["name"])){
                        // Allow certain file formats
                        $allowTypes = array('jpg','png','jpeg');
                        if(in_array($fileType, $allowTypes)){
                            // Upload file to server
                            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                                // Insert image file name into database
                                $AddDesc = str_replace(" ", "-", $AddDesc);

                                //Insert data into DB
                                //(w3schools.com. 2021.)
                                $GenerateID = rand(31, 1000000); 
                                $insert = "INSERT INTO tbl_item (ItemID ,ItemImg, Description, CostPrice, Quantity, SellPrice) 
                                           VALUES ('$GenerateID', 'SCUBA_images-list/" . $fileName . "', '$AddDesc', '$AddCost', '$AddQuantity', '$AddSell')";
        
                                $db_handle->executeInsert($insert);
        
                                if($insert)
                                {
                                    $modalTitleAdd = "New Item Added";
                                    $modalBodyAdd = "A new item has been uploaded successfully.";
                                    echo '<script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#addSuccess").modal("show");
                                    });
                                    </script>';     
                                }
                                else {                            
                                    $modalTitle = "Upload Failed";
                                    $modalBody = "File upload failed, please try again.";
                                    echo '<script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#validationModal").modal("show");
                                    });
                                    </script>';  
                                } 
                            }
                            else {
                                $modalTitle = "Upload Failed";
                                $modalBody = "File upload failed, please try again.";
                                echo '<script type="text/javascript">
                                $(document).ready(function(){
                                    $("#validationModal").modal("show");
                                });
                                </script>';
                            }
                        }
                        else {
                            $modalTitle = "Unsupported File Type";
                            $modalBody = "File upload failed, only JPG, JPEG & PNG files are accepted, please try again.";
                            echo '<script type="text/javascript">
                            $(document).ready(function(){
                                $("#validationModal").modal("show");
                            });
                            </script>';
                        }
                    }
                    else {
                        $modalTitle = "Add File";
                        $modalBody = "Please select a file to upload.";
                        echo '<script type="text/javascript">
                        $(document).ready(function(){
                            $("#validationModal").modal("show");
                        });
                        </script>';
                    }
                }
                //If inputs not all filled in, call modal popup and set pop data
                else if(empty($AddDesc) || empty($AddQuantity) || empty($AddCost) || empty($AddSell)) {
                    $modalTitle = "Validation Message";
                    $modalBody = "Please fill in all fields.";
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#validationModal").modal("show");
                    });
                    </script>';            
                }   
            }    
        }    
    }

    if (isset($_POST['btnDeleteItem']))
    {  
        //SELECT all from tbl_item
        $itemCheck = $db_handle->executeSQL("SELECT * FROM tbl_item");

         //If DB call not null 
        if(!empty($itemCheck))
        {
            foreach($itemCheck as $key => $value){

                if(stripos($_SERVER['REQUEST_URI'], $itemCheck[$key]["Description"]) !== false)
                //(PHP, C. and Nunez, S., 2021. Check if URL has certain string with PHP)
                { 
                    $dbItemCode = $itemCheck[$key]['ItemID'];

                    $itemCheckDelete = $db_handle->executeSQL("SELECT OrderID FROM tbl_orderitem WHERE ItemID='$dbItemCode'");
                    if(!empty($itemCheckDelete))
                    {
                        foreach($itemCheckDelete as $key => $value){
                            $dbSubDelete = $itemCheckDelete[$key]['OrderID'];
     
                            //Hard delete from all tables
                            $deleteFromTblOrderItem = "DELETE FROM tbl_orderitem WHERE OrderID='" . $dbSubDelete . "'";           
                            $deleteFromTblOrder = "DELETE FROM tbl_order WHERE OrderID='" . $dbSubDelete . "'";
                            $deleteFromTblItem = "DELETE FROM tbl_item WHERE ItemID='" . $dbItemCode . "'";
     
                            if(!empty($deleteFromTblOrderItem) && !empty($deleteFromTblOrder) && !empty($deleteFromTblItem))
                             {
                                 $db_handle ->executeDelete($deleteFromTblOrderItem);
                                 $db_handle ->executeDelete($deleteFromTblOrder);
                                 $db_handle ->executeDelete($deleteFromTblItem);                           
     
                             }    
                             else {
                                 $modalTitle = "Error Deleting Item";
                                 $modalBody = "Could not delete item.";
                                 echo '<script type="text/javascript">
                                 $(document).ready(function(){
                                     $("#validationModal").modal("show");
                                 });
                                 </script>';      
                            } 
                        }  
                    }
                    else{
                        $modalTitle = "Error Deleting Item";
                        $modalBody = "Could not delete item.";
                        echo '<script type="text/javascript">
                        $(document).ready(function(){
                            $("#validationModal").modal("show");
                        });
                        </script>';      
                    } 
                         
                }       
            }
            $itemCheckDeleteSuccess = $db_handle->executeSQL("SELECT OrderID FROM tbl_orderitem WHERE ItemID='$dbItemCode'");
                    
            if(empty($itemCheckDeleteSuccess))
            {
                $modalMessage = "Your item was deleted successfully. No users will be able to see this item as it is hard deleted from the system and can't be tracked anymore.";

                //Calling Bootstrap Modal
                echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#deleteItem").modal("show");
                });
                </script>';   
            }           
        }  
        else {
            $modalTitle = "Error Deleting Item";
            $modalBody = "Could not delete item.";
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#validationModal").modal("show");
            });
            </script>';      
        }     
    }

    if (isset($_POST['btnSoftDeleteItem']))
    {  
        //SELECT all from tbl_item
        $itemCheck = $db_handle->executeSQL("SELECT * FROM tbl_item");

         //If DB call not null 
        if(!empty($itemCheck))
        {
            foreach($itemCheck as $key => $value){

                if(stripos($_SERVER['REQUEST_URI'], $itemCheck[$key]["Description"]) !== false)
                //(PHP, C. and Nunez, S., 2021. Check if URL has certain string with PHP)
                { 
                    $dbItemCode = $itemCheck[$key]['ItemID'];

                    if(!empty($dbItemCode))
                    {
                        //Soft delete from item table
                        $updateIsDeleted = "UPDATE tbl_item SET IsDeleted = 1 WHERE ItemID = '$dbItemCode'";  
     
                            if(!empty($updateIsDeleted))
                             {
                                 $db_handle ->executeUpdate($updateIsDeleted);  
                                 
                                 $modalMessage = "Your item was deleted successfully. No users will be able to see this item as it is soft deleted from the system. They will however
                                 still see their history for this item.";
                                 //Calling Bootstrap Modal
                                 echo '<script type="text/javascript">
                                 $(document).ready(function(){
                                     $("#deleteItem").modal("show");
                                 });
                                 </script>';   
     
                             }    
                             else {
                                 $modalTitle = "Error Deleting Item";
                                 $modalBody = "Could not delete item.";
                                 echo '<script type="text/javascript">
                                 $(document).ready(function(){
                                     $("#validationModal").modal("show");
                                 });
                                 </script>';      
                            }                                  
                    }
                    else{
                        $modalTitle = "Error Deleting Item";
                        $modalBody = "Could not delete item.";
                        echo '<script type="text/javascript">
                        $(document).ready(function(){
                            $("#validationModal").modal("show");
                        });
                        </script>';      
                    }                          
                }       
            }         
        }  
        else {
            $modalTitle = "Error Deleting Item";
            $modalBody = "Could not delete item.";
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#validationModal").modal("show");
            });
            </script>';      
        }     
    }

    if (isset($_POST['btnSubmitEdit']))
    {
        $Desc = $_POST['txtDesc'];
        $Quantity = $_POST['txtQuantity'];
        $Cost = $_POST['txtCostPrice'];
        $Sell = $_POST['txtSellPrice'];

        //When all inputs filled
        if(!empty($Desc) && !empty($Quantity) && !empty($Cost) && !empty($Sell))
        {
            if(isset($_GET["desc"]))
            {
               //Checking if TABLE tbl_item exists
               $result = ("SELECT * FROM tbl_item WHERE Description= '" . $_GET["desc"] . "'");    
               $res = mysqli_query($connectionString, $result);
            }             
            else {
                $modalTitle = "No Item Selected";
                $modalBody = "Please select an item to edit.";
                echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#validationModal").modal("show");
                });
                </script>';  
            } 

            if($res)
            {
                //Updating item in the Database
                if(isset($_GET["desc"]))
                {
                    $Desc = str_replace(" ", "-", $Desc);

                    $sql = "UPDATE tbl_item SET Description='$Desc', Quantity=$Quantity, CostPrice=$Cost, SellPrice=$Sell 
                    WHERE Description = '" . $_GET["desc"] . "'";
                }
                else {
                    $modalTitle = "No Item Selected";
                    $modalBody = "Please select an item to edit.";
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#validationModal").modal("show");
                    });
                    </script>';  
                }
                    
                if (!empty($sql))
                {
                    //If succeeds show modal popup success
                    $db_handle ->executeUpdate($sql);
                    $modalTitleSuccess = "Item Edited";
                    $modalBodySuccess = "Item edited successful.";
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#editSuccess").modal("show");
                    });
                    </script>'; 
                }
                //Fail safe code catch
                else {
                    $modalTitle = "No Item Selected";
                    $modalBody = "Please select an item to edit.";
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#validationModal").modal("show");
                    });
                    </script>';  
                }                      
            }
                
        }        
         //If inputs not all filled in, call modal popup and set pop data
        else if(empty($Desc) || empty($Quantity) || empty($Cost) || empty($Sell)) {
            $modalTitle = "Validation Message";
            $modalBody = "Please fill in all fields.";
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#validationModal").modal("show");
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
    <div class="modal" id="deleteItem">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title">Deletion Message</h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pop_body">     
                <!-- (iconfinder.com. 2021.) -->
                   <img class="shopping_cart_icon" src="https://cdn4.iconfinder.com/data/icons/social-messaging-ui-coloricon-1/21/52-512.png" alt="Item Deleted" /></a></td>  
                   <div style="text-align:center"><?php echo "$modalMessage"; ?></div>
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
        location.href = "http://localhost/WEDE6011_POE/adminDash.php";
    });
    </script>';  
?>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="editSuccess">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title"><?php echo $modalTitleSuccess?></h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align:center">
                    <!-- (wikimedia.org. 2021.) -->
                        <img class="shopping_cart_icon" src="https://freeiconshop.com/wp-content/uploads/edd/edit-flat.png" alt="Item Edited" /></a></td>  
                        <p><?php echo $modalBodySuccess?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="addSuccess">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title"><?php echo $modalTitleAdd?></h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align:center">
                    <!-- (thenounproject.com. 2021.) -->
                        <img class="shopping_cart_icon" src="https://static.thenounproject.com/png/2564306-200.png" alt="New Item" /></a></td>  
                        <p><?php echo $modalBodyAdd?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>

<!-- Responsive Bootstrap Modal HTML -->
<!-- (Stackpath.bootstrapcdn.com. 2021) -->
<html>
    <div class="modal" id="validationModal">
        <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header modal_background">
                    <h5 class="modal-title"><?php echo $modalTitle?></h5>
                    <button type="button" class="close exit_modal" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align:center">
                        <img class="shopping_cart_icon" src="https://www.freeiconspng.com/uploads/orange-error-icon-0.png" alt="Validation IMG" /></a></td>  
                        <p><?php echo $modalBody?></p>
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
                  <img class="shopping_cart_icon" style="margin-bottom:10px" src="https://i.pinimg.com/originals/24/2d/c2/242dc2fd066c6c8e36eff57b81275619.png" alt="Logout?" /></a></td>
                      <?php                         
                        echo "Are you sure you want to log out?";  
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
