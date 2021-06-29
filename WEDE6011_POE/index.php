<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php
session_start();
?>
<html>
    <head>
        <title>Extreme Diving Login</title>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="stylesheet.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
        <!-- (Ajax.googleapis.com. 2021) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>
    <!-- Responsive login page HTML -->
    <body class = "bgd_img">
        <div class = "body">

            <form action = "index.php" method = "post"> 
                <div class="row-spacing"></div> 
                <div class="container">
                    <h1>EXTREME DIVE SHOP LOGIN</h1>

                    <label for="txtEmail"><b>Email:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtEmail" type = "text" placeholder = "Please enter email"
                    value="<?php if (isset($_POST['txtEmail'])) echo $_POST['txtEmail']; ?>"/>

                    <label for="txtPassword"><b>Password:</b></label>
                    <!-- Sticky Form -->
                    <input class="input_fields" name = "txtPassword" type = "password" placeholder = "Please enter password"
                        value="<?php if (isset($_POST['txtPassword'])) echo $_POST['txtPassword']; ?>"/>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" name = "btnLogin" class="btn_login-signup col-sm-3">LOGIN</button>
                            <button type="submit" name = "btnRegister" class="btn_login-signup col-sm-3" style="margin-left:93px">SIGN UP</button>
                            <!-- (W3schools.com. 2021.) -->
                            <button type="submit" name = "btnCancel" class="btn_cancel col-sm-3" style="margin-left:93px">CANCEL</button>
                        </div>
                    </div>        
                    <button type="submit" name = "btnBackToLanding" class="btn_back col-sm-12">BACK TO HOME</button>     
                </div>
            </form>
        </div>
    </body>
</html>

<?php
//Taking console errors away
error_reporting (E_ALL ^ E_NOTICE);

//Establishing DB Connection and Migrating if needed
if (empty($_SESSION['completed'])){
    require_once("createTable.php");    
    $_SESSION['completed'] = TRUE;
 }
 else {
    require_once("DBConn.php");
 }

//Calling DBScriptExecution Class
$db_handle = new DBScriptExecution();

    if (isset($_POST['btnBackToLanding']))
    {
        //Routing to login screen
        header("Location: landingPage.php?");
        exit;
    }

    if (isset($_POST['btnCancel']))
    {
        //Refresh Page
        header("Location: index.php?");
        exit;
    }

if (isset($_POST['btnRegister']))
{
    //Routing to registration screen
    header("Location: registration.php?");
    exit;
}

if (isset($_POST['btnLogin']))
{
    //Passing Logged in Session User
    $passUserMail = $_POST['txtEmail'];
    $res = $db_handle->executeSQL("SELECT FName, LName, UserID FROM tbl_User WHERE Email = '".$passUserMail."'"); 

    if (!empty($res)) { 
        foreach($res as $key => $value){
        $session_UserN = $res[$key]['FName']; 
        $session_UserS = $res[$key]['LName']; 
        $session_UserID = $res[$key]['UserID'];       
        }
        $_SESSION['loggedUserN'] = $session_UserN;
        $_SESSION['loggedUserS'] = $session_UserS;
        $_SESSION['loggedUserID'] = $session_UserID;
    }

    $email = $_POST['txtEmail'];
    //Converting user password input to MD5 hash
    $password = $_POST['txtPassword'];
    $md5Password = md5($password);
    
    //When all inputs filled
    if(!empty($email) && !empty($password))
    {   
        //Select users in the Database   
        $dataResult = $db_handle->executeSQL("SELECT * FROM tbl_User WHERE Email = '".$email."'");  

        if (!empty($dataResult)) { 
            foreach($dataResult as $key => $value){
            //Setting user email and password
            $dbEmail = $dataResult[$key]['Email'];
            $dbHashed = $dataResult[$key]['Password'];
            $dbAdmin = $dataResult[$key]['IsAdmin'];
            }

            //Comparing User password to DB MD5 Hashed password
            if(hash_equals($md5Password, trim($dbHashed)) && $dbAdmin == "0")
            {
                unset($_SESSION["myShoppingCart"]);
                //If succeeds, route to dashboard page
                header("Location: myShop.php?");
                exit;
            }
            else if(hash_equals($md5Password, trim($dbHashed)) && $dbAdmin == "1")
            {
                //If succeeds, route to admin dashboard page
                header("Location: adminDash.php?");
                exit;
            }
            else { 
                //Calling modal popup and setting pop data
                $modalTitle = "Login Error";
                $modalBody = "Username or Password is incorrect.";
                echo '<script type="text/javascript">
                $(document).ready(function(){
                    $("#validationModal").modal("show");
                });
                </script>'; 
                            
            }
        }
        else {
            //Fail safe code catch
            $modalTitle = "Login Error";
            $modalBody = "Login credentials is invalid.";
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#validationModal").modal("show");
            });
            </script>'; 
        }
    }
    //If inputs not all filled in, call modal popup and set pop data
    else if(empty($email) && empty($password)){
        $modalTitle = "Validation Message";
        $modalBody = "Please fill in all fields.";
        echo '<script type="text/javascript">
        $(document).ready(function(){
            $("#validationModal").modal("show");
        });
        </script>';   
    }
}       

include_once("sendMail.php");

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
                    <img class="shopping_cart_icon" src="https://www.freeiconspng.com/uploads/orange-error-icon-0.png" alt="Please Sign In" /></a></td>  
                    <p style="text-align:center"><?php echo $modalBody?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>
