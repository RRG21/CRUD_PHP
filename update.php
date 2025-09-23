<?php
include 'db_connection.php';

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing record
$sql = "SELECT * FROM form_01 WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "Record not found";
    exit();
}

// Handle update submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['fname']);
    $lastName  = mysqli_real_escape_string($conn, $_POST['lname']);
    $password  = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $gender    = mysqli_real_escape_string($conn, $_POST['gender']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
    $address   = mysqli_real_escape_string($conn, $_POST['address']);

    $update_sql = "UPDATE form_01 SET 
        fname='$firstName', lname='$lastName', password='$password', 
        cpassword='$cpassword', gender='$gender', email='$email', 
        phone='$phone', address='$address' WHERE id=$id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f6f6ff; }
        h2 { color: #333; }
        form { background-color: #fff; padding: 20px; border-radius: 8px; width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        label { display: block; margin-top: 10px; font-weight: bold;}
        input[type="text"], input[type="email"], input[type="password"], textarea {
            width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px;
        }
        input[type="radio"] { margin-left: 10px; }
        input[type="submit"] {
            margin-top: 15px; background-color: #2196F3; color: white; padding: 10px 20px;
            border: none; border-radius: 4px; cursor: pointer; font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <h2>Update Record</h2>
    <form method="post" action="">
        <label>First Name:</label><input type="text" name="fname" required value="<?php echo htmlspecialchars($row['fname']); ?>">
        <label>Last Name:</label><input type="text" name="lname" required value="<?php echo htmlspecialchars($row['lname']); ?>">
        <label>Password:</label><input type="password" name="password" required value="<?php echo htmlspecialchars($row['password']); ?>">
        <label>Confirm Password:</label><input type="password" name="cpassword" required value="<?php echo htmlspecialchars($row['cpassword']); ?>">
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male" <?php if($row['gender']=='Male') echo 'checked'; ?> required> Male
        <input type="radio" name="gender" value="Female" <?php if($row['gender']=='Female') echo 'checked'; ?> required> Female
        <label>Email:</label><input type="email" name="email" required value="<?php echo htmlspecialchars($row['email']); ?>">
        <label>Phone:</label><input type="text" name="phone" required value="<?php echo htmlspecialchars($row['phone']); ?>">
        <label>Address:</label><textarea name="address" required><?php echo htmlspecialchars($row['address']); ?></textarea>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
