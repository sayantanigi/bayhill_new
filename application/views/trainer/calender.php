<?php
$userData = $this->db->query("SELECT * FROM users WHERE id = '".$_SESSION['bayhill']['user_id']."'")->row();
?>
<style>
#bookingData{width: 100%; display: flex; flex-direction: row; flex-wrap: wrap; justify-content: space-around; margin-bottom: 10px}
.table>tbody {vertical-align: middle !important;}
.form-control {padding: .2rem .2rem !important; font-size: 14px !important;}
.purchased-table tr td{padding: 5px !important;}
.fc-scroller{height: auto !important;}
.availtimedata{display: none; margin-top: 0px; text-align: center; margin-bottom: 20px;}
</style>
<section class="courseListpnl">
    <div class="container">
        <div class="text-success-msg f-20">
            <?php if ($this->session->flashdata('message')) {
                echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: green; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('message').'</p>';
                unset($_SESSION['message']);
            } ?>
            <?php if ($this->session->flashdata('error')) {
                echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: red; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('error').'</p>';
                unset($_SESSION['error']);
            } ?>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 wow fadeInUp">
                <h2 class="subtitle mb-0 wow fadeInUp">Welcome, <?= $userData->first_name." ".$userData->last_name?></h2>
                <h3 class="maintitle mb-0 wow fadeInUp">Update Availability</h3>
            </div>
            <div class="col-lg-12 fadeInUp d-flex justify-content-end">
                <div class="col-lg-6 mt-3 fadeInUp" style="padding: 0px 10px 0 0;">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <div class="Calender_Pick" id="calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-3 purchased-table">
                    <div class="card shadow rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    <div class="col-md-12">
                                        <p style="color:red; margin: 0;" class="" id="validateerrschedule"></p>
                                        <p style="color:red; margin: 0;" class="" id="validateerrschedulefromtime"></p>
                                        <p style="color:red; margin: 0;" class="" id="validateerrscheduletotime"></p>
                                        <p style="color:red; margin: 0;" class="" id="errstartingdate"></p>
                                        <form id="myForm">
                                            <div class="form-group">
                                                <?php
                                                date("Y-m-d", strtotime("+1 week"));
                                                $startDate = date('Y-m');
                                                $calenderday = $this->db->query("SELECT calender FROM settings WHERE settingId = '1'")->row();
                                                $data = explode(',', $calenderday->calender);
                                                $getstart_date = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".@$userData->id."' ORDER BY `start_date` ASC")->result_array();
                                                ?>
                                                <input type="hidden" id="timeZone" name="timeZone" value="America/Los_Angeles"></select>
                                                <?php for($i = 0; $i < count($data); $i++) {
                                                $value = explode('.', $data[$i]);
                                                $getavailability = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".@$userData->id."' AND weekday = '".$value[1]."' AND is_datewise = '0' GROUP BY weekday")->result_array();
                                                if(!empty($getavailability)) {
                                                foreach ($getavailability as $key => $avail) { ?>
                                                <div for="<?= $value[1]?>" class="col-12" style="width: 100%; display:inline-block;">
                                                    <div class="icheck-primary col-3" style="display: inline-block; float: left">
                                                        <input type="checkbox" id="checkboxPrimary<?= $value[0]?>" class="chooseday" name="weekDay<?= $value[0]?>" value='<?= $value[1]?>' checked>
                                                        <label for="checkboxPrimary<?= $value[0]?>"> <?= $value[1]?></label>
                                                    </div>
                                                    <div class="form-group date col-9" id="calenderDays<?= $value[0]?>" <?php if ($avail['weekday'] == $value[1]) { echo 'style="display: flex; border: 1px solid #20519e;flex-direction: row-reverse; flex-wrap: nowrap; align-items: center; margin-bottom: 15px;"'; } else { echo 'style="display: none; background: #fcddde; border: 1px solid; margin-bottom: 15px;"'; }?>>
                                                        <button type="button" class="btn btn-info addMoreBtn1" id="add_row_<?= $value[0]?>" style=" padding: 5px; margin-right: 8px; width: 28px; height: 28px; display: flex; border-radius: 15px; ">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <table class="table jobsites" id="purchaseTableclone<?= $value[0]?>" style="margin: 0;">
                                                            <tbody id="clonetable_feedback<?= $value[0]?>">
                                                            <?php
                                                            $getTimeslot = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".@$userData->id."' AND weekday = '".$value[1]."' AND is_datewise = '0' GROUP BY weekdayslot")->result_array();
                                                            foreach ($getTimeslot as $key => $timeslot) { ?>
                                                                <?php
                                                                $avail_time = $timeslot['weekdayslot'];
                                                                $fromTime = explode(' to ', $avail_time); ?>
                                                                <tr style="box-shadow: none;">
                                                                    <td><input type="time" class="form-control getfromtime" name="fromtime<?= $value[0]?>[]" id="fromtime" required value="<?= $fromTime[0]?>"></td>
                                                                    <td><input type="time" class="form-control gettotime" name="totime<?= $value[0]?>[]" id="totime" required value="<?= $fromTime[1]?>"></td>
                                                                    <td style="text-align: center;"><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return remove(<?= $value[0]?>)">X</a></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php } } else { ?>
                                                <div for="<?= $value[1]?>" class="col-12" style="width: 100%; display:inline-block;">
                                                    <div class="icheck-primary col-3" style="display: inline-block; float: left">
                                                        <input type="checkbox" id="checkboxPrimary<?= $value[0]?>" class="chooseday" name="weekDay<?= $value[0]?>" value='<?= $value[1]?>'>
                                                        <label for="checkboxPrimary<?= $value[0]?>"> <?= $value[1]?></label>
                                                    </div>
                                                    <div class="form-group date col-9" id="calenderDays<?= $value[0]?>" style="display: none; border: 1px solid #20519e; flex-wrap: nowrap; flex-direction: row-reverse; align-items: center; justify-content: center; margin-bottom: 15px;">
                                                        <button type="button" class="btn btn-info addMoreBtn1" id="add_row_<?= $value[0]?>" style=" padding: 5px; margin-right: 8px; width: 28px; height: 28px; display: flex; border-radius: 15px; ">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <table class="table jobsites" id="purchaseTableclone<?= $value[0]?>" style="margin: 0px;">
                                                            <tbody id="clonetable_feedback<?= $value[0]?>">
                                                                <tr>
                                                                    <td><input type="time" class="form-control getfromtime" name="fromtime<?= $value[0]?>[]" id="fromtime" required></td>
                                                                    <td><input type="time" class="form-control gettotime" name="totime<?= $value[0]?>[]" id="totime" required></td>
                                                                    <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return remove(<?= $value[0]?>)">X</a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <?php } } ?>
                                            </div>
                                            <div class="form-group" style="display: flex;">
                                                <div class="col-12" style=" display: flex; align-items: center; justify-content: space-evenly; ">
                                                    <div class="col-6" style=" display: flex; flex-wrap: nowrap; flex-direction: row; align-items: baseline;">
                                                        <h5 class="control-label" style="font-size: 15px; width: 80px; display: inline-block; float: left;">Start Date</h5>
                                                        <?php
                                                        if(!empty(@$getstart_date[0]['start_date'])) {
                                                            $date = date('Y-m-d', strtotime(@$getstart_date[0]['start_date']));
                                                            $val = '1';
                                                        } else {
                                                            $date = "";
                                                            $val = '0';
                                                        } ?>
                                                        <input type="text" id="starting_date" class="form-control" name="starting_date" style="background: #fff;padding: 15px;border-radius: 15px;width: 130px;padding: 0;text-align: center;" value="<?= $date?>"/>
                                                    </div>
                                                    <div class="icheck-primary col-6" style="text-align: end;">
                                                        <input type="checkbox" id="repeat_month" name="repeat_month" <?php if(@$getstart_date[0]['repeat_month'] == '1') {echo "checked value='1'"; } else {echo "value='0'"; }?>>
                                                        <label for="repeat_month">Repeat Every Month </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="modal-footer border-top-0 d-flex justify-content-center">
                                                    <input type="button" class="btn btn-success" id="submit-button" value="Save">
                                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['bayhill']['user_id']; ?>">
                                                    <input type="hidden" name="action_id" id="action_id" value="<?php echo @$val; ?>">
                                                </div>
                                                <div class="">
                                                    <p style="margin: 0px;text-align: center;margin-top: 10px;" id="err_msg"></p>
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
            <div class="col-lg-12 mt-3 col-md-12 fadeInUp">
                <div class="quick-form-job availtimedata" style="">
                    <div>Selected Date: <p class="choosendate"></p></div>
                    <div class="getdatespecificdata"></div>
                    <div style="display: inline-block;">
                        <button id="confirmSlotsButton" style="display: none;">Confirm Slots</button>
                    </div>
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
</section>
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
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const myEvents = [
        <?php
        $getTrainerData = $this->db->query("SELECT * FROM trainer_availability WHERE user_id = '".$userData->id."'")->result();
        $availableByDate = [];
        if(!empty($getTrainerData)) {
            foreach ($getTrainerData as $value) {
                $available_date = date('Y-m-d', strtotime($value->start_date));
                $slot = explode(' to ', $value->weekdayslot);
                $weekdayslot = date('h:i A', strtotime($slot[0])).' to '.date('h:i A', strtotime($slot[1]));
                $available_detail = [
                    'id' => $value->id,
                    'title' => $weekdayslot,
                    'start_date' => $value->start_date,
                    'time' => $weekdayslot,
                ];

                if (!isset($availableByDate[$available_date])) {
                    $availableByDate[$available_date] = [];
                }
                $availableByDate[$available_date][] = $available_detail;
            }
        }
        foreach ($availableByDate as $available_date => $bookings) {
            $count = count($bookings);
            for ($i = 0; $i < min(3, $count); $i++) {
                $b = $bookings[$i];
                ?>
                {
                    id: '<?= $b['id'] ?>',
                    title: '<?= addslashes($b['title']) ?>',
                    date: '<?= addslashes($b['start_date']) ?>',
                    time: '<?= addslashes($b['time']) ?>',
                    backgroundColor: 'green',
                    extendedProps: {
                        id: '<?= $b['id'] ?>',
                        date: '<?= addslashes($b['start_date']) ?>',
                        time: '<?= addslashes($b['time']) ?>',
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
                    $restDetails[] = $b['start_date'].' '.$b['time'];
                }
                $restDetailsStr = htmlspecialchars(implode('\n', $restDetails));
                ?>
                {
                    title: '+<?= $restCount ?> more',
                    date: '<?= addslashes($b['start_date']) ?>',
                    time: '<?= addslashes($b['time']) ?>',
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
            var choosendate = clickedDateStr;
            var user_id = "<?php echo $_SESSION['bayhill']['user_id']; ?>";
            $.ajax({
                type:"post",
                url:"<?php echo base_url()?>trainer/Dashboard/getBookingDetails",
                data:{user_id: user_id, choosendate: choosendate},
                dataType: 'html',
                success:function(response) {
                    $('.getdatespecificdata').html('');
                    response = JSON.parse(response);
                    if (response.status === 'error') {
                        $('.getdatespecificdata').html('<p>' + response.message + '</p>');
                    } else {
                        var html = '<table border="1" cellpadding="5" cellspacing="0"><thead><tr>' +
                                '<th>Booking ID</th><th>Date</th><th>Time</th>' +
                                '<th>Course</th><th>Student</th><th>Phone</th><th>Email</th>' +
                                '</tr></thead><tbody>';
                        response.forEach(function(item) {
                            html += '<tr>' +
                                    '<td>' + item.booking_id + '</td>' +
                                    '<td>' + item.booking_date + '</td>' +
                                    '<td>' + item.booking_time + '</td>' +
                                    '<td>' + item.course_name + '</td>' +
                                    '<td>' + item.student_name + '</td>' +
                                    '<td>' + item.student_phone + '</td>' +
                                    '<td>' + item.student_email + '</td>' +
                                    '</tr>';
                        });
                        html += '</tbody></table>';
                        $('.getdatespecificdata').html(html);
                    }

                    $('.availtimedata').show();
                    $('.availslotdata').hide();
                },
                error: function() {
                    $('.getdatespecificdata').html('An error occurred while fetching your data');
                }
            });
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
        var user_id = "<?php echo $_SESSION['bayhill']['user_id']; ?>";
        $.ajax({
            type:"post",
            url:"<?php echo base_url()?>trainer/Dashboard/getBookingDetails",
            data:{user_id: user_id, choosendate: choosendate},
            dataType: 'html',
            success:function(response) {
                $('.getdatespecificdata').html('');
                response = JSON.parse(response);
                if (response.status === 'error') {
                    $('.getdatespecificdata').html('<p>' + response.message + '</p>');
                } else {
                    var html = '<table border="1" cellpadding="5" cellspacing="0"><thead><tr>'+'<th>Booking ID</th><th>Date</th><th>Time</th>'+'<th>Course</th><th>Student</th><th>Phone</th><th>Email</th>'+'</tr></thead><tbody>';
                    response.message.forEach(function(item) {
                        html += '<tr>' +
                                '<td>' + item.booking_id + '</td>' +
                                '<td>' + item.booking_date + '</td>' +
                                '<td>' + item.booking_time + '</td>' +
                                '<td>' + item.course_name + '</td>' +
                                '<td>' + item.student_name + '</td>' +
                                '<td>' + item.student_phone + '</td>' +
                                '<td>' + item.student_email + '</td>' +
                                '</tr>';
                    });
                    html += '</tbody></table>';
                    $('.getdatespecificdata').html(html);
                }

                $('.availtimedata').show();
                $('.availslotdata').hide();
            },
            error: function() {
                $('.getdatespecificdata').html('An error occurred while fetching your data');
            }
        });
    });
    calendar.render();
});

$(document).ready(function() {
    $(function() {
        $("#starting_date").datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            immediateUpdates: true,
            todayHighlight: true,
            startDate:'+0d'
        }).datepicker("setDate", "0");
        $("#specific_date").datepicker({
            multidate: true,
            format: "yyyy-mm-dd",
            immediateUpdates: true,
            todayHighlight: true,
            startDate:'+0d'
        }).datepicker("setDate", "0");
    });
});

$("#repeat_month").click(function(){
    if($("#repeat_month").is(':checked')) {
        $("#repeat_month").val("1");
    } else {
        $("#repeat_month").val("0");
    }
})

$('#submit-button').on('click', function() {
    var action_id = $('#action_id').val();
    var schedule = $(".chooseday:checked").val();
    var from_time = $('.getfromtime').val().length;
    var to_time = $('.gettotime').val().length;
    var starting_date = $('#starting_date').val().length;
    var timeZone = $("#timeZone").val();
    if (schedule === undefined || schedule.trim() === '') {
        $('#validateerrschedule').text('Please enter schedule');
        setInterval(function () {
            $('#validateerrschedule').empty();
        }, 5000);
    } else if(timeZone === ''){
        $('#validateerrschedule').text('Please enter your timezone');
        setInterval(function () {
            $('#validateerrschedule').empty();
        }, 5000);
    } else if(starting_date === 0){
        $('#validateerrschedule').text('Please enter start date');
        setInterval(function () {
            $('#validateerrschedule').empty();
        }, 5000);
    } else {
        var date1 = new Date('1970-01-01T'+$('.getfromtime').val()+':00');
        var date2 = new Date('1970-01-01T'+$('.gettotime').val()+':00');
        var differenceiInms = date2 - date1;
        var form_data = $('#myForm').serialize();
        $.ajax({
            type:"post",
            url:"<?php echo base_url()?>trainer/Dashboard/create_availability",
            data: form_data,
            success:function(returndata) {
                if(returndata == 1) {
                    $('#err_msg').text('Data updated successfuly').css('color', '#198754');
                    setInterval(function () {
                        $('#err_msg').empty();
                    }, 8000);
                } else {
                    $('#err_msg').text('Something went wrong. Please try again later.').css('color', '#e20612');
                    setInterval(function () {
                        $('#err_msg').empty();
                    }, 8000);
                    return false;
                }
            }
        });
        return false;
    }
})

function updateschedule(slotid) {
    var slotid = slotid;
    alert(slotid);
}

function closeAvail() {
    location.reload();
}

<?php
for($i = 0; $i < count($data); $i++) {
    $value = explode('.', $data[$i]); ?>
    $("#checkboxPrimary<?= $value[0]?>").click(function(){
        if($("#checkboxPrimary<?= $value[0]?>").is(':checked')) {
            $("#calenderDays<?= $value[0]?>").css("display", "flex");
        } else {
            $("#calenderDays<?= $value[0]?>").css("display", "none");
        }
    })
    $("#add_row_<?= $value[0]?>").click(function() {
        var y = document.getElementById('clonetable_feedback<?= $value[0]?>');
        var new_row = y.rows[0].cloneNode(true);
        var len = y.rows.length;
        new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;
        var inp0 = new_row.cells[0].getElementsByTagName('input')[0];
        inp0.value = '';
        inp0.id = 'service'+(len+1);
        var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
        inp1.value = '';
        inp1.id = 'service'+(len+1);
        var submit_btn =$('#submit').val();
        y.appendChild(new_row);
    })
<?php } ?>

function remove(row) {
    var y=document.getElementById('purchaseTableclone'+row);
    var len = y.rows.length;
    console.log(len);
    if(len>1) {
        var i= (len-1);
        document.getElementById('purchaseTableclone'+row).deleteRow(i);
    }
}

$("#add_rowdate1").click(function() {
    var y = document.getElementById('clonetable_feedbackdate1');
    var new_row = y.rows[0].cloneNode(true);
    var len = y.rows.length;
    new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;
    var inp0 = new_row.cells[0].getElementsByTagName('input')[0];
    inp0.value = '';
    inp0.id = 'service'+(len+1);
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.value = '';
    inp1.id = 'service'+(len+1);
    var submit_btn =$('#submit').val();
    y.appendChild(new_row);
})

function removesdate1(row) {
    var y=document.getElementById('purchaseTableclonedate1');
    var len = y.rows.length;
    console.log(len);
    if(len>1) {
        var i= (len-1);
        document.getElementById('purchaseTableclonedate1').deleteRow(i);
    }
}
</script>