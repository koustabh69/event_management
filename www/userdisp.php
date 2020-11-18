<html>

<head>
    
    
    </head>

    
    <body>
            
        
        <table name="event">

<?php

require('dbconnect.php');


        $sql=mysqli_query($conn,"SELECT * from event");
        
        if($sql)
        {
    while($row=mysqli_fetch_assoc($sql))
    {
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
            <td colspan=2><form method="post" action=""><input type="hidden" value="<?php echo $row['ID']; ?>" name="bid"><input type="submit" name="going" value="GOING"></form></td>
        <td colspan=2>MAX ATTENDEE <?php  echo $row['Allowed_attendees']; ?></td>
		</tr>
        
        <?php
    }
        }
        else
        {
            echo "ERROR IN DISPLAYING EVENTS ".mysqli_error($conn);
        }
    

    
    if(isset($_POST['going']))
    {
        $idnow=$_POST['bid'];
         $going=mysqli_query($conn,"Select * from event where ID='$idnow'");
       /* if($going)
         {*/
            echo $idnow;
         $goingrow=mysqli_fetch_assoc($going);
           echo $goingrow['Title'];
         $goingnumber=$goingrow['Waitlist'];
            echo $goingnumber;
            
         $goingnumber=$goingnumber+1;
        //    echo $goingnumber;
                 $qry2res=mysqli_query($conn,"update event set Waitlist='$goingnumber' where ID='$idnow'");
            if(!$qry2res)
            {
                echo "Error ".mysqli_error($conn);
            }
            else
            {
              echo "UDPATE SUCCESS ";  
            }
            /* }
             else
             {
               echo "FAILED IN FETCHING GOING NUMBER ".mysqli_error($conn);   
             }
*/
    }
        
    
        
     
       
         
    
   
    
    
   

?>
        </table>
        
    
    </body>
</html>