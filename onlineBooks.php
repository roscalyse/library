<?php include_once ('includes/header.php') ?>

 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">

                        <?php if($user['usertype']=='admin') { ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Online Books</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfBookModal">Add Online Book</button></h4></li>
                            </ol>
                        <?php } else{ ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">View My Online Books</h4></div>
                        <?php } ?>   
                            
                            <!--modal to add online books-->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" id="pdfBookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Add Book</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                                            <form id="addOnlineBook" enctype="multipart/form-data">
                                                <div class="form-row">
                                                    
                                                    <div class="col-6 mb-3">   
                                                      <label for="Name">Enter Book Name</label>              
                                                    <input type="text" class= "form-control" id="bookName" name="bookName">
                                                                                    
                                                    </div>
                                                    <div class="col-6 mb-3">   
                                                <label for="Author">Enter Author</label>              
                                                
                                                    <select name="author_id" id="author_id" class="form-control">
                                                        <option>Choose Author</option>
                                                        <?php

                                                        $Authors =getAllAuthors($conn);
                                                        foreach($Authors as $Author):
                                                        ?>
                                                        <option value="<?= $Author['id'] ?>"><?= $Author['name'] ?></option>
                                                        <?php endforeach ?>
                                                        
                                                    </select>
                                                                                
                                                </div>
                                                <div class="col-6 mb-3">   
                                                    <label for="Author">Enter Category</label>
                                                    <select class="form-control" name="category_id" id="category_id">
                                                        <option>choose Category</option>
                                                        <?php

                                                        $categories =getAllCategories($conn);
                                                        foreach($categories as $category):
                                                        ?>
                                                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                                        <?php endforeach; ?>
                                
                                                    </select>
                                                                                
                                                </div>
                                                <div class="col-6 mb-3">   
                                                      <label for="Name">Enter Edition</label>              
                                                    <input type="text" class= "form-control" id="edition" name="edition">
                                                                                    
                                                    </div>

                                                <div class="col-6 mb-3"> 
                                                <label class="custom-file-label" for="customFile">Choose File</label>                                    
                                                    <input type="file" name="file" id="file" class="custom-file-input">
                                                </div>
                                               
                                                    <div class="col-12">
                                                        
                                                            <button type="submit" class="btn btn-primary">Add Book</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                       
                                                    </div>
                                                </div>
                                            </form>
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
                                <h4 class="card-title">All Online Books</h4> 
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                   
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>Author</th>
                                                <th>Category</th>
                                                <th>Edition</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $num=0;
                                            $onlineBooks=getAllOnlineBooks($conn);
                                            foreach ($onlineBooks as $onlineBook):
                                        ?>
                                            <tr>
                                                <td><?= $num+=1 ?></td>
                                                <td><?=$onlineBook['name']?></td>
                                                <td>
                                                    <?php
                                                        //getting author name by id
                                                        $name=getAuthorNameById($conn, $onlineBook['author_id']);                                                         
                                                        echo $name['name'] 
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $category=getCategoryNameById($conn,$onlineBook['category_id']);
                                                    if($category) {
                                                    echo $category['name'];
                                                    } else{
                                                        echo "Null";
                                                    }
                                                    
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $version=$onlineBook['edition'];
                                                        if($version) {
                                                        echo $version;
                                                        } else{
                                                            echo "Null";
                                                        }
                                                     ?>   
                                                </td>
                                                <td>
                                                 <div class="ml-auto mail-tools">
                                                  <a href="viewPdf.php?id=<?=$onlineBook['id']?> "class="btn btn-success mb-1 btn-sm">Read</a>
                                                  <?php if($user['usertype']=='admin') { ?>
                                                  <button type="button" value="<?= $onlineBook['id']?>" class="deletePdfBtn btn btn-danger mb-1 btn-sm" data-toggle="tooltip" title="Delete" data-placement="bottom" class="ml-2"><i class="icon-trash mb-1 "></i></button>
                                                  <?php }  ?>
                                                 </div>
                                                 </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>SN</th>
                                                <th>Book</th>
                                                <th>Author</th>
                                                <th>Category</th>
                                                <th>Edition</th>
                                                <th>Action</th>
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
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

			$(document).on('submit', '#addOnlineBook', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("add_online_book", true);
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
                            swal("Success", res.message, "success");
							$('#errorMessage').addClass('d-none');
							$('#pdfBookModal').modal('hide');
							$('#addOnlineBook')[0].reset();
							//alert(res.message);							
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
            $(document).on('click', ' .deletePdfBtn', function (e){
               
               e.preventDefault();
               var onlineBook_id= $(this).val();
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
                        'delete_pdf': true,
                        'onlineBook_id': onlineBook_id
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