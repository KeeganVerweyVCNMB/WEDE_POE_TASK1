<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php
session_start();
?>
<html>
    <head>
        <title>ED Landing Page</title>
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
    <!-- Responsive landing page HTML -->
    <body class = "bgd_landingImg">
        <div class = "body">

            <form action = "landingPage.php" method = "post">  
            <div class="row col-sm-12"> 
                <img class="shop_logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLAiqydvgfFWYOg8Y6JsbA8qBaggMUhijrAA&usqp=CAU" alt="Dive Shop Logo" />
            </div>
            <div class="row-spacing-lndg"></div>

            <div class="row col-sm-12"> 
                <label class="offset-1 row landing_font fade_shop_header">COME DIVE WITH US</label></br>
            </div>
            <div class="row col-sm-12"> 
                <label class="offset-1 row landing_fontSub fade_shop_header">The best shopping experience in the ocean...</label>
            </div>
            <div class="row-spacing-buttons"></div>

            <div class="row col-sm-12"> 
                <input type = "submit" id="slideAdmin" name = "btnAdmin" class = "col-sm-2 offset-2 landing_buttons" value = "ADMIN">
            </div>
            <div class="row-spacing-buttons"></div>

            <div class="row col-sm-12"> 
                <input type = "submit" id="slideLogin" name = "btnNavToLogin" class = "col-sm-2 offset-2 landing_buttons" value = "LOGIN">
            </div>
            <div class="row-spacing-buttons"></div>

            <div class="row col-sm-12"> 
                <input type = "submit" id="slideSignUp" name = "btnNavToReg" class = "col-sm-2 offset-2 landing_buttons" value = "SIGN UP">
            </div>
            <div class="row-spacing-buttons"></div>

            <div class="row col-sm-12"> 
                <input type = "submit" id="slideBrowse" name = "btnBrowse" class = "col-sm-2 offset-2 landing_buttons" value = "SHOP">  
            </div>  
            <div class="col-sm-12" style="position:fixed; bottom:10px; width:100%;"> 
                <!-- (google.com. 2021.) -->
                <a href="https://www.google.com/maps/place/Pro+Dive+-+Scuba+Diving+Centre/@-33.9814625,25.5739453,17z/data=!3m1!4b1!4m5!3m4!1s0x1e7ad21b104f2a49:0xdae3af59fa0ce62!8m2!3d-33.981467!4d25.576134" class="fa fa-map-marker fa-lg float-right"></a>
                <!-- (youtube.com. 2021.) -->
                <a href="https://www.youtube.com/watch?v=SfkWI9L-854" class="fa fa-youtube fa-lg float-right"></a>
                <!-- (facebook.com. 2021.) -->
                <a href="https://www.facebook.com/search/top?q=mikes%20dive%20shop" class="fa fa-facebook fa-lg float-right"></a>
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
    $_SESSION['completed'] = TRUE;
 }
 else {
    require_once("DBConn.php");
 }

    if (isset($_POST['btnAdmin']))
    {
        //Routing to login screen
        header("Location: index.php?");
        exit;
    }
    if (isset($_POST['btnNavToLogin']))
    {
        //Routing to login screen
        header("Location: index.php?");
        exit;
    }
    if (isset($_POST['btnNavToReg']))
    {
        //Routing to registration screen
        header("Location: registration.php?");
        exit;
    }
    if (isset($_POST['btnBrowse']))
    {
        //Routing to browse screen
        header("Location: browse.php?");
        exit;
    }
?>