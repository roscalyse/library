<?php include_once ('includes/header.php') ?>
<?php 

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
       echo '<script> windows.location.href="displayStaff.php"</script>';
    } else{
       echo '<script>alert("Staff Addition Failed")</script>';
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
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Staff</h4></div>

                            
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    
                   
                   
                    <div class="col-12 col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title"></h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                        <form method="POST">
                                            <div class="form-row">
                                                    <div class="col-6 mb-3">
                                                        <label for="First Name">First Name</label>

                                                        <input type="text" name="fName" class="form-control" placeholder="First Name" required>

                                                    </div>
                                                    <div class="col-6 mb-3"> 
                                                        <label for="Last Name">Last Name</label>                                               
                                                        <input type="text" name="lName"  class="form-control" placeholder="Last Name" required>
                                                    </div>
                                              <div class="col-6"> 
                                                <label for="email">Email</label>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-transparent border-right-0" id="basic-email"><i class="icon-envelope"></i></span>
                                                    </div>
                                                    <input type="email" name="email"  class="form-control" placeholder="Email" required>
                                                </div>
                                              </div> 
                                              
                                                <div class="col-6 mb-3">
                                                       <label for="contact">Contact</label>
                                                       <input type="number"name="contact"   class="form-control" placeholder="contact" >

                                                    </div>
                                              
                                                <label for="username">Password</label>

                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-transparent border-right-0" id="basic-password"><i class="icon-options"></i></span>
                                                    </div>
                                                    <input type="password" name="password"  class="form-control" placeholder="Password">
                                                </div>
                                                <input type="text" class="d-none" name="usertype" class="form-control" value="staff">
                                                <div class="form-group">


                                               
                                                <div class="form-group">

                                                    <button type="submit" name="addStaff" class="btn btn-primary">Add Staff</button>   <button type="submit" class="btn btn-outline-warning">Reset</button>

                                                </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>

<?php include_once ('includes/footer.php') ?>