<?php
include('includes/connection.php');
include('includes/functions.php');
session_start();
    $user = $_SESSION['user'];
    $email=$user['email'];
    $query ="SELECT * FROM notifications WHERE email = ? AND is_read=0 ORDER BY date_created DESC";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        $notifications = mysqli_fetch_all($results, MYSQLI_ASSOC);
        // Return the notifications as JSON
        // var_dump($notifications);
        echo json_encode($notifications);
    }
?>
