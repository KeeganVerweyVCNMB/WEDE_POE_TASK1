<?php 
//Keegan Verwey 
//19004753
include 'DBConn.php';

//Checking if TABLE tbl_user exists
$result = ("SELECT * FROM tbl_User");    
       $res = mysqli_query($connectionString, $result);

//If Table tbl_user exists, DROP TABLE and Re-Create, else create the table
if($res !== FALSE)
{
    $dropTable = ("DROP TABLE tbl_User");    
    $dropRes = mysqli_query($connectionString, $dropTable);   

    $latestTable = ("CREATE TABLE tbl_User(UserID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    FName TEXT NOT NULL,
    LName TEXT NOT NULL,
    Email TEXT NOT NULL,
    IsAdmin INT NOT NULL,
    DeliveryAddress TEXT NOT NULL,
    Password TEXT NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('userData.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($FName, $LName, $Email, $IsAdmin, $DelAddres, $Password) = $explodeLine;
        
        $qry = "INSERT INTO tbl_User (FName, LName, Email, IsAdmin, DeliveryAddress,  Password) 
        VALUES ('".$FName."','".$LName."','".$Email."','".$IsAdmin."','".$DelAddres."','".$Password."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}
else if($res !== TRUE)
{
    //Creating TABLE tbl_User
    $latestTable = ("CREATE TABLE tbl_User(UserID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    FName TEXT NOT NULL,
    LName TEXT NOT NULL,
    Email TEXT NOT NULL,
    IsAdmin INT NOT NULL,
    DeliveryAddress TEXT NOT NULL,
    Password TEXT NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('userData.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($FName, $LName, $Email, $IsAdmin, $DelAddres, $Password) = $explodeLine;
        
        $qry = "INSERT INTO tbl_User (FName, LName, Email, IsAdmin, DeliveryAddress,  Password) 
        VALUES ('".$FName."','".$LName."','".$Email."','".$IsAdmin."','".$DelAddres."','".$Password."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}

//Checking if TABLE tbl_Item exists
$result = ("SELECT * FROM tbl_Item");    
       $res = mysqli_query($connectionString, $result);

//If Table tbl_Item exists, DROP TABLE and Re-Create, else create the table
if($res !== FALSE)
{
    $dropTable = ("DROP TABLE tbl_Item");    
    $dropRes = mysqli_query($connectionString, $dropTable);   

    $latestTable = ("CREATE TABLE tbl_Item(ItemID INT PRIMARY KEY NOT NULL,
    ItemImg TEXT NOT NULL,
    Description TEXT NOT NULL,
    CostPrice DECIMAL(15,2) NOT NULL,
    Quantity DECIMAL(10,2) NOT NULL,
    SellPrice DECIMAL(15,2) NOT NULL,
    IsDeleted INT NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('items.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($ItemID, $ItemImg, $Description, $CostPrice, $Quantity, $SellPrice, $IsDeleted) = $explodeLine;

        $qry = "INSERT INTO tbl_Item (ItemID, ItemImg, Description, CostPrice, Quantity, SellPrice, IsDeleted) 
        VALUES ('".$ItemID."', '".$ItemImg."','".$Description."','".$CostPrice."','".$Quantity."','".$SellPrice."','".$IsDeleted."')";

        mysqli_query($connectionString, $qry);
          
    }   
    fclose($open);    
    $deleteBlank = "DELETE FROM tbl_item WHERE SellPrice = '0.00'";
    mysqli_query($connectionString, $deleteBlank);
}
else if($res !== TRUE)
{
    //Creating TABLE tbl_Item
    $latestTable = ("CREATE TABLE tbl_Item(ItemID INT PRIMARY KEY NOT NULL,
    ItemImg TEXT NOT NULL,
    Description TEXT NOT NULL,
    CostPrice DECIMAL(15,2) NOT NULL,
    Quantity DECIMAL(10,2) NOT NULL,
    SellPrice DECIMAL(15,2) NOT NULL,
    IsDeleted INT NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('items.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($ItemID, $ItemImg, $Description, $CostPrice, $Quantity, $SellPrice, $IsDeleted) = $explodeLine;

        $qry = "INSERT INTO tbl_Item (ItemID, ItemImg, Description, CostPrice, Quantity, SellPrice, IsDeleted) 
        VALUES ('".$ItemID."', '".$ItemImg."','".$Description."','".$CostPrice."','".$Quantity."','".$SellPrice."','".$IsDeleted."')";

        mysqli_query($connectionString, $qry);
          
    }   
    fclose($open);    
    $deleteBlank = "DELETE FROM tbl_Item WHERE SellPrice = '0.00'";
    mysqli_query($connectionString, $deleteBlank);  
}

//Loading data from loadMyShop.php
include 'loadMyShop.php';
        
?>