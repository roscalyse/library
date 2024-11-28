
<?php include_once ('includes/header.php') ?>

<main>
    <div class="container-fluid">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="text-center mb-0" style="font-family: Georgia, serif;">Welcome to Limkokwing University Library</h4> </div>

                    
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->
        <?php if($user['usertype']=='admin') { ?>
        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="icon-bag icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                                <h2 class="card-liner-title"><?=booksQuantity($conn)?></h2>
                                <h6 class="card-liner-subtitle">Total Number of Books </h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="icon-user icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                            <?php
                            $users=getAllUsers($conn);
                            $num=0;
                            foreach($users as $user):
                            $num+=1;
                            endforeach;
                            ?>
                                <h2 class="card-liner-title"><?=$num?></h2>
                                <h6 class="card-liner-subtitle">Total Users</h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="icon-basket icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                                <h2 class="card-liner-title"><?=ReservationsQuantity($conn)?></h2>
                                <h6 class="card-liner-subtitle">Total Reservations</h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <span class="card-liner-icon mt-1"><small>Shs</small></span>
                            <div class='card-liner-content'>
                                <h2 class="card-liner-title"><?= format_money(getTotalFines($conn))?></h2>
                                <h6 class="card-liner-subtitle">Total Fines</h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
        <div class="col-12 col-xl-12 col-md-6 mt-3">
            <div class="card">  
                <div class="card-header d-flex justify-content-between align-items-center">                               
                    <h4 class="card-title">Books Inventory Bar Chart</h4>                                    
                </div>
                <div class="card-body text-center">
                    <div id="apex_pie_chart" class="height-500"></div>
                    
                </div>
            </div>
        </div>
    </div> 
    
        <?php } else {?>
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="icon-basket icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                                <h2 class="card-liner-title"><?=userNumberOfReservations($conn, $user['email'])?></h2>
                                <h6 class="card-liner-subtitle">Reserved Books </h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <i class="fa fa-book icons card-liner-icon mt-2"></i>
                            <div class='card-liner-content'>
                            
                                <h2 class="card-liner-title"><?=userNumberOfBooks($conn, $user['email'])?></h2>
                                <h6 class="card-liner-subtitle">Borrowed Books</h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <span class="card-liner-icon mt-1"><small>Shs</small></span>
                            <div class='card-liner-content'>
                                <h2 class="card-liner-title">
                                    <?php 
                                    $results=emailExistsInTransactions($conn, $user['email']);
                                    $paid=getUserPaymentByEmail($conn, $user['email']);
                                    $due=getUserFineByEmail($conn, $user['email']);
                                    if($due) {
                                        if(isset($paid['amount_paid'])){
                                            if($due['amount_fine']>=$paid['amount_paid']){
                                                echo "<p class='text-danger'>".
                                                format_money($due['amount_fine']-$paid['amount_paid'])."</p>";
                                            } else{
                                                echo "<p class='text-danger'> 0 </p>";
                                            }
                                        }else{
                                            echo "<p class='text-danger'>". $due['amount_fine'] ."</p>";
                                        }
                                        
                                    } else{
                                        echo '0';
                                    }
                                    ?>
                                </h2>
                                <h6 class="card-liner-subtitle">My Total Fines</h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
           
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center'>
                            <span class="card-liner-icon mt-1"><small>Shs</small></span>
                            <div class='card-liner-content'>
                                <h2 class="card-liner-title">
                                    <?php 
                                    
                                    if($paid) {
                                        echo format_money($paid['amount_paid']-$due['amount_fine']);
                                    } else{
                                        echo '0';
                                    }
                                    ?>
                                </h2>
                                <h6 class="card-liner-subtitle">Extra Paid</h6> 
                            </div>                                
                        </div>
                        
                    </div>
                </div>
            </div>
           
        </div>
        <?php } ?>
    </div>
</main>  


<script>
 document.addEventListener("DOMContentLoaded", function() {
            // Define the theme variable (light/dark)
    var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');
    var bodycolor = getComputedStyle(document.body).getPropertyValue('--bodycolor');
    var bordercolor = getComputedStyle(document.body).getPropertyValue('--bordercolor');
    var theme = 'light';
    if ($('body').hasClass('dark')) {
        theme = 'dark';
    }
    if ($('body').hasClass('dark-alt')) {
        theme = 'dark';
    }

            // Chart options
            var options = {
                theme: {
                    mode: theme // Set the theme
                },
                chart: {
                    width: 490,
                    type: 'pie',
                },
                labels: ['Reserved Books', 'Borrowed Books', 'Available Books'],
                series: [
                    <?=ReservationsQuantity($conn)?>, 
                    <?=allIssuedQuantity($conn)?>,
                    <?php $num=allBooksQuantity($conn); echo available($conn,$num['total'] , allIssuedQuantity($conn), ReservationsQuantity($conn));?>
                ],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 350
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            // Create and render the chart
            var chart = new ApexCharts(
                document.querySelector("#apex_pie_chart"),
                options
            );

            chart.render().then(function() {
                console.log("Chart rendered successfully.");
            }).catch(function(error) {
                console.error("Error rendering chart:", error);
            });
        });
</script>
<script src="dist/vendors/apexcharts/apexcharts.min.js"></script> 
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>       -->
<!-- <script src="dist/js/apex.script.js"></script> -->       
<?php include_once ('includes/footer.php') ?>