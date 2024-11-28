<?php include_once ('includes/header.php') ?>

<main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Reservations</h4></div>
                            <?php
                             if (isset($_SESSION['error'])) {
                                  echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
                                  unset($_SESSION['error']);
                             }
                            ?>
                           
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
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

                                            <form action="" method="POST">
                                                <div class="form-row">
                                                     <div class="col-6 mb-3">
                                                      <label for="Author">Enter Author</label>              
                                                    
                                                         <select name="author" class="form-control">
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
                                                    
                                                         <select name="title" class="form-control">
                                                            <option>choose </option>
                                                             <?php

                                                              $books =getAllBooks($conn);
                                                              foreach($books as $book):
                                                              ?>
                                                              <option value="<?= $book['id'] ?>"><?= $book['title'] ?></option>
                                                              <?php endforeach ?>
                                                              
                                    
                                                         </select>
                                                                                    
                                                    </div>
                                                    <input type="text" name="status" value="reserved" hidden>

                                                    <div class="col-6 mb-3">
                                                        <label for="username">Enter E-mail</label>

                                                        <input type="text" name="email" class="form-control" placeholder="">

                                                    </div>
                                                    <div class="col-12">

                                                        <button type="submit" name="reserve" class="btn btn-primary">Add Reservation</button>   <button type="submit" class="btn btn-outline-warning">Reset</button>

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