<?php
$message = isset($_GET['message']) ? $_GET['message'] : 'Operation completed.';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e9ffe9; margin: 20px; text-align: center; }
        h2 { color: green; }
        a {
            display: inline-block; margin: 10px; padding: 10px 20px; background-color: #4CAF50; color: white;
            text-decoration: none; border-radius: 4px; font-weight: bold;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2><?php echo htmlspecialchars($message); ?></h2>
    <a href="insert.php">Insert Record</a>
    <a href="view.php">View Records</a>
</body>
</html>
