<?php include_once ('includes/header.php') ?>

<main>
            <div class="container-fluid">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                            <div class="w-sm-100 mr-auto"><span class="h4 my-auto">User Profile</span></div>

                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <!-- START: Card Data-->
               
                <div class="row mt-3">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">                               
                                <h4 class="card-title">Full Details</h4>
                            </div>
                            <?php
                            $staff=getStaffByEmail($conn, $user['email']);
                            $student=getStudentByEmail($conn, $user['email']);
                            if($user['usertype']=='staff' || $user['usertype']=='admin'){
                            ?>
                            <div class="card-body p-0"> 
                                <div class="row">
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">First Name: <?=$staff['first_name']?></h5>
                                    </div>                              
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">Last Name: <?=$staff['last_name']?></h5>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">e-mail: <?=$staff['email']?></h5>
                                    </div>                              
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">Position: <?=$user['usertype']?></h5>
                                    </div> 
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">Contact: <?=$staff['contact']?></h5>
                                    </div> 
                                </div>
                                
                            </div>
                            <?php
                            } else if($user['usertype']=='student'){
                            ?>
                            <div class="card-body p-0"> 
                                <div class="row">
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">First Name: <?=$student['first_name']?></h5>
                                    </div>                              
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">Last Name: <?=$student['last_name']?></h5>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">Registration Number: <?=$student['stud_id']?></h5>
                                    </div>                              
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">Contact: <?=$student['contact']?></h5>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">e-mail: <?=$student['email']?></h5>
                                    </div>                              
                                    <div class="card-header d-flex justify-content-between align-items-center col-xl-6">                               
                                        <h5 class="card-title pl-3">Position: <?=$user['usertype']?></h5>
                                    </div> 
                                </div>
                            </div>
                            <?php }?>
                        </div>
                       
                    </div>
                   
                </div>
                <!-- END: Card DATA-->
            </div>
        </main>

<?php include_once ('includes/footer.php') ?>