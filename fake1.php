<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="payment_style.css">
    </head>
    <body>
        <div class="login-page">
            <div class="form">
                <?php
                    if(!empty($_GET['message']))
                    {
                        $message = $_GET['message'];
                        echo '<h2>'.'Mr.'.$message.' '.'book a slot for your car'.'</h2>';
                        'mesg'.'='.$message;
                    }
                ?>
              <form class="login-form" method="POST">
                <center><h1 style="color:#fc9723;">Payment</h1></center>
                <b>Your Car Is Parked</b>
                <br>
                <br>
                <button name="payment">Take Out Car And Pay</button>
              </form>
              <?php
                    if(array_key_exists('payment', $_POST))
                    {
                        button1($message);
                    }
                    function button1($a)
                    {
                        $dbhost = 'localhost';
                        $dbuser = 'root';
                        $dbpass = '';
                        $dbname="parkingdata";

                        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

                        if(! $conn ) {
                            die('Could not connect: ' . mysqli_error());
                        }

                        $sql1 = 'SELECT slot,carno,time FROM slot';
                        mysqli_select_db( $conn,'parkingdata');
                        $retval1 = mysqli_query($conn,$sql1);

                        if(! $retval1 ) {
                            die('Could not get data: ' . mysqli_error());
                        }
                        $count=0;

                        $sql3 = "SELECT carno FROM user WHERE name= '". $a. "'";
                        mysqli_select_db( $conn,'parkingdata');
                        $retval3 = mysqli_query($conn,$sql3);
                        while($row3 = mysqli_fetch_array($retval3))
                        {
                            $carnumber=$row3['carno'];
                        }

                        while($row1 = mysqli_fetch_array($retval1))
                        {
                            if($carnumber==$row1['carno'])
                            {
                                $time=$row1['time'];
                                break;
                            }
                        }
                        $date=date('Y-m-d H:i:s T', time());
                        $datetime1 = strtotime('May 3, 2012 10:38:22 GMT');
                        $datetime2 = strtotime('06 Apr 2012 07:22:21 GMT');

                        // == <seconds between the two times>
                        $timetaken=$datetime2 - $datetime1;
                        echo'<br>';
                        echo 'You have taken '.$timetaken.' secs ';
                        echo'<br>';
                        echo'<br>';
                        $totalcost=$timetaken*(10);
                        echo 'Your total Payment is '.$totalcost.' rupees ';
                        //$days = $secs/86400;

                        echo'';
                        mysqli_close($conn);
                    }
                ?>

                <?php
                    if(array_key_exists('completed', $_POST))
                    {
                        $carnum=$_POST["mesg"];
                        button6($carnum,$message);
                    }
                    function button6($a,$b)
                    {
                        $dbhost = 'localhost';
                        $dbuser = 'root';
                        $dbpass = '';
                        $dbname="parkingdata";

                        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

                        if(! $conn ) {
                            die('Could not connect: ' . mysqli_error());
                        }

                        $sql1 = "DELETE FROM slot WHERE carno = '". $a. "'";
                        mysqli_select_db( $conn,'parkingdata');
                        $retval1 = mysqli_query($conn,$sql1);

                        if ($conn->query($sql1) === TRUE) {
                            echo "Record deleted successfully";
                          } else {
                            echo "Error deleting record: " . $conn->error;
                          }

                        $sql8 = "UPDATE user SET park='0' WHERE  carno = '". $a. "'";
                        mysqli_select_db( $conn,'parkingdata');
                        $retval8 = mysqli_query($conn,$sql8);

                        if ($conn->query($sql8) === TRUE) {
                            echo "Record deleted successfully";
                          } else {
                            echo "Error deleting record: " . $conn->error;
                          }

                        mysqli_close($conn);


                        echo '<script type="text/javascript">';
                        echo 'alert("Mr ".$b." We received your payment");';
                        //echo 'window.location.href = "book.php?message=".$b.;';
                        echo 'window.location.href = "book.php";';
                        echo '</script>';
                        exit;
                        
                    }

                ?>
                <form class="login-form" method="POST">
                    <input type="hidden" name="mesg" value="<?php echo $carnumber; ?>" required="required" />
                    <br>
                    <button name="completed">Pay the Payment</button>
                </form>
                
            </div>
          </div>
    </body>
</html>