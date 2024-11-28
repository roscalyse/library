<?php
// function getAllUserDueBooks($conn, $email, $duedate) {
//     $query= "SELECT book_id FROM borrowedbooks WHERE email =? AND status = 0 AND due_date = ? AND notified=0";
//     $stmt = mysqli_prepare($conn, $query);
//     if ($stmt) {
//         mysqli_stmt_bind_param($stmt, 'ss', $email, $duedate);
//         mysqli_stmt_execute($stmt);
//         $result = mysqli_stmt_get_result($stmt);
//     // declare array
//         $dueBooks=[];
//         if($result) {
//             while($row= mysqli_fetch_assoc($result)) {
//                 $dueBooks[] = $row;
//             }
//             return $dueBooks;
//         }
//     }
// }
// function updateNotified($conn, $id) {
//     $query ="UPDATE borrowedbooks SET notified=1 WHERE id=?";
//     $stmt= mysqli_prepare($conn, $query);
//     if($stmt) {
//         mysqli_stmt_bind_param($stmt, 'i',$id );
//         if(mysqli_stmt_execute($stmt)) {
//             return true;
//         } else {
//             return mysqli_stmt_error($stmt);
            
//         }
//     }
// }
function checkNotificationExists($conn, $user_email, $message) {
    $query ="SELECT COUNT(*) FROM notifications WHERE message = ? and email=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'ss',$message ,$user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}

function deleteNotification($conn,$id){
    $query = "UPDATE notifications SET is_read=1 WHERE id=?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i', $id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}

function format_money($amount){
    // checking if input is numeric
    if(!is_numeric($amount)){
        return "invalid input";
    }
    //formating amount to have commas
    return number_format($amount);
}

function userNumberOfBooks($conn, $email) {
    $query ="SELECT COUNT(*) FROM borrowedbooks where email = ? AND status=0";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}

function userNumberOfReservations($conn, $email) {
    $query ="SELECT COUNT(*) FROM reservations where email = ? AND status='reserved'";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}
// include 'connection.php';
// $email='jett@gmail.com';
// echo userNumberOfReservations($conn, $email);
function addDate($conn, $date) {
    return date('Y-m-d', strtotime($date . ' +1 day'));
}
function deleteRecord($conn){
    $query = "DELETE FROM reservations WHERE reservation_date < NOW() - INTERVAL 1 DAY AND status='reserved'";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){       
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function getPicByEmail($conn, $email) {
    $query ="SELECT pic FROM users where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function getAllReturnedBooks($conn) {
    $query= "SELECT B.book_id,B.status, B.email, COALESCE(m.first_name, s.first_name) AS first_name, COALESCE(m.last_name, s.last_name) AS last_name, B.return_date FROM borrowedbooks B LEFT JOIN members m ON B.email = m.email LEFT JOIN staff s ON B.email = s.email WHERE B.status=1;";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $returns=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $returns[] = $row;
        }
        return $returns;
    }
}
function getStudentByEmail($conn, $email) {
    $query ="SELECT * FROM members where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}

function getStaffByEmail($conn, $email) {
    $query ="SELECT * FROM staff where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function getAllPayments($conn) {
    $query= "SELECT * FROM payments";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $payments=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $payments[] = $row;
        }
        return $payments;
    }
}
function getPaymentsById($conn, $payment_id) {
    $query ="SELECT * FROM payments where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $payment_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function updatePayment($conn, $amount, $id) {
    $query ="UPDATE payments SET amount=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'si',$amount, $id );
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}
function deletePayment($conn,$id){
    $query = "DELETE FROM payments WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function getUserPaymentByEmail($conn, $email) {
    $query ="SELECT SUM(amount) AS amount_paid FROM payments where email='$email' GROUP BY email;";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        //mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function getUserFineByEmail($conn, $email) {
    $query ="SELECT SUM(fine) AS amount_fine FROM transactions where email='$email' GROUP BY email;";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        //mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
// include 'connection.php';
// $email='rebb@gmail.com';
// $due=getUserFineByEmail($conn, $email)($conn, $email);
// if($due) {
//     echo "<p class='text-danger'> Shs ".$due['amount_fine']."</p>";
// } else{
//     echo '0 Shs';
// }
function VerifyEmailInPayments($conn, $email) {
    $query ="SELECT COUNT(*) FROM payments where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}
function emailExistsInTransactions($conn, $email) {
    $query ="SELECT COUNT(*) FROM transactions where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}
function addAmount($conn,$email, $amount) {
    // define a querry
    $query = "INSERT INTO payments (email,amount) values (?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss',$email, $amount);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllFines($conn) {
    $query= "SELECT 
    COALESCE(m.first_name, s.first_name) AS first_name,
    COALESCE(m.last_name, s.last_name) AS last_name,
    t.email,
    t.fine,
    t.amount,
    t.transaction_date
    FROM 
        transactions t
    LEFT JOIN 
        members m ON t.email = m.email
    LEFT JOIN 
        staff s ON t.email = s.email;
    ";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $transactions=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $transactions[] = $row;
        }
        return $transactions;
    }
}
function getUserFines($conn) {
    $query= "SELECT 
    COALESCE(m.first_name, s.first_name) AS first_name,
    COALESCE(m.last_name, s.last_name) AS last_name,
    t.email,
    SUM(t.fine) AS total_amount
    FROM 
        transactions t
    LEFT JOIN 
        members m ON t.email = m.email
    LEFT JOIN 
        staff s ON t.email = s.email GROUP BY email
    ";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $transactions=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $transactions[] = $row;
        }
        return $transactions;
    }
}
// include 'connection.php';
// var_dump( getUserFines($conn));

function getTotalFines($conn) {
    $query= "SELECT  fine from transactions";  
    
    $stmt = mysqli_query($conn, $query);
    $total_fines=0;
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $total_fines+=$row['fine'];
        }
        return $total_fines;
    }
}

function addFine($conn, $email, $fine) {
    // define a querry
    $query = "INSERT INTO transactions (email, fine) values (?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $email, $fine);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}

function interval($date1, $date2) {
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);

    $interval = $datetime1->diff($datetime2);

    return $interval->days;
}
function getIssueDetailsById($conn, $issue_id) {
    $query ="SELECT * FROM borrowedbooks where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $issue_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function fineCalc($conn, $days){
    return $days*2000;
}
// $date1 = '2023-06-29';
// $date2 = '2023-06-20';
// if($date2>$date1){
// echo interval($date2, $date1);
// }
function updatePic($conn, $profile_pic, $email) {
    $query ="UPDATE users SET pic=? WHERE email=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss',$profile_pic, $email);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}
function issueBook($conn, $email, $date, $book_id) {
    // define a querry
    $query = "INSERT INTO borrowedbooks (due_date, book_id, email) values (?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $date, $book_id, $email);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllBorrowedbooks($conn) {
    $query= "SELECT * FROM borrowedbooks";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $issuedBooks=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $issuedBooks[] = $row;
        }
        return $issuedBooks;
    }
}
function getUserBorrowedbooks($conn,$email) {
    $query= "SELECT * FROM borrowedbooks WHERE email='$email'";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $issuedBooks=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $issuedBooks[] = $row;
        }
        return $issuedBooks;
    }
}
function deleteIssued($conn,$id){
    $query = "DELETE FROM borrowedbooks WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function updateReturned($conn, $id, $date) {
    $query ="UPDATE borrowedbooks SET status=1, return_date=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'si',$date, $id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}

// $id=5;
// $date=date('Y-m-d');
// updateReturned($conn, $id, $date);

function getAllUsers($conn) {
    $query= "SELECT * FROM users";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $users=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $users[] = $row;
        }
        return $users;
    }
}
function booksQuantity($conn) {
    $query ="SELECT COUNT(*) FROM books";
    $stmt= mysqli_prepare($conn, $query);
	if($stmt){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}
function ReservationsQuantity($conn) {
    $query ="SELECT COUNT(*) FROM reservations WHERE status='reserved'";
    $stmt= mysqli_prepare($conn, $query);
	if($stmt){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}
function allBooksQuantity($conn) {
    $query ="SELECT SUM(total_copies) AS total FROM books";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        //mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function allIssuedQuantity($conn) {
    $query ="SELECT COUNT(*) FROM borrowedbooks WHERE status =0";
    $stmt= mysqli_prepare($conn, $query);
	if($stmt){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}
// include 'connection.php';
// $a=allBooksQuantity($conn);
// echo $a['total']."\n";
// echo allIssuedQuantity($conn)."\n";
// echo ReservationsQuantity($conn)."\n";
// echo available($conn,$a['total'] , allIssuedQuantity($conn), ReservationsQuantity($conn));
function getMemberById($conn, $member_id) {
    $query ="SELECT * FROM members where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $member_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function updatePasword($conn, $newPassword, $email) {
    $query ="UPDATE users SET password=? WHERE email=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $newPassword, $email);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}
function checkPassword($conn,$email) {
    $query ="SELECT password FROM users where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return  mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}

function addStudents($conn,$fName, $lName, $regNo, $email, $contact,  $creator) {
    // define a querry
    $query = "INSERT INTO members (stud_id, first_name, last_name, email, contact, created_by) values (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssss', $regNo, $fName, $lName, $email, $contact, $creator);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function addUser($conn, $email, $password, $usertype) {
    // define a querry
    $query = "INSERT INTO users (email, password, usertype) values (?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $email, $password, $usertype);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllStudents($conn) {
    $query= "SELECT * FROM members";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $students=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $students[] = $row;
        }
        return $students;
    }
}
function deleteStudent($conn,$member_id){
    $query = "DELETE FROM members WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$member_id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function regnoExists($conn, $regno) {
    $query ="SELECT COUNT(*) FROM members where stud_id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $regno);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}

function getEmailById($conn, $id) {
    $query ="SELECT email FROM members where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function updateStudents($conn, $fName, $lName, $regNo, $email, $contact,  $id, $modifier,$date) {
    $query ="UPDATE members SET stud_id=?, first_name=?, last_name=?, email=?, contact=?, date_modified=?, modified_by=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssssssi',$regNo, $fName, $lName, $email, $contact, $date, $modifier, $id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}
// include 'connection.php';
// $fName="LUKWIYA";
// $lName="smith";
// $regNo="luct578";
// $email="omuron@gmail.com";
// $contact="0755630332";
// $modifier="aisha2024@gmail.com";
// $id=4;
// $date=date('Y-m-d');
// echo $date;
// $up= updateStudents($conn, $fName, $lName, $regNo, $email, $contact, $id, $modifier,$date);
// if($up){
//     echo 'fine';
// }
// else{ echo 'fine';}

function updateUser($conn, $email, $password, $id) {
    $query ="UPDATE users SET email=?, password=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssi', $email,$password, $id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}

//$id=16;

//$email= getEmailById($conn,$id);
//$email="ken@gmail.com";
//$del= deleteUser($conn,$email);
function deleteUser($conn,$email){
    $query = "DELETE FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'s',$email);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function emailExists($conn, $email) {
    $query ="SELECT COUNT(*) FROM users where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}
function getUsertypeByEmail($conn, $email) {
    $query ="SELECT usertype FROM users where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
/*function getUserIdByEmail($conn, $email) {
    $query ="SELECT id FROM users where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}*/
// staff
function addStaff($conn,$fName, $lName, $email, $contact, $creator) {
    // define a querry
    $query = "INSERT INTO staff (first_name, last_name, email, contact,created_by) values (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssis',$fName, $lName, $email,$contact,$creator);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function updateStaff($conn, $fName, $lName, $email, $contact, $id,  $modifier,$date) {
    $query ="UPDATE staff SET first_name=?, last_name=?, email=?, contact=?, date_modified=?, modified_by=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssi', $fName, $lName, $email, $contact, $date, $modifier, $id );
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}
function getStaffById($conn, $staff_id) {
    $query ="SELECT * FROM staff where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $staff_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function getAllStaff($conn) {
    $query= "SELECT * FROM staff WHERE status!='admin'";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $staffs=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $staffs[] = $row;
        }
        return $staffs;
    }
}
function deleteStaff($conn,$staff_id){
    $query = "DELETE FROM staff WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$staff_id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function getStaffEmailById($conn, $id) {
    $query ="SELECT email FROM staff where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}

// books section
function addBooks($conn,$title, $isbn, $edition, $publisher, $year, $shelve, $total, $available, $author_id,$category_id) {
    // define a querry
    $query = "INSERT INTO books (title, isbn, edition, publisher, publication_year, shelve_number, total_copies, available_copies, author_id, category_id) values (?,?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssisiiii',$title, $isbn, $edition, $publisher, $year, $shelve, $total, $available, $author_id,$category_id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllBooks($conn) {
    $query= "SELECT * FROM books ORDER BY date_created DESC";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $books=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $books[] = $row;
        }
        return $books;
    }
}
function getBookById($conn, $book_id) {
    $query ="SELECT * FROM books where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $book_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function updateBook($conn,$title, $isbn, $edition, $publisher, $year, $shelve, $total, $author_id,$category_id, $id) {
    $query ="UPDATE books SET title=?, isbn=?, edition=?, publisher=?, publication_year=?, shelve_number=?, total_copies=?,author_id=?, category_id=?  WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssisiiii',$title, $isbn, $edition, $publisher, $year, $shelve, $total, $author_id,$category_id, $id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}

function deleteBook($conn,$book_id){
    $query = "DELETE FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$book_id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function getAllOnlineBooks($conn) {
    $query= "SELECT * FROM online_books";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $onlineBooks=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $onlineBooks[] = $row;
        }
        return $onlineBooks;
    }
}
function getFileById($conn, $id) {
    $query ="SELECT * FROM online_books where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function deleteOnlineBook($conn,$book_id){
    $query = "DELETE FROM online_books WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$book_id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
//categories
function addCategory($conn,$name, $description) {
    // define a querry
    $query = "INSERT INTO category (name, description) values (?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $name, $description);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllCategories($conn) {
    $query= "SELECT * FROM category ORDER BY name ASC";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $categories=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $categories[] = $row;
        }
        return $categories;
    }
}
function getCategoryById($conn, $category_id) {
    $query ="SELECT * FROM category where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $category_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}

function deleteCategory($conn,$category_id){
    $query = "DELETE FROM category WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$category_id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}

function updateCategory($conn, $name, $description, $id) {
    $query ="UPDATE category SET name=?, description=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssi',$name, $description, $id );
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}

function getCategoryNameById($conn, $category_id) {
    $query ="SELECT name FROM category where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $category_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}

// authors
function addAuthor($conn,$name,$biography, $dob, $dod,) {
    // define a querry
    $query = "INSERT INTO authors (name, biography, DOB, DOD) values (?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $biography, $dob, $dod);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}

function getAllAuthors($conn) {
    $query= "SELECT * FROM Authors ORDER BY name ASC";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $Authors=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $Authors[] = $row;
        }
        return $Authors;
    }
}
function getAuthorById($conn, $Author_id) {
    $query ="SELECT * FROM authors where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $Author_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function getAuthorNameById($conn, $author_id) {
    $query ="SELECT name, biography FROM authors where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $author_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
function updateAuthor($conn, $name, $dob, $dod, $bio, $id) {
    $query ="UPDATE authors SET name=?, biography=?, DOB=?, DOD=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssi',$name, $bio, $dob, $dod, $id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}

function deleteAuthor($conn,$Author_id){
    $query = "DELETE FROM authors WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$Author_id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}

// reviews
function addReview($conn,$review, $b_id, $email) {
    // define a querry
    $query = "INSERT INTO reviews (comment, book_id, email) values (?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'sis', $review, $b_id, $email);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllReviews($conn, $book_id) {
    $query= "SELECT * FROM reviews where book_id= ? ORDER BY date_created DESC";
    $stmt = mysqli_prepare($conn, $query);
    
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $book_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
    }
         // declare array
        $reviews=[];
      if($results) {
        while($row= mysqli_fetch_assoc($results)) {
            $reviews[] = $row;
        }
        return $reviews;
    }

}
function checkNumberReviews($conn, $book_id) {
    $query ="SELECT COUNT(*) FROM reviews where book_id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $book_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}
//reservation
function getBookQuantityById($conn, $book_id) {
    $query ="SELECT total_copies FROM books where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $book_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
// include 'connection.php';
// $book_id=17;
// var_dump(getBookQuantityById($conn, $book_id));
function reduceTotal($conn, $total) {
    $total-=1;
    return $total;
}
function updateBookQuantity($conn,$id, $total) {
    $query ="UPDATE books SET total_copies=? WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'ii',$total, $id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}

/*
include 'connection.php';
$book_id=5;
$totals =getBookQuantityById($conn, $book_id);
echo $totals['total_copies'];
$total= reduceTotal($conn, $totals['total_copies']);
updateBookQuantity($conn,$book_id, $total);
$new=getBookQuantityById($conn, $book_id);
echo $new['total_copies'];
*/
// function to check if a user email exists
function issuedNo($conn, $id) {
    $query ="SELECT COUNT(*) FROM borrowedbooks where book_id = ? and status=0";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}
// include 'connection.php';
// $id=13;
// echo issuedNo($conn, $id);
function checkIssueExists($conn, $email, $book_id) {
    $query ="SELECT COUNT(*) FROM borrowedbooks where email = ? and book_id=? and status = 0";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'si', $email, $book_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}

function reserved($conn, $id) {
    $query ="SELECT COUNT(*) FROM reservations where book_id = ? AND status='reserved'";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count;
    } else {
        return false;
    }
}
 //include 'connection.php';
// $id=12;
// echo reserved($conn, $id);

function available($conn, $total, $num1, $num2){
    return ($total-$num1-$num2);
}

function VerifyEmail($conn, $email) {
    $query ="SELECT COUNT(*) FROM members where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}

/*include 'connection.php';
$email="roscalyse196@gmail.com";
if ( VerifyEmail($conn, $email)) {
    echo "yes";
}*/
function getStudentIdByEmail($conn, $email) {
    $query ="SELECT id FROM members where email = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'s', $email);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}
/*include 'connection.php';
$email="roscalyse1996@gmail.com";
if(getStudentIdByEmail($conn, $email)) {
    $res=getStudentIdByEmail($conn, $email);
    echo $res['id'];
}*/
function addReservation($conn,$status,$book_id, $email) {
    // define a querry
    $query = "INSERT INTO reservations (status, book_id, email) values (?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $status,$book_id, $email);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllReservations($conn) {
    $query= "SELECT * FROM reservations";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $Reservations=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $Reservations[] = $row;
        }
        return $Reservations;
    }
}
function getUserReservations($conn,$email) {
    $query= "SELECT * FROM reservations where email='$email' AND status='reserved'";
    $stmt = mysqli_query($conn, $query);
    // declare array
    $Reservations=[];
    if($stmt) {
        while($row= mysqli_fetch_assoc($stmt)) {
            $Reservations[] = $row;
        }
        return $Reservations;
    }
}
function updateStatus($conn, $id) {
    $query ="UPDATE reservations SET status='Taken' WHERE id=?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt, 'i',$id);
        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return mysqli_stmt_error($stmt);
            
        }
    }
}

function getReservationById($conn, $reservation_id) {
    $query ="SELECT * FROM reservations where id = ?";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'i', $reservation_id);
        mysqli_stmt_execute($stmt);
        $results= mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($results);
    } else {
        return false;
    }
}

function deleteReservation($conn,$reservation_id){
    $query = "DELETE FROM reservations WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt){
        mysqli_stmt_bind_param($stmt,'i',$reservation_id);
        mysqli_stmt_execute($stmt);
        return true;
    }

}
function checkReservationExists($conn, $email, $book_id) {
    $query ="SELECT COUNT(*) FROM reservations where email = ? and book_id=? and status ='reserved'";
    $stmt= mysqli_prepare($conn, $query);
    if($stmt) {
        mysqli_stmt_bind_param($stmt,'si', $email, $book_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        return $count>0;
    } else {
        return false;
    }
}

?>