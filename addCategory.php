<?php include_once ('includes/header.php') ?>
<?php 

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
}
?>

<main>
   
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Categories</h4></div>

                           
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
                                                <input type="text" name="cName" class="form-control" placeholder="Name:">
                                              </div>
                                   
                                              <div class="form-group">
                                                 <textarea class="form-control"name="descri" placeholder="Description:"></textarea>
                                              </div>


                                              <button type="submit" name="addCategory" class="btn btn-primary btn-default">Add Category</button>
                               
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