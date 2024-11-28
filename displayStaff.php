<?php include_once ('includes/header.php') ?>
<?php
if(isset($_GET['id'])){
  $id= $_GET['id']; 
  $email=getStaffEmailById($conn, $id);
  $results= deleteUser($conn,$email['email']); 
  
  if($results){
    $result= deleteStaff($conn,$id);
   
    if($result) {
       echo '<script>alert("Staff Deleted Successfully")</script>';
       
        }else{
         echo '<script>alert("Staff Deletion Failed")</script>';
        }
  }
}

if(isset($_POST['addStaff'])) {
   //echo var_dump($_POST);
   $fName=$_POST['fName'];
   $lName =$_POST['lName'];
   
   $email=$_POST['email'];
   $contact =$_POST['contact'];
   $password=$_POST['password'];
      
   // call function
   $result =addStaff($conn,$fName, $lName, $email, $contact, $password);
   if($result) {
    $email=$_POST['email'];;
    $password=$_POST['password']; 
    $usertype=$_POST['usertype'];
    $user= addUser($conn, $email, $password, $usertype);
    if($user) { 
       echo '<script>alert("Staff Added Successfully")</script>';
       echo '<script> window.location.href="displayStaff.php"</script>';
    } else{
       echo '<script>alert("Staff Addition Failed")</script>';
    }
   }
}
?>

 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Staff</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStaffModal">Add Staff</button></h4></li>
                                
                            </ol>
							<!-- modal to add staff -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addStaffModal" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Add Staff</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
											<div class="alert alert-warning d-none" id="errorMessage"></div>
                                                <form id="saveStaff">
                                                    <div class="form-row">
                                                            <div class="col-6 mb-3">
                                                                <label for="First Name">First Name</label>

                                                                <input type="text" name="fName" id="fName" class="form-control" placeholder="First Name">

                                                            </div>
                                                            <div class="col-6 mb-3"> 
                                                                <label for="Last Name">Last Name</label>                                               
                                                                <input type="text" name="lName" id="lName"  class="form-control" placeholder="Last Name">
                                                            </div>
                                                    <div class="col-6"> 
                                                        <label for="email">Email</label>

                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-transparent border-right-0" id="basic-email"><i class="icon-envelope"></i></span>
                                                            </div>
                                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                                        </div>
                                                    </div> 
                                                    
                                                        <div class="col-6 mb-3">
                                                            <label for="contact">Contact</label>
                                                            <input type="text" name="contact" id="contact" class="form-control" placeholder="contact" >

                                                            </div>
                                                    
                                                        <label for="username">Password</label>

                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-transparent border-right-0" id="basic-password"><i class="icon-options"></i></span>
                                                            </div>
                                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                                        </div>
                                                        <input type="text" class="d-none" name="usertype" id="usertype" class="form-control" value="staff">
                                                        <input type="text" class="d-none" name="creator" id="creator" class="form-control" value="<?=$user['email']?>">
                                                        <div class="form-group">

                                                            <button type="submit" class="btn btn-primary">Add Staff</button>   
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                        </div>
                                                </form>
                                            </div>
                                          </div> 
                                        </div>
                                    </div>
                               </div>
							</div>
                            
							<!-- modal to update staff -->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="updateStaffModal" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Update Staff</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
											<div class="alert alert-warning d-none" id="updateErrorMessage"></div>

                                                <form id="editStaff">
                                                    <div class="form-row">
														<input type="text" name="staff_id" id="staff_id" hidden>
														<div class="col-6 mb-3">
															<label for="First Name">First Name</label>

															<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">

														</div>
														<div class="col-6 mb-3"> 
															<label for="Last Name">Last Name</label>                                               
															<input type="text" name="last_name" id="last_name"  class="form-control" placeholder="Last Name">
														</div>
														<!-- <div class="col-6"> 
																<label for="email">Email</label> -->

																<!-- <div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text bg-transparent border-right-0" id="basic-email"><i class="icon-envelope"></i></span>
																	</div> -->
																	<input type="email" name="e-mail" id="e-mail" class="form-control d-none" placeholder="Email">
																<!-- </div>
															</div>  -->
															<input type="text" class="d-none" name="modifier" id="modifier" class="form-control" value="<?=$user['email']?>">

															<div class="col-12 mb-3">
                                                            <label for="contact">Contact</label>
                                                            <input type="number" name="phone" id="phone" class="form-control" placeholder="contact" >

														</div>
                                                    
                                                        <!-- <label for="username">Password</label> -->

                                                        <!-- <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-transparent border-right-0" id="basic-password"><i class="icon-options"></i></span>
                                                            </div> -->
                                                            <input type="password" name="pincode" id="pincode" class="form-control d-none" placeholder="Password">
                                                        </div>
                                                       

                                                        <div class="form-group">

                                                            <button type="submit" class="btn btn-primary">Update Staff</button>   
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                        
														</div>
													</div>
                                                </form>
                                            
										  
                                        </div>
                                    </div>
								 </div>
                            </div>
							<!-- modal to view staff -->
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="viewStaffModal"aria-labelledby="myLargeModalLabel10" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="myLargeModalLabel10"><b>View Staff</b> </h5>
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
                                <h4 class="card-title">All Staff</h4> 
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        
                                        $num=0;
                                        $staffs =getAllStaff($conn);
                                        foreach($staffs as $staff):
                                      ?>
                                            <tr>
                                                <td><?= $num+=1 ?></td>
                                                <td><?= $staff['first_name']. " ". $staff['last_name'] ?></td>
                                                <td><?= $staff['email'] ?></td>
                                                <td><?= $staff['date_created'] ?></td>
												<td><?= $staff['created_by'] ?></td>
                                                <td>
                                                 <div class="ml-auto mail-tools">
                                                  <button type="button" value="<?=$staff['id']?>" data-toggle="tooltip" class="viewStaffBtn btn btn-primary mb-1 btn-sm" title="view" data-placement="bottom"><i class="icon-eye  mb-1"></i></button> 
                                                  <button type="button" value="<?=$staff['id']?>" data-toggle="tooltip" title="edit" data-placement="bottom" class="editStaffBtn btn btn-success ml-2 mb-1 btn-sm"><i class="icon-pencil mb-1"></i></button> 
                                                  <button type="button" value="<?=$staff['id'] ?>" data-toggle="tooltip" title="Delete"data-placement="bottom" class="deleteStaffBtn btn  btn-danger  ml-2 mb-1 btn-sm"><i class="icon-trash mb-1"></i></button>
                                                 </div>
                                                </td>
                                            </tr>
                                           
                                         <?php endforeach ?>                                    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Full Name</th>
                                                
                                                <th>Email</th>
												<th>Date registered</th>
												<th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <h5 class="text-primary"><?= $num ?> Total Staff</h5>
                                </div>
                            </div>
                        </div> 

                    </div>                  
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>
		<script>
		 $(document).on('submit', '#saveStaff', function (e){
				   
					e.preventDefault();
					var formData = new FormData(this);
					//alert(formData);
					formData.append("save_staff", true);
					$.ajax({
						type: "POST",
						url: "new.php",
						data: formData,
						processData: false,
						contentType: false,
						success: function (response){
							//alert(response);
							var res = jQuery.parseJSON(response);
							
							if(res.status == 422){ 
													
								$('#errorMessage').removeClass('d-none');
								$('#errorMessage').text(res.message);
							} else if(res.status ==200){
								swal("Success!", res.message, "success");
								$('#errorMessage').addClass('d-none');
								$('#addStaffModal').modal('hide');
								$('#saveStaff')[0].reset();
								//alert(res.message);							
								$('#example').load(location.href + " #example");
							} else {
								swal("Error", res.message, "error");
								$('#saveStaff')[0].reset();
								// $('#errorMessage').removeClass('d-none');
								// $('#errorMessage').text(res.message);
								}

							},
							error: function (xhr, status, error) {
								swal("Error", "Something went wrong!", "error"); 
							}			
					
					});
				});
			
		 $(document).on('click', '.editStaffBtn', function (){
			var staff_id= $(this).val();
			//$('#updateStaffModal').modal('show');
			//alert(staff_id);
			$.ajax({
				type: "GET",
				url: "new.php?staff_id=" + staff_id,
				success: function (response) {
					//alert(response);
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
										
						swal("Error",res.message, "error");
					} else if(res.status == 200){
						$('#staff_id').val(res.data.id);
						$('#first_name').val(res.data.first_name);
						$('#last_name').val(res.data.last_name);
						
						$('#e-mail').val(res.data.email);
						$('#phone').val(res.data.contact);
						$('#pincode').val(res.data.password);
						//alert(res.data);
						$('#updateStaffModal').modal('show');
					
					} 
					},
					error: function (xhr, status, error) {
						swal("Error", "Something went wrong!", "error"); 
					}	
				});
			});
	
		 $(document).on('submit', '#editStaff', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("update_staff", true);
				$.ajax({
					type: "POST",
					url: "new.php",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response){
						//alert(response);
						var res = jQuery.parseJSON(response);
						//alert(response);
						if(res.status == 422){ 
												
							$('#updateErrorMessage').removeClass('d-none');
							$('#updateErrorMessage').text(res.message);
							
						} else if(res.status ==200){
                            swal("Success!",res.message, "success");
							$('#updateErrorMessage').addClass('d-none');
							$('#updateStaffModal').modal('hide');
							$('#editStaff')[0].reset();
														
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
		 
		 $(document).on('click', ' .deleteStaffBtn', function (e){
               
				e.preventDefault();
				var staff_id= $(this).val();
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
						'delete_staff': true,
						'staff_id': staff_id
						},
						success: function (response) {
							//alert(response);
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
		 
		 $(document).on('click', '.viewStaffBtn', function (){
			var staff_id= $(this).val();
			//alert(category_id);
			$.ajax({
				type: "GET",
				url: "new.php?staff_id=" + staff_id,
				success: function (response) {					
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
										
						alert(res.message);
					} else if(res.status ==200){
						$('#view_first_name').text(res.data.first_name);
						$('#view_last_name').text(res.data.last_name);
						
						$('#view_email').text(res.data.email);
						$('#view_contact').text(res.data.contact);
												
						$('#viewStaffModal').modal('show');
										
						
					} 
					},
					error: function (xhr, status, error) {
						swal("Error", "Something went wrong!", "error"); 
					}
				});
			});
		
		</script>
<?php include_once ('includes/footer.php') ?>