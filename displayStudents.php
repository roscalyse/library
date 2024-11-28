<?php include_once ('includes/header.php') ?>

<?php
/*if(isset($_GET['id'])){
  $id= $_GET['id']; 
  $email=getEmailById($conn, $id);
  $results= deleteUser($conn,$email['email']); 
  
  if($results){
    $result= deleteStudent($conn,$id);
   
    if($result) {
       echo '<script>alert("Student Deleted Successfully")</script>';
       
        }else{
         echo '<script>alert("Student Deletion Failed")</script>';
        }
  }
}

if(isset($_POST['addStudent'])) {
    //echo var_dump($_POST);
    $fName=$_POST['fName'];
    $lName =$_POST['lName'];
    $regNo=$_POST['regNo'];
    $email=$_POST['email'];
    $contact =$_POST['contact'];
    $password=$_POST['password'];
    //$usertype=$_POST['usertype'];
    
    // call function
    $result =addStudents($conn,$fName, $lName, $regNo, $email, $contact, $password);
    if($result) {
     $email=$_POST['email'];;
     $password=$_POST['password']; 
     $usertype=$_POST['usertype'];
     $user= addUser($conn, $email, $password, $usertype);
     if($user) { 
        echo '<script>alert("Student Added Successfully")</script>';
        echo '<script> window.location.href="displayStudents.php"</script>';
     } else{
        echo '<script>alert("Students Addition Failed")</script>';
     }
    }
 }

 if(isset($_POST['updateStudent'])) {
    $id=$_POST['id'];
   $fName=$_POST['fName'];
   $lName =$_POST['lName'];
   $regNo=$_POST['regNo'];
   $email=$_POST['email'];
   $contact =$_POST['contact'];
   $password=$_POST['password'];
   
  
   // call function
   $result =updateStudents($conn, $fName, $lName, $regNo, $email, $contact, $password, $id);
   if($result) {
   
       echo '<script>alert("Student updated Successfully ")</script>';
       echo '<script> window.location.href="displayStudents.php"</script>';
    } else{
       echo '<script>alert("Students updated Failed")</script>';
    }
  
}*/
?>
 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Students</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">Add Student</button></h4></li>
                                
                            </ol>
							<!-- Modal to add students -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addStudentModal" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Add Student</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
												<div id="errorMessage" class=" alert alert-warning d-none"></div>
                                                <form id="saveStudent">
                                                <div class="form-row">
                                                        <div class="col-6 mb-3">
                                                            <label for="First Name">First Name</label>

                                                            <input type="text" name="fName" id="fName" class="form-control" placeholder="First Name">

                                                        </div>
                                                        <div class="col-6 mb-3"> 
                                                            <label for="Last Name">Last Name</label>                                               
                                                            <input type="text" name="lName" id="lName" class="form-control" placeholder="Last Name">
                                                        </div>
                                                    <label for="stud_id">Registration Number</label>
                                                    <div class="input-group  mb-3">

                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="icon-user"></i></span>
                                                        </div>
                                                        <input type="text" name="regNo" id="regNo" class="form-control" placeholder="Registration Number" >

                                                    </div>
                                                
                                                        <div class="col-6 mb-3">
                                                        <label for="email">Email</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0" id="basic-email"><i class="icon-envelope"></i></span>
                                                            </div>
                                                            <input type="text" name="e-mail" id="e-mail" class="form-control" placeholder="Email" >
                                                        </div>

                                                        </div>
                                                        <div class="col-6 mb-3">
                                                        <label for="contact">Contact</label>
                                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="contact" >

                                                        </div>


                                                    <label for="username">Password</label>

                                                    <div class="input-group mb-3 ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0" id="basic-password"><i class="icon-options"></i></span>
                                                        </div>
                                                        <input type="password" name="pincode" id="pincode" class="form-control" placeholder="Password">
                                                    </div>

                                                    <input type="text" class="d-none" name="usertype" id="usertype" class="form-control" value="student">

													<input type="text" class="d-none" name="creator" id="creator" class="form-control" value="<?=$user['email']?>">
                                                    <div class="form-group">
													
														<button type="submit" class="btn btn-primary">Add Student</button>   
														<button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>

                                                    </div>
                                                </form>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                          
                            </div>  

							<!-- modal to update students -->
							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="editStudentModal"aria-labelledby="myLargeModalLabel10" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="myLargeModalLabel10">Update Student </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										<div id="updateErrorMessage" class="alert alert-warning d-none"></div>
											<form id="updateStudent">
												<div class="form-row">
													<input type="text" name="student_id" id="student_id" hidden>																		
													<div class="col-6 mb-3">
														<label for="First Name">First Name</label>

														<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">

													</div>
													<div class="col-6 mb-3"> 
														<label for="Last Name">Last Name</label>                                               
														<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
													</div>
														
													<label for="stud_id">Registration Number</label>
													<div class="input-group  mb-3">

														<div class="input-group-prepend">
															<span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="icon-user"></i></span>
														</div>
														<input type="text" name="stud_id" id="stud_id" class="form-control" placeholder="Registration Number" >

													</div>
											
													<!-- <div class="col-6 mb-3"> -->
													<!-- <label for="email">Email</label>

													<div class="input-group">
														<div class="input-group-prepend">
														<span class="input-group-text bg-transparent border-right-0" id="basic"><i class="icon-envelope"></i></span>
														</div> -->
														<input type="text" name="email" id="email" class="form-control d-none" placeholder="Email" >
													<!-- </div> -->
													<input type="text" class="d-none" name="modifier" id="modifier" class="form-control" value="<?=$user['email']?>">

													<div class="col-12 mb-3">
														<label for="contact">Contact</label>
														<input type="text" name="contact" id="contact" class="form-control" placeholder="contact">

													</div>
												</div>


												<!-- <label for="pin">Password</label>

												<div class="input-group mb-3 ">
													<div class="input-group-prepend">
														<span class="input-group-text bg-transparent border-right-0" id="basic-password"><i class="icon-options"></i></span>
													</div> -->
													<input type="text" name="password" id="password" class="form-control d-none" placeholder="Password">
												<!-- </div> -->

																											  
												<div class="form-group">

													<button type="submit" class="btn btn-primary">Update Student</button>  
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
												</div>
																					
										</div>
										</form>
									</div>
								</div>
							</div>
			
						 </div> 
		
						<!-- modal to view students -->
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="viewStudentModal"aria-labelledby="myLargeModalLabel10" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myLargeModalLabel10"><b>View Student</b> </h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
									<div id="updateErrorMessage" class="alert alert-warning d-none"></div>
										
											<div class="form-row">
																													
												<div class="col-6 mb-3">
													<label for="First Name"><b>First Name</b></label>

													<p id="view_first_name" class="form-control"></p>

												</div>
												<div class="col-6 mb-3"> 
													<label for="Last Name"><b>Last Name</b></label>                                               
													<p id="view_last_name" class="form-control"></p>
												</div>
												
											<label for="stud_id"><b>Registration Number</b></label>
											<div class="input-group  mb-3">
												
												<p id="view_stud_id" class="form-control"></p>

											</div>
										
												<div class="col-6 mb-3">
												<label for="email"><b>Email</b></label>

												<div class="input-group">
													
													<p id="view_email" class="form-control"></p>
												</div>

												</div>
												<div class="col-6 mb-3">
												<label for="contact"><b>Contact</b></label>
												<p id="view_contact" class="form-control"></p>

												</div>

												  
											<div class="form-group">
  
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
											</div>
																				
									</div>
									
								</div>
							</div>
						</div>
		
					 </div> 	
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">All Students </h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                
                                                <th>Full Name</th>
                                                
                                                <th>Email</th>
                                                <th>Date registered</th>
												<th>Created By</th>
                                                <th>action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        
                                          $num=0;
                                          $students =getAllStudents($conn);
                                          foreach($students as $student):
                                        ?>
                                            <tr>
                                                <td><?= $num+=1 ?></td>
                                                
                                                <td><?= $student['first_name'] ." ". $student['last_name'] ?></td>
                                                                                                
                                                <td><?= $student['email'] ?></td>
                                               <td><?= $student['date_created'] ?></td>
											   <td><?= $student['created_by'] ?></td>
                                                <td>
                                                 <div class="ml-auto mail-tools">
                                                  <button type="button" value="<?=$student['id']?>" class="viewStudentBtn btn btn-primary mb-1 btn-sm" data-toggle="tooltip" title="view" data-placement="bottom"><i class="icon-eye mb-1"></i></button> 
                                                  <button type="button" value="<?=$student['id']?>" data-toggle="tooltip" title="edit" data-placement="bottom" class="editStudentBtn ml-2 btn btn-success mb-1 btn-sm"><i class="icon-pencil"></i></button> 
                                                  <button type="button" value="<?= $student['id'] ?>" data-toggle="tooltip" title="Delete" data-placement="bottom" class="deleteStudentBtn btn btn-danger ml-2 mb-1 btn-sm"><i class="icon-trash"></i></button>
											</div>
                                                </td>
                                               
                                            </tr>    
											<?php endforeach?>          
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                               
                                                <th>Full Name</th>
                                                
                                                <th>Email</th>
                                               <th>date registered</th>
											   <th>Created By</th>
                                                <th>action</th> 
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <h5 class="text-primary"><?= $num ?> Total Students</h5>
                                </div>
                            </div>
                        </div> 

                    </div>                  
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>
 <script>
		$(document).on('submit', '#saveStudent', function (e){
		   
			e.preventDefault();
			var formData = new FormData(this);
			formData.append("save_student", true);
			$.ajax({
				type: "POST",
				url: "new.php",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response){
					// alert(response);
					var res = jQuery.parseJSON(response);
					
					if(res.status == 422){ 
											
						$('#errorMessage').removeClass('d-none');
						$('#errorMessage').text(res.message);
					} else if(res.status ==200){
						swal("Success!", res.message, "success");
						$('#errorMessage').addClass('d-none');
						$('#addStudentModal').modal('hide');
						$('#saveStudent')[0].reset();
						//alert(res.message);							
						$('#example').load(location.href + " #example");
					} else {
						swal("Error", res.message, "error");
						$('#saveStudent')[0].reset();
						// $('#errorMessage').removeClass('d-none');
						// $('#errorMessage').text(res.message);
						}

					},
					error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
					}
					
			});
		});
		
		$(document).on('click', '.editStudentBtn', function (){
			var student_id= $(this).val();
			//alert(id);
			$.ajax({
				type: "GET",
				url: "new.php?student_id=" + student_id,
				success: function (response) {
					//alert(response);
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
										
						swal("Error",res.message, "error");
					} else if(res.status == 200){
						$('#student_id').val(res.data.id);
						$('#first_name').val(res.data.first_name);
						$('#last_name').val(res.data.last_name);
						$('#stud_id').val(res.data.stud_id);
						$('#email').val(res.data.email);
						$('#contact').val(res.data.contact);
						$('#password').val(res.data.password);
						//alert(res.data);
						console.log($('#stud_id').val(res.data.stud_id));
						$('#editStudentModal').modal('show');
										
						
					} 
					},
					error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
					}
				});
			});

		$(document).on('submit', '#updateStudent', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("update_student", true);
				$.ajax({
					type: "POST",
					url: "new.php",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response){
						
						var res = jQuery.parseJSON(response);
						// alert(response);
						if(res.status == 422){ 
												
							$('#updateErrorMessage').removeClass('d-none');
							$('#updateErrorMessage').text(res.message);
							
						} else if(res.status ==200){
                            swal("Success!",res.message, "success");
							$('#updateErrorMessage').addClass('d-none');
							$('#editStudentModal').modal('hide');
							$('#updateStudent')[0].reset();
														
							$('#example').load(location.href + " #example");
						} else {
							swal("Error",res.message, "error");
							// $('#errorMessage').removeClass('d-none');
							// $('#errorMessage').text(res.message);
							}

						},
						error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
							
				});
			});
		
		$(document).on('click', ' .deleteStudentBtn', function (e){
               
				e.preventDefault();
				var student_id= $(this).val();
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
						'delete_student': true,
						'student_id': student_id
						},
						success: function (response) {
							var res = jQuery.parseJSON(response);
							if(res.status == 500){ 
								swal("Error",res.message, "error");			
								
							} else{
								swal("Success",res.message, "success");
								$('#example').load(location.href + " #example");
							}
						},
						error: function (xhr, status, error) {
								swal("Error", "Something went wrong!", "error"); 
						}
						});
				});
			});
		
		$(document).on('click', '.viewStudentBtn', function (){
			var student_id= $(this).val();
			//alert(category_id);
			$.ajax({
				type: "GET",
				url: "new.php?student_id=" + student_id,
				success: function (response) {					
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
										
						alert(res.message);
					} else if(res.status ==200){
						$('#view_first_name').text(res.data.first_name);
						$('#view_last_name').text(res.data.last_name);
						$('#view_stud_id').text(res.data.stud_id);
						$('#view_email').text(res.data.email);
						$('#view_contact').text(res.data.contact);
												
						$('#viewStudentModal').modal('show');
										
						
					} 
					}
				});
			});
</script>
<?php include_once ('includes/footer.php') ?>