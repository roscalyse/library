<?php include_once ('includes/header.php') ?>
<main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            
                           
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header  justify-content-between align-items-center">                               
                                <h4 class="card-title">All Fines Report</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display table dataTable table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Names</th>
                                                <th>E-mail</th>
                                                <th>Fine</th>
                                                <th>Date</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $num=0;
                                            $transactions=getAllFines($conn);
                                            foreach ($transactions as $transaction):
                                        ?>
                                            <tr>
                                                <td><?=$num+=1?></td>
                                                <td><?= $transaction['first_name']?> <?= $transaction['last_name']?></td>
                                                <td><?= $transaction['email']?></td>
                                                <td><?= format_money($transaction['fine'])?></td>
                                                <td><?= $transaction['transaction_date']?></td>
                                                
                                            </tr>
                                         <?php endforeach?>  
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SN</th>
                                                <th>Names</th>
                                                <th>E-mail</th>
                                                <th>Fine</th>
                                                <th>Date</th>
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