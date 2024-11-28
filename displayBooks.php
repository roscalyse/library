<?php include_once ('includes/header.php') ?>
<?php
if(isset($_GET['id'])){
  $result= deleteBook($conn,$_GET['id']);
  if($result){
    echo '<script>alert("book Deleted Successfully")</script>';
  }else{
    echo '<script>alert("book Deletion Failed")</script>';

  }
} 

if(isset($_POST['addBook'])) {
    //echo var_dump($_POST);
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
    $result =addBooks($conn, $title, $isbn, $edition, $publisher, $year, $shelve, $total, $available, $author_id, $category_id);
    if($result) {
     echo '<script>alert("book Added Successfully")</script>';
     echo '<script> window.location.href="displayBooks.php"</script>';
    } else{
     echo '<script>alert("Book Addition Failed")</script>';
    }
 }
?>
<?php// if(loggedin() && $user->user_type == "student"){?>

 
<?php //}elseif($user->user_type == "admin"){?>

<main>
    <div class="container-fluid">
        <!-- START: Breadcrumbs-->
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <?php if($user['usertype']=='admin') { ?>
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Books</h4></div>
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Book</button></h4></li>                       
                    </ol>
                <?php } else{ ?> 
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">View Books</h4></div> 
                    <?php } ?> 
                    <!--modal to update modal-->
                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" id="editBookModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myLargeModalLabel10"><b>Update Book</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="updateErrorMessage" class="alert alert-warning d-none"></div>
                                    <form id="updateBook">
                                    <div class="form-row">
                                        <div class="col-6 mb-3">
                                            <label for="ISBN">Enter ISBN</label>

                                            <input type="text" name="isbns" id="isbns" class="form-control" placeholder="">

                                        </div>
                                        <input type="number" id="book_id" name="book_id" hidden>
                                        <div class="col-6 mb-3">   
                                            <label for="Author">Enter Author</label>              
                                        
                                            <select name="author_ids" id="author_ids" class="form-control">
                                                <option value disabled selected>Choose Author</option>
                                                <?php

                                                $Authors =getAllAuthors($conn);
                                                foreach($Authors as $Author):
                                                ?>
                                                <option value="<?= $Author['id'] ?>"><?= $Author['name'] ?></option>
                                                <?php endforeach ?>
                                                
                                            </select>
                                                                        
                                        </div>
        
                                        <div class="col-6 mb-3"> 
                                            <label for="Author">Enter Title</label>                                               
                                            <input type="text" name="titles" id="titles" class="form-control" placeholder="">
                                        </div>
                                        <div class="col-6 mb-3">   
                                            <label for="category">Enter Category</label>              
                                        
                                            <select name="category_ids" id="category_ids" class="form-control">
                                                <option value disabled selected>choose Category</option>
                                                <?php

                                                $categories =getAllCategories($conn);
                                                foreach($categories as $category):
                                                ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                                <?php endforeach; ?>
                        
                                            </select>
                                                                        
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="username">Enter Edition</label>

                                            <input type="text" name="editions" id="editions" class="form-control" placeholder="">

                                        </div>
                                        <div class="col-6 mb-3"> 
                                            <label for="email">Enter Publisher</label>                                               
                                            <input type="text" name="publishers" id="publishers" class="form-control" placeholder="">
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="">Enter Publication Year</label>

                                            <input type="number" name="publication_years" id="publication_years" class="form-control" placeholder="">

                                        </div>
                                        <div class="col-6 mb-3"> 
                                            <label for="number">Enter Number of Copies</label>                                               
                                            <input type="number" name="total_copiess" id="total_copiess" class="form-control" placeholder="">
                                        </div>
                                        <div class="col-6 mb-3"> 
                                            <label for="email">Enter Shelve Number</label>                                               
                                            <input type="text" name="shelve_numbers" id="shelve_numbers" class="form-control" placeholder="">
                                        </div>


                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mb-4 ml-4">Update</button>
                                            <button type="button" class="btn btn-secondary mb-4 " data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                                                                
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--modal to add books-->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" id="addBookModal" aria-hidden="true">
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
                                        <form id="addBook">
                                            <div class="form-row">
                                                <div class="col-6 mb-3">
                                                    <label for="ISBN">Enter ISBN</label>

                                                    <input type="text" name="isbn" id="isbn" class="form-control" placeholder="">

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
                                                    <label for="Author">Enter Title</label>                                               
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="">
                                                </div>
                                                <div class="col-6 mb-3">   
                                                <label for="category_id">Enter Category</label>              
                                                
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
                                                    <label for="username">Enter Edition</label>

                                                    <input type="text" name="edition" id="edition" class="form-control" placeholder="">

                                                </div>
                                                <div class="col-6 mb-3"> 
                                                    <label for="email">Enter Publisher</label>                                               
                                                    <input type="text" name="publisher" id="publisher" class="form-control" placeholder="">
                                                </div>

                                                <div class="col-6 mb-3">
                                                    <label for="">Enter Publication Year</label>

                                                    <input type="number" name="publication_year" id="publication_year" class="form-control" placeholder="">

                                                </div>
                                                <div class="col-6 mb-3"> 
                                                    <label for="number">Enter Number of Copies</label>                                               
                                                    <input type="number" name="total_copies" id="total_copies" class="form-control" placeholder="">
                                                </div>
                                                <div class="col-6 mb-3"> 
                                                    <label for="email">Enter Shelve Number</label>                                               
                                                    <input type="text" name="shelve_number" id="shelve_number" class="form-control" placeholder="">
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
        
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header  justify-content-between align-items-center">                               
                        <h4 class="card-title">All Books</h4> 
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped table-bordered" >
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>                                        
                                        <th>Shelve Number</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $num=0;
                                    $books =getAllBooks($conn);
                                    foreach($books as $book):
                                ?>
                                    <tr>
                                        <td><?= $num+=1 ?></td>
                                        <td><?= $book['title'] ?></td>
                                        <td>
                                        <?php 
                                        //getting author name by id
                                        $name=getAuthorNameById($conn, $book['author_id']); 
                                        
                                        echo $name['name'] ?></td>
                                        <td><?php $category=getCategoryNameById($conn,$book['category_id']);
												if($category) {
                                                echo $category['name'];
												} else{
													echo "Null";
												}
												
												?></td>
                                        <td><?= $book['shelve_number'] ?></td>
                                        <td>
                                            <div class="ml-auto mail-tools">
                                            <a href="bookDetails.php?id=<?=$book['id']?>" class="btn btn-primary mb-1 btn-sm" data-toggle="tooltip" title="view" data-placement="bottom"><i class="icon-eye "></i></a> 

                                            <?php if($user['usertype']=='admin') { ?>
                                            <button type="button" value="<?=$book['id']?>" data-toggle="modal" data-target="tooltip" class="editBookBtn btn btn-success mb-1 btn-sm" title="edit" data-placement="bottom" class="ml-2"><i class="icon-pencil mb-1"></i></button> 
                                            <button type="button" value="<?=$book['id']?>" class="deleteBookBtn btn btn-danger mb-1 btn-sm" data-toggle="tooltip" title="Delete"data-placement="bottom" class="ml-2"><i class="icon-trash mb-1"></i></button>
                                            <?php } ?>
                                        
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>                                        
                                        <th>Shelve Number</th>
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
<?php //}else{?>

<?php //}?>
<script>
            // function initializeSelect2(selectId, modalId) {
            // $(selectId).select2({
            //     dropdownParent: $(modalId),
            //     minimumResultsForSearch: 0
            //     });
            // }

            // $(document).ready(function() {
            //     initializeSelect2('#author_id', '#addBookModal');
            //     initializeSelect2('#category_id', '#addBookModal');
            // });


			$(document).on('submit', '#addBook', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("save_book", true);
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
                            
							$('#errorMessage').addClass('d-none');
                            swal("Success!", res.message, "success");
							$('#addBookModal').modal('hide');
							$('#addBook')[0].reset();
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
			$(document).on('click', '.editBookBtn', function (){
			var book_id= $(this).val();
			//alert(book_id);
			$.ajax({
				type: "GET",
				url: "new.php?book_id=" + book_id,
				success: function (response) {
					//alert(response);
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
									
						swal("Error",res.message , "error");
					} else if(res.status ==200){
						$('#book_id').val(res.data.id);
						$('#isbns').val(res.data.isbn);
						$('#author_ids').val(res.data.author_id);
						$('#titles').val(res.data.title);
						$('#category_ids').val(res.data.category_id);
						$('#editions').val(res.data.edition);
						$('#publishers').val(res.data.publisher);
						$('#publication_years').val(res.data.publication_year);
						$('#total_copiess').val(res.data.total_copies);
						$('#shelve_numbers').val(res.data.shelve_number);
						$('#editBookModal').modal('show');
										
						
					} 
					},
                    error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
                    }
				});
			});
			$(document).on('submit', '#updateBook', function (e){
               //alert("yes");
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("update_book", true);
				$.ajax({
					type: "POST",
					url: "new.php",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response){
						// alert(response);
						var res = jQuery.parseJSON(response);
						
						if(res.status ==422){ 
												
							$('#updateErrorMessage').removeClass('d-none');
							$('#updateErrorMessage').text(res.message);
							
						} else if(res.status ==200){
                           
                            swal("Success!",res.message , "success");
							$('#updateErrorMessage').addClass('d-none');
							$('#editBookModal').modal('hide');
							$('#updateBook')[0].reset();
														
							$('#example').load(location.href + " #example");
						} else {
                            swal("Error",res.message , "error");
							$('#eupdateErrorMessage').removeClass('d-none');
							$('#updateErrorMessage').text(res.message);
							}

						},
                        error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
                         }

				});
			});
            $(document).on('click', ' .deleteBookBtn', function (e){
               
				e.preventDefault();
				var book_id= $(this).val();
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
                        'delete_book': true,
                        'book_id': book_id
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
</script>
<?php include_once ('includes/footer.php') ?>