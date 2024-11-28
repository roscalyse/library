<?php include_once ('includes/header.php') ?>

<?php 
$id=$_GET['id'];
$student=getMemberById($conn,$id);

if(isset($_POST['updateStudent'])) {
    $id=$_POST['id'];
   $fName=$_POST['fName'];
   $lName =$_POST['lName'];
   $regNo=$_POST['regNo'];
   $email=$_POST['email'];
   $contact =$_POST['contact'];
   $password=$_POST['password'];
   
  
   // call function
   $result =updateStudents($conn, $fName, $lName, $regNo, $email, $contact, $password, $id);
   if($result) {
   
       echo '<script>alert("Student updated Successfully ")</script>';
       echo '<script> window.location.href="displayStudents.php"</script>';
    } else{
       echo '<script>alert("Students updated Failed")</script>';
    }
  
}
?>

<main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Update Student</h4></div>

                            
                        </div>
                    </div>
                </div>
               
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

                                                        <input type="text" name="fName" class="form-control" value="<?= $student['first_name'] ?>">

                                                    </div>
                                                    <input type="text" name="id" class="form-control d-none" value="<?= $_GET['id'] ?>">
                                                    <div class="col-6 mb-3"> 
                                                        <label for="Last Name">Last Name</label>                                               
                                                        <input type="text" name="lName" class="form-control" value="<?= $student['last_name'] ?>" placeholder="last name">
                                                    </div>
                                                <label for="stud_id">Registration Number</label>
                                                <div class="input-group  mb-3">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-transparent border-right-0" id="basic-addon1"><i class="icon-user"></i></span>
                                                    </div>
                                                    <input type="text" name="regNo" class="form-control"value="<?= $student['stud_id'] ?>" >

                                                </div>
                                               
                                                    <div class="col-6 mb-3">
                                                      <label for="email">Email</label>

                                                      <div class="input-group">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text bg-transparent border-right-0" id="basic-email"><i class="icon-envelope"></i></span>
                                                        </div>
                                                        <input type="email" name="email" class="form-control" value="<?= $student['email'] ?>">
                                                      </div>

                                                    </div>
                                                    <div class="col-6 mb-3">
                                                       <label for="contact">Contact</label>
                                                       <input type="number" name="contact" class="form-control" value="<?= $student['contact'] ?>">

                                                    </div>


                                                <label for="username">Password</label>

                                                <div class="input-group mb-3 ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-transparent border-right-0" id="basic-password"><i class="icon-options"></i></span>
                                                    </div>
                                                    <input type="password" name="password" class="form-control" value="<?= $student['password'] ?>">
                                                </div>

                                                <input type="text" class="d-none" name="usertype" class="form-control" value="student">
                                                <div class="form-group">

                                                    <button type="submit" name="updateStudent" class="btn btn-primary">Update Student</button>   <button type="submit" class="btn btn-outline-warning">Reset</button>

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