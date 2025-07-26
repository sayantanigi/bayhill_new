<?php
$userData = $this->db->query("SELECT * FROM users WHERE id = '".$_SESSION['bayhill']['user_id']."'")->row();
$pincode = @$userData->zipcode;
$dob = @$userData->dob;
if ($dob) {
    $dobDate = new DateTime($dob);
    $now = new DateTime();
    $age = $now->diff($dobDate)->y;
    if ($age > 18) {
        $category = "1";
    } else {
        $category = "2";
    }
} else {
    echo "Date of Birth not available.";
}
?>
<style>
#bookingData{width: 100%; display: flex; flex-direction: row; flex-wrap: wrap; justify-content: space-around; margin-bottom: 10px}
.package-card__body__btn {margin-top: 0 !important;}
.package-card__body {padding: 8px 16px 8px 16px !important;}
.package-card {height: 60px !important;}
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
            <div class="col-lg-8 col-md-12 wow fadeInUp">
                <h2 class="subtitle mb-0 wow fadeInUp">Welcome, <?= $userData->first_name." ".$userData->last_name?></h2>
                <h3 class="maintitle mb-0 wow fadeInUp">Your Assigned Course List</h3>
                <p class="mb-1 mt-4 fw-bold" style="#000; ">Assigned Course Count: <?= @$getAssignedCourseListCount->count; ?></p>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp animated">
                <div class="package-card">
                    <div class="package-card__body">
                        <div class="package-card__body__btn text-center">
                            <a href="<?= base_url("trainer/assessment")?>" class="drivschol-btn w-100">Pay Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 purchased-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Student Name</th>
                        <th>Booking Details</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th width="120"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($getAssignedCourseList)) {
                    foreach ($getAssignedCourseList as $purchsedList) {
                    $course = $this->db->query("SELECT * FROM courses WHERE id = '".$purchsedList->course_id."'")->row();
                    ?>
                    <tr>
                        <td class="fw-bold align-middle">
                            <p style="margin: 0px;"><?= $course->course_name; ?> <br/><?= $course->course_name1; ?></p>
                            <a href="<?= base_url('course/course_details?course_code='.base64_encode($course->course_code))?>" class="text-warning fw-bold">Read More <i class="fas fa-arrow-right"></i></a>
                            <p>Booked Classes: <?php $getBookingData = $this->db->query("SELECT * FROM booking WHERE trainer_id = '".$userData->id."' AND course_id = '".@$purchsedList->course_id."'")->row();
                            if(!empty($getBookingData->transaction_id)){
                                $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
                                echo count($getBookingSlots)."/".$course->course_class;
                            } ?>
                            </p>
                        </td>
                        <td class="align-middle">
                            <?php
                            $getUserData = $this->db->query("SELECT * FROM users WHERE id = '".$purchsedList->user_id."'")->row();
                            if(!empty($getUserData)) {
                                echo $getUserData->salutation." ".$getUserData->first_name." ".$getUserData->last_name;
                            } else {
                                echo "User Not Found";
                            }
                            ?>
                        </td>
                        <td class="align-middle">
                            <?php
                            $getBookingData = $this->db->query("SELECT * FROM booking WHERE trainer_id = '".$userData->id."' AND course_id = '".@$course->id."'")->row();
                            if(!empty($getBookingData->transaction_id)){
                                $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result(); ?>
                            <div class="col-lg-12 col-md-12" style="text-align: center; margin-top: 15px;border: 1px solid #f59b24;border-radius: 18px; display: block !important; visibility: visible !important;">
                                <div style="margin-left: 10px;">
                                <?php
                                if(!empty($getBookingSlots)) {
                                    $i = 1;
                                    foreach ($getBookingSlots as $slot) {
                                        if($slot->status == "1") { ?>
                                        <p style="margin: 0px; font-size: 14px; color:#f59b24;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Pending)"; ?></p>
                                        <?php } else if($slot->status == "2") { ?>
                                        <p style="margin: 0px; font-size: 14px; color:red;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Canceled)"; ?></p>
                                        <?php } else { ?>
                                        <p style="margin: 0px; font-size: 14px; color:green;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time."(Completed)"; ?></p>
                                        <?php } ?>
                                <?php $i++; } } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <?php if($purchsedList->status != '1') { ?>
                            <a href="<?= base_url() ?>payment-details?ctitle=<?= base64_encode($course->course_name)?>&uid=<?= base64_encode($purchsedList->user_id)?>&bookingID=<?= base64_encode($purchsedList->id)?>" class="drivschol-btn w-100">Complete this payment</a>
                            <?php } else {
                                echo "Paid";
                            } ?>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <?php
                            $getBookingData = $this->db->query("SELECT * FROM booking WHERE trainer_id = '".$userData->id."' AND course_id = '".@$course->id."'")->row();
                            if($getBookingData->status == '0') {
                                echo "Pending";
                            } else if($getBookingData->status == '1') {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            }
                            ?>
                        </td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="completedClass(<?= @$getBookingData->id ?>, <?= @$course->id ?>)">Completed Class</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="courseNote(<?= @$getBookingData->id; ?>)">Notes</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php } } else { ?>
                    <div class="col-lg-12 col-md-12 wow fadeInUp">No course assigned yet.</div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="courseNotesubmit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Note</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" id="modalBookingId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <textarea class="form-control" id="course_note" name="course_note" placeholder="Enter Note" rows="5" required></textarea>
                        </div>
                        <div class="text-end">
                            <p id="updatenotemsg" class="text-center"></p>
                            <button type="submit" class="btn enrollbtn px-4">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="staticBackdropcompletedClass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Booking Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" id="bookedSlotDataContent">
                    </div>
                    <p id="updateccmsg" class="text-center"></p>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<script>
function completePayment(id) {
    $('.completePayment_'+id).show();
    setTimeout(function () {
        $('.completePayment_'+id).fadeOut('slow');
    }, 4000);
}

$(document).ready(function() {
    $('#courseNotesubmit').on('submit', function(e) {
        e.preventDefault();
        var bookingId = $('#modalBookingId').val();
        var course_note = $('#course_note').val();
        $.ajax({
            url: '<?= base_url("trainer/Dashboard/course_note") ?>',
            type: 'POST',
            data: {
                booking_id: bookingId,
                course_note: course_note
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status === 'success') {
                    $('#updatenotemsg').text(response.message).css('color', 'green');
                    setTimeout(function() {
                        $('#staticBackdrop').modal('hide');
                    }, 3000);
                    setTimeout(function() {
                        location.reload();
                    }, 4000);
                } else {
                    $('#updatenotemsg').text(response.message).css('color', 'red');
                }
            },
            error: function() {
                alert('An error occurred while submitting you note');
            }
        });
    });
});

function courseNote(bookingId) {
    $('#modalBookingId').val(bookingId);
    $('#staticBackdrop').modal('show');
}

function completedClass (bookingId, courseId) {
    $('#staticBackdropcompletedClass').modal('show');
    $.ajax({
        url: '<?= base_url("trainer/Dashboard/BookigData") ?>',
        type: 'POST',
        data: {
            booking_id: bookingId,
            courseId: courseId
        },
        dataType: 'html',
        success: function(response) {
            $('#bookedSlotDataContent').empty();
            $('#bookedSlotDataContent').html(response);
        },
        error: function() {
            alert('An error occurred while submitting you note');
        }
    });
}

function updateBookingStatus(bookingId, status) {
    $.ajax({
        url: '<?= base_url("trainer/Dashboard/updateBookingStatus") ?>',
        type: 'POST',
        data: {
            booking_id: bookingId,
            status: status
        },
        success: function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
                $('#updateccmsg').text(response.message).css('color', 'green');
                setTimeout(function() {
                    $('#staticBackdropcompletedClass').modal('hide');
                }, 3000);
                setTimeout(function() {
                    location.reload();
                }, 4000);
            } else {
                $('#updateccmsg').text(response.message).css('color', 'red');
            }
        },
        error: function() {
            $('#updateccmsg').text("An error occurred while updating the booking status.").css('color', 'red');
        }
    });
};

</script>