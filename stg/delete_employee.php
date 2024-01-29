<?php
include "connexion_db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Check if the employee exists
    $checkEmployeeSql = "SELECT * FROM employee WHERE id = $id";
    $result = $conn->query($checkEmployeeSql);

    if ($result->num_rows > 0) {
        // Employee exists, proceed with deletion
        $deleteEmployeeSql = "DELETE FROM employee WHERE id = $id";

        if ($conn->query($deleteEmployeeSql) === TRUE) {
            header("Location:employee_admin.php");
        } else {
            echo "Error deleting employee: " . $conn->error;
        }
    } else {
        echo "Employee not found.";
    }
} else {
    // If no ID is provided, truncate the table to reset the auto-increment counter
    $truncateTableSql = "TRUNCATE TABLE employee";

    if ($conn->query($truncateTableSql) === TRUE) {
        echo "All employees deleted, and the auto-increment counter reset!";
    } else {
        echo "Error truncating the employee table: " . $conn->error;
    }
}

$conn->close();
?>
