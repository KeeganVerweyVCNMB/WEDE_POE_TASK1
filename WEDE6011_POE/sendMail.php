<!-- Keegan Verwey -->
<!-- 19004753 -->
<?php 
$dive_listItems = $db_handle->executeSQL("SELECT Quantity FROM tbl_item");
//If DB call not null 
//(fahmidasclassroom.com. 2021.)
if(!empty($dive_listItems))
{
    foreach ($dive_listItems as $key => $value) 
    {
        //Checking when items quantity is less or equal to '0' to send stock low email to admin user
        if($dive_listItems[$key]["Quantity"] <= 0)
        { 
            //Email Styling
            $to = "keeganverwey@gmail.com";
            $subject = "Stock Running Low";

            $message = ' 
            <html> 
            <head> 
                <title>Your Stock Are Running Low</title> 
            </head> 
            <body> 
                <img Style="width:240px; height:50px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLAiqydvgfFWYOg8Y6JsbA8qBaggMUhijrAA&usqp=CAU" alt="Dive Shop Logo" />
                <p>Please login to <a href="http://localhost/WEDE6011_POE/index.php?">The Scuba ED Admin Dashboard</a> to
                have a look at in store items running low.</p></br></br>

                <p>Thank you.</p></br></br>
                <p>Kind regards,</p></br>
                <p>THE SCUBA SHOP.</p>
            </body> 
            </html>'; 

            //Header information
            $headers = "From: Admin <keeganverwey@gmail.com>\nMIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1";
            //Send Mail
            mail($to, $subject, $message, $headers);
        
        }
    }
}
?>