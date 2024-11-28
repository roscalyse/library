<?php include_once ('includes/header.php') ?>

 <!-- START: Main body-->
 <main>
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12 align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">App Calendar</h4></div>

                </div>
            </div>
        </div>
        

        <!-- START: Card Data-->
        <div class="row row-eq-height">
            
            <div class="col-12 col-md-9 mt-3">
                <div class="card h-100">
                    <div class="card-body h-100">
                        <div id='calendar' class="h-100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Card DATA-->
    </div>
</main>
  <script>
    
    $(document).ready(function () {
     
    var calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            height: 'parent',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            defaultView: 'dayGridMonth',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events

            // Load events via AJAX
            events: function (fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: 'events.php', // URL to PHP file that fetches events
                    dataType: 'json',
                    success: function (data) {
                        var events = [];
                        data.forEach(function (event) {
                            events.push({
                                title: event.title,
                                start: event.start, // 'start' is due_date from database
                                color: '#28a745'   // Optional: Set a color
                            });
                        });
                        successCallback(events);
                    },
                    error: function () {
                        failureCallback();
                    }
                });
            }
        });

        calendar.render();
    }
});

  </script>      

<?php include_once ('includes/footer.php') ?>