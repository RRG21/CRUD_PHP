<?php
include 'db_connection.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastName  = mysqli_real_escape_string($conn, $_POST['lname']);
    $password  = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $gender    = mysqli_real_escape_string($conn, $_POST['gender']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
    $address   = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "INSERT INTO form_01 (fname, lname, password, cpassword, gender, email, phone, address) 
            VALUES ('$firstName', '$lastName', '$password', '$cpassword', '$gender', '$email', '$phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        header("Location: success.php?message=Record Inserted Successfully");
        exit();
    } else {
        $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Record</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f0f8ff; }
        h2 { color: #333; }
        form { background-color: #fff; padding: 20px; border-radius: 8px; width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="password"], textarea {
            width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;
        }
        input[type="radio"] { margin-left: 10px; }
        input[type="submit"] {
            margin-top: 15px; background-color: #4CAF50; color: white; padding: 10px 20px;
            border: none; border-radius: 4px; cursor: pointer; font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        p.message { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Insert Record</h2>
    <?php if ($message != "") echo "<p class='message'>$message</p>"; ?>
    <form method="post" action="insert.php">
        <label>First Name:</label><input type="text" name="fname" required>
        <label>Last Name:</label><input type="text" name="lname" required>
        <label>Password:</label><input type="password" name="password" required>
        <label>Confirm Password:</label><input type="password" name="cpassword" required>
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <label>Email:</label><input type="email" name="email" required>
        <label>Phone:</label><input type="text" name="phone" required>
        <label>Address:</label><textarea name="address" required></textarea>
        <input type="submit" name="submit" value="Insert">
    </form>
</body>
</html>
