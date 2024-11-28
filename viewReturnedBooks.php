<?php include_once ('includes/header.php') ?>

 <main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0">Manage Books returned</h4></div>

                           
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">All returned Books</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>User email</th>
                                                <th>Full Names</th>
                                                <th>Return Date</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $num=0;
                                            $returns=getAllReturnedBooks($conn);
                                            foreach ($returns as $return):
                                        ?>
                                            <tr>
                                                <td><?=$num+=1?></td>
                                                <td>
                                                <?php
                                                $book=getBookById($conn, $return['book_id']);
                                                echo $book['title']. " By ";
                                                $authorName=getAuthorNameById($conn, $book['author_id']);
                                                echo $authorName['name']
                                                ?>
                                                </td>
                                                <td><?=$return['email']?></td>
                                                <td><?=$return['first_name']. " ". $return['last_name']?></td>
                                                <td><?=$return['return_date']?></td>
                                                
                                            </tr>
                                        <?php endforeach ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Book</th>
                                                <th>User email</th>
                                                <th>Full Names</th>
                                                <th>Return Date</th>
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
  
<?php include_once ('includes/footer.php') ?>