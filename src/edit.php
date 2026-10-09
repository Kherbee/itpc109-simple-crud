<?php
require 'db.php';

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

$stmt = $pdo->prepare(
    'SELECT * FROM students WHERE id = ?'
);

$stmt->execute([$id]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    exit('Student not found.');
}
?>

<h1>Edit Student</h1>

<form action="update.php" method="POST">

    <input type="hidden" name="id"
        value="<?= $student['id'] ?>">

    <p>
        Student Number:
        <input name="student_number"
            value="<?= htmlspecialchars($student['student_number']) ?>"
            required>
    </p>

    <p>
        First Name:
        <input name="first_name"
            value="<?= htmlspecialchars($student['first_name']) ?>"
            required>
    </p>

    <p>
        Last Name:
        <input name="last_name"
            value="<?= htmlspecialchars($student['last_name']) ?>"
            required>
    </p>

    <p>
        Course:
        <input name="course"
            value="<?= htmlspecialchars($student['course']) ?>"
            required>
    </p>

    <button type="submit">Update Student</button>

</form>

<p>
    <a href="index.php">Back to Student List</a>
</p>