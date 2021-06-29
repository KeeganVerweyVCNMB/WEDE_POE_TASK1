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
        <title>Extreme Diving Profile</title>
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
            <form action = "myProfile.php" method = "post">    
            <div class="row-spacing-reg"></div> 
                <div class="container">
                    <h1>MY PROFILE</h1>

                    <?php
                    //SELECT all from tbl_User
                     $user_profile = $db_handle->executeSQL("SELECT * FROM tbl_User WHERE UserID = $session_UserID");
    
                    //If DB call not null 
                    if(!empty($user_profile))
                    {
                        //For each row in tbl_User devide it into different key values 
                        //and add it into HTML until loop is finished or in other words
                        //until it reaches the end of tbl_User
                        foreach ($user_profile as $key => $value) 
                        {?>
                            <label for="txtFName"><b>First Name:</b></label>
                            <input class="input_fields_profile" name = "txtFName" readonly type = "text" value="<?php echo $user_profile[$key]["FName"]; ?>"/>

                            <label for="txtLName"><b>Last Name:</b></label>
                            <input class="input_fields_profile" name = "txtLName" readonly type = "text" value="<?php echo $user_profile[$key]["LName"]; ?>"/>

                            <label for="txtAddressLine"><b>Address:</b></label>
                            <input class="input_fields_profile" name = "txtAddressLine" readonly type = "text" value="<?php echo $user_profile[$key]["DeliveryAddress"]; ?>"/>

                            <label for="txtEmail"><b>Email:</b></label>
                            <input class="input_fields_profile" name = "txtEmail" readonly type = "text" value="<?php echo $user_profile[$key]["Email"]; ?>"/>
                        <?php
                        }
                    }?>                  

                    <button type="submit" name = "btnEditProfile" class="btn_EditProfile col-sm-12">EDIT PROFILE</button>   
                    <button type="submit" name = "btnBack" class="btn_back col-sm-12">BACK TO DASHBOARD</button>     
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
        header("Location: myShop.php?");
        exit;
    }   

    if (isset($_POST['btnEditProfile']))
    {
        //Refresh Page
        header("Location: editProfile.php?");
        exit;
    }
?>

