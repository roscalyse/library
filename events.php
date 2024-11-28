<?php
session_start();
$user = $_SESSION['user'];
$email=$user['email'];
// echo $email;
include 'includes/connection.php';
$sql = "SELECT d.title, B.due_date AS start FROM borrowedbooks B, books d WHERE B.book_id = d.id AND B.status=0 AND B.email= '$email'"; 
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row; 
    }
}
// echo var_dump($events);
// Return data as JSON
echo json_encode($events);
?>