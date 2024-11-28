<?php include_once ('includes/header.php') ?>

<?php
/*
if(isset($_POST['reserve'])) {
    session_start();
   //echo var_dump($_POST);
   $book_id=$_POST['title'];
   $status=$_POST['status'];
   $author_id=$_POST['author'];
   $email=$_POST['email'];
   if(VerifyEmail($conn, $email)) {
    $mId= getStudentIdByEmail($conn, $email);
    $member_id= $mId['id'];
    $result= addReservation($conn,$status,$book_id, $member_id);
    if($result) {
        echo '<script>success()</script>';
        echo '<script> window.location.href="displayReservations.php"</script>';
    }

   } else {    
    $_SESSION['error'] = "Incorrect email.";
    header ('location: displayReservation.php');
   }
   
}
*/
// if (isset($_GET['id'])) {
// $id= $_GET['id'];
// $result= updateStatus($conn, $id);
// if ($result) {
//    echo '<script> window.location.href="displayReservations.php"</script>';
// }
// }
?>
 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <?php if($user['usertype']=='admin') { ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Reservations</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Reservation</button></li>
                                
                            </ol>
                        <?php } else { ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">View My Reservations</h4></div>
                        <?php } ?>
							<!--Modal to add Reservation -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="saveReservationModal" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Add Reservation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                                            <form id="saveReservation">
                                                <div class="form-row">
                                                     
                                                    <div class="col-6 mb-3">   
                                                      <label for="Author">Enter Book</label>              
                                                    
                                                         <select name="title" id="title" class="form-control">
                                                            <option>choose Book</option>
                                                             <?php

                                                              $books =getAllBooks($conn);
                                                              foreach($books as $book):
                                                              ?>
                                                              <option value="<?= $book['id'] ?>"><?= $book['title']." By "?><?php  $name=getAuthorNameById($conn, $book['author_id']); echo $name['name']; ?></option>
                                                              <?php endforeach ?>
                                                              
                                    
                                                         </select>
                                                                                    
                                                    </div>
                                                    <input type="text" name="status" id="status" value="reserved" hidden>

                                                    <div class="col-6 mb-3">
                                                        <label for="username">Enter E-mail</label>

                                                        <input type="text" name="email" id="email" class="form-control" placeholder="">

                                                    </div>
                                                    <div class="col-12">
                                                        
                                                            <button type="submit" class="btn btn-primary">Add Reservation</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        

                                                    </div>
                                                </div>
                                            </form>
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                          
                            </div>  

							<!--Modal to edit Reservation -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="editReservationModal" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Update Reservation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                                            <form id="updateReservation">
                                                <div class="form-row">
                                                    
                                                    <div class="col-6 mb-3">   
                                                      <label for="bookTitle">Enter Book</label>              
                                                    
                                                         <select name="bookTitle" id="bookTitle" class="form-control">
                                                            <option>choose </option>
                                                             <?php

                                                              $books =getAllBooks($conn);
                                                              foreach($books as $book):
                                                              ?>
                                                              <option value="<?= $book['id'] ?>"><?= $book['title'] ." By "?><?php  $name=getAuthorNameById($conn, $book['author_id']); echo $name['name']; ?></option>
                                                              <?php endforeach ?>
                                                              
                                    
                                                         </select>
                                                                                    
                                                    </div>
                                                    <input type="text" name="newStatus" id="newStatus" value="reserved" hidden>
													<input type="text" name="reservation_id" id="reservation_id" hidden>

                                                    <div class="col-6 mb-3">
                                                        <label for="username">Enter E-mail</label>

                                                        <input type="text" name="e-mail" id="e-mail" class="form-control" placeholder="">

                                                    </div>
                                                    <div class="col-12">
                                                        
                                                            <button type="submit" class="btn btn-primary">Update Reservation</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        

                                                    </div>
                                                </div>
                                            </form>
                                          
                                        </div>
                                    </div>
                                </div>
                          
                            </div> 
                        </div>
                        <ol class="float-right">
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                            unset($_SESSION['error']);
                        }
                        ?></ol>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">All Reservations</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                    <?php if($user['usertype']=='admin') { ?>
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                               
                                                <th>E-mail</th>
                                                <th>Book</th>
                                                <th>Reservation Date</th>
                                                <th>Status</th>                                        
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $num=0;
                                            
                                            $Reservations=getAllReservations($conn);
                                            foreach ($Reservations as $Reservation):
                                               
                                            ?>
                                            <tr>
                                                <td><?= $num+=1 ?></td>
                                                <td><?php
                                               // $user= getEmailById($conn,
                                                 //$Reservation['member_id']);
                                                 echo $Reservation['email'];
                                                  ?></td>
                                                
                                                <td><?php
                                                $book= getBookById($conn,
                                                 $Reservation['book_id']);
                                                $author= getAuthorNameById($conn, $book['author_id']);

                                                 echo $book['title']. " by ". $author['name'];
                                                  ?></td>
                                                
                                                <td><?= $Reservation['reservation_date'] ?></td>
                                                <td><?php 
                                                if($Reservation['status']=='reserved' && date('Y-m-d')> addDate($conn, $Reservation['reservation_date'])){
                                                    deleteRecord($conn);
                                                }else{
                                                    echo $Reservation['status'];
                                                }
                                                 ?></td>
                                                <td>
                                                 <div class="ml-auto mail-tools">
                                                  <form id="issueBook" class="list-inline-item">
                                                    <input type="text" name="email" id="email" value="<?= $Reservation['email'] ?>" class="form-control d-none" placeholder="">
                                                    <input type="text" name="res" id="res" value="<?= $Reservation['id'] ?>" class="form-control d-none" placeholder="">
                                                    <input type="text" name="title" id="title" class="form-control d-none" value="<?= $Reservation['book_id'] ?>" placeholder="">
                                                    <button type="submit" data-toggle="tooltip" class=" btn btn-primary mb-1 btn-sm"title="issue" data-placement="bottom" class="ml-2"><i class="fa fa-handshake"></i></button> 
                                                  </form>
                                                  
                                                  <!-- <button type="button" value="<?// $Reservation['id']?>" class="editReservationBtn btn btn-success list-inline-item"data-toggle="tooltip" title="edit" data-placement="bottom" class="ml-2"><i class="icon-pencil mb-1"></i></button>  -->
                                                  <button type="button" value="<?= $Reservation['id']?>" class="deleteReservationBtn btn btn-danger list-inline-item mb-1 btn-sm" data-toggle="tooltip" title="Delete" data-placement="bottom" class="ml-2"><i class="icon-trash mb-1 "></i></button>
                                                 </div> 
                                                </td>
                                            </tr>
                                           
                                         <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                               
                                                <th>E-mail</th>
                                                <th>Book</th>
                                                <th>Reservation Date</th>
                                                <th>Status</th>
                                                <th>action</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <?php } else{ ?>
                                            <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>Reservation Date</th>
                                                <th>Status</th>                                        
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $num=0;
                                            $email=$user['email'];
                                            $Reservations=getUserReservations($conn,$email);
                                            foreach ($Reservations as $Reservation):
                                               
                                            ?>
                                            <tr>
                                                <td><?= $num+=1 ?></td>
                                                
                                                <td><?php
                                                $book= getBookById($conn,
                                                 $Reservation['book_id']);
                                                $author= getAuthorNameById($conn, $book['author_id']);

                                                 echo $book['title']. " by ". $author['name'];
                                                  ?></td>
                                                
                                                <td><?= $Reservation['reservation_date'] ?></td>
                                                <td><?php 
                                                if($Reservation['status']=='reserved' && date('Y-m-d')> addDate($conn, $Reservation['reservation_date'])){
                                                    deleteRecord($conn);
                                                }else{
                                                    echo $Reservation['status'];
                                                }
                                                 ?></td>
                                                <td><button type="button" value="<?= $Reservation['id']?>" class="deleteReservationBtn btn btn-warning list-inline-item" data-toggle="tooltip" title="Delete" data-placement="bottom" class="ml-2"><i class="icon-trash mb-1 "></i></button>
                                                </div> </td>
                                            </tr>
                                           
                                         <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>Reservation Date</th>
                                                <th>Status</th>
                                                <th>action</th>
                                            </tr>
                                        </tfoot>
                                        <?php }?>
                                    </table>
                                </div>
                            </div>
                        </div> 

                    </div>                  
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>
 <script>
			$(document).on('submit', '#saveReservation', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("save_reservation", true);
				$.ajax({
					type: "POST",
					url: "new.php",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response){
						//  alert(response);
						var res = jQuery.parseJSON(response);
						
						if(res.status == 422){ 
												
							$('#errorMessage').removeClass('d-none');
							$('#errorMessage').text(res.message);
						} else if(res.status ==200){
                            swal("Success!", res.message, "success");
                            $('#saveReservation')[0].reset();
							$('#errorMessage').addClass('d-none');
							$('#saveReservationModal').modal('hide');
							
							//alert(res.message);							
							$('#example').load(location.href + " #example");
						} else {
                            swal("Error", res.message, "error");
							// $('#errorMessage').removeClass('d-none');
							// $('#errorMessage').text(res.message);
							}

						},
                        error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
					
				});
			});

			$(document).on('click', '.editReservationBtn', function (){
			var reservation_id= $(this).val();
			//alert(reservation_id);
			$.ajax({
				type: "GET",
				url: "new.php?reservation_id=" + reservation_id,
				success: function (response) {
					//alert(response);
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
										
						alert(res.message);
					} else if(res.status ==200){
						$('#reservation_id').val(res.data.id);
						$('#author').val(res.data.author_id);
						$('#bookTitle').val(res.data.book_id);
						$('#e-mail').val(res.data.email);
						//alert(res.data.book_id);
						$('#editReservationModal').modal('show');
										
						
					} 
					}
				});
			});

			$(document).on('click', ' .deleteReservationBtn', function (e){
               
				e.preventDefault();
				var reservation_id= $(this).val();
				swal({
					title: "Are you sure?",
					text: "You will not be able to recover this  file!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: 'btn-danger',
					confirmButtonText: 'Yes!',
					closeOnConfirm: false,
					//closeOnCancel: false
					},
					function(){
                        $.ajax({
                        type: "POST",
                        url: "new.php",
                        data: {
                        'delete_reservation': true,
                        'reservation_id': reservation_id
                        },
                        success: function (response) {
                            var res = jQuery.parseJSON(response);
                            if(res.status == 500){ 
                                swal("Error", res.message, "error");
                            } else{
                                swal("Deleted!", res.message, "success");
                                $('#example').load(location.href + " #example");
                            }
                        },
                        error: function (xhr, status, error) {
                                swal("Error", "Something went wrong!", "error"); 
                        }
                    });
				});
			});
            $(document).on('submit', '#issueBook', function (e){
               
               e.preventDefault();
               var formData = new FormData(this);
               formData.append("issue_book", true);
               $.ajax({
                   type: "POST",
                   url: "new.php",
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function (response){
                    //   alert(response);
                       var res = jQuery.parseJSON(response);
                       
                       if(res.status == 422){ 
                                               
                           $('#errorMessage').removeClass('d-none');
                           $('#errorMessage').text(res.message);
                       } else if(res.status ==200){
                           swal("Success!", res.message, "success");
                           $('#errorMessage').addClass('d-none');
                           $('#issuedBookModal').modal('hide');
                           $('#issueBook')[0].reset();
                           						
                           $('#example').load(location.href + " #example");
                          // alert(res.message);	
                       } else if(res.status ==500) {
                           swal("Error", res.message, "error");
                        //    $('#errorMessage').removeClass('d-none');
                        //    $('#errorMessage').text(res.message);
                        } else{
                            swal("Error", res.message, "error");
                            // $('#errorMessage').removeClass('d-none');
                            // $('#errorMessage').text(res.message);
                        }

                       },
                       error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
           
               
               });
           });
</script>
<?php include_once ('includes/footer.php') ?>