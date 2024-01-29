<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "connexion_db.php";


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userType = $row["role"];

        $_SESSION['user_type'] = $userType;

        if ($userType === 'admin') {
            header("Location: employee_admin.php");
            exit();
        } else {
            header("Location: employee_user.php");
            exit();
        }
    } else {
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>
