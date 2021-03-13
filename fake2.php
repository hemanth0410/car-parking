<?php
    $carnum=$_POST["car"];
    $user=$_POST["user"];

        
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname="parkingdata";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if(! $conn ) {
        die('Could not connect: ' . mysqli_error());
    }

    $carnum=mysqli_real_escape_string($conn,$carnum);
    $user=mysqli_real_escape_string($conn,$user);


    $sql1="SELECT * FROM slot WHERE carno = '$carnum' ";
    $veri1=mysqli_query($conn,$sql1);
    if(! $veri1 ) {
        die('Could not get data: ' . mysql_error());
    }
    while($row = mysqli_fetch_array($veri1))
    {
        echo $row['slot'];
    }
    if(mysqli_num_rows($veri1)>0)
    {
        $sql2 = "DELETE FROM slot WHERE carno = '$carnum' ";
        $veri2=mysqli_query($conn,$sql2);
        if($veri2 === TRUE)
        {
            echo "deleted successfully";
        }
        else
        {
            echo "Error deleting record: " . $conn->error;
        }
    }
    else
    {
        echo "Error updating record: " . $conn->error;
    }

    $sql3="SELECT * FROM user WHERE carno = '$carnum' ";
    $veri3=mysqli_query($conn,$sql3);
    if(mysqli_num_rows($veri3)>0)
    {
        $sql4 = "UPDATE user SET park=0 WHERE  carno = '$carnum' ";
        $veri4=mysqli_query($conn,$sql4);
        if($veri4 === TRUE)
        {
            echo "updated successfully";
        }
        else
        {
            echo "Error updating record: " . $conn->error;
        }
    }
    else
    {
        echo "Error updating record: " . $conn->error;
    }

    mysqli_close($conn);

?>