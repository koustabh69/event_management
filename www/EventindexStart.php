

    
    
        <?php
      
	require('dbconnect.php'); 
if(isset($_POST['submit'])){
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      $title=$_POST['title'];
      $description=$_POST['description'];
      $date=$_POST['date'];
      $location=$_POST['location'];
      $Max=$_POST['MaxWaitlist'];
      $from=$_POST['from'];
      $to=$_POST['to'];
      $sql=mysqli_query($conn, "INSERT INTO event values(null,'$title','$description','$target_file','$date','$location','$Max',0,'$from','$to')");
      if($sql){
          echo "success image entry in DB ";
      }
      else{
          echo "fail image DB entry ".mysqli_error($conn);
      }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
        
			
			if(isset($_POST['btn2']))
			{
				$uname=$_POST['uname'];
				$email=$_POST['email'];
				
				
				//query for adding user...execution left
				$adduserquery=mysqli_query($conn,"insert into user values (null,'$uname','$email')");
                if($adduserquery)
                {
                    echo "MEMBER ADDED ";
                }
                else
                {
                    echo "ERROR IN ADDING MEMBER ";
                }
			}
			
			
			if(isset($_POST['btn3']))
			{
				$uname=$_POST['uname'];
				$email=$_POST['email'];
				
				//query for deleting user...execution left
				$deleteuserquery=mysqli_query($conn,"delete from user where Name='$uname' and Email='$email'");
                if($deleteuserquery)
                {
                    echo "MEMBER DELETED ";
                }
                else
                {
                    echo "ERROR IN DELETING MEMBER ";
                }
			}
			
			if(isset($_POST['del']))
			{
				$eid=$_POST['eventid'];
				$dtitle=$_POST['dtitle'];
                echo $eid;
                echo $dtitle;
				//query for deleting event...execution left
				
                
                /*$deltarget=$rowd['Image'];*/
                $resultdel=mysqli_query($conn,"select * from event where ID='$eid'");
                $rowd=mysqli_fetch_assoc($resultdel);
                
                $delimg=$rowd['Image'];
                unlink($delimg);
                
                $delnos=mysqli_query($conn,"delete from event where ID='$eid'");
                
                if($delnos)
                {
                    echo "DELETE SUCCESS";
                    
                }
                else
                {
                    echo "DELETE FAIL ".mysqli_query($conn);
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
        <!--<form action="" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload2" id="fileToUpload2">
  <input type="submit" value="Upload Image" name="submit2">
</form>
       --> 
        <form method="post" action="">
            <center>NAME: <input type=text name="uname" require> &nbsp;&nbsp; Email: <input type=text name="email" require> </center>
            <br>
            <center>
            <input type="submit" name="btn2" value="ADD MEMBER"> &nbsp;&nbsp;
            <input type="submit" name="btn3" value="DELETE MEMBER">
            </center>
		</form>        
			<hr>
            <center>
		
		<form enctype="multipart/form-data" method="post" action="">
        <label>TITLE :</label> <input type="text" name="title" require> &nbsp;&nbsp; Description : <input type="text" name="description" required> &nbsp;&nbsp; <input type="file"  name="fileToUpload" id="fileToUpload" required>
                </center>
            <br>
            <center>
        DATE: <input type="date" name="date" require> &nbsp;&nbsp; LOCATION: <input type="text" name="location" require>&nbsp;&nbsp; MAX ATTENDEE: <input type=number name="MaxWaitlist" require>     
         &nbsp;&nbsp;
          START TIME: <input type="time" name="from" require> &nbsp;&nbsp END TIME: <input type="time" name="to" require>  
                </center>
            <br>
            <center>
            <input type="submit" value="CREATE EVENT" name="submit">
               </center>
                </form>
             
            <br><br>
			
			<form method="post" action="">
            <center>
            ID: <input type="number" name="eventid" require> &nbsp;&nbsp;  <input type="submit" name="del" value="DELETE EVENT">
            </center>
        </form>
        
    
		<hr>
		<br>
		<br>
		<center>
		<table name="event">
		
            <?php
    $sql=mysqli_query($conn, "SELECT * from event");
    while($row=mysqli_fetch_assoc($sql))
    {
            /*
			header("Content-type: " . jpg);
            */
		?>
            
            <tr>
            <td colspan="4"> <?php  echo $row['ID']; ?> </td>
            </tr>
            
		<tr>
		<td rowspan=2> <img src="<?php echo $row['Image']; ?>" style="width: 100px;height:100px;"></td>
		<td>TITLE <?php  echo $row['Title']; ?></td>
		<td colspan=2>DESCRIPTION <?php  echo $row['Description']; ?></td>
		</tr>

		<tr>
		<td>LOCATION <?php  echo $row['Location']; ?></td>
		<td>FROM <?php  echo $row['Start_time']; ?></td>
		<td>TO <?php  echo $row['End_time']; ?></td>
		</tr>
		
		<tr>
		<td colspan=2>WAITLIST <?php  echo $row['Waitlist']; ?></td>
        <td colspan=2>MAX ATTENDEE <?php  echo $row['Allowed_attendees']; ?></td>
		</tr>
		<?php
		}
		?>
        </table>
		</center>
    </body>
</html>