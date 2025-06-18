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
                            <a href="<?= base_url('admin/course') ?>">
                                <div class="card overflow-hidden card-h-100 custom-shadow rounded-lg border">
                                <?php $course = $this->Adminmodel->count('courses', array('status' => 1)); ?>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="font-size-15 text-uppercase mb-0">course</h5>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded bg-soft-primary font-size-20 mini-stat-icon">
                                                    <i class="fa fa-link text-primary"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="font-size-24"><?= $course ?></h3>
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
                            <div class="Calender_Pick" id="calendar">
                                <!-- <div style="display: flex; flex-direction: row; justify-content: space-around; margin-top: 10px;">
                                    <p style="margin: 0px !important;display: flex;align-items: center;">
                                        <span style="background: #008000; display: inline-block; width: 10px; height: 10px; margin-right: 10px;">&nbsp;</span>
                                        <span> Available</span>
                                    </p>
                                    <p style="margin: 0px !important;display: flex;align-items: center;">
                                        <span style="background: #fe0000; display: inline-block; width: 10px; height: 10px; margin-right: 10px;"></span>
                                        <span> Booked</span>
                                    </p>
                                </div> -->
                            </div>
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
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.css'>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const myEvents = [
        <?php
        $getBookingData = $this->db->query("SELECT * FROM booking_details")->result();
        if(!empty($getBookingData)) {
            foreach ($getBookingData as $value) {
                $booking_id = $value->booking_id;
                $getbooking = $this->db->query("SELECT * FROM booking WHERE id = '".$booking_id."'")->row();
                $getcourseData = $this->db->query("SELECT * FROM courses WHERE id = '".$getbooking->course_id."'")->row();
                $courseName = @$getcourseData->course_name.' '.$getcourseData->course_name1;
                $gettrainerData = $this->db->query("SELECT * FROM users WHERE id = '".$getbooking->trainer_id."'")->row();
                $trainerName = @$gettrainerData->salutation.' '.$gettrainerData->first_name.' '.$gettrainerData->last_name;
                $getstudentData = $this->db->query("SELECT * FROM users WHERE id = '".$getbooking->user_id."'")->row();
                $studentName = @$getstudentData->salutation.' '.$getstudentData->first_name.' '.$getstudentData->last_name;
                $fromtime = explode(' - ', $value->booking_time);
                $booking_date = date('Y-m-d', strtotime($value->booking_date)); ?>
                {
                    title:'<?= $courseName; ?>',
                    start: '<?= $booking_date; ?>',
                    backgroundColor: 'green'
                },
            <?php }
        } ?>
    ];
    const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            center: 'title',
            right: 'today, prev,next '
        },
        plugins: ['dayGrid', 'interaction'],
        selectable: true,
        events: myEvents
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
                //alert('An error occurred while submitting you note');
                $('#bookedSlotDataContent').empty();
                $('#bookedSlotDataContent').html('An error occurred while submitting you note');
            }
        });
    });
    calendar.render();
});
</script>