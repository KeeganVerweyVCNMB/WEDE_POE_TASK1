<html>
    <head>
        <title>Login Page</title>
        <link href = "login.css" rel = "stylesheet" type = "text/css" />
    </head>
    <body>
        <div class = "body_design">
        <img src="https://centralaz.edu/wp-content/uploads/2017/08/CIS_Comp_Prog_Main_507378942.jpg" alt="Login App" class="image_spec">
        
            <form action = "LoginApp.php" method = "post">            
            <div class = "frame_design">
            <h1><u>LOGIN SYSTEM</u></h1>
            <table>
                <tr>
                    <td>
                        <div class = "control_font">
                            Username:
                        </div>
                    </td>

                    <td>            
                        <div class = "control_font">
                        <div class = "login_font"><input name = "txtUsername" type = "text" /></div> 
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class = "control_font">
                            Password:
                        </div>
                    </td>

                    <td>                    
                        <div class = "control_font">
                        <div class = "login_font"><input name = "txtPassword" type = "text" /></div> 
                        </div>
                    </td>

                </tr>
               
            </table>

            <table>
                <tr>
                    <td>
                        <input type = "submit" name = "btnLogin" class = "button_login" value = "LOGIN"><br>
                    </td>

                    <td>
                        <input type = "submit" name = "btnRegister" class = "button_register" value = "REGISTER"><br>
                    </td>
                </tr>
            </table>
           
            </form>
        </div>
        </div>
        <div class="copyright-message">
                <h6>Copyright @2021 by SPR Login Systems. All rights resereved. </br>  No part of this webpage may be reproduced or used 
                    without </br> &nbsp&nbsp&nbsp&nbsp any written permissions from the copyright owner. </br> &nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp This system is protected by AWS Systems.</h6>
            </div>
    </body>
</html>

<?php

session_start();
// $usernameList = array();
// $passwordList = array();


// Connect to DISD3_DATABASE
/////////////////////////////////////////////////////////////////////
$servername = "localhost";         
$username = "root";
$password = "";
$dbname = "DISD3_DATABASE";

// Create connection
$conn= mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected Successfully.";
/////////////////////////////////////////////////////////////////////


if (isset($_POST['btnRegister']))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    if($username != '' || $username != null || $username != "" && $password != '' || $password != null || $password != "")
    {
        // $_SESSION["usernameList"] = array();
        // $_SESSION["passwordList"] = array();

        // array_push($_SESSION["usernameList"], $username);
        // array_push($_SESSION["passwordList"], $password);

        $sql = "INSERT INTO Users (Username, UserPassword)
        VALUES ('$username', '$password')";

        if ($conn ->query($sql) === TRUE)
        {
           //echo("NEW RECORD ADDED SUCCESFULLY");
           echo '<script>alert("Registered Successful")</script>'; 
        }
        else {
         echo "ERROR: " .$sql. "<br>" . $conn->error;
        }
        //echo '<script>alert("Registered Successful")</script>';   
    }
    else {
        echo '<script>alert("Please fill in all fields")</script>';   
    }

    // print_r($_SESSION["usernameList"]);
    // print_r($_SESSION["passwordList"]);
        
}

if (isset($_POST['btnLogin']))
{
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    // if($username != 0 || $username != '' || $username != null || $username != "" && $password != 0 || $password != '' || $password != null || $password != "" && !empty($_SESSION["usernameList"]) && !empty($_SESSION["passwordList"]))
    if($username != 0 || $username != '' || $username != null || $username != "" && $password != 0 || $password != '' || $password != null || $password != "")
    {
        // $keyUsername = array_search($username, $_SESSION["usernameList"]);
        // print($keyUsername);
        // if($username == $_SESSION["usernameList"][$keyUsername] && $password == $_SESSION["passwordList"][$keyUsername])
        // {
        //     header("Location: homeScreen.php?");
        // }
        // else {
        //     echo '<script>alert("Invalid Login Credentials")</script>';   
        // }

        $result = ("SELECT * FROM Users WHERE Username = '$username' AND UserPassword = '$password'");    
        $res=mysqli_query($conn,$result);
         if (mysqli_num_rows($res) > 0) {
            echo '<script>alert("Login Succesfull")</script>';
            header("Location: homeScreen.php?");
        }
        else {
            echo '<script>alert("Invalid Login Credentials")</script>';   
        }
    }
    else {
        echo '<script>alert("Please fill in all fields")</script>';   
    }

} 
    
?>

