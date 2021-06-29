<?php 
//Keegan Verwey 
//19004753

//Checking if TABLE tbl_order exists
$result = ("SELECT * FROM tbl_Order");    
       $res = mysqli_query($connectionString, $result);

//If Table tbl_Order exists, DROP TABLE and Re-Create, else create the table
if($res !== FALSE) 
{
    $dropTable = ("DROP TABLE tbl_Order");    
    $dropRes = mysqli_query($connectionString, $dropTable);   

    $latestTable = ("CREATE TABLE tbl_Order(OrderID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES tbl_User(UserID))");    

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('order.txt','r');
 
    //Opening the order text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($OrderID, $UserID) = $explodeLine;
        
        $qry = "INSERT INTO tbl_Order (OrderID, UserID) 
        VALUES ('".$OrderID."','".$UserID."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}
else if($res !== TRUE)
{
    //Creating TABLE tbl_order
    $latestTable = ("CREATE TABLE tbl_Order(OrderID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES tbl_User(UserID))");     

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('order.txt','r');
 
    //Opening the order text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($OrderID, $UserID) = $explodeLine;
        
        $qry = "INSERT INTO tbl_Order (OrderID, UserID) 
        VALUES ('".$OrderID."','".$UserID."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}

//Checking if TABLE tbl_OrderItem exists
$result = ("SELECT * FROM tbl_OrderItem");    
       $res = mysqli_query($connectionString, $result);

//If Table tbl_OrderItem exists, DROP TABLE and Re-Create, else create the table
if($res !== FALSE)
{
    $dropTable = ("DROP TABLE tbl_OrderItem");    
    $dropRes = mysqli_query($connectionString, $dropTable);   

    $latestTable = ("CREATE TABLE tbl_OrderItem(OrderItemID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    OrderID INT NOT NULL,
    ItemID INT NOT NULL,
    Quantity DECIMAL(10,2) NOT NULL,
    SellPrice DECIMAL(15,2) NOT NULL, 
    PurchaseDate TEXT NOT NULL,   
    FOREIGN KEY (OrderID) REFERENCES tbl_Order(OrderID),
    FOREIGN KEY (ItemID) REFERENCES tbl_item(ItemID))");        

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('orderItem.txt','r');
 
    //Opening the order item text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);
        
        list($OrderItemID, $OrderID, $ItemID, $PurchaseDate, $Quantity, $SellPrice) = $explodeLine;
        
        $qry = "INSERT INTO tbl_OrderItem (OrderItemID, OrderID, ItemID, PurchaseDate, Quantity, SellPrice) 
        VALUES ('".$OrderItemID."','".$OrderID."','".$ItemID."','".$PurchaseDate."','".$Quantity."','".$SellPrice."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}
else if($res !== TRUE)
{
    //Creating TABLE tbl_OrderItem
    $latestTable = ("CREATE TABLE tbl_OrderItem(OrderItemID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    OrderID INT NOT NULL,
    ItemID INT NOT NULL,
    Quantity DECIMAL(10,2) NOT NULL,
    SellPrice DECIMAL(15,2) NOT NULL,    
    PurchaseDate TEXT NOT NULL,  
    FOREIGN KEY (OrderID) REFERENCES tbl_Order(OrderID),
    FOREIGN KEY (ItemID) REFERENCES tbl_item(ItemID))");        

    $resTable = mysqli_query($connectionString, $latestTable);

    $open = fopen('orderItem.txt','r');
 
    //Opening the order item text file and reading it into the Database line by line
    //Reference: (Import Data From txt File to MySQL Using Php, 2021)
    while (!feof($open)) 
    {
        $getTextLine = fgets($open);
        $explodeLine = explode(",", $getTextLine);

        list($OrderItemID, $OrderID, $ItemID, $PurchaseDate, $Quantity, $SellPrice) = $explodeLine;
        
        $qry = "INSERT INTO tbl_OrderItem (OrderItemID, OrderID, ItemID, PurchaseDate, Quantity, SellPrice) 
        VALUES ('".$OrderItemID."','".$OrderID."','".$ItemID."','".$PurchaseDate."','".$Quantity."','".$SellPrice."')";

        mysqli_query($connectionString, $qry);
          
    }    
    fclose($open);
}

?>