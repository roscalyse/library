   <!-- START: Back to top-->
   <a href="#" class="scrollup text-center"> 
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->

        <!-- START: Template JS-->
       
        <script src="dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="dist/vendors/moment/moment.js"></script>
        <script src="dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="dist/vendors/flag-select/js/jquery.flagstrap.min.js"></script> 
        <!-- END: Template JS-->
       
       
        <!-- START: APP JS-->
        <script src="dist/js/app.js"></script>
        <!-- END: APP JS-->


        <!-- START: Page JS-->
        <script src="dist/js/home.script.js"></script>
        <!-- END: Page JS-->

        <!-- START: Page Vendor JS-->
        <script src="dist/vendors/select2/js/select2.full.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->
        <script src="dist/js/select2.script.js"></script>
        <!-- END: Page Script JS-->

        <!-- START: Page Vendor JS-->
        <script src="dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
        <script src="dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
        <?php if($user['usertype']=='admin') { ?>
        <script src="dist/vendors/datatable/jszip/jszip.min.js"></script>
        <script src="dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
        
        <script src="dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
        <?php } ?>
        <script src="dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
        <script src="dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->        
        <script src="dist/js/datatable.script.js"></script>
        <!-- END: Page Script JS--> 

        <!-- START: Page Vendor JS-->
        <script src="dist/vendors/fullcalendar/core/main.min.js"></script>        
        <script src='dist/vendors/fullcalendar/interaction/main.js'></script>
        <script src='dist/vendors/fullcalendar/daygrid/main.js'></script>
        <script src='dist/vendors/fullcalendar/timegrid/main.js'></script>
        <script src='dist/vendors/fullcalendar/list/main.js'></script>
        <!-- END: Page Vendor JS-->

       
        <script src="dist/vendors/sweetalert/sweetalert.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- START: Page Script JS-->
        <script src="dist/js/sweetalert.script.js"></script>
        
    </body>
    <!-- END: Body-->


</html>
