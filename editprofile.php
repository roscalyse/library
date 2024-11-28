<?php include_once ('includes/header.php') ?>
<?php


?>

<main>
   
    <div class="container-fluid">
        
        <div class="row">                  
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills flex-column flex-sm-row justify-content-center ">
                                    <li class="nav-item">
                                        <a class="nav-link body-color h6 mb-0 active" data-toggle="tab" href="#Description" > Update profile pic </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link body-color h6 mb-0" data-toggle="tab" href="#Additional"> Change Password</a>
                                    
                                </ul> 
                                <div class="tab-content mt-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description">
                                        <div class="row">
                                            <div class="col-12 col-sm-6 col-xl-4">
                                                <div id="errorMessage" class="alert alert-warning d-none" ></div>
                                                <form id="addPic" enctype="multipart/form-data">
                                                    <div class="custom-file mb-3">
                                                   
                                                        <label class="custom-file-label" for="customFile">Choose Picture</label>
                                                
                                                        <input type="file" class="custom-file-input"  id="profile_photo" name="profile_photo"  accept="image/*">
                                                    </div>
                                                    <input type="text" id="email" name="email" value="<?=$user['email'] ?>" hidden>
                                                    <button type="submit"class="btn btn-primary rounded-btn btn-block">Upload</button>
                                        
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Additional" role="tabpanel" aria-labelledby="Additional">
                                
                                        <form id="updatePassword">
                                                <div id="updateErrorMessage" class="alert alert-warning d-none" ></div>
                                                    <div class="row col-12 d-flex justify-content-center">
                                                        
                                                            <div class="form-group col-md-5">
                                                                <label for="">Confirm Password</label><br>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-transparent border-right-0" id="showPassword" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye-slash toggle-icon"></i></span>
                                                                    </div>
                                                                    <input type="password" id="password" name="password" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label for="">New Password</label><br>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-transparent border-right-0"  onclick="togglePasswordVisibility('newPassword')"><i class="fa fa-eye-slash toggle-icon"></i></span>
                                                                    </div>
                                                                    <input type="password" id="newPassword" name="newPassword" class="form-control">
                                                                </div>
                                                            </div>
                                                    <input type="text" id="e-mail" name="e-mail" value="<?=$user['email'] ?>" hidden>
                                                    </div>
                                            
                                                    <div class="d-flex justify-content-center">
                                                    <button type="submit"class="btn btn-primary btn-default rounded-btn">Submit</button>
                                                
                                                    </div>
                                            
                                        </form>
                                    
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        
    </div>
           
</main>
<script>
   $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    
    $(document).on('submit', '#addPic', function (e){
        
        e.preventDefault();
        var formData = new FormData(this);
        /*formData.append("save_pic", true);*/
        $.ajax({
            type: "POST",
            url: "upload.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response){
                var res = jQuery.parseJSON(response);

                if(res.status ==200){
                    swal("Success!", res.message, "success");
                    $('.rel').empty().load(location.href + ' .rel');
                    // $('#prof').empty().load(location.href + ' #prof');
                    var timestamp = new Date().getTime(); // Generate a timestamp to avoid caching
                    $('#prof').attr('src', '<?php echo $user["pic"]; ?>?' + timestamp);
                    // window.location.reload();
                } else {
                    swal("Error", res.message, "error");
                }
                },
            error: function(xhr, status, error) {
            // Handle the error response
            console.error("An error occurred: " + error);
            }
    
        });
    });
    $(document).on('submit', '#updatePassword', function (e){
               e.preventDefault();
               var formData = new FormData(this);
               formData.append("update_password", true);
               $.ajax({
                   type: "POST",
                   url: "new.php",
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function (response){
                       //alert (response);
                       var res = jQuery.parseJSON(response);
                       
                       if(res.status == 422){ 
                                               
                           $('#updateErrorMessage').removeClass('d-none');
                           $('#updateErrorMessage').text(res.message);
                           
                       } else if(res.status ==200){
                           swal("Success!", res.message, "success");
                           $('#updateErrorMessage').addClass('d-none');
                          
                           $('#updatePassword')[0].reset();
                         
                       } else {
                           swal("Error", res.message, "error");
                           }

                       },
                       error: function (xhr, status, error) {
                           swal("Error", "Something went wrong!", "error"); 
                       }
                           
               });
           });
           function togglePasswordVisibility(passwordId) {
                var passwordField = document.getElementById(passwordId);
                var toggleIcon = passwordField.parentElement.querySelector('.toggle-icon');

                // Toggle the password field between text and password
                if (passwordField.type === 'password') {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye"); // Switch to hidden eye icon
                } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash"); // Switch back to visible eye icon
                }
            }
</script>
<?php include_once ('includes/footer.php') ?>