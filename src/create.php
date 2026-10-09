<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $studentNumber = trim($_POST['student_number'] ?? '');
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if (
        $studentNumber === '' ||
        $firstName === '' ||
        $lastName === '' ||
        $course === ''
    ) {
        exit('All fields are required.');
    }

    $stmt = $pdo->prepare(
        'INSERT INTO students
         (student_number, first_name, last_name, course)
         VALUES (?, ?, ?, ?)'
    );

    $stmt->execute([
        $studentNumber,
        $firstName,
        $lastName,
        $course
    ]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h1>Add Student</h1>

<form method="POST">

    <p>
        Student Number:
        <input name="student_number" required>
    </p>

    <p>
        First Name:
        <input name="first_name" required>
    </p>

    <p>
        Last Name:
        <input name="last_name" required>
    </p>

    <p>
        Course:
        <input name="course" required>
    </p>

    <button type="submit">Save Student</button>

</form>

<p>
    <a href="index.php">Back to Student List</a>
</p>

</body>
</html>