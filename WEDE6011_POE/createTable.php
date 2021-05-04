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

    $latestTable = ("CREATE TABLE tbl_User(ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    FName TEXT NOT NULL,
    LName TEXT NOT NULL,
    Email TEXT NOT NULL,
    Password TEXT NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('userData.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($FName, $LName, $Email, $Password) = $explodeLine;
        
        $qry = "INSERT INTO tbl_User (FName, LName, Email, Password) 
        VALUES ('".$FName."','".$LName."','".$Email."','".$Password."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}
else if($res !== TRUE)
{
    //Creating TABLE tbl_User
    $latestTable = ("CREATE TABLE tbl_User(ID INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    FName TEXT NOT NULL,
    LName TEXT NOT NULL,
    Email TEXT NOT NULL,
    Password TEXT NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('userData.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($FName, $LName, $Email, $Password) = $explodeLine;
        
        $qry = "INSERT INTO tbl_User (FName, LName, Email, Password) 
        VALUES ('".$FName."','".$LName."','".$Email."','".$Password."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}

//Checking if TABLE tbl_item exists
$result = ("SELECT * FROM tbl_item");    
       $res = mysqli_query($connectionString, $result);

//If Table tbl_item exists, DROP TABLE and Re-Create, else create the table
if($res !== FALSE)
{
    $dropTable = ("DROP TABLE tbl_item");    
    $dropRes = mysqli_query($connectionString, $dropTable);   

    $latestTable = ("CREATE TABLE tbl_item(ItemID VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    CostPrice DECIMAL(15,2) NOT NULL,
    Quantity DECIMAL(10,2) NOT NULL,
    SellPrice DECIMAL(15,2) NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('items.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($ItemID, $Description, $CostPrice, $Quantity, $SellPrice) = $explodeLine;

        $qry = "INSERT INTO tbl_item (ItemID, Description, CostPrice, Quantity, SellPrice) 
        VALUES ('".$ItemID."','".$Description."','".$CostPrice."','".$Quantity."','".$SellPrice."')";

        mysqli_query($connectionString, $qry);
          
    }   
    fclose($open);    
    $primaryKey = "ALTER TABLE tbl_item ADD PRIMARY KEY (ItemID)";
    mysqli_query($connectionString, $primaryKey);
    $deleteBlank = "DELETE FROM tbl_item WHERE SellPrice = '0.00'";
    mysqli_query($connectionString, $deleteBlank);
}
else if($res !== TRUE)
{
    //Creating TABLE tbl_item
    $latestTable = ("CREATE TABLE tbl_item(ItemID VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    CostPrice DECIMAL(15,2) NOT NULL,
    Quantity DECIMAL(10,2) NOT NULL,
    SellPrice DECIMAL(15,2) NOT NULL)");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('items.txt','r');
 
    //Opening the user text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($ItemID, $Description, $CostPrice, $Quantity, $SellPrice) = $explodeLine;

        $qry = "INSERT INTO tbl_item (ItemID, Description, CostPrice, Quantity, SellPrice) 
        VALUES ('".$ItemID."','".$Description."','".$CostPrice."','".$Quantity."','".$SellPrice."')";

        mysqli_query($connectionString, $qry);
          
    }   
    fclose($open);    
    $primaryKey = "ALTER TABLE tbl_item ADD PRIMARY KEY (ItemID)";
    mysqli_query($connectionString, $primaryKey);
    $deleteBlank = "DELETE FROM tbl_item WHERE SellPrice = '0.00'";
    mysqli_query($connectionString, $deleteBlank);  
}
        
?>