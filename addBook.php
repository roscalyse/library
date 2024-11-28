<?php include_once ('includes/header.php') ?>

<?php 

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

<main>
   
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Books</h4></div>

                           
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
                                                <div class="form-row">
                                                    <div class="col-6 mb-3">
                                                        <label for="ISBN">Enter ISBN</label>

                                                        <input type="text" name="isbn" class="form-control" placeholder="">

                                                    </div>
                                                    <div class="col-6 mb-3">   
                                                      <label for="Author">Enter Author</label>              
                                                    
                                                         <select name="author_id" class="form-control">
                                                            <option value="">Choose Author</option>
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
                                                        <input type="text" name="title" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="col-6 mb-3">   
                                                      <label for="Author">Enter Category</label>              
                                                    
                                                         <select name="category_id" class="form-control">
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

                                                        <input type="text" name="edition" class="form-control" placeholder="">

                                                    </div>
                                                    <div class="col-6 mb-3"> 
                                                        <label for="email">Enter Publisher</label>                                               
                                                        <input type="text" name="publisher" class="form-control" placeholder="">
                                                    </div>

                                                    <div class="col-6 mb-3">
                                                        <label for="">Enter Publication Year</label>

                                                        <input type="number" name="publication_year" class="form-control" placeholder="">

                                                    </div>
                                                    <div class="col-6 mb-3"> 
                                                        <label for="number">Enter Number of Copies</label>                                               
                                                        <input type="number" name="total_copies" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="col-6 mb-3"> 
                                                        <label for="email">Enter Shelve Number</label>                                               
                                                        <input type="text" name="shelve_number" class="form-control" placeholder="">
                                                    </div>


                                                    <div class="col-12">

                                                        <button type="submit" name="addBook" class="btn btn-primary">Add Book</button>   

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
                <!-- END: Card DATA-->
            </div>
</main>
          <!-- START: Page Vendor JS-->
        <script src="dist/vendors/select2/js/select2.full.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->
        <script src="dist/js/select2.script.js"></script>
        <!-- END: Page Script JS-->
        
<?php include_once ('includes/footer.php') ?>