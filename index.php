<!-- place all the required files in C:\xampp\htdocs\1stProject then start apache and mysql in xampp control panel the open http://localhost/1stproject/ and submit the form then you can see the datas in http://localhost/phpmyadmin/  -->
<?php
$inserted = false;
$name = ''; // Initialize $name variable
$error = '';

// if (isset($_POST)) {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $server = "sql108.infinityfree.com";
    $username = "if0_37325607";
    $password = "63F0t0QXT8";

    $con = mysqli_connect("sql108.infinityfree.com", "if0_37325607", "63F0t0QXT8", "if0_37325607_mytrip");

    if (!$con) {
        die("Connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $other = $_POST['other'];

    // $sql = "INSERT INTO `trip`.`trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$other',current_timestamp());";
    // // echo $sql;
    // if ($con->query($sql) == true) {
    //     // echo "Successfully Inserted";
    //     $inserted = true;
    // } else {
    //     echo "Error: $sql <br> $con->error";
    // }

    // Validate required fields
    if (empty($name) || empty($age) || empty($gender) || empty($email) || empty($phone)) {
        $error = "Please fill in all required fields.";
    } else {
        // Proceed with SQL query if no errors
        $sql = "INSERT INTO `mytrip`.`trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$other', current_timestamp());";

        if ($con->query($sql) == true) {
            $inserted = true;
        } else {
            $error = "Error: $sql <br> $con->error";
        }
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NIT BBSR Bangalore Trip form</title>
    <link rel="stylesheet" href="style1.css" />
</head>

<body>
    <div class="container">
        <form action="index.php" method="post">
            <img class="bg" src="image.png" alt="NIT College Image" />
            <h1>Welcome to NIT Bhubaneswar Bangalore Trip form</h1>
            <p>
                Enter your details and submit this form to confirm your participation
                In the trip
            </p>
            <?php
            if ($inserted) {
                echo "<p class='submitMSG'>Thanks $name for submitting your form. We are happy to see you joining us for the Bangalore Trip.</p>";
            } elseif ($error) {
                echo "<p class='errorMSG'>$error</p>";
            }
            ?>
            <input type="text" name="name" id="name" placeholder="Enter Your name" />
            <input type="number" name="age" id="age" placeholder="Enter Your age" />
            <input type="text" name="gender" id="gender" placeholder="Enter Your Gender" />
            <input type="email" name="email" id="email" placeholder="Enter Your email" />
            <input type="text" name="phone" id="phone" placeholder="Enter your Phone number" />
            <textarea name="other" id="other" placeholder="Enter any other information here"></textarea>
            <button class="btn">Submit</button>
        </form>
        <footer>
            <p>&copy; 2024 Kuldeep Sahoo. All rights reserved.</p>
        </footer>
    </div>
    <script src="index.js"></script>
</body>

</html>