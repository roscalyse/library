<?php
include 'includes/connection.php'; 
include 'includes/functions.php'; 
session_start();
$today = date("Y-m-d");
$user = $_SESSION['user'];
$email=$user['email'];
// Query to get all records with a due date matching today's date
$query = "SELECT * FROM borrowedbooks WHERE due_date = ? and email=? AND status=0";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ss', $today, $email);
mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
        // Get user details and book info
        $user_email = $row['email'];
        $bookId = $row['book_id'];
        $book=getBookById($conn, $bookId);
        $bookTitle= $book['title'];
       
        $due_date = $row['due_date'];
        // var_dump($row);
        // Notification message
        $message = "Reminder: The book '$bookTitle' is due today ({$due_date}). Please return it.";
        if(checkNotificationExists($conn, $user_email, $message)<1){
            $insert_query = "INSERT INTO notifications (email, message) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, 'ss', $user_email, $message);
            mysqli_stmt_execute($insert_stmt);
        }
        // Insert notification into notifications table
        
    }
    
    // echo json_encode(['status' => 'success', 'message' => 'Notifications created for due items.']);
} else {
    // echo json_encode(['status' => 'no_due_items', 'message' => 'No items due today.']);
}

?>
