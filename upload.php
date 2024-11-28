<?php
include ('includes/functions.php');
include ('includes/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if email and profile_photo are set
    if (isset($_POST['email']) && isset($_FILES['profile_photo'])) {
        $email = $_POST['email']; // Get the user's email
        $file = $_FILES['profile_photo']; // Get the uploaded file
        
        // Create a sanitized version of the email to use in the directory or file name
        $sanitizedEmail = preg_replace('/[^a-zA-Z0-9]/', '_', $email);
        
        // Specify the upload directory
        $uploadDir = 'uploads/' . $sanitizedEmail . '/'; // Create a unique folder for each user based on email
        
        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Create a unique filename to avoid conflicts
        $uploadFile = $uploadDir . basename($file['name']);

        // Move the uploaded file to the user's directory
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $result=updatePic($conn, $uploadFile, $email);
            if($result){
                $res =[
                    'status' => 200,
                    'message' => 'Profile picture uploaded successfully.'
                    
                ];
                echo json_encode($res);
                return false;
               
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
            'message' => 'No file provided.'
            
        ];
        echo json_encode($res);
        return false;
       
    }
}
}
?>
