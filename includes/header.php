<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit();
}

$user = $_SESSION['user'];
?>
<?php 
include 'includes/connection.php';
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    

<head>
        <meta charset="UTF-8">
        <title>Limkokwing University Library</title>
        <link rel="shortcut icon" href="dist/images/LUCT-Uganda-Logo.jpg" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
         
        <script src="dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <!-- START: Template CSS-->
        <link rel="stylesheet" href="dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="dist/vendors/flags-icon/css/flag-icon.min.css"> 
        <link rel="stylesheet" href="dist/vendors/flag-select/css/flags.css">
        <!-- END Template CSS-->

         <!-- START: Page CSS-->
        <link rel="stylesheet" href="dist/vendors/datatable/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" href="dist/vendors/datatable/buttons/css/buttons.bootstrap4.min.css"/>
        <!-- END: Page CSS-->

        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="dist/vendors/chartjs/Chart.min.css">
        <!-- END: Page CSS-->

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="dist/vendors/morris/morris.css"> 
        <link rel="stylesheet" href="dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"> 
        <link rel="stylesheet" href="dist/vendors/chartjs/Chart.min.css"> 
        <link rel="stylesheet" href="dist/vendors/starrr/starrr.css"> 
        <link rel="stylesheet" href="dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="dist/vendors/ionicons/css/ionicons.min.css"> 
        <link rel="stylesheet" href="dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
        <!-- END: Page CSS-->

         <!-- START: Template CSS-->
         <link rel="stylesheet" href="dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="dist/vendors/flags-icon/css/flag-icon.min.css"> 
        <link rel="stylesheet" href="dist/vendors/flag-select/css/flags.css">
        <!-- END Template CSS--> 
         <!-- START: Page CSS-->
        <link rel="stylesheet" href="dist/vendors/select2/css/select2.min.css"/>
        <link rel="stylesheet" href="dist/vendors/select2/css/select2-bootstrap.min.css"/>
        <!-- END: Page CSS-->

        <!-- START: appCalendar CSS-->   
        <link rel="stylesheet" href="dist/vendors/fullcalendar/core/main.min.css"> 
        <link rel="stylesheet" href='dist/vendors/fullcalendar/daygrid/main.css'/>
        <link rel="stylesheet" href='dist/vendors/fullcalendar/timegrid/main.css'/>
        <link rel="stylesheet" href='dist/vendors/fullcalendar/list/main.css'/>   
        <!-- END: appCalender CSS-->

        <link rel="stylesheet" href="dist/vendors/sweetalert/sweetalert.css">
 

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="dist/css/main.css">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <img src="dist/images/LUCT-Uganda-Logo.jpg" alt="logo" width="23" class="img-fluid"/>
        </div>
        <!-- END: Pre Loader-->

        <!-- START: Header-->
        <div id="header-fix" class="header fixed-top">
            <nav class="navbar navbar-expand-lg  p-0">
                <div class="navbar-header h4 mb-0 align-self-center logo-bar text-center">  
                    <a href="index.php" class="horizontal-logo text-center">
                        
                        <span class="h3 align-self-center mb-0 ">LUCT</span>              
                    </a>                   
                </div>
                <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                    <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu body-color"></i></a>
                </div>
                <div class="navbar-header ml-auto py-2 h-100">
                    <img src="dist/images/LUCT-Uganda-Logo.jpg" alt="logo" width="80" class="img-fluid"/>
                </div>
                <div class="navbar-right ml-auto h-100">
                    <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                    <li class="dropdown align-self-center d-inline-block">
                            <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                           
                                <span class="badge badge-default"> <span class="ring">
                                    </span><span class="ring-point">
                                    </span> </span>
                                    
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right border py-0">
                                
                                <li >
                                    <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                        <div class="media">
                                            
                                            <div class="media-body">
                                                <button id="notification-btn" class="btn btn-primary btn-sm">Notifications (<span id="notification_count">0</span>)</button>
                                                <p class="mb-0 text-dark" id="notification-list" style="white-space: normal; overflow-wrap: break-word;"></p>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>                      
                        
                        <?php $image=getPicByEmail($conn, $user['email']); ?>
                        <li class="dropdown user-profile align-self-center d-inline-block">
                            <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false"> 
                                <div class="media">
                                                                       
                                    <img id="prof" src="
                                    <?php 
                                     
                                    echo !empty($image['pic']) ? $image['pic'] : 'dist/images/default.png';
                                    ?>" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                </div>
                            </a>

                            <div class="dropdown-menu  dropdown-menu-right p-0">
                                <a href="editProfile.php" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                <a href="viewProfile.php" class="dropdown-item px-2 align-self-center d-flex">
                                    <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                <div class="dropdown-divider"></div>
                                
                                <a href="signout.php" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                    <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                            </div>

                        </li>

                    </ul>
                </div>
            </nav>
        </div>
        <!-- END: Header-->

        <!-- START: Main Menu-->
        <div class="sidebar">
            <div class="media d-block text-center user-profile">
                <div class="rel">
                    <img class="img-fluid" src="<?php echo !empty($image["pic"]) ? $image["pic"] : 'dist/images/default.png'; ?>" alt="" width="100px" height="100px">
                </div>
                <div class="media-body text-center mt-0 color-primary mt-2">
                        <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false"> 
                            <h6 class="mb-0 font-weight-bold" ><?= $user['email']; ?></h6>
                            <?=$user['usertype'];?> 
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-0" style="">
                            <a href="editProfile.php" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                            <a href="viewProfile.php" class="dropdown-item px-2 align-self-center d-flex">
                                <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                            <div class="dropdown-divider"></div>
                            
                            <a href="signout.php" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                        </div>
                </div>
            </div>
            
            <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li class="dropdown active"><a href="index.php">Dashboard</a>                  
                    <ul>
                        <li class="active"><a href="index.php"><i class="icon-home"></i> Dashboard</a></li>
                    </ul>
                </li>
                

                <li class="dropdown"><a href="#">Features</a>                 
                    <ul>
                        <li><a href="displayBooks.php"><i class="fa fa-book"></i>Books</a>
                        <li><a href="onlineBooks.php"><i class="fa fa-book"></i>Online Books</a> 

                        <?php if($user['usertype']=='admin') { ?>                            
                        </li>
                        <li  class="dropdown"><a href=""><i class="fa fa-user"></i>Manage Users</a>
                            <ul class="sub-menu">
                                <li><a href="displayStudents.php"><i class="icon-user"></i>Students</a>                             
                                                      
                                </li>
                                <li><a href="displayStaff.php"><i class="icon-user"></i>Staff</a></li>                                
                            </ul>                      
                        </li>
                        <?php }?> 
                        <li><a href="displayReservations.php"><i class="fa fa-calendar"></i>Reservations</a>                                
                                              
                        </li>
                        <li><a href="viewIssuedBooks.php"><i class="fa fa-exchange-alt"></i>Issued books</a></li>
                        <?php if($user['usertype']=='admin') { ?>
                        <li><a href="viewPayments.php"><i class="fa fa-exchange-alt"></i>Payments</a></li>
                                
                        <?php } ?>                              
                        
                        <?php if($user['usertype']=='admin') { ?>
                        <li  class="dropdown"><a href=""><i class="icon-settings"></i>Settings</a>
                            <ul class="sub-menu">
                               <li><a href="displayCategories.php"><i class="fa fa-book"></i>Categories</a></li>                             
                         
                               <li><a href="displayAuthors.php"><i class="icon-user"></i>Authors</a></li>                              
                            </ul>                         
                        </li>
                        
                        <li  class="dropdown"><a href=""><i class="fa fa-file-alt"></i> Reports</a>
                            <ul class="sub-menu">
                                <li><a href="totalFines.php"><i class="fa fa-file-alt"></i>Fines Report</a></li>
                                <li><a href="inventoryReport.php"><i class="fa fa-file-alt"></i>inventory Report</a></li>
                                <li><a href="viewReturnedBooks.php"><i class="fa fa-file-alt"></i>Returned books</a></li>
                                <li><a href="allFines.php"><i class="fa fa-file-alt"></i>View Fines</a></li>
                            </ul>  
                        </li> 
                        <?php } ?>             
                    </ul>                   
                </li>
                <li class="dropdown"><a href="#">Web Apps</a>                  
                    <ul>
                        <li><a href="appCalendar.php"><i class="icon-calendar"></i> Calendar</a></li>
                        
                    </ul>                   
                </li>
               
                
               
            </ul>
          
        </div>
<script>
    function formatDate(dateString) {
    const options = { 
        year: 'numeric', 
        month: '2-digit', 
        day: '2-digit', 
        hour: '2-digit', 
        minute: '2-digit', 
        hour12: true,
        
    };
    console.log(dateString);
    const date = new Date(dateString + ' UTC');
    return date.toLocaleString('en-GB', options);
}

    $(document).ready(function() {
        // Function to fetch notifications
        function fetchNotifications() {
            $.ajax({
                url: 'fetch_notifications.php', // PHP file that returns JSON notifications
                method: 'GET',
                success: function(data) {                   
                    const notifications = JSON.parse(data);  
                                                    
                    let notificationCount = notifications.length;
                    
                    // console.log(notificationCount); 
                    // Update the notification count
                    $('#notification_count').text(notificationCount);
                    // Clear the notification list and add new notifications
                    $('#notification-list').empty();
                    
                    if (notificationCount > 0) {
                        notifications.forEach(notification => {
                            $('#notification-list').append(`
                                <li class="notification-item">
                                   
                                    <button class="btn btn-outline-light btn-sm mark-read" data-id="${notification.id}"><i class="fas fa-trash" style="color: orange;" ></i></button>
                                     ${notification.message}<br>
                                    <span class="time ml-4"><small>${formatDate(notification.date_created)}</small></span>
                                </li>
                            `);
                        });
                    } else {
                        $('#notification-list').append('<li class="text-warning">No new notifications</li>');
                    }
               
                }
            });
      
        }

        // Periodically fetch notifications every 5 seconds
        setInterval(fetchNotifications, 5000);

        // Mark a notification as read
        $(document).on('click', '.mark-read', function() {
            let notificationId = $(this).data('id');
           
            $.ajax({
                url: 'new.php', // Script to mark as read
                method: 'POST',
                data: { notificationId: notificationId },
                success: function(response) {
                    // alert(response);
                    fetchNotifications(); // Refresh notifications after marking as read
                }
            });
        });

        // Initially fetch notifications
        fetchNotifications();
    });

    function checkDueDates() {
        $.ajax({
            url: 'addNotification.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    console.log(response.message); // Log success
                    // Optionally, you can update the notifications UI here
                    loadNotifications(); // Call a function to load new notifications
                } else {
                    console.log(response.message); // Log if no due items are found
                }
            },
            error: function(xhr, status, error) {
                console.error("Error checking due dates: " + error);
            }
        });
    }

setInterval(checkDueDates, 5000); 

</script>
