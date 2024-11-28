<?php include_once ('includes/header.php') ?>

<?php

//header('content-type: application/json');
/*if(isset($_GET['id'])){
  $result= deleteCategory($conn,$_GET['id']);
  if($result){
    echo '<script>alert("Category Deleted Successfully")</script>';
  }else{
    echo '<script>alert("Category Deletion Failed")</script>';

  }
} 
if(isset($_POST['addCategory'])) {
    //echo var_dump($_POST);
    $name=$_POST['cName'];
    $description =$_POST['descri'];
    
    // call function
    $result =addCategory($conn, $name, $description);
    if($result) {
     echo '<script>alert("Category Added Successfully")</script>';
     echo '<script> windows.location.href="displayCategories.php"</script>';
    } else{
     echo '<script>alert("Category Addition Failed")</script>';
    }
 }*/
 
 if(isset($_POST['save_category'])){
	$name=$_POST['cName'];
    $description =$_POST['descri'];
	
	if(empty($name)|| empty($description)){
		$res =[
			'status' => 422,
			'message' => 'All fields are mandatory'
		];
		echo json_encode($res);
		exit();
		//return false;
	} else{
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
 }
?>
 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Categories</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add Category</button></h4></li>
                                
                            </ol>
							<!-- modal to add category -->
                            <div class="modal fade bd-example-modal-lg" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Add Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                           <div class="modal-body">
											<div id="errorMessage" class="alert alert-warning d-none"></div>
                                            
                                              <form id="saveCategory">
                                                
                                                <div class="form-group">
                                                <input type="text" name="cName" id="cName" class="form-control" placeholder="Name:">
                                                </div>
                                    
                                                <div class="form-group">
                                                <textarea class="form-control"name="descri" id="descri" placeholder="Description:"></textarea>
                                                </div>


                                                <button type="submit"  class="btn btn-primary btn-default">Add Category</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                              </form>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
							</div>
                          
                           <!-- modal to edit category -->
                            <div class="modal fade bd-example-modal-lg" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Update Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                           <div class="modal-body">
											<div id="updateErrorMessage" class="alert alert-warning d-none"></div>
                                            
                                              <form id="updateCategory">
                                                <input type="text" name="category_id" id="category_id" hidden>
                                                <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Name:">
                                                </div>
                                    
                                                <div class="form-group">
                                                <textarea class="form-control" name="description" id="description" placeholder="Description:"></textarea>
                                                </div>


                                                <button type="submit"  class="btn btn-primary btn-default">Update Category</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                              </form>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
							</div>   
                           
						   	<!-- modal to view category -->
                            <div class="modal fade bd-example-modal-lg" id="viewCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">view Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                           <div class="modal-body">
											
                                                <div class="form-group">
												<label>Name</label>
                                                <p id="view_name" class="form-control"> </p>
                                                </div>
												<div class="form-group">
												<label><b>Description</b></label>
                                                <p id="view_description">  </p>
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
                                <h4 class="card-title">All Categories</h4> 
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
                                        //have to include total copies of specific category
                                          $num=0;
                                          $categories =getAllCategories($conn);
                                          foreach($categories as $category):
                                        ?>
                                            <tr>
                                              
                                                <td><?= $num+=1 ?></td>
                                                <td><?= $category['name'] ?></td>
                                                
                                                <td>
                                                 <div class="ml-auto mail-tools">
                                                  <button type="button" value="<?=$category['id']; ?>" class="viewCategoryBtn btn btn-primary mb-1 btn-sm" data-toggle="tooltip" title="view" data-placement="bottom" class="mb-2"><i class="icon-eye"></i></button> 
                                                  <button type="button" value="<?=$category['id']; ?>" class="editCategoryBtn btn btn-success mb-1 btn-sm" data-toggle="tooltip" title="edit" data-placement="bottom" class="mb-2"><i class="icon-pencil"></i></button> 
                                                  <button type="button" value="<?=$category['id']; ?>" class="deleteCategoryBtn btn btn-danger mb-1 btn-sm" data-toggle="tooltip" title="Delete" data-placement="bottom" class="mb-2"><i class="icon-trash"></i></button>
                                                 </div>
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
		
		<script>
			$(document).on('submit', '#saveCategory', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("save_category", true);
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
                            
							$('#errorMessage').addClass('d-none');
							swal("Success!", res.message, "success");
							$('#addCategoryModal').modal('hide');
							$('#saveCategory')[0].reset();
							//alert(res.message);							
							$('#example').load(location.href + " #example");
						} else {
							swal("Error",res.message , "error");
							// $('#errorMessage').removeClass('d-none');
							// $('#errorMessage').text(res.message);
							}

						},
						error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
							
				});
			});
       
			$(document).on('click', '.editCategoryBtn', function (){
			var category_id= $(this).val();
			//alert(category_id);
			$.ajax({
				type: "GET",
				url: "new.php?id=" + category_id,
				success: function (response) {
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
										
						alert(res.message);
					} else if(res.status ==200){
						$('#category_id').val(res.data.id);
						$('#name').val(res.data.name);
						$('#description').val(res.data.description);
						
						$('#editCategoryModal').modal('show');
										
						
					} 
					},
					error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
				});
			});
			
			$(document).on('submit', '#updateCategory', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("update_category", true);
				$.ajax({
					type: "POST",
					url: "new.php",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response){
						
						var res = jQuery.parseJSON(response);
						
						if(res.status == 422){ 
												
							$('#updateErrorMessage').removeClass('d-none');
							$('#updateErrorMessage').text(res.message);
							
						} else if(res.status ==200){
                            swal("Success!", res.message, "success");
							$('#updateErrorMessage').addClass('d-none');
							$('#editCategoryModal').modal('hide');
							$('#updateCategory')[0].reset();
														
							$('#example').load(location.href + " #example");
						} else {
							swal("Error", res.message, "error");
							}

						},
						error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
							
				});
			});
		
			$(document).on('click', '.viewCategoryBtn', function (){
			var category_id= $(this).val();
			//alert(category_id);
			$.ajax({
				type: "GET",
				url: "new.php?id=" + category_id,
				success: function (response) {
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
										
						alert(res.message);
					} else if(res.status ==200){
						$('#view_category_id').text(res.data.id);
						$('#view_name').text(res.data.name);
						$('#view_description').text(res.data.description);
						
						$('#viewCategoryModal').modal('show');
										
						
					} 
					},
					error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
					}
				});
			});
			
			$(document).on('click', ' .deleteCategoryBtn', function (e){
               
				e.preventDefault();
				var category_id= $(this).val();
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
						'delete_category': true,
						'category_id': category_id
						},
						success: function (response) {
							var res = jQuery.parseJSON(response);
							if (res.status == 500) {
								swal("Error", res.message, "error"); 
							} else {
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
		</script>
      

<?php include_once ('includes/footer.php') ?>