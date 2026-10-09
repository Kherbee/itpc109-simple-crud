<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Invalid request.');
}

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

$studentNumber = trim($_POST['student_number'] ?? '');
$firstName = trim($_POST['first_name'] ?? '');
$lastName = trim($_POST['last_name'] ?? '');
$course = trim($_POST['course'] ?? '');

if (
    !$id ||
    $studentNumber === '' ||
    $firstName === '' ||
    $lastName === '' ||
    $course === ''
) {
    exit('Invalid or incomplete student information.');
}

$stmt = $pdo->prepare(
    'UPDATE students
     SET student_number = ?,
         first_name = ?,
         last_name = ?,
         course = ?
     WHERE id = ?'
);

$stmt->execute([
    $studentNumber,
    $firstName,
    $lastName,
    $course,
    $id
]);

header('Location: index.php');
exit;