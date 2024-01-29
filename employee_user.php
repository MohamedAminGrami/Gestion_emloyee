<?php
$userType = "user";

if ($userType === "admin") {
    header("Location: employee_admin.php");
    exit();
}

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
    <title>Employee Page (User)</title>
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
    <h2 class="text-center mb-4">Employee List</h2>

    <?php if (empty($employees)) : ?>
        <p>No employees found.</p>
    <?php else : ?>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td><?= $employee['id'] ?></td>
                    <td><?= $employee['name'] ?></td>
                    <td><?= $employee['department_name'] ?></td>
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
