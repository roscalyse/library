<?php include_once ('includes/header.php') ?>
<?php 

if(isset($_POST['addAuthor'])) {
   //echo var_dump($_POST);
   $name=$_POST['aName'];
   $dob=$_POST['dob'];
   $dod=$_POST['dod'];
   $biography =$_POST['bio'];
   
   // call function
   $result =addAuthor($conn, $name, $biography,  $dob, $dod);
   if($result) {
    echo '<script>alert("Author Added Successfully")</script>';
    echo '<script> windows.location.href="displayAuthors.php"</script>';
   } else{
    echo '<script>alert("Author Addition Failed")</script>';
   }
}
?>

<main>
   
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Authors</h4></div>

                           
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                   
                   
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title"></h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            
                                            <form action="" method ="POST">
                                            
                                              <div class="form-group">
                                                <input type="text" name="aName" class="form-control" placeholder="Name:">
                                              </div>
                                             <div class="row">
                                              <div class="form-group col-sm-4 mb-3"> 

                                                <label for="date">Date Of Birth: 
                                                </label> 
                                                <input type="date" name="dob" class="form-control" 
                                                   id="dt"> 
                                               </div>
                                               <div class="form-group col-sm-4 mb-3"> 

                                                <label for="datetime-local">Date of Death: 
                                                </label> 
                                                <input type="date" name="dod" class="form-control" 
                                                id="dt"> 
                                               </div>
                                             </div>

                                              <div class="form-group">
                                                 <textarea class="form-control"name="bio" placeholder="Author's Biography:"></textarea>
                                              </div>


                                              <button type="submit" name="addAuthor" class="btn btn-primary btn-default">Add Author</button>
                               
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