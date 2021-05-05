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
            <h1 class="offset-4 row">Extreme Diving Login</h1>
                <div class="offset-4 form-group row">
                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class = "col-sm-10">
                        <!-- Sticky Form -->
                        <input onkeydown="return event.key != 'Enter';" name = "txtEmail" type = "text" placeholder = "Please enter email"
                        value="<?php if (isset($_POST['txtEmail'])) echo $_POST['txtEmail']; ?>"/>
                    </div> 
                </div>

                <div class="offset-4 form-group row">
                    <label class="col-sm-2 col-form-label">Password:</label>
                    <div class = "col-sm-10">
                        <!-- Sticky Form -->
                        <input onkeydown="return event.key != 'Enter';" name = "txtPassword" type = "password" placeholder = "Please enter password"
                        value="<?php if (isset($_POST['txtPassword'])) echo $_POST['txtPassword']; ?>"/>
                    </div> 
                </div>

                <div class="offset-5 form-group row">
                  <div class="col-sm-12">
                      <input type = "submit" name = "btnLogin" class = "col-sm-2 buttons" value = "LOGIN">
                      <input type = "submit" name = "btnRegister" class = "col-sm-2 buttons" value = "REGISTER HERE">
                  </div>
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
    $res = $db_handle->executeSQL("SELECT FName, LName FROM tbl_User WHERE Email = '".$passUserMail."'"); 

    if (!empty($res)) { 
        foreach($res as $key => $value){
        $session_UserN = $res[$key]['FName']; 
        $session_UserS = $res[$key]['LName'];       
        }
        $_SESSION['loggedUserN'] = $session_UserN;
        $_SESSION['loggedUserS'] = $session_UserS;
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
            }

            //Comparing User password to DB MD5 Hashed password
            if(hash_equals($md5Password, trim($dbHashed)))
            {
                //If succeeds, route to dashboard page
                header("Location: dashboard.php?");
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
                    <p><?php echo $modalBody?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</html>
