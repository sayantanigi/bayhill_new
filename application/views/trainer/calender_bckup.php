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
                                            <input type="hidden" name="timeZone" id="timeZone" value="<?= $timeZone ?>">
                                            <?php foreach ($calendarDays as $day):
                                                list($dayId, $dayName) = explode('.', $day);
                                                $slots = $availability[$dayName] ?? [];
                                                $checked = !empty($slots) ? 'checked' : '';
                                            ?>
                                            <div class="day-block" style="display: flex;">
                                                <div class="icheck-primary col-3" style="display: inline-block; float: left">
                                                    <input type="checkbox" id="checkboxPrimary<?= $dayId ?>" class="chooseday" name="weekDay<?= $dayId ?>" value="<?= $dayName ?>" <?= $checked ?>>
                                                    <label for="checkboxPrimary<?= $dayId ?>"><?= $dayName ?></label>
                                                </div>

                                                <div class="form-group date col-9 time-slots" id="calenderDays<?= $dayId ?>" style="<?= empty($slots) ? 'display:none' : '' ?>">
                                                    <button type="button" class="btn btn-info addMoreBtn" data-day="<?= $dayId ?>">+</button>
                                                    <table class="table jobsites">
                                                        <tbody id="clonetable_feedback<?= $dayId ?>">
                                                            <?php if ($slots): foreach ($slots as $slot):
                                                                list($from, $to) = explode(' to ', $slot['weekdayslot']); ?>
                                                            <tr>
                                                                <td><input type="time" name="fromtime<?= $dayId ?>[]" value="<?= $from ?>" required></td>
                                                                <td><input type="time" name="totime<?= $dayId ?>[]" value="<?= $to ?>" required></td>
                                                                <td><a href="javascript:void(0)" class="removeRow" data-day="<?= $dayId ?>">X</a></td>
                                                            </tr>
                                                            <?php endforeach; else: ?>
                                                            <tr>
                                                                <td><input type="time" name="fromtime<?= $dayId ?>[]" required></td>
                                                                <td><input type="time" name="totime<?= $dayId ?>[]" required></td>
                                                                <td><a href="javascript:void(0)" class="removeRow" data-day="<?= $dayId ?>">X</a></td>
                                                            </tr>
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>

                                            <div>
                                                <label>Start Date</label>
                                                <input type="date" name="starting_date" id="starting_date" value="<?= date('Y-m-d', strtotime($startDate)) ?>">
                                                <input type="checkbox" name="repeat_month" id="repeat_month" value="1" <?= $repeatMonth ? 'checked' : '' ?>> Repeat Every Month
                                            </div>

                                            <input type="hidden" name="user_id" value="<?= $_SESSION['bayhill']['user_id'] ?>">
                                            <input type="hidden" name="action_id" value="<?= $actionId ?>">

                                            <button type="button" id="submit-button" class="btn btn-success">Save</button>
                                            <p id="err_msg"></p>
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

/*$('#submit-button').on('click', function() {
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
})*/

function updateschedule(slotid) {
    var slotid = slotid;
    alert(slotid);
}

function closeAvail() {
    location.reload();
}

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

$(document).ready(function(){
    // Toggle visibility
    $('.chooseday').on('change', function(){
        let dayId = this.id.replace('checkboxPrimary','');
        $('#calenderDays' + dayId).toggle(this.checked);
    });

    // Add time slot
    $('.addMoreBtn').on('click', function(){
        let dayId = $(this).data('day');
        let row = $('#clonetable_feedback' + dayId + ' tr:first').clone();
        row.find('input').val('');
        $('#clonetable_feedback' + dayId).append(row);
    });

    // Remove time slot
    $(document).on('click', '.removeRow', function(){
        let dayId = $(this).data('day');
        let table = $('#clonetable_feedback' + dayId);
        if (table.find('tr').length > 1) $(this).closest('tr').remove();
    });

    // Submit
    $('#submit-button').on('click', function(){
        let schedule = $(".chooseday:checked").length;
        let timeZone = $("#timeZone").val();
        let startDate = $("#starting_date").val();

        if (schedule === 0) return showError("Please select at least one day");
        if (!timeZone) return showError("Please enter your timezone");
        if (!startDate) return showError("Please enter start date");

        // let validTime = true;
        // $('input[type="time"]').each(function(){
        //     if ($(this).val().trim() === '') validTime = false;
        // });
        // if (!validTime) return showError("Please fill in all time fields");

        $.post("<?= base_url('trainer/Dashboard/create_availability') ?>", $('#myForm').serialize(), function(res){
            let data = JSON.parse(res);
            if (data.status == 1) {
                $('#err_msg').text(data.message).css('color', 'green');
            } else {
                $('#err_msg').text('Error saving schedule').css('color', 'red');
            }
            setTimeout(()=> $('#err_msg').empty(), 5000);
        });
    });

    function showError(msg) {
        $('#err_msg').text(msg).css('color', 'red');
        setTimeout(()=> $('#err_msg').empty(), 5000);
    }
});
</script>