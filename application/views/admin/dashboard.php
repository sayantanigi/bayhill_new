<style>
.app-search{margin-left:0!important}
.autocomplete-results{position:absolute;top:100%;left:0;right:0;z-index:9999;background:#fff;border:1px solid #ddd;border-top:none;max-height:220px;overflow-y:auto;box-shadow:0 2px 8px rgba(0,0,0,.07)}
.search-item{padding:8px 16px;cursor:pointer;transition:background .15s;font-size:15px;line-height:1.5;border-bottom:1px solid #f3f3f3}
.search-item:last-child{border-bottom:none}
.search-item.active,.search-item:hover{background:#f0f6ff;color:#004085}
.student-item strong,.trainer-item strong{color:#007bff}
.text-danger{color:#dc3545!important}
.text-muted{color:#6c757d!important; margin: 0px !important}
.autocomplete-results:empty{display:none}
.trainer-item{display: flex; flex-direction: row; flex-wrap: wrap; justify-content: space-between;}
.student-item{display: flex; flex-direction: row; flex-wrap: wrap; justify-content: space-between;}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Welcome to the Admin <?= $title ?></h4>
                        <div class="page-title-right"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="col-xl-12" style="display: flex; flex-direction: row; flex-wrap: wrap;">
                        <div class="col-xl-12" style="display: flex; flex-direction: row; flex-wrap: wrap;">
                            <div class="col-sm-4" style="padding-right: 15px;">
                                <form class="app-search d-none d-lg-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="trainer_search" autocomplete="off" placeholder="Search by Trainer Name">
                                        <span class="ri-search-line"></span>
                                        <div id="trainer_results" class="autocomplete-results"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-4" style="padding-right: 10px; padding-left: 10px;">
                                <form class="app-search d-none d-lg-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="student_search" autocomplete="off" placeholder="Search by Student Name">
                                        <span class="ri-search-line"></span>
                                        <div id="student_results" class="autocomplete-results"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-4" style="padding-right: 10px; padding-left: 10px;">
                                <form class="app-search d-none d-lg-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="search_by_mobile" autocomplete="off" placeholder="Search by Mobile Number">
                                        <span class="ri-search-line"></span>
                                        <div id="search_by_mobile_results" class="autocomplete-results"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row h-100">
                        <div class="col-md-6 col-xl-4">
                            <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                <a href="<?= base_url('admin/trainer') ?>">
                                    <?php $trainers = $this->Adminmodel->count('users', array('user_type' => 2)); ?>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">Trainers</h5>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                                    <i class="fa fa-users text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24"><?= $trainers ?></h3>
                                    </div>
                                </a>
                                <div id="project-chart"></div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <a href="<?= base_url('admin/student') ?>">
                                <?php $students = $this->Adminmodel->count('users', array('user_type' => 1)); ?>
                                <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">Students</h5>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                                    <i class="fa fa-link text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24"><?= $students ?></h3>
                                    </div>
                                    <div id="completed-chart"></div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-4">
                            <a href="<?= base_url('admin/booking') ?>">
                                <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                <?php $booking_list = $this->Adminmodel->count('booking', ''); ?>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">Booking List</h5>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                                    <i class="fa fa-link text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24"><?= $booking_list ?></h3>
                                    </div>
                                    <div id="completed-chart"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <div style="margin-bottom: 10px; display: flex; justify-content: flex-end;">
                                <button id="addBookingBtn" type="button" class="fc-today-button fc-button fc-button-primary">Add New Booking</button>
                            </div>
                            <div class="Calender_Pick" id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdropcompletedClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 680px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Booking Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3" id="bookedSlotDataContent"></div>
                <p id="updateccmsg" class="text-center"></p>
            </div>
        </div>
        </form>
    </div>
</div>
<div id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true" style="display:none; position:fixed; z-index:99999; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:#fff; padding:20px; border-radius:8px; min-width:300px; position:relative; max-height: 525px; overflow-x: scroll;">
        <span id="closeModal" style="position:absolute; top:10px; right:15px; cursor:pointer; font-weight:bold;">&times;</span>
        <h2>New Booking</h2>
        <div class="col-lg-12 mb-3">
            <div class="card shadow rounded">
                <form id="bookingFromAdminDahhboard">
                    <div class="card-body">
                        <div class="col-12 d-flex">
                            <div class="col-sm-6" style="padding: 0px 10px 0px 0px;">
                                <div class="form-group mb-2">
                                    <!-- <label class="fw-semibold  text-black">Email <span style="color:red">*</span></label> -->
                                    <input type="email" class="form-control" placeholder="Enter Student Email" name="email" id="email" required autocomplete="off">
                                </div>
                                <small id="email_error"></small>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="col-sm-2" style="padding: 0px 10px 0px 0px;">
                                <div class="form-group mb-2">
                                    <!-- <label class="fw-semibold  text-black">Salutation <span style="color:red">*</span></label> -->
                                    <select class="form-control" name="salutation" id="salutation" required disabled>
                                        <option value="">Select Salutation</option>
                                        <option value="Mr." aria-label="Mr.">Mr.</option>
                                        <option value="Ms." aria-label="Ms.">Ms.</option>
                                        <option value="Mrs." aria-label="Mrs.">Mrs.</option>
                                        <option value="Miss." aria-label="Miss.">Miss.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5" style="padding: 0px 10px 0px 0px;">
                                <div class="form-group mb-2">
                                    <!-- <label class="fw-semibold  text-black">First Name <span style="color:red">*</span></label> -->
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Student First Name" required autocomplete="off" readonly="readonly">
                                </div>
                                <small id="fname_error"></small>
                            </div>
                            <div class="col-sm-5" style="padding: 0px 10px 0px 0px;">
                                <div class="form-group mb-2">
                                    <!-- <label class="fw-semibold  text-black">Last Name <span style="color:red">*</span></label> -->
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Student Last Name" required autocomplete="off" readonly="readonly">
                                </div>
                                <small id="lname_error"></small>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                                <div class="form-group mb-2">
                                    <!-- <label class="fw-semibold  text-black">Phone <span style="color:red">*</span></label> -->
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Student Phone No." required autocomplete="off" readonly="readonly">
                                </div>
                                <small id="phone_error"></small>
                            </div>
                            <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                                <!-- <label class="fw-semibold  text-black">State</label> -->
                                <select class="form-control" name="state" id="state" disabled>
                                    <?php
                                    $state_list = $this->db->query("SELECT * FROM states WHERE id = '1416'")->result();
                                    if($state_list) {
                                    foreach ($state_list as $state) { ?>
                                    <option value="<?= $state->id?>"><?= $state->name?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                                <!-- <label class="fw-semibold  text-black">City</label> -->
                                <input type="text" class="form-control" placeholder="Enter City" name="city" id="city" readonly/>
                            </div>
                            <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                                <!-- <label class="fw-semibold  text-black">Zip Code</label> -->
                                <input type="text" class="form-control" placeholder="Enter Zip Code" name="pincode" id="pincode" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="col-sm-12" style="padding: 0px 10px 0px 0px;">
                                <div class="form-group mb-2">
                                    <!-- <label class="fw-semibold  text-black">Street Address</label> -->
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Street Adress" value="" readonly>
                                </div>
                                <small id="address_error"></small>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div class="col-sm-6" style="padding: 0px 10px 0px 0px;">
                                <!-- <label class="fw-semibold text-black">Course List</label> -->
                                <select class="form-control" name="courseList" id="courseList">
                                    <option value="">Select Course</option>
                                    <?php
                                    $course_list = $this->db->query("SELECT * FROM courses WHERE status = '1' AND is_deleted='1'")->result();
                                    if($course_list) {
                                    foreach ($course_list as $course) { ?>
                                    <option value="<?= $course->id?>"><?= $course->course_name.' '.$course->course_name1.' '.$course->course_name2?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="col-sm-6" style="padding: 0px 10px 0px 0px;">
                                <div class="form-group mb-2">
                                    <!-- <label class="fw-semibold text-black">Trainer List</label> -->
                                    <select class="form-control" name="trainerList" id="trainerList">
                                        <option value="">Select Trainer</option>
                                        <?php
                                        $trainer_list = $this->db->query("SELECT * FROM users WHERE user_type = '2'")->result();
                                        if($trainer_list) {
                                        foreach ($trainer_list as $trainer) { ?>
                                        <option value="<?= $trainer->id?>"><?= $trainer->salutation.' '.$trainer->first_name.' '.$trainer->last_name?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                <small id="address_error"></small>
                            </div>
                        </div>
                        <div class="col-12 d-flex">
                            <div id="booking-container" style="width: 100%">
                                <div class="booking-row row mb-2 w-100" style="padding: 10px 0 0 15px;">
                                    <div class="col-sm-4" style="padding: 0px 10px 0px 0px;">
                                        <label class="fw-semibold text-black">Booking Date</label>
                                        <input type="date" class="form-control" name="bookingdate[]" />
                                    </div>
                                    <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                                        <label class="fw-semibold text-black">Booking From Time</label>
                                        <input type="time" class="form-control" name="bookingfromtime[]" data-validation="time" data-validation-format="hh:mm"/>
                                    </div>
                                    <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                                        <label class="fw-semibold text-black">Booking To Time</label>
                                        <input type="time" class="form-control" name="bookingtotime[]" data-validation="time" data-validation-format="hh:mm"/>
                                    </div>
                                    <div class="col-sm-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-success add-booking-row" style="width: 37px; height: 38px;">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <button class="btn btn-success text-uppercase px-5 shadow" id="addTrainerButton">Submit</button>
                            <!-- <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a> -->
                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="course_id" id="course_id">
                            <input type="hidden" name="trainer_id" id="trainer_id">
                        </div>
                    </div>
                </form>
            </div>
            <div style="text-align: center;" id="submit_status"></div>
        </div>
    </div>
</div>
<style>
span.fc-title {
    cursor: pointer !important;
}
</style>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.2/main.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.4.2/main.min.css'>

<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.4.2/main.min.js'></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
const modal = document.getElementById('bookingModal');
const openBtn = document.getElementById('addBookingBtn');
const closeBtn = document.getElementById('closeModal');

openBtn.onclick = function() {
    modal.style.display = 'flex';
};

closeBtn.onclick = function() {
    modal.style.display = 'none';
};

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const myEvents = [
        <?php
        // Group bookings by date
        $getBookingData = $this->db->query("SELECT * FROM booking_details")->result();
        $bookingsByDate = [];
        if(!empty($getBookingData)) {
            foreach ($getBookingData as $value) {
                $booking_id = $value->booking_id;
                $getbooking = $this->db->query("SELECT * FROM booking WHERE id = '".$booking_id."'")->row();
                $getcourseData = $this->db->query("SELECT * FROM courses WHERE id = '".$getbooking->course_id."'")->row();
                $courseName = @$getcourseData->course_name.' '.$getcourseData->course_name1;
                $gettrainerData = $this->db->query("SELECT * FROM users WHERE id = '".$getbooking->trainer_id."'")->row();
                $trainerName = !empty($gettrainerData) ? @$gettrainerData->salutation.' '.$gettrainerData->first_name.' '.$gettrainerData->last_name : "";
                $getstudentData = $this->db->query("SELECT * FROM users WHERE id = '".$getbooking->user_id."'")->row();
                $studentName = !empty($getstudentData) ? @$getstudentData->salutation.' '.$getstudentData->first_name.' '.$getstudentData->last_name : "";
                $fromtime = explode(' - ', $value->booking_time);
                $booking_date = date('Y-m-d', strtotime($value->booking_date));

                $booking_detail = [
                    'id' => $booking_id,
                    'title' => $courseName,
                    'trainer' => $trainerName,
                    'student' => $studentName,
                    'time' => $value->booking_time,
                ];

                if (!isset($bookingsByDate[$booking_date])) {
                    $bookingsByDate[$booking_date] = [];
                }
                $bookingsByDate[$booking_date][] = $booking_detail;
            }
        }
        foreach ($bookingsByDate as $booking_date => $bookings) {
            $count = count($bookings);
            for ($i = 0; $i < min(3, $count); $i++) {
                $b = $bookings[$i];
                ?>
                {
                    title:'<?= addslashes($b['title']) ?>',
                    start: '<?= $booking_date ?>',
                    backgroundColor: 'green',
                    extendedProps: {
                        id:'<?= $b['id'] ?>',
                        trainer: '<?= addslashes($b['trainer']) ?>',
                        student: '<?= addslashes($b['student']) ?>',
                        time: '<?= addslashes($b['time']) ?>'
                    }
                },
                <?php
            }
            // If more than 3, show a "+N more" event
            if ($count > 3) {
                $remaining = array_slice($bookings, 3);
                $restCount = count($remaining);
                $restDetails = [];

                foreach ($remaining as $b) {
                    $restDetails[] = $b['title'].' ('.$b['id'].' - '.$b['student'].' - '.$b['trainer'].' at '.$b['time'].')';
                }
                $restDetailsStr = htmlspecialchars(implode('\n', $restDetails));
                ?>
                {
                    title: '+<?= $restCount ?> more',
                    start: '<?= $booking_date ?>',
                    backgroundColor: 'red',
                    extendedProps: {
                        details: "<?= $restDetailsStr ?>"
                    }
                },
                <?php
            }
        }
        ?>
    ];

    const calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridDay,timeGridWeek,dayGridMonth,listYear'
        },
        defaultView: 'dayGridMonth',
        selectable: true,
        events: myEvents,
        eventClick: function(info) {
            var clickedDate = info.event.start;
            var year = clickedDate.getFullYear();
            var month = String(clickedDate.getMonth() + 1).padStart(2, '0');
            var day = String(clickedDate.getDate()).padStart(2, '0');
            var clickedDateStr = year + '-' + month + '-' + day;
            $('.choosendate').text(clickedDate.toDateString());
            if (info.event.title.startsWith('+') && info.event.extendedProps.details) {
                var choosendate = clickedDateStr;
                $.ajax({
                    type:"post",
                    url:"<?php echo base_url()?>admin/Dashboard/getBookingDetails",
                    data:{choosendate: choosendate},
                    dataType: 'html',
                    success:function(response) {
                        $('#bookedSlotDataContent').empty();
                        $('#bookedSlotDataContent').html(response);
                        $('#staticBackdropcompletedClass').modal('show');
                    },
                    error: function() {
                        $('#bookedSlotDataContent').empty();
                        $('#bookedSlotDataContent').html('An error occurred while submitting your note');
                    }
                });
            } else {
                var bookingId = btoa(info.event.extendedProps.id);
                var BASE_URL = "<?= base_url() ?>";
                var url = BASE_URL + "admin/course/booking_details/" + bookingId;
                window.open(url);
            }
        },
        views: {
            dayGridDay: { buttonText: 'Day' },
            timeGridWeek: { buttonText: 'Week' },
            dayGridMonth: { buttonText: 'Month' },
            listYear: { buttonText: 'Year' }
        }
    });

    let selectedSlots = [];
    calendar.on('select', function(info) {
        $('#staticBackdropcompletedClass').modal('show');
        $('.choosendate').text(new Date(info.startStr).toDateString());
        var choosendate = info.startStr;
        $.ajax({
            type:"post",
            url:"<?php echo base_url()?>admin/Dashboard/getBookingDetails",
            data:{choosendate: choosendate},
            dataType: 'html',
            success:function(response) {
                $('#bookedSlotDataContent').empty();
                $('#bookedSlotDataContent').html(response);
            },
            error: function() {
                $('#bookedSlotDataContent').empty();
                $('#bookedSlotDataContent').html('An error occurred while submitting your note');
            }
        });
    });
    calendar.render();
});

$("#trainer_search").on("keyup", function(){
    var inpt = $(this).val().trim();
    if (inpt.length === 0) {
        $("#trainer_results").html('');
        return;
    }
    $.ajax({
        url: "<?= base_url('admin/getTrainerData')?>",
        type: "POST",
        data: { query: inpt },
        dataType: "json",
        success: function(response) {
            var resultHtml = '';
            if (response.length > 0) {
                $.each(response, function(i, trainer){
                    resultHtml += '<a href="<?= base_url('admin/trainer/trainer_details/') ?>'+btoa(trainer.id.toString())+'" class="search-link" style="text-decoration:none;color:inherit;" target="_blank">'+'<div class="search-item trainer-item" data-id="'+trainer.id+'" data-name="'+trainer.name+'">'+'<strong>'+trainer.name+'</strong> <p class="text-muted">('+trainer.username+')</p>'+'</div></a>';
                });
            } else {
                resultHtml = '<div class="text-danger">No trainers found</div>';
            }
            $("#trainer_results").html(resultHtml);
        },
        error: function() {
            $("#trainer_results").html('<div class="text-danger">No trainers found</div>');
        }
    });
});

// Student search
$("#student_search").on("keyup", function(){
    var inpt = $(this).val().trim();
    if (inpt.length === 0) {
        $("#student_results").html('');
        return;
    }
    $.ajax({
        url: "<?= base_url('admin/getStudentData')?>",
        type: "POST",
        data: { query: inpt },
        dataType: "json",
        success: function(response) {
            var resultHtml = '';
            if (response.length > 0) {
                $.each(response, function(i, student){
                    resultHtml += '<a href="<?= base_url('admin/student/student_details/') ?>'+btoa(student.id.toString())+'" class="search-link" style="text-decoration:none;color:inherit;" target="_blank">'+'<div class="search-item student-item" data-id="'+student.id+'" data-name="'+student.name+'">'+'<strong>'+student.name+'</strong><p class="text-muted">('+student.username+')</p>'+'</div></a>';
                });
            } else {
                resultHtml = '<div class="text-danger">No students found</div>';
            }
            $("#student_results").html(resultHtml);
        },
        error: function() {
            $("#student_results").html('<div class="text-danger">No students found</div>');
        }
    });
});

$("#search_by_mobile").on("keyup", function(){
    var inpt = $(this).val().trim();
    if (inpt.length === 0) {
        $("#search_by_mobile_results").html('');
        return;
    }
    $.ajax({
        url: "<?= base_url('admin/getSearchData')?>",
        type: "POST",
        data: { query: inpt },
        dataType: "json",
        success: function(response) {
            console.log(response);
            var resultHtml = '';
            if (response.length > 0) {
                $.each(response, function(i, search){
                    if(search.usertype == '1'){
                        resultHtml += '<a href="<?= base_url('admin/student/student_details/') ?>'+btoa(search.id.toString())+'" class="search-link" style="text-decoration:none;color:inherit;" target="_blank">'+'<div class="search-item student-item" data-id="'+search.id+'" data-name="'+search.name+'">'+'<strong>'+search.name+'</strong><p class="text-muted">('+search.username+')</p>'+'</div></a>';
                    } else {
                        resultHtml += '<a href="<?= base_url('admin/trainer/trainer_details/') ?>'+btoa(search.id.toString())+'" class="search-link" style="text-decoration:none;color:inherit;" target="_blank">'+'<div class="search-item student-item" data-id="'+search.id+'" data-name="'+search.name+'">'+'<strong>'+search.name+'</strong><p class="text-muted">('+search.username+')</p>'+'</div></a>';
                    }
                });
            } else {
                resultHtml = '<div class="text-danger">No result found</div>';
            }
            $("#search_by_mobile_results").html(resultHtml);
        },
        error: function() {
            $("#search_by_mobile_results").html('<div class="text-danger">No result found</div>');
        }
    });
});

$('#email').on('blur', function(){
    var email = $('#email').val();
    $.ajax({
        url: "<?= base_url('admin/getStudentDataForBooking')?>",
        type: "POST",
        data: { email: email },
        dataType: "json",
        success: function(response) {
            //console.log(response.length);
            if(response.length > 0) {
                $('#salutation').prop('disabled', true);
                $('#fname, #lname, #phone, #state, #city, #pincode, #address').prop('readonly', true);
                $('#salutation').val(response[0].salutation);
                $('#fname').val(response[0].first_name);
                $('#lname').val(response[0].last_name);
                $('#phone').val(response[0].phone);
                $('#state').val(response[0].state);
                $('#city').val(response[0].city);
                $('#pincode').val(response[0].zipcode);
                $('#address').val(response[0].address);
                $('#student_id').val(response[0].id);
            } else {
                $('#salutation').prop('disabled', false);
                $('#fname, #lname, #phone, #state, #city, #pincode, #address').prop('readonly', false);
                $('#salutation, #fname, #lname, #phone, #city, #pincode, #address, #courseList, #trainerList, #student_id').val('');
            }
        },
        error: function() {
            $('#salutation').prop('disabled', false);
            $('#fname, #lname, #phone, #state, #city, #pincode, #address').prop('readonly', false);
            $('#salutation, #fname, #lname, #phone, #city, #pincode, #address, #courseList, #trainerList, #student_id').val('');
        }
    });
})

$('#courseList').on('change', function(){
    $('#course_id').val($(this).val());
})

$('#trainerList').on('change', function(){
    $('#trainer_id').val($(this).val());
})

$(document).ready(function() {
    // Handle Add More
    $('#booking-container').on('click', '.add-booking-row', function() {
        var newRow = `
        <div class="booking-row row mb-2 w-100" style="padding: 10px 0 0 15px;">
            <div class="col-sm-4" style="padding: 0px 10px 0px 0px;">
                <input type="date" class="form-control" name="bookingdate[]" />
            </div>
            <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                <input type="time" class="form-control" name="bookingfromtime[]" data-validation="time" data-validation-format="hh:mm"/>
            </div>
            <div class="col-sm-3" style="padding: 0px 10px 0px 0px;">
                <input type="time" class="form-control" name="bookingtotime[]" data-validation="time" data-validation-format="hh:mm"/>
            </div>
            <div class="col-sm-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-booking-row" style="width: 37px; height: 38px;">-</button>
            </div>
        </div>`;
        $('#booking-container').append(newRow);
    });

    // Handle Remove Row
    $('#booking-container').on('click', '.remove-booking-row', function() {
        $(this).closest('.booking-row').remove();
    });
});

$('#bookingFromAdminDahhboard').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "<?= base_url('admin/save_booking')?>",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            // Handle server response (success/failure)
            response = JSON.parse(response);
            if(response.status === 'success'){
                $('#submit_status').text(response.message).css('color', 'green');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            } else {
                $('#submit_status').text('An error occurred. Please try again.').css('color', 'red');
            }
        },
        error: function(xhr) {
            $('#submit_status').text('An error occurred. Please try again.').css('color', 'greeredn');
        }
    });
});
</script>