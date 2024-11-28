<?php include_once ('includes/header.php') ?>

 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                        <?php if($user['usertype']=='admin') { ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Authors</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Author</button></h4></li>
                                
                            </ol>
                        <?php } else { ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">View Authors</h4></div>
                        <?php } ?>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" id ="addAuthorModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Add Authors</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
											<div id="errorMessage" class="alert alert-warning d-none"></div>
                                                <form id="addAuthor" >
                                                
                                                <div class="form-group">
                                                <input type="text" name="aName" id="aName" class="form-control" placeholder="Name:">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4 mb-3"> 

                                                    <label for="date">Date Of Birth: 
                                                    </label> 
                                                    <input type="date" name="dob" id="dob" class="form-control" 
                                                        id="dt"> 
                                                    </div>
                                                    <div class="form-group col-sm-4 mb-3"> 

                                                    <label for="datetime-local">Date of Death: 
                                                    </label> 
                                                    <input type="date" name="dod" id="dod" class="form-control" 
                                                    id="dt"> 
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                <textarea class="form-control"name="bio" id="bio" placeholder="Author's Biography:"></textarea>
                                                </div>


                                                <button type="submit" class="btn btn-primary btn-default">Add Author</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
                                            </form>                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
								<!--edit modal-->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" id ="editAuthorModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Update Authors</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
											<div id="updateErrorMessage" class="alert alert-warning d-none"></div>
                                                <form id="editAuthor" >
                                                
                                                <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name:">
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4 mb-3"> 

                                                    <label for="date">Date Of Birth: 
                                                    </label> 
                                                    <input type="date" name="birth" id="birth" class="form-control" 
                                                        id="dt"> 
                                                    </div>
                                                    <div class="form-group col-sm-4 mb-3"> 

                                                    <label for="datetime-local">Date of Death: 
                                                    </label> 
                                                    <input type="date" name="death" id="death" class="form-control" 
                                                    id="dt"> 
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                <textarea class="form-control"name="biog" id="biog" placeholder="Author's Biography:"></textarea>
                                                </div>
												
												<input type="text" name="author_id" id="author_id" hidden>	

                                                <button type="submit" class="btn btn-primary btn-default">Update Author</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
                                            </form>                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
								<!-- view author modal-->
								 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" id ="viewAuthorModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">View Author</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
											
                                                <div class="form-group">
                                                <label><b>Name</b></label>
												<p class="form-control" id="view_name"></p>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-4 mb-3"> 

                                                    <label for="date"><b>Date Of Birth:</b> 
                                                    </label> 
                                                     <p class="form-control" id="view_dob"></p>
                                                    </div>
                                                    <div class="form-group col-sm-4 mb-3"> 

                                                    <label for="datetime-local"><b>Date of Death:</b> 
                                                    </label> 
                                                    <p class="form-control" id="view_dod"></p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                <label><b>Biography</b></label>
												<p id="view_bio"></p>
                                                </div>
												
												
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
                                                                            
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
                                <h4 class="card-title">All Authors</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Name</th>
                                               
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        
                                          $num=0;
                                          $Authors =getAllAuthors($conn);
                                          foreach($Authors as $Author):
                                        ?>
                                            <tr>
                                              
                                                <td><?= $num+=1 ?></td>
                                                <td><?= $Author['name'] ?></td>
                                                
                                                <td>
                                                 <div class="ml-auto mail-tools">
                                                  <button type="button" value="<?= $Author['id'] ?>" class="viewAuthorBtn btn btn-primary mb-1 btn-sm" data-toggle="tooltip" title="view" data-placement="bottom"><i class="icon-eye mb-1"></i></button>
                                                  <?php if($user['usertype']=='admin') { ?> 
                                                  <button type="button" value="<?= $Author['id'] ?>" class="editAuthorBtn btn btn-success mb-1 btn-sm" data-toggle="tooltip" title="edit" data-placement="bottom" class="ml-2 "><i class="icon-pencil mb-1"></i></button> 
                                                  <button type="button" value ="<?=$Author['id'] ?>" class="deleteAuthorBtn btn btn-danger mb-1 btn-sm" data-toggle="tooltip" title="Delete"data-placement="bottom" class="ml-2"><i class="icon-trash  mb-1 "></i></button>
                                                 </div>
                                                 <?php } ?>
                                                </td>
                                                
                                            </tr>
                                        <?php endforeach; ?>    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Name</th>
                                                
                                               
                                                <th>action</th>
                                            
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div> 

                    </div>                  
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>
  <!-- START: APP JS datatable-->
<script>
			$(document).on('submit', '#addAuthor', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("save_author", true);
				$.ajax({
					type: "POST",
					url: "new.php",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response){
						
						var res = jQuery.parseJSON(response);
						
						if(res.status == 422){ 
												
							$('#errorMessage').removeClass('d-none');
							$('#errorMessage').text(res.message);
						} else if(res.status ==200){
                            swal("Success!", res.message, "success");
							$('#errorMessage').addClass('d-none');
							$('#addAuthorModal').modal('hide');
							$('#addAuthor')[0].reset();
							//alert(res.message);							
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
		    $(document).on('click', '.editAuthorBtn', function (){
			var author_id= $(this).val();
			//alert(reservation_id);
			$.ajax({
				type: "GET",
				url: "new.php?author_id=" + author_id,
				success: function (response) {
					//alert(response);
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
									
                        swal("Error",res.message, "error");	
					} else if(res.status ==200){
						$('#author_id').val(res.data.id);
						$('#name').val(res.data.name);
						$('#birth').val(res.data.DOB);
						$('#death').val(res.data.DOD);
						$('#biog').val(res.data.biography);
						//alert(res.data.DOB);
						$('#editAuthorModal').modal('show');
						
					} 
					},
                    error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
                    }
				});
			});
			$(document).on('submit', '#editAuthor', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("update_author", true);
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
												
							$('#updateErrorMessage').removeClass('d-none');
							$('#updateErrorMessage').text(res.message);
							
						} else if(res.status ==200){
                            swal("Success!",res.message, "success");
							$('#updateErrorMessage').addClass('d-none');
							$('#editAuthorModal').modal('hide');
							$('#editAuthor')[0].reset();
														
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
			$(document).on('click', '.viewAuthorBtn', function (){
			var author_id= $(this).val();
			
			$.ajax({
				type: "GET",
				url: "new.php?author_id=" + author_id,
				success: function (response) {
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
                        swal("Error",res.message, "error");
					} else if(res.status ==200){
						$('#view_dob').text(res.data.DOB);
						$('#view_name').text(res.data.name);
						$('#view_dod').text(res.data.DOD);
						$('#view_bio').text(res.data.biography);
						$('#viewAuthorModal').modal('show');
					
					} 
					},
                    error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
                    }
				});
			});
			$(document).on('click', ' .deleteAuthorBtn', function (e){
               
				e.preventDefault();
				var author_id= $(this).val();
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
                        'delete_author': true,
                        'author_id': author_id
                        },
                        success: function (response) {
                            var res = jQuery.parseJSON(response);
                            if(res.status == 500){ 
                                swal("Error",res.message, "error");
                            } else{
                                swal("Deleted!",res.message, "success");
                                $('#example').load(location.href + " #example");
                            }
                        },
                        error: function (xhr, status, error) {
                                swal("Error", "Something went wrong!", "error"); 
                        }
                    });
				});
			});
			
</script>
<?php include_once ('includes/footer.php') ?>