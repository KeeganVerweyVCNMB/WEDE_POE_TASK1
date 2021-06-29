<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php
session_start();
ob_start();
//Establishing DB Connection
require_once("DBConn.php");

//Calling DBScriptExecution Class
$db_handle = new DBScriptExecution();

//Passed Logged in Session User
$session_UserID = $_SESSION['loggedUserID'];  
?>
<html>
    <head>
        <title>Extreme Diving Edit Profile</title>
         <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="stylesheet.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
        <!-- (Ajax.googleapis.com. 2021) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>

    <!-- Responsive user profile page HTML -->
    <body class = "bgd_img_profile">
        <div class = "body">
            <form action = "editProfile.php" method = "post">    
            <div class="row-spacing-reg"></div> 
                <div class="container">
                    <h1>EDIT PROFILE</h1>

                    <?php
                    //SELECT all from tbl_User
                     $user_profile = $db_handle->executeSQL("SELECT * FROM tbl_User WHERE UserID = $session_UserID");
    
                    //If DB call not null read data into inputs
                    if(!empty($user_profile))
                    {
                        foreach ($user_profile as $key => $value) 
                        {?>
                            <label for="txtFName"><b>First Name:</b></label>
                            <input class="input_fields_profileEdit" name = "txtFName" type = "text" value="<?php echo $user_profile[$key]["FName"]; ?>"/>

                            <label for="txtLName"><b>Last Name:</b></label>
                            <input class="input_fields_profileEdit" name = "txtLName" type = "text" value="<?php echo $user_profile[$key]["LName"]; ?>"/>

                            <label for="txtAddressLine"><b>Address:</b></label>
                            <input class="input_fields_profileEdit" name = "txtAddressLine" type = "text" value="<?php echo $user_profile[$key]["DeliveryAddress"]; ?>"/>

                            <label for="txtEmail"><b>Email:</b></label>
                            <input class="input_fields_profileEdit" name = "txtEmail" type = "text" value="<?php echo $user_profile[$key]["Email"]; ?>"/>
                        <?php
                        }
                    }?>                  

                    <button type="submit" name = "btnSubmit" class="btn_EditProfile col-sm-12">SUBMIT</button>   
                    <button type="submit" name = "btnBack" class="btn_back col-sm-12">BACK TO PROFILE</button>     
                    <button type="submit" name = "btnBackToDashboard" class="btn_back col-sm-12">BACK TO DASHBOARD</button>     
                </div> 
                <div class="row-spacing-reg"></div>                 
            </form>
        </div>
    </body>
</html>

<?php

    if (isset($_POST['btnBack']))
    {
        //Refresh Page
        header("Location: myProfile.php?");
        exit;
    }   
    if (isset($_POST['btnBackToDashboard']))
    {
        //Refresh Page
        header("Location: myShop.php?");
        exit;
    }   

    if (isset($_POST['btnSubmit']))
    {
        $Name = $_POST['txtFName'];
        $Surname = $_POST['txtLName'];
        $Address = $_POST['txtAddressLine'];
        $Email = $_POST['txtEmail'];

        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $Email))
        {
            $modalTitle = "Email Validation Message";
            $modalBody = "Please ensure that you enter a valid email.";
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#validationModal").modal("show");
            });
            </script>';   
        }
        //When all inputs filled
        else if(!empty($Name) && !empty($Surname) && !empty($Address) && !empty($Email))
        {
             //Updating user details in the Database
             $sql = "UPDATE tbl_User SET FName='$Name', LName='$Surname', DeliveryAddress='$Address', Email='$Email' 
             WHERE UserID = '$session_UserID'";
                 
             if (!empty($sql))
             {
                 //If succeeds show modal popup success
                 $db_handle ->executeUpdate($sql);
                 $modalTitleSuccess = "Profile Edited";
                 $modalBodySuccess = "Profile edited successful.";
                 echo '<script type="text/javascript">
                 $(document).ready(function(){
                     $("#editSuccess").modal("show");
                 });
                 </script>'; 
             }
             //Fail safe code catch
             else {
                 $modalTitle = "Update Profile Error";
                 $modalBody = "Please try again later.";
                 echo '<script type="text/javascript">
                 $(document).ready(function(){
                     $("#validationModal").modal("show");
                 });
                 </script>';  
             }            
                
        }        
         //If inputs not all filled in, call modal popup and set pop data
        else if(empty($Name) || empty($Surname) || empty($Address) || empty($Email)) {
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

<?php   
    //Refresh Page
    echo '<script type="text/javascript">
    $(document).on( "click", "#close", function() {
        location.href = "http://localhost/WEDE6011_POE/editProfile.php";
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
