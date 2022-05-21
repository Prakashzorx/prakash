<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "Mukunda@123";
$dbname = "mk_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;
    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);
    //echo $uname;
    //echo $pass;exit;

    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();
    } else if (empty($pass)) {

        header("Location: index.php?error=Password is required");

        exit();
    } else {

        $sql = "SELECT * FROM `admin_login` WHERE `email`='$uname' AND `password`='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            echo "Logged in!";


            if ($row['email'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['a_name'] = $row['email'];

                $_SESSION['aname'] = $row['name'];

                $_SESSION['aid'] = $row['id'];

                header("Location: MFPL/index.php");

                exit();
            } else {

                header("Location: index.php?error=Incorrect Details.. Try again!");

                exit();
            }
        } else {
            $sql = "SELECT * FROM `users` WHERE `email`='$uname' AND `password`='$pass'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);
                // echo "Logged in!";

                //print_r($row);exit;
                if ($row['email'] === $uname && $row['password'] === $pass) {

                    // echo "Logged in!";

                    $_SESSION['user_name'] = $row['email'];

                    $_SESSION['uname'] = $row['name'];

                    $_SESSION['uid_user'] = $row['user_id'];

                    header("Location: brand_user/index.php");

                    exit();
                } else {

                    header("Location: index.php?error=Incorrect Details.. Try again!");

                    exit();
                }
            } else {



                $sql = "SELECT * FROM `brand_tbl` WHERE `bp_email`='$uname' AND `password`='$pass'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) === 1) {

                    $row = mysqli_fetch_assoc($result);
                    // echo "Logged in!";

                    //print_r($row);exit;
                    if ($row['bp_email'] === $uname && $row['password'] === $pass) {

                        // echo "Logged in!";

                        $_SESSION['muser_name'] = $row['bp_email'];

                        $_SESSION['mname'] = $row['bp_name'];

                        $_SESSION['mid_user'] = $row['id'];

                        header("Location: brand_user_manager/index.php");

                        exit();
                    } else {

                        header("Location: index.php?error=Incorrect Details.. Try again!");

                        exit();
                    }
                } else {



                    header("Location: index.php?error=Incorrect Details.. Try again!");

                    exit();
                }
            }


            // header("Location: index.php?error=Incorrect Details.. Try again!");

            //exit();

        }
    }
} else {

    header("Location: index.php");

    exit();
}
