<?php include_once ('includes/header.php') ?>

<main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Fines</h4></div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAmountModal">Pay Fine</button></h4></li>
                                
                            </ol>
							<!-- modal for fine payment -->
                            <div class="modal fade bd-example-modal-lg" id="addAmountModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Pay fines</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                           <div class="modal-body">
											<div id="errorMessage" class="alert alert-warning d-none"></div>
                                            
                                              <form id="finePayment">
                                               <div class="row col-12"> 
                                                    <div class="col-6 mb-3">
                                                        <label for="email">Email</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0" id="basic-email"><i class="icon-envelope"></i></span>
                                                            </div>
                                                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" >
                                                        </div>
                                                    </div>
                                        
                                                    <div class="col-6 mb-3">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" >
                                                    </div>
                                                </div>


                                                <button type="submit"  class="btn btn-primary btn-default">Add Amount</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                              </form>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
							</div>
                            <!-- modal for editing fine payment -->
                            <div class="modal fade bd-example-modal-lg" id="editAmountModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel10" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel10">Update Payment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                           <div class="modal-body">
											<div id="updateErrorMessage" class="alert alert-warning d-none"></div>
                                            
                                              <form id="editPayment">
                                               <div class="row col-12"> 
                                                    <div class="col-6 mb-3">
                                                        <label for="email">Email</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text bg-transparent border-right-0" id="basic-email"><i class="icon-envelope"></i></span>
                                                            </div>
                                                            <input type="text" name="e-mail" id="e-mail" class="form-control" placeholder="Email" readonly >
                                                        </div>
                                                    </div>
                                                    <input type="text" name="payment_id" id="payment_id" hidden>
                                                    <div class="col-6 mb-3">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" name="paid_amount" id="paid_amount" class="form-control" placeholder="Amount" >
                                                    </div>
                                                </div>


                                                <button type="submit"  class="btn btn-primary btn-default">Update Amount</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
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
                                <h4 class="card-title">All Fine Payments</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>E-mail</th>
                                                <th>Amount</th>
                                                <th>Payment Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $num=0;
                                            $payments=getAllPayments($conn);
                                            foreach ($payments as $payment):
                                        ?>
                                            <tr>
                                                <td><?=$num+=1?></td>
                                                <td><?= $payment['email']?></td>
                                                <td><?= format_money($payment['amount'])?></td>
                                                <td><?= $payment['payment_date']?></td>
                                                <td>
                                                <div class="ml-auto mail-tools">
                                               
                                                    <button type="button" value="<?=$payment['id']; ?>" class="editAmountBtn btn btn-success mb-1 btn-sm" data-toggle="tooltip" title="edit" data-placement="bottom" class="ml-2"><i class="icon-pencil"></i></button> 
                                                    <button type="button" value="<?=$payment['id']; ?>" class="deletePaymentBtn btn btn-danger mb-1 btn-sm" data-toggle="tooltip" title="Delete" data-placement="bottom" class="ml-2"><i class="icon-trash"></i></button>
                                                 </div>
                                                </td>
                                            </tr>
                                         <?php endforeach?>  
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>E-mail</th>
                                                <th>Amount</th>
                                                <th>Payment Date</th>
                                                <td>Action</td>
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
    $(document).on('submit', '#finePayment', function (e){
        
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("save_fine", true);
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
                    $('#addAmountModal').modal('hide');
                    $('#finePayment')[0].reset();
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
            $(document).on('click', '.editAmountBtn', function (){
			var payment_id= $(this).val();
			//alert(payment_id);
			$.ajax({
				type: "GET",
				url: "new.php?payment_id=" + payment_id,
				success: function (response) {
					var res = jQuery.parseJSON(response);
					if(res.status == 404){ 
						swal("Error", res.message, "error");
					} else if(res.status ==200){
						$('#payment_id').val(res.data.id);
						$('#e-mail').val(res.data.email);
						$('#paid_amount').val(res.data.amount);
						
						$('#editAmountModal').modal('show');
										
						
					} 
					},
                    error: function (xhr, status, error) {
                        swal("Error", "Something went wrong!", "error"); 
                    }
				});
			});
            $(document).on('submit', '#editPayment', function (e){
               
               e.preventDefault();
               var formData = new FormData(this);
               formData.append("update_payment", true);
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
                           swal("Success!", res.message, "success");
                           $('#updateErrorMessage').addClass('d-none');
                           $('#editAmountModal').modal('hide');
                           $('#editPayment')[0].reset();
                            //alert(res.message);                           
                           $('#example').load(location.href + " #example");
                       } else {
                            swal("Error", res.message, "error");
                        //    $('#errorMessage').removeClass('d-none');
                        //    $('#errorMessage').text(res.message);
                           }

                       },
                       error: function (xhr, status, error) {
							swal("Error", "Something went wrong!", "error"); 
						}
           
               });
           });
           $(document).on('click', ' .deletePaymentBtn', function (e){
               
               e.preventDefault();
               var payment_id= $(this).val();
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
                        'delete_payment': true,
                        'payment_id': payment_id
                        },
                        success: function (response) {
                            var res = jQuery.parseJSON(response);
                            if(res.status == 500){ 
                                swal("Error",res.message, "error");
                            } else{
                                swal("Success!",res.message, "success");
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