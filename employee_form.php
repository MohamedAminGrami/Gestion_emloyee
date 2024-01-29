<?php

include "connexion_db.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include "navbar.php";

$id = isset($_GET['id']) ? $_GET['id'] : null;

$employee = null;
if ($id) {
    $sql = "SELECT * FROM employee WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "Employee not found.";
        exit();
    }
}

// Fetch department names from the 'department' table
$departments = [];
$departmentSql = "SELECT department_name FROM department";
$departmentResult = $conn->query($departmentSql);

if ($departmentResult->num_rows > 0) {
    while ($row = $departmentResult->fetch_assoc()) {
        $departments[] = $row['department_name'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Employee Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <h2 class="text-center mb-4"><?= $id ? 'Update' : 'Create' ?> Employee</h2>
    <form action="save_employee.php" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $employee ? $employee['name'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="department">Department:</label>
            <select class="form-control" id="department" name="department" required>
                <?php foreach ($departments as $dept) : ?>
                    <option value="<?= $dept ?>" <?= ($employee && $employee['department_name'] == $dept) ? 'selected' : '' ?>>
                        <?= $dept ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block"><?= $id ? 'Update' : 'Create' ?></button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
