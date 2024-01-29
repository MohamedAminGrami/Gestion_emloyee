<?php
include "connexion_db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $name = $_POST["name"];
    $department = $_POST["department"];

    $checkDepartmentSql = "SELECT * FROM department WHERE department_name = '$department'";
    $result = $conn->query($checkDepartmentSql);

    if ($result->num_rows > 0) {
        if ($id) {
            // Update existing employee
            $sql = "UPDATE employee SET name='$name', department_name='$department' WHERE id=$id";
        } else {
            // Create new employee
            $sql = "INSERT INTO employee (name, department_name) VALUES ('$name', '$department')";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location: employee_admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Department does not exist in the 'department' table.";
    }
}

$conn->close();
?>