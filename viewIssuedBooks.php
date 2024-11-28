<?php include_once ('includes/header.php') ?>

 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">

                        <?php if($user['usertype']=='admin') { ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Issued Books</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#issuedBookModal">Issue Book</button></h4></li>
                            </ol>
                        <?php } else{ ?>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">View My Issued Books</h4></div>
                        <?php } ?>   
                            <!-- modal to view issued books-->
                            <div class="modal fade bd-example-modal-lg" id="viewIssueModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">view Issue Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                           <div class="modal-body">
											
                                                <div class="form-group">
												<label>E-mail</label>
                                                <p id="view_email" class="form-control"> </p>
                                                </div>
												<div class="form-group">
												<label><b>Due_date</b></label>
                                                <p id="view_due_date" class="form-control">  </p>
                                                </div>
                                                <div class="form-group">
												<label><b>Return_date</b></label>
                                                <p id="view_return_date" class="form-control">  </p>
                                                </div>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
							</div>
                            <!--modal to issue books-->
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" id="issuedBookModal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Issue Book</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div id="errorMessage" class="alert alert-warning d-none"></div>
                                            <form id="issueBook">
                                                <div class="form-row">
                                                    
                                                    <div class="col-6 mb-3">   
                                                      <label for="Author">Enter Book</label>              
                                                    
                                                         <select name="title" class="form-control">
                                                            <option>choose </option>
                                                             <?php

                                                              $books =getAllBooks($conn);
                                                              foreach($books as $book):
                                                              ?>
                                                              <option value="<?= $book['id'] ?>"><?= $book['title'] ." By "?> <?php  $name=getAuthorNameById($conn, $book['author_id']); echo $name['name']; ?></option>
                                                              <?php endforeach ?>
                                                              
                                    
                                                         </select>
                                                                                    
                                                    </div>
                                                   <!-- <input type="text" name="status" value="reserved" hidden>-->
                                                   
                                                    <div class="col-6 mb-3">
                                                        <label for="username">Enter E-mail</label>

                                                        <input type="text" name="email" class="form-control" placeholder="">

                                                    </div>
                                                    <div class="col-12">
                                                        
                                                            <button type="submit" class="btn btn-primary">Issue Book</button>
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
                                <h4 class="card-title">All Issued Books</h4> 
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                    <?php if($user['usertype']=='admin') { ?>
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $num=0;
                                            $issuedBooks=getAllBorrowedbooks($conn);
                                            foreach ($issuedBooks as $issuedBook):
                                        ?>
                                            <tr>
                                                <td><?= $num+=1 ?></td>
                                                <td><?php
                                                $book= getBookById($conn,
                                                 $issuedBook['book_id']);
                                                $author= getAuthorNameById($conn, $book['author_id']);

                                                 echo $book['title']. " by ". $author['name'];
                                                  ?></td>
                                                <td><?= $issuedBook['email']?></td>
                                                <td><?php 
                                                $status=$issuedBook['status'];
                                                if($status==1){
                                                    echo '<p class="text-success">Returned</p>';
                                                } else{
                                                    echo '<p class="text-danger">Pending</p>';
                                                }
                                                ?></td>
                                                <td>
                                                 <div class="ml-auto mail-tools">
                                                  
                                                  <button type="button" value="<?= $issuedBook['id']?>" class="viewIssuedBtn btn btn-primary"data-toggle="tooltip" title="view" data-placement="bottom" class="ml-2"><i class="icon-eye mb-1"></i></button> 
                                                  <button type="button" value="<?= $issuedBook['id']?>" class="returnBtn btn btn-success"data-toggle="tooltip" title="return" data-placement="bottom" class="ml-2"><i class="fa fa-handshake mb-1"></i></button> 
                                                  <button type="button" value="<?= $issuedBook['id']?>" class="deleteIssuedBtn btn btn-danger" data-toggle="tooltip" title="Delete" data-placement="bottom" class="ml-2"><i class="icon-trash mb-1 "></i></button>
                                                 </div>
                                                 </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>User</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    <?php } else { ?>
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $num=0;
                                            $email=$user['email'];
                                            $issuedBooks=getUserBorrowedbooks($conn,$email);
                                            foreach ($issuedBooks as $issuedBook):
                                        ?>
                                            <tr>
                                                <td><?= $num+=1 ?></td>
                                                <td><?php
                                                $book= getBookById($conn,
                                                 $issuedBook['book_id']);
                                                $author= getAuthorNameById($conn, $book['author_id']);

                                                 echo $book['title']. " by ". $author['name'];
                                                  ?></td>
                                                <td>
                                                    <?php 
                                                    $dueDate=$issuedBook['due_date'];
                                                    if($dueDate==date('Y-m-d')) {
                                                        echo 'Today';
                                                    } else{
                                                        echo $dueDate;
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php 
                                                $status=$issuedBook['status'];
                                                if($status==1){
                                                    echo '<p class="text-success">Returned</p>';
                                                } else{
                                                    echo '<p class="text-danger">Pending</p>';
                                                }
                                                ?></td>
                                                
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                             
                                            </tr>
                                        </tfoot>
                                    <?php } ?>    
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
						// alert(response);
						var res = jQuery.parseJSON(response);
						
						if(res.status == 422){ 
												
							$('#errorMessage').removeClass('d-none');
							$('#errorMessage').text(res.message);
						} else if(res.status ==200){
                            swal("Success", res.message, "success");
							$('#errorMessage').addClass('d-none');
							$('#issuedBookModal').modal('hide');
							$('#issueBook')[0].reset();
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
            $(document).on('click', ' .deleteIssuedBtn', function (e){
               
               e.preventDefault();
               var issue_id= $(this).val();
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
                        'delete_issue': true,
                        'issue_id': issue_id
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
           $(document).on('click', '.viewIssuedBtn', function (){
			var issue_id= $(this).val();
			//alert(issue_id);
			$.ajax({
				type: "GET",
				url: "new.php?issue_id=" + issue_id,
				success: function (response) {
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
                        swal("Error", res.message, "error"); 
                
					} else if(res.status ==200){
						$('#view_borrow_date').text(res.data.borrow_date);
						$('#view_due_date').text(res.data.due_date);
						$('#view_email').text(res.data.email);
                        $('#view_return_date').text(res.data.return_date);
						$('#view_book_id').text(res.data.book_id);
						$('#viewIssueModal').modal('show');
						
					} 
					},
                    error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
                    }
				});
			});
            $(document).on('click', ' .returnBtn', function (e){
               
               e.preventDefault();
               var issue_id= $(this).val();
               swal({
					title: "Are you sure?",
					text: "This action is irreversible!",
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
                        'return_book': true,
                        'issue_id': issue_id
                        },
                        success: function (response) {
                            //alert (response);
                            var res = jQuery.parseJSON(response);
                            if(res.status == 500){ 
                                    swal("Error", res.message, "error"); 
                            } else{
                                swal("Success!", res.message, "success"); 
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