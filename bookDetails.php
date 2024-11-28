<?php include_once ('includes/header.php') ?>
<?php
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $_SESSION['bookId'] = $book_id; // Store the ID in a session
} else if (isset($_SESSION['bookId'])) {
    $book_id = $_SESSION['bookId']; // Retrieve the ID from the session if no ID in the URL
}
// if (isset($_GET['id'])) {
//     $book_id= $_GET['id'];
    $result=getBookById($conn,$book_id);
// }

    
?>
<main>
            <div class="container-fluid ">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0 text-uppercase"><?= $result['title'] ?></h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <?php 
                                $total=$result['total_copies'];
                                $num1=issuedNo($conn, $book_id);
                                $num2=reserved($conn, $book_id);
                                $copiesNow= available($conn, $total, $num1, $num2);
                                ?>
                                <li class="breadcrumb-item">
                                    <?php
                                    if($copiesNow>0){
                                        echo "<h6 class='btn btn-info btn-sm'>book is available!</h6>";
                                    } else {
                                        echo "<h6 class='btn btn-warning btn-sm text-danger'>book is unavailable!</h6>";
                                    }
                                    ?>
                                </li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row mt-3">
                    <div class="col-12 col-sm-12">

                        <div class="row">
                            <div class="col-12 col-xl-12 mb-5 mb-xl-0">
                                <div class="card mb-4">
                                    <img src="dist/images/books3.jpg" alt="" class="img-fluid rounded-top">
                                    <div class="card-body">
                                        <ul class="list-inline comment-info font-weight-bold">
                                            <li class="list-inline-item  mr-3 text-primary "><i class="fa fa-user pr-1 text-primary"></i> 
                                                <?php $authorName=getAuthorNameById($conn,$result['author_id']);
                                                echo $authorName['name'];
                                                 ?>
                                            </li>
                                            <li class="list-inline-item text-primary" id="reviewNumber"><i class="fa fa-comments pr-1"></i>  <?=checkNumberReviews($conn, $result['id']) ?> Reviews</li>
                                            
                                            <li class="list-inline-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" >Write Review</button></li>
                                            <li class="list-inline-item">
                                                <form id="saveReservation">
                                                <div class="form-row">
                                                                                            
                                                    <div class="col-6 mb-3 d-none" >   
                                                            
                                                    
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="" value="<?=$result['id']?>">
                                                                                    
                                                    </div>
                                                    <input type="text" name="status" id="status" value="reserved" hidden>

                                                    <div class="col-6 mb-3 d-none">
                                                        <label for="username">Enter E-mail</label>

                                                        <input type="text" name="email" id="email" class="form-control" placeholder="" value="<?=$user['email']?>">

                                                    </div>
                                                    <div class="col-12">
                                                        
                                                            <input type="submit" class="btn btn-outline-warning text-primary"  value="Place Reservation">
                                                            
                                                    </div>
                                                </div>
                                            </form>
                                            </li>
                                        </ul>
                                       
                                       
                                           
                                        <!--modal to add reviews-->
                                            <div class="modal fade bd-example-modal-lg" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle1" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                               <div class="modal-content">
                                                  <div class="modal-header">
                                                     <h5 class="modal-title" id="exampleModalLongTitle1"><b>Write Your Review</b></h5>
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                     <span aria-hidden="true">&times;</span>
                                                     </button>
                                                  </div>
                                                  <form id="addReview">
                                                  <div class="modal-body">
                                                  <div id="errorMessage" class="alert alert-warning d-none"></div>
                                                    <input type="text" name="user" id="user" value="<?=$user['email']?>" hidden>
                                                    <div class="form-group">
                                                     <textarea class="form-control border-0"name="review" placeholder="your review here......"></textarea>
                                                    </div>
                                                    <input type="text"  name="book_id" class="d-none" value="<?= $book_id ?>">
                                                  </div>
                                            
                                                
                                                    <button type="submit" class="btn btn-primary mb-4 ml-4">Add Review</button>
                                                    <button type="button" class="btn btn-secondary mb-4" data-dismiss="modal">Close</button>
                                                  </form>
                                                 </div>
                                            </div>
                                         </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <h6><b class="text-primary">Category:</b> 
                                                <?php $category=getCategoryNameById($conn,$result['category_id']);
												if($category) {
                                                echo $category['name'];
												} else{
													echo "Null";
												}
												
												?></h6>
                                            </div>
                                            
                                            <div class="col-6">
                                                <h6><b class="text-primary">publication year:</b> 
                                                <?=$result['publication_year']
                                                ?></h6>
                                            </div>
                                            <div class="col-6">
                                                <h6><b class="text-primary">publisher:</b> 
                                                <?=$result['publisher']
                                                ?></h6>
                                            </div>
                                            <div class="col-6">
                                                <h6><b class="text-primary">Edition:</b> 
                                                <?=$result['edition']
                                                ?></h6>
                                            </div>
                                            <div class="col-6">
                                                <h6><b class="text-primary">Shelve_Number:</b> 
                                                <?=$result['shelve_number']
                                                ?></h6>
                                            </div>
                                        </div>
                                        
                                        <blockquote class="blockquote my-4 p-5 bg-primary position-relative text-white rounded">
                                            <p class="font-weight-bold">" 
                                                <?php $authorName=getAuthorNameById($conn,$result['author_id']);
                                                echo $authorName['biography'];
                                                 ?>"</p>
                                            <p>-Author's Biography</p>
                                        </blockquote>
                                       
                                    </div>
                                </div>
                                 
                                <?php if($user['usertype']=='admin') { ?>
                                <div class="card mb-3" id="inventory">
                                    <div class="card-header d-flex justify-content-between align-items-center">                               
                                        <h4 class="card-title"><b>Inventory</b></h4>                                
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled font-weight-bold">
                                            <li class=" mb-2">
                                                    <i class="icofont icofont-bubble-right pr-2"></i><b class="text-primary"> Total Copies:</b>  <?= $result['total_copies'] ?></li>
                                            <li class=" mb-2">
                                                    <i class="icofont icofont-bubble-right pr-2"></i> <b class="text-primary">Available Copies:</b>  
                                                        <?php 
                                                        
                                                        echo $copiesNow;
                                                        ?>
                                                    </li>
                                            <li class=" mb-2">
                                                    <i class="icofont icofont-bubble-right pr-2"></i><b class="text-primary"> Reserved Copies:</b>  <?= reserved($conn, $book_id) ?></li>
                                            <li class=" mb-2">
                                                    <i class="icofont icofont-bubble-right pr-2"></i><b class="text-primary"> Borrowed Copies:</b>  <?= issuedNo($conn, $book_id) ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>                            
                            
                                <div class="card mb-4" id="allReview">
                                    <div class="card-body pb-0">
                                        <h5 class="header-title  text-uppercase mb-3">Reviews</h5>
                                       
                                        <?php
                                        $reviews= getAllReviews($conn, $result['id']);
                                        if((checkNumberReviews($conn, $result['id']))==0){
                                            echo '<p>'. "no reviews". "</p>";
                                        }
                                        foreach($reviews as $review):
                                        ?> 
                                        
                                    </div>
                                   
                                    <div class="media d-block d-sm-flex text-center text-sm-left p-4">
                                        <img class="img-fluid d-md-flex mr-sm-4 rounded-circle" src="<?php $image=getPicByEmail($conn, $review['email']); echo !empty($image['pic']) ? $image['pic'] : 'dist/images/default.png';?>" alt="" width="50">
                                        <div class="media-body align-self-center">
                                          
                                            <h6 class="mb-1 font-weight-bold"><?= $review['email'] ?> </h6>
                                            <?= $review['comment'] ?>                                          
                                        </div> 
                                        <?php endforeach ?>
                                    </div>
                                   
                                    
                                </div>
                               
                            </div>
                           
                        </div>

                    </div>
                </div>
                <!-- END: Card DATA-->
            </div> 
            
</main>
<script>
  
			$(document).on('submit', '#addReview', function (e){
               
				e.preventDefault();
				var formData = new FormData(this);
				formData.append("add_review", true);
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
							$('#errorMessage').addClass('d-none');
							$('#addReviewModal').modal('hide');
							$('#addReview')[0].reset();
							//alert(res.message);							
							$('#allReview').load(location.href + " #allReview");
                            $('#reviewNumber').load(location.href + " #reviewNumber");
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
                    //   alert(response);
                       var res = jQuery.parseJSON(response);
                      
                       if(res.status == 422){ 
                                               
                           $('#errorMessage').removeClass('d-none');
                           $('#errorMessage').text(res.message);
                       } else if(res.status ==200){
                            swal("Success!",res.message, "success");
                           $('#errorMessage').addClass('d-none');
                           $('#saveReservationModal').modal('hide');
                           $('#saveReservation')[0].reset();
                           //alert(res.message);							
                           $('#example').load(location.href + " #example");
                           $('#inventory').load(location.href + " #inventory");
                       } else if(res.status ==500){
                            swal("Error",res.message, "error");
                        
                        }else{
                            swal("Error",res.message, "error");
                        
                        }


                       },
                       error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
               });
           });

</script>
<?php include_once ('includes/footer.php') ?>