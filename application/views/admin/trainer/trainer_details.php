<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<style>
.files:before,.profile .image,.text{text-align:center}
small>p{color:red}
p strong{font-weight:600!important;color:#000!important}
.sa-confirm-button-container button{background-color:#146c43!important;border-color:#146c43!important}
.files,.image_area{position:relative}
.overlay,.text{position:absolute}
.preview,.preview1{overflow:hidden;width:160px;height:160px;margin:10px;border:1px solid red}
.modal-lg{max-width:1000px!important}
.overlay{bottom:10px;left:0;right:0;background-color:rgba(255,255,255,.5);overflow:hidden;height:0;transition:.5s;width:100%}
.image_area:hover .overlay{height:50%;cursor:pointer}
.text{color:#333;font-size:20px;top:50%;left:50%;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}
#img-container{border:1px solid red;width:75vw;height:75vw;background:#666}
img{display:block;max-width:100%}
body{margin-top:20px}
.profile{width:100%;position:relative;background:#fff;border:1px solid #d5d5d5;padding-bottom:5px;margin-bottom:20px}
.profile .image{display:block;position:relative;z-index:1;overflow:hidden;border:5px solid #fff}
.profile .user{position:relative;padding:0 5px 5px}
.profile .user .avatar{position:absolute;left:20px;top:-85px;z-index:2}
.profile .user h2{font-size:16px;line-height:20px;display:block;float:left;margin:4px 0 0 135px;font-weight:700}
.profile .user .actions{float:right}
.profile .user .actions .btn{margin-bottom:0}
.profile .info{float:left;margin-left:20px}
.files:after,.files:before{position:absolute;left:0;pointer-events:none;right:0;display:block;margin:0 auto}
.img-profile{height:100px;width:100px}
.img-cover{width:800px;height:180px}
@media (max-width:768px){.btn-responsive{padding:2px 4px;font-size:80%;line-height:1;border-radius:3px}}
@media (min-width:769px) and (max-width:992px){.btn-responsive{padding:4px 9px;font-size:90%;line-height:1.2}}
.files input{outline:#92b0b3 dashed 2px;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;padding:52px 0 46px 32%;text-align:center!important;margin:0;width:100%!important}
.files input:focus{outline:#92b0b3 dashed 2px;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;border:1px solid #92b0b3}
.files:after{top:60px;width:50px;height:56px;content:"";background-image:url(https://image.flaticon.com/icons/png/128/109/109612.png);background-size:100%;background-repeat:no-repeat}
.color input{background-color:#f1f1f1}
.files:before{bottom:10px;width:100%;height:57px;color:#2ea591;font-weight:600;text-transform:capitalize}
.jobsites{padding: 0px !important; margin: 0px !important;}
.table tr {box-shadow: unset !important; border-color: unset !important; border-style: hidden !important; border-width: 0px !important;}
.getdatespecificdatetime {border-radius: 10px; width: 150px; padding: 10px; display: inline-block; text-align: center; font-size: 12px; font-weight: 600; margin-bottom: 5px; border: 1px solid #000; margin-right: 12px; }
.getdatespecificdata {display: inline-block; margin-bottom: 10px; padding: 10px; border-radius: 15px;}
.availtimedata{display: none; margin-top: 0px; text-align: center; margin-bottom: 20px;}
.availtimedata .selected {background: green; color: #fff;}
.choosendate {display: inline; font-size: 18px;}
.availslotdata {text-align: center; border-radius: 10px; box-shadow: 0 0 10px #dddddd; margin-top: 0px; display: none; width: 100%; flex-wrap: wrap; justify-content: center;}
.availslotdataheader {background: #eee; width: 100%; display: inline-block; height: 50px;}
.availslotdataheaderdata {display: flex; margin-top: 10px;}
.availslotdataheaderdataleft{display: inline; font-size: 18px; text-align: justify;}
.availslotdataheaderdataright{display: inline; font-size: 18px; text-align: end;}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <section class="bg-light-gray">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0"><?= $page ?></h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?= $page ?></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-0">
                            <div class="card shadow rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container">
                                            <div class="col-md-12">
                                                <div class="profile clearfix">
                                                    <div class="image item" id="Cover-Image">
                                                        <img src="<?= !empty($trainerData->coverImage) ? base_url('uploads/trainer/cover_image/' . $trainerData->coverImage . '') : base_url('uploads/bnr.jpg'); ?>" class="img-cover" id="cblah">
                                                    </div>
                                                    <div class="user clearfix">
                                                        <div class="avatar item" id="item">
                                                            <?php if(!empty($trainerData->image) && file_exists('uploads/trainer/profilePic/'.$trainerData->image)) { ?>
                                                            <img src="<?= base_url('uploads/trainer/profilePic/'.$trainerData->image) ?>" class="img-thumbnail img-profile" id="pblah">
                                                            <?php } else { ?>
                                                            <img src="<?= base_url('uploads/default_profile.jpg') ?>" class="img-thumbnail img-profile" id="pblah">
                                                            <?php } ?>
                                                        </div>
                                                        <h2>
                                                            <span id="slttn"><?= $trainerData->salutation; ?></span>
                                                            <span id="f-name"><?= $trainerData->first_name; ?></span>
                                                            <span id="l-name"><?= $trainerData->last_name; ?></span>
                                                        </h2>
                                                    </div>
                                                    <div class="info"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="card rounded">
                                                <div class="card-body">
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Full Name: </b><p class="text-muted" id="sltatn" style="display: contents"><?= @$trainerData->salutation." ".@$trainerData->first_name." ".@$trainerData->last_name;?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>username: </b><p class="text-muted" id="sltatn" style="display: contents"><?= @$trainerData->username?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Email: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->email; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>About: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->about; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Gender: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->gender; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>DOB: </b><p class="text-muted" id="individual_email" style="display: contents"><?= date('d-m-Y', strtotime(@$trainerData->dob)); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Phone: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->phone; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Street Address: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->address; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>State: </b><p class="text-muted" id="individual_email" style="display: contents">
                                                                <?php
                                                                $getState = $this->db->query("SELECT * FROM states WHERE id = '".@$trainerData->state."'")->row();
                                                                echo @$getState->name; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>City: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->city; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Zipcode: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->zipcode; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Driving Instructor Certificates: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->certificates; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Instructor License Number: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->licensenumber; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Expiration Date: </b><p class="text-muted" id="individual_email" style="display: contents"><?= date('d-m-Y', strtotime(@$trainerData->license_expiration_date)); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Driving License Number: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->dlicensenumber; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Expiration Date: </b><p class="text-muted" id="individual_email" style="display: contents"><?= date('d-m-Y', strtotime(@$trainerData->driving_expiration_date)); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Languages: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->languages; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Experience: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$trainerData->experience; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Skills: </b>
                                                            <p class="text-muted" id="individual_email" style="display: contents">
                                                            <?php
                                                            if(!empty(@$trainerData->skills)) {
                                                                $skills = unserialize(@$trainerData->skills);
                                                                foreach ($skills as $i => $row) {
                                                                    echo ($i + 1).'. '.$row['skills'].' => '.$row['rating'].PHP_EOL;
                                                                }
                                                            } else {
                                                                echo "No skills added yet";
                                                            } ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Status: </b><p class="text-muted" id="individual_status" style="display: contents"><?php if($trainerData->status == 1) { echo "Active"; } else { echo "Inactive"; } ?> </p>
                                                            <?= @$trainerData->timeZone; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-0">
                            <div class="card shadow rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container">
                                            <div class="col-md-12">
                                                <div class="Calender_Pick" id="calendar"></div>
                                                <div class="quick-form-job availtimedata" style="">
                                                    <h3 style=" padding: 25px 0px 0px 0px; font-size: 18px; ">Selected Date: <p class="choosendate"></p></h3>
                                                    <div class="getdatespecificdata"></div>
                                                    <div style="display: inline-block;">
                                                        <button id="confirmSlotsButton" style="display: none;">Confirm Slots</button>
                                                    </div>
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.2/main.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.4.2/main.min.css'>

<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.4.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.4.2/main.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const myEvents = [
        <?php
        if(!empty(@$trainerData->id)) {
            @$timeZone = $trainerData->timeZone;
            $availability = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".@$trainerData->id."' group by utcStartDate")->result_array();
            if(!empty($timeZone)){
                if(!empty($availability)) {
                    foreach ($availability as $value) {
                        $fromtime = explode(' to ', $value['utcTime']);
                        $utcDateTime = new DateTime($value['utcStartDate']." ".$fromtime[0], new DateTimeZone('UTC'));
                        $localTimeZone = new DateTimeZone($timeZone);
                        $utcDateTime->setTimezone($localTimeZone); ?>
                        {
                            title:'Available',
                            start: '<?= $utcDateTime->format('Y-m-d'); ?>',
                            backgroundColor: 'green'
                        },
                    <?php }
                }
            }
        } ?>
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
                var trainerID = <?= @$trainerData->id?>;
                $.ajax({
                    type:"post",
                    url:"<?php echo base_url()?>admin/Trainer/getUserAvailability",
                    data:{choosendate: choosendate, trainerID: trainerID},
                    dataType: 'html',
                    success:function(response) {
                        $('.getdatespecificdata').html(response);
                        $('.availtimedata').show();
                        $('.availslotdata').hide();
                    },
                    error: function() {
                        $('#getdatespecificdata').empty();
                        $('#getdatespecificdata').html('An error occurred while submitting your note');
                    }
                });
            } else {
                var choosendate = clickedDateStr;
                var trainerID = <?= @$trainerData->id?>;
                $.ajax({
                    type:"post",
                    url:"<?php echo base_url()?>admin/Trainer/getUserAvailability",
                    data:{choosendate: choosendate, trainerID: trainerID},
                    dataType: 'html',
                    success:function(response) {
                        $('.getdatespecificdata').html(response);
                        $('.availtimedata').show();
                        $('.availslotdata').hide();
                    },
                    error: function() {
                        $('#getdatespecificdata').empty();
                        $('#getdatespecificdata').html('An error occurred while submitting your note');
                    }
                });
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
        $('.choosendate').text(new Date(info.startStr).toDateString());
        var choosendate = info.startStr;
        var trainerID = <?= @$trainerData->id?>;
        $.ajax({
            type:"post",
            url:"<?php echo base_url()?>admin/Trainer/getUserAvailability",
            data:{choosendate: choosendate, trainerID: trainerID},
            success:function(returndata) {
                //console.log(returndata);
                $('.getdatespecificdata').html(returndata);
                $('.availtimedata').show();
                $('.availslotdata').hide();
            }
        });
    });
    calendar.render();
});
</script>