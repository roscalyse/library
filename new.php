
<?php
//header('Content-Type: application/json');
include('includes/connection.php');
include('includes/functions.php');

if (isset($_POST['notificationId'])) {
	$id=$_POST['notificationId'];
	deleteNotification($conn,$id);
	
}
if(isset($_POST['add_online_book'])){
	$name = $_POST['bookName'];
    $edition = $_POST['edition'];
    $category_id = $_POST['category_id'];
	$author_id = $_POST['author_id'];
	if(empty($name) || empty($category_id) || empty($author_id)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
	}
    // Handle file upload
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        // Check if the file is a PDF
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['pdf'];

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) { // Limit file size to 10MB
                    // Generate a unique file name to prevent overwriting
                    $newFileName = uniqid('', true) . "." . $fileExt;
                    $fileDestination = 'fileUploads/' . $newFileName;

                    // Move file to the destination folder
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Insert data into the database
                        $sql = "INSERT INTO online_books (name, author_id, category_id,edition, file) 
                                VALUES (?,?,?,?,?)";
                        $stmt = $conn->prepare($sql);
                        if($stmt){
							mysqli_stmt_bind_param($stmt,'siiss', $name,$author_id,$category_id,$edition,$fileDestination);
						
							if(mysqli_stmt_execute($stmt)) {
								$res =[
									'status' => 200,
									'message' => 'Book uploaded successfully!'
								];
								echo json_encode($res);
								return false;
								
							} else {
								$res =[
									'status' => 500,
									'message' => 'Failed to upload book.'
								];
								echo json_encode($res);
								return false;
								
							}
						}
                    } else {
						$res =[
						'status' => 500,
						'message' => 'Failed to move uploaded file.'
					];
					echo json_encode($res);
					return false;
                       
                    }
                } else {$res =[
					'status' => 500,
					'message' => 'File size exceeds 10MB.'
				];
				echo json_encode($res);
				return false;
                    
                }
            } else {
				$res =[
				'status' => 500,
				'message' => 'Error uploading file.'
			];
			echo json_encode($res);
			return false;
                
            }
        } else {
			$res =[
				'status' => 500,
				'message' => 'Invalid file type. Only PDF files are allowed.'
			];
			echo json_encode($res);
			return false;
           
        }
    } else {
		$res =[
			'status' => 500,
			'message' => 'No file uploaded.'
		];
		echo json_encode($res);
		return false;
       
    }
}
if(isset($_POST['delete_pdf'])) {
	$id=$_POST['onlineBook_id'];
	$result=deleteOnlineBook($conn,$id);
	if($result){
	   $res =[
		   'status' => 200,
		   'message' => 'Book deleted Successfully'
		   
	   ];
	   echo json_encode($res);
	   return false;
   }else{
	   $res =[
		   'status' => 500,
		   'message' => 'Book Not Deleted'
	   ];
	   echo json_encode($res);
	   return false;
   
   }
}
if(isset($_POST['update_password'])){
	$email=$_POST['e-mail']; 
	$password=$_POST['password'];
    $newPassword =$_POST['newPassword'];
	
	if(empty($password)|| empty($newPassword)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		
	} 
	$salt="codeflix";
	$password_encripted = sha1($password.$salt);
	$newPassword_encripted = sha1($newPassword.$salt);
	$comfirm=implode(" ",checkPassword($conn,$email));
	if($comfirm==$password_encripted) {
		$result =updatePasword($conn, $newPassword_encripted, $email);
		if($result){
			$res =[
				'status' => 200,
				'message' => 'Password updated Successfully'
				
			];
			echo json_encode($res);
			return false;
		}else{
			$res =[
				'status' => 500,
				'message' => 'Oops update Failed'
			];
			echo json_encode($res);
			return false;
		
		}
	} else{
		$res =[
			'status' => 500,
			'message' => 'Comfirm password incorrect '
		];
		echo json_encode($res);
		return false;
	}
}
	
if(isset($_GET['payment_id'])){
	$id=$_GET['payment_id'];
	$payment= getPaymentsById($conn, $id);
	if($payment) {
	   $res =[
		   'status' => 200,
		   'data'=> $payment
	   ];
	   echo json_encode($res);
	   return false; 
	} else{		
	   $res =[
		   'status' => 404,
		   'message' => 'record not found'
	   ];
	   echo json_encode($res);
	   return false;
	}
}
if(isset($_POST['update_payment'])){
	$id=$_POST['payment_id'];	
	$email=$_POST['e-mail'];
	$amount=$_POST['paid_amount'];
	 if(empty($email)|| empty($amount)){
		 $res =[
			 'status' => 422,
			 'message' => 'All fields are mandatory'
		 ];
		 echo json_encode($res);
		 return false;
		 //return false;
	 } 
	 $result=updatePayment($conn, $amount, $id);
	 if($result){
		 $res =[
			 'status' => 200,
			 'message' => 'payment updated Successfully'
			 
		 ];
		 echo json_encode($res);
		 return false;
	 }else{
		 $res =[
			 'status' => 500,
			 'message' => 'payment update Failed'
		 ];
		 echo json_encode($res);
		 return false;
	 
	 }
}
if(isset($_POST['delete_payment'])) {
	$id=$_POST['payment_id'];
	$result=deletePayment($conn,$id);
	if($result){
	   $res =[
		   'status' => 200,
		   'message' => 'payment record deleted '
		   
	   ];
	   echo json_encode($res);
	   return false;
   }else{
	   $res =[
		   'status' => 500,
		   'message' => 'payment record Not Deleted'
	   ];
	   echo json_encode($res);
	   return false;
   
   }
}
if(isset($_POST['save_fine'])){
	
	$email=$_POST['email'];
	$amount =$_POST['amount'];
	
	// call function
	if(empty($email)|| empty($amount)){
	 $res =[
		 'status' => 422,
		 'message' => 'All fields are mandatory'
	 ];
	 echo json_encode($res);
	 return false;
	 //return false;
	 } 
	 if(emailExistsInTransactions($conn, $email)) {
		$result =addAmount($conn,$email, $amount);
		if($result){		
			$res =[
				'status' => 200,
				'message' => 'Amount Added Successfully'
				
			];
			echo json_encode($res);
			return false;
		}else{
			$res =[
				'status' => 500,
				'message' => 'Amount Addition Failed'
			];
			echo json_encode($res);
			return false;
		
		}
	} else {
		$res =[
			'status' => 500,
			'message' => 'User has no fine debt'
		];
		echo json_encode($res);
		return false;
	}
} 
if(isset($_GET['issue_id'])){
	$id=$_GET['issue_id'];
	$issue= getIssueDetailsById($conn, $id);
	if($issue) {
	   $res =[
		   'status' => 200,
		   'data'=> $issue
	   ];
	   echo json_encode($res);
	   return false; 
	} else{		
	   $res =[
		   'status' => 404,
		   'message' => 'record not found'
	   ];
	   echo json_encode($res);
	   return false;
	}
}
if(isset($_POST['issue_book'])){
	$book_id=$_POST['title'];
	$email=$_POST['email'];
	// $id= $_POST['res'];

	// $total=getBookQuantityById($conn, $book_id);
	// $num1=issuedNo($conn, $book_id);
	// $num2=reserved($conn, $book_id);
	// $available= available($conn, $total['total_copies'], $num1, $num2);
	if(empty($book_id) || empty($email)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
			
	if( emailExists($conn, $email) ){
		$user=implode(" ",getUsertypeByEmail($conn, $email));
		if($user =='student'){
			$duedate=date("Y-m-d", strtotime(date("Y-m-d"). ' + 3 days'));
		
		} else if($user =='staff' || $user =='admin') {
			$duedate=date("Y-m-d", strtotime(date("Y-m-d"). ' + 7 days'));
		}
		$checkIssue=checkIssueExists($conn, $email, $book_id);
		if(!$checkIssue) {
			$number=userNumberOfBooks($conn, $email);
			if($number<3) {	
				// call function
				$results =issueBook($conn, $email, $duedate, $book_id);
				if($results){
					if (isset($_POST['res'])) {
				
						$result= updateStatus($conn, $_POST['res']);
					}
							
					$res =[
						'status' => 200,
						'message' => 'Book issued Successfully'
						
					];
					echo json_encode($res);
						return false;
				}else{
					$res =[
						'status' => 500,
						'message' => 'Issue Failed'
					];
					echo json_encode($res);
					return false;
			
				}
			} else {
				$res =[
					'status' => 500,
					'message' => 'Issued Books limit Reached'
				];
				echo json_encode($res);
				return false;
			
			}
			
		} 	else {
			$res =[
				'status' => 500,
				'message' => 'User has this Book Already'
			];
			echo json_encode($res);
			return false;
		
		}
	} else{
		$res =[
			'status' => 500,
			'message' => 'Email doesnt exist'
		];
		echo json_encode($res);
		return false;
		
	}


}
if(isset($_POST['delete_issue'])) {
	$id=$_POST['issue_id'];
	$result=deleteissued($conn,$id);
	if($result){
	   $res =[
		   'status' => 200,
		   'message' => 'Book issued deleted '
		   
	   ];
	   echo json_encode($res);
	   return false;
   }else{
	   $res =[
		   'status' => 500,
		   'message' => 'Book issued Not Deleted'
	   ];
	   echo json_encode($res);
	   return false;
   
   }
}
if(isset($_POST['return_book'])) {
	$id=$_POST['issue_id'];
	$return_date=date('Y-m-d');
	$issue=getIssueDetailsById($conn, $id);
	$duedate=$issue['due_date'];
	$email=$issue['email'];
	$days=interval($return_date, $duedate);
	$fine=fineCalc($conn, $days);

	if($return_date>$duedate){
		addFine($conn, $email, $fine);
	}
	$result=updateReturned($conn, $id, $return_date);
	if($result){
	   $res =[
		   'status' => 200,
		   'message' => 'Return Successful '
		   
	   ];
	   echo json_encode($res);
	   return false;
   }else{
	   $res =[
		   'status' => 500,
		   'message' => 'Return Unsuccessful'
	   ];
	   echo json_encode($res);
	   return false;
   
   }
   
}
if(isset($_POST['add_review'])){
	$review=$_POST['review'];
	$b_id=$_POST['book_id'];
	$email=$_POST['user'];      
	 
	 if(empty($review)){
		 $res =[
			 'status' => 422,
			 'message' => 'All fields are mandatory'
		 ];
		 echo json_encode($res);
		 return false;
		 //return false;
	 } 
	 // call function
	$results =addReview($conn,$review, $b_id, $email);
	if($results){		
		$res =[
			'status' => 200,
			'message' => 'Review Added Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Review Addition Failed'
		];
		echo json_encode($res);
		return false;
	
	}
}
 
if(isset($_POST['save_book'])){
	
   $title=$_POST['title'];
   $isbn =$_POST['isbn'];
   $edition =$_POST['edition'];
   $publisher=$_POST['publisher'];
   $year =$_POST['publication_year'];
   $shelve=$_POST['shelve_number'];
   $total=$_POST['total_copies'];
   $author_id=$_POST['author_id'];
   $category_id=$_POST['category_id'];
   $available=$_POST['total_copies'];
   // call function
   if(empty($title)|| empty($isbn)||empty($edition)|| empty($publisher) ||empty($year)|| empty($shelve)||empty($total)|| empty($author_id)|| empty($category_id)|| empty($available)){
	$res =[
		'status' => 422,
		'message' => 'All fields are mandatory'
	];
	echo json_encode($res);
	return false;
	//return false;
    } 
   $result =addBooks($conn, $title, $isbn, $edition, $publisher, $year, $shelve, $total, $available, $author_id, $category_id);
   if($result){		
		$res =[
			'status' => 200,
			'message' => 'Book Added Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Book Addition Failed'
		];
		echo json_encode($res);
		return false;
	
	}
} 
if(isset($_GET['book_id'])){
	 $id=$_GET['book_id'];
	 $book= getBookById($conn, $id);
	 if($book) {
		$res =[
			'status' => 200,
			'data'=> $book
		];
		echo json_encode($res);
		return false; 
	 } else{		
		$res =[
			'status' => 404,
			'message' => 'Book not found'
		];
		echo json_encode($res);
		return false;
	 }
}
if(isset($_POST['update_book'])){
   $id=$_POST['book_id'];
   $title=$_POST['titles'];
   $isbn =$_POST['isbns'];
   $edition =$_POST['editions'];
   $publisher=$_POST['publishers'];
   $year =$_POST['publication_years'];
   $shelve=$_POST['shelve_numbers'];
   $total=$_POST['total_copiess'];
   $author_id=$_POST['author_ids'];
   $category_id=$_POST['category_ids'];
   $available=$_POST['total_copiess'];

	if(empty($title)|| empty($isbn)||empty($edition)|| empty($publisher) ||empty($year)|| empty($shelve)||empty($total)|| empty($author_id)|| empty($category_id)|| empty($available)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$result=updateBook($conn,$title, $isbn, $edition, $publisher, $year, $shelve, $total, $author_id,$category_id, $id);
	if($result){
		$res =[
			'status' => 200,
			'message' => 'Book updated Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Book update Failed'
		];
		echo json_encode($res);
		return false;
	
	}
}

if(isset($_POST['delete_book'])) {
	 $id=$_POST['book_id'];
	 $result=deleteBook($conn,$id);
	 if($result){
		$res =[
			'status' => 200,
			'message' => 'Book deleted Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Book Not Deleted'
		];
		echo json_encode($res);
		return false;
	
	}
}


if(isset($_POST['save_reservation'])){
    $book_id=$_POST['title'];
	$status=$_POST['status'];
	//$author_id=$_POST['author'];
	$email=$_POST['email'];

	if(empty($book_id)|| empty($email)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	if(emailExists($conn, $email)) {
   // $mId= getStudentIdByEmail($conn, $email);
   // $member_id= $mId['id'];
   $total=getBookQuantityById($conn, $book_id);
   $num1=issuedNo($conn, $book_id);
   $num2=reserved($conn, $book_id);
   $available= available($conn, $total['total_copies'], $num1, $num2);
	if($available) {
		$reservationCheck=checkReservationExists($conn, $email, $book_id);
		if(!$reservationCheck) {
			$number=userNumberOfReservations($conn, $email);
			
			if($number<3){
				$result= addReservation($conn,$status,$book_id, $email);
				
				if($result){		
					$res =[
						'status' => 200,
						'message' => 'Reservation Added Successfully! Please pick up your book in 24hrs'
						
					];
					echo json_encode($res);
					return false;
				} else {
					$res =[
						'status' => 500,
						'message' => 'Reservation Addition Failed'
					];
					echo json_encode($res);
					return false;
				
				}
			} else{
				$res =[
					'status' => 600,
					'message' => 'Reservation Limit Reached'
				];
				echo json_encode($res);
				return false;
			}
		 } else{
			$res =[
				'status' => 600,
				'message' => 'Reservation Already Exists'
			];
			echo json_encode($res);
			return false;
		}
	} else {
		$res =[
			'status' => 600,
			'message' => 'Book not available'
		];
		echo json_encode($res);
		return false;
    }
		
 } else{
	 $res =[
			'status' => 400,
			'message' => 'e-mail doesnt exist'
		];
		echo json_encode($res);
		return false;
 }

}

if(isset($_GET['reservation_id'])){
	 $id=$_GET['reservation_id'];
	 $reservation= getReservationById($conn, $id);
	 if($reservation) {
		$res =[
			'status' => 200,
			'data'=> $reservation
		];
		echo json_encode($res);
		return false; 
	 } else{		
		$res =[
			'status' => 404,
			'message' => 'reservation not found'
		];
		echo json_encode($res);
		return false;
	 }
}

if(isset($_POST['delete_reservation'])) {
	 $id=$_POST['reservation_id'];
	 $result=deleteReservation($conn,$id);
	 if($result){
		$res =[
			'status' => 200,
			'message' => 'Reservation deleted Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Reservation Not Deleted'
		];
		echo json_encode($res);
		return false;
	
	}
}

if(isset($_POST['save_author'])){
   $name=$_POST['aName'];
   $dob=$_POST['dob'];
   $dod=$_POST['dod'];
   $biography =$_POST['bio'];

	if(empty($name)|| empty($biography)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	
    $result =addAuthor($conn, $name, $biography,  $dob, $dod);
	if($result){		
		$res =[
			'status' => 200,
			'message' => 'Author Added Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Author Addition Failed'
		];
		echo json_encode($res);
		return false;
	
	}
 
}

if(isset($_GET['author_id'])){
	 $id=$_GET['author_id'];
	 $author= getAuthorById($conn, $id);
	 if($author) {
		$res =[
			'status' => 200,
			'data'=> $author
		];
		echo json_encode($res);
		return false; 
	 } else{		
		$res =[
			'status' => 404,
			'message' => 'author not found'
		];
		echo json_encode($res);
		return false;
	 }
}

if(isset($_POST['update_author'])){
   $id=$_POST['author_id'];	
   $name=$_POST['name'];
   $dob=$_POST['birth'];
   $dod=$_POST['death'];
   $bio =$_POST['biog'];

	if(empty($name)|| empty($bio)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$result=updateAuthor($conn, $name, $dob, $dod, $bio, $id);
	if($result){
		$res =[
			'status' => 200,
			'message' => 'author updated Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'author update Failed'
		];
		echo json_encode($res);
		return false;
	
	}
}

if(isset($_POST['delete_author'])) {
	 $id=$_POST['author_id'];
	 $result=deleteAuthor($conn,$id);
	 if($result){
		$res =[
			'status' => 200,
			'message' => 'Author deleted Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Author Not Deleted'
		];
		echo json_encode($res);
		return false;
	
	}
}

if(isset($_POST['save_staff'])){
   $fName=$_POST['fName'];
   $lName =$_POST['lName'];
  
   $email=$_POST['email'];
   $contact =$_POST['contact'];
   $password=$_POST['password'];
   $usertype=$_POST['usertype'];
   $creator=$_POST['creator'];
	if(empty($fName)|| empty($lName) || empty($email)|| empty($contact)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$salt="codeflix";
	$password_encripted = sha1($password.$salt);
	if(emailExists($conn, $email)){
		$res =[
			'status' => 500,
			'message' => 'User email exists'
		];
		echo json_encode($res);
		return false;
	} else{
		$result =addStaff($conn,$fName, $lName, $email, $contact,$creator);
		if($result){
			$user= addUser($conn, $email, $password_encripted, $usertype);
			$res =[
				'status' => 200,
				'message' => 'Staff Added Successfully'
				
			];
			echo json_encode($res);
			return false;
		}else{
			$res =[
				'status' => 500,
				'message' => 'Staff Addition Failed'
			];
			echo json_encode($res);
			return false;
		
		}
	}
}

if(isset($_GET['staff_id'])){
	 $id=$_GET['staff_id'];
	 $staff= getStaffById($conn, $id);
	 if($staff) {
		$res =[
			'status' => 200,
			'data'=> $staff
		];
		echo json_encode($res);
		return false; 
	 } else{		
		$res =[
			'status' => 404,
			'message' => 'staff not found'
		];
		echo json_encode($res);
		return false;
	 }
}

if(isset($_POST['update_staff'])){
   $id=$_POST['staff_id'];	
   $fName=$_POST['first_name'];
   $lName =$_POST['last_name'];
   
   $email=$_POST['e-mail'];
   $contact =$_POST['phone'];
   $modifier=$_POST['modifier'];
   $date=date('Y-m-d');
	if(empty($fName)|| empty($lName) || empty($email)|| empty($contact)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$result = updateStaff($conn, $fName, $lName, $email, $contact, $id,  $modifier,$date);
	if($result){
		$res =[
			'status' => 200,
			'message' => 'staff updated Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Staff update Failed'
		];
		echo json_encode($res);
		return false;
	
	}
}

 if(isset($_POST['delete_staff'])) {
	 $id=$_POST['staff_id'];
	 $email=implode(" ", getStaffEmailById($conn, $id));
	 $result=deleteUser($conn,$email);
	 if($result){
		deleteStaff($conn,$id);
		$res =[
			'status' => 200,
			'message' => 'Staff deleted Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Staff Not Deleted'
		];
		echo json_encode($res);
		return false;
	
	}
}


if(isset($_POST['save_student'])){
   $fName=$_POST['fName'];
   $lName =$_POST['lName'];
   $regNo=$_POST['regNo'];
   $email=$_POST['e-mail'];
   $contact =$_POST['phone'];
   $password=$_POST['pincode'];
   $usertype=$_POST['usertype'];
   $creator=$_POST['creator'];
	
	if(empty($fName)|| empty($lName) || empty($regNo)|| empty($email)|| empty($contact)|| empty($password)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$salt="codeflix";
	$password_encripted = sha1($password.$salt);
	if(emailExists($conn, $email) || regnoExists($conn, $regNo)){
		$res =[
			'status' => 500,
			'message' => 'User email or Registration Number exists'
		];
		echo json_encode($res);
		return false;
	} else{
		$result =addStudents($conn,$fName, $lName, $regNo, $email, $contact, $creator);
		if($result){
			$user= addUser($conn, $email, $password_encripted, $usertype, $creator);
			$res =[
				'status' => 200,
				'message' => 'Student Added Successfully'
				];
			echo json_encode($res);
			return false;
		}else{
			$res =[
				'status' => 500,
				'message' => 'Student Addition Failed'
			];
			echo json_encode($res);
			return false;
		
		}
	}
 
}

if(isset($_GET['student_id'])){
	 $id=$_GET['student_id'];
	 $student= getMemberById($conn, $id);
	 if($student) {
		$res =[
			'status' => 200,
			'data'=> $student
		];
		echo json_encode($res);
		return false; 
	 } else{		
		$res =[
			'status' => 404,
			'message' => 'student not found'
		];
		echo json_encode($res);
		return false;
	 }
}

if(isset($_POST['update_student'])){
   $id=$_POST['student_id'];	
   $fName=$_POST['first_name'];
   $lName =$_POST['last_name'];
   $regNo=$_POST['stud_id'];
   $email=$_POST['email'];
   $contact =$_POST['contact'];
   $password=$_POST['password'];
   $modifier=$_POST['modifier'];
   $date=date('Y-m-d');
	if(empty($fName)|| empty($lName) || empty($regNo)|| empty($email)|| empty($contact)|| empty($password)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$result = updateStudents($conn, $fName, $lName, $regNo, $email, $contact, $id, $modifier,$date);
	if($result){
		$res =[
			'status' => 200,
			'message' => 'student updated Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Student update Failed'
		];
		echo json_encode($res);
		return false;
	
	}
}

 if(isset($_POST['delete_student'])) {
	 $id=$_POST['student_id'];
	 $email=implode(" ", getEmailById($conn, $id));
	 $result=deleteUser($conn,$email);
	 if($result){
		deleteStudent($conn,$id);
		$res =[
			'status' => 200,
			'message' => 'Student deleted Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Student Not Deleted'
		];
		echo json_encode($res);
		return false;
	
	}
}

if(isset($_POST['save_category'])){
	$name=$_POST['cName'];
    $description =$_POST['descri'];
	
	if(empty($name)|| empty($description)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$result =addCategory($conn, $name, $description);
	if($result){
		$res =[
			'status' => 200,
			'message' => 'Category Added Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Category Addition Failed'
		];
		echo json_encode($res);
		return false;
	
	}
}
 
 if(isset($_GET['id'])){
	 $id=$_GET['id'];
	 $category= getCategoryById($conn, $id);
	 if($category){		
		$res =[
			'status' => 200,
			'data'=> $category
		];
		echo json_encode($res);
		return false; 
	 } else{		
		$res =[
			'status' => 404,
			'message' => 'student not found'
		];
		echo json_encode($res);
		return false;
	 }
}
 
 if(isset($_POST['update_category'])){
	$id=$_POST['category_id']; 
	$name=$_POST['name'];
    $description =$_POST['description'];
	
	if(empty($name)|| empty($description)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		return false;
		//return false;
	} 
	$result =updateCategory($conn, $name, $description, $id);
	if($result){
		$res =[
			'status' => 200,
			'message' => 'Category updated Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Category update Failed'
		];
		echo json_encode($res);
		return false;
	
	}
}
 
 if(isset($_POST['delete_category'])) {
	 $id=$_POST['category_id'];
	 $result=deleteCategory($conn,$id);
	 if($result){
		$res =[
			'status' => 200,
			'message' => 'Category deleted Successfully'
			
		];
		echo json_encode($res);
		return false;
	}else{
		$res =[
			'status' => 500,
			'message' => 'Category Not Deleted'
		];
		echo json_encode($res);
		return false;
	
	}
}
 ?>