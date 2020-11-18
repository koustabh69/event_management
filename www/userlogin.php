<?php
require('dbconnect.php');
if(isset($_POST['login']))
{
 $name=$_POST['name'];
    $email=$_POST['email'];
    $qryres=mysqli_query($conn,"Select * from user where Name='$name' and Email='$email'");
    if(mysqli_fetch_row($qryres) > 0)
    {
     header("location: userdisp.php");   
    }
else
{
    echo "NO SUCH USER EXIST ";
}
}
        
        ?>
<html>
<head>
    
    </head>
    
    <body>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
    
        <center>
        <form method="post" action="">
            
            <label>NAME: </label> <input type=text name="name"> &nbsp;&nbsp;&nbsp; <label>EMAIL ID: </label> <input type="text" name="email"> <br><br>
            <input type="submit" name="login" value="ENTER">
            
            </form>
        </center>
            </body>
</html>

