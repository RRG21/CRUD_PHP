<?php
include 'db_connection.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM form_01 WHERE id = $delete_id";
    mysqli_query($conn, $delete_sql);
    header("Location: view.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Records</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        h2 { color: #333; }
        table {
            width: 100%; border-collapse: collapse; background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd; padding: 8px; text-align: left;
        }
        th {
            background-color: #4CAF50; color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a.button {
            text-decoration: none; padding: 6px 12px; border-radius: 4px; color: white;
            font-weight: bold;
        }
        a.update {
            background-color: #2196F3;
        }
        a.delete {
            background-color: #f44336;
        }
        a.update:hover {
            background-color: #0b7dda;
        }
        a.delete:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <h2>Records</h2>
    <a href="insert.php" style="background-color:#4CAF50; padding:8px 16px; color:white; text-decoration:none; border-radius:5px;">Insert New Record</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Password</th>
            <th>Confirm Password</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM form_01";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['fname']}</td>
                        <td>{$row['lname']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['cpassword']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                        <td>
                            <a class='button update' href='update.php?id={$row['id']}'>Update</a>
                            <a class='button delete' href='view.php?delete_id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
