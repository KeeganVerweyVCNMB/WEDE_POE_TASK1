<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php
session_start();
?>
<html>
    <head>
        <title>Extreme Diving Registration</title>
         <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="stylesheet.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
        <!-- (Ajax.googleapis.com. 2021) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- (Stackpath.bootstrapcdn.com. 2021) -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>
    <!-- Responsive registration page HTML -->
    <body class = "bgd_img">
        <div class = "body">
            <form action = "registration.php" method = "post">    
                <h1 class="offset-4 row">Extreme Diving Registration</h1>
                    <div class="offset-4 form-group row">
                        <label class="col-sm-2 col-form-label">First Name:</label>
                        <div class = "col-sm-10">
                            <!-- Sticky Form -->
                            <input onkeydown="return event.key != 'Enter';" name = "txtFName" type = "text" placeholder = "Please enter name"
                            value="<?php if (isset($_POST['txtFName'])) echo $_POST['txtFName']; ?>"/>
                        </div> 
                    </div>

                    <div class="offset-4 form-group row">
                        <label class="col-sm-2 col-form-label">Last Name:</label>
                        <div class = "col-sm-10">
                            <!-- Sticky Form -->
                            <input onkeydown="return event.key != 'Enter';" name = "txtLName" type = "text" placeholder = "Please enter surname"
                            value="<?php if (isset($_POST['txtLName'])) echo $_POST['txtLName']; ?>"/>
                        </div> 
                    </div>

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

                    <div class="offset-4 form-group row">
                        <div class="col-sm-12">
                            <input type = "submit" name = "btnReturn" class = "col-sm-3 buttons" value = "RETURN TO LOGIN">
                            <input type = "submit" name = "btnRegister" class = "col-sm-2 buttons" value = "SUBMIT">
                        </div>
                    </div> 
            </form>
        </div>
    </body>
</html>

<?php

//Establishing DB Connection
require_once("DBConn.php");
//Calling DBScriptExecution Class
$db_handle = new DBScriptExecution();

    if (isset($_POST['btnReturn']))
    {
        //Routing to login(index) screen
        header("Location: index.php?");
        exit;
    }

    if (isset($_POST['btnRegister']))
    {
        $FName = $_POST['txtFName'];
        $LName = $_POST['txtLName'];
        $email = $_POST['txtEmail'];
        $password = $_POST['txtPassword'];

        //Converting user password input to MD5 hash
        $md5RegPassword = md5($password);

        //Email validation
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
        {
            $modalTitle = "Email Validation Message";
            $modalBody = "Please ensure that you enter a valid email.";
            echo '<script type="text/javascript">
            $(document).ready(function(){
                $("#validationModal").modal("show");
            });
            </script>';   
        }
        else{
            //When all inputs filled
            if(!empty($FName) && !empty($LName) && !empty($email) && !empty($password))
            {
                //Inserting user inputs into the Database
                $sql = "INSERT INTO tbl_User (FName, LName, Email, Password)
                VALUES ('$FName', '$LName', '$email', '$md5RegPassword')";

                if (!empty($sql))
                {
                    //If succeeds, route to login(index) page
                    $db_handle ->executeInsert($sql);
                    header("Location: index.php?");
                    exit;
                }
                //Fail safe code catch
                else {
                    $modalTitle = "Registration Error";
                    $modalBody = "Error Registering New User.";
                    echo '<script type="text/javascript">
                    $(document).ready(function(){
                        $("#validationModal").modal("show");
                    });
                    </script>';   
                }  
                    
            }
            //If inputs not all filled in, call modal popup and set pop data
            else if(empty($FName) || empty($LName) || empty($email) || empty($password)) {
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

