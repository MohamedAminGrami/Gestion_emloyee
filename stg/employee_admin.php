<?php

include "connexion_db.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include "navbar.php";

$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

$employees = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Employee Page (Admin)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .employee-container {
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container employee-container">
    <h2 class="text-center mb-4">Employee List (Admin)</h2>
    <a href="employee_form.php" class="btn btn-success mb-3">Create Employee</a>

    <?php if (empty($employees)) : ?>
        <p>No employees found.</p>
    <?php else : ?>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td><?= $employee['id'] ?></td>
                    <td><?= $employee['name'] ?></td>
                    <td><?= $employee['department_name'] ?></td>
                    <td>
                        <a href="employee_form.php?id=<?= $employee['id'] ?>" class="btn btn-warning btn-sm">Update</a>
                        <a href="delete_employee.php?id=<?= $employee['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
