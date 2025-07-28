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
                <h2 class="subtitle mb-0 wow fadeInUp">Welcome, <?= $_SESSION['bayhill']['first_name']." ".$_SESSION['bayhill']['last_name']?></h2>
                <h3 class="maintitle mb-0 wow fadeInUp">Your Purchased Course List</h3>
                <p class="mb-0" style="color: #EC2526; font-style: italic; font-size: 13px;">*CANCELLATIONS FEES OF $60 APPLY IF CANCELLATION ISN’T MADE 48 HOURS PRIOR TO YOUR SCHEDULED CLASS</p>
                <p class="mb-1 mt-4 fw-bold" style="#000; ">Purchased Course Count: <?= @$getPurchasedCourseListCount->count; ?></p>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp animated">
                <div class="package-card" style="height: 38%; margin-top: 30px;">
                    <div class="package-card__body" style="padding: 8px 15px 8px 15px;">
                        <div class="package-card__body__btn text-center" style="margin-top: 0px; !important;" style="margin-top: 10px; !important;">
                            <form action="<?= base_url()?>getcourselistbyzipcode" method="POST">
                                <input class="btn btn-secondary mb-0 text-white fe-semibold rounded-0 flex-fill findZipcode w-100" type="submit" value="Add Another Package"style="border-radius: 30px !important; background-color: #014599;">
                                <input type="hidden" name="pincode" value="<?= $pincode; ?>">
                                <input type="hidden" name="course_type" value="<?= $category; ?>">
                            </form>
                            <!-- <a href="<?= base_url("payservice")?>" class="drivschol-btn w-100">Pay Now</a> -->
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
                        <th>Status</th>
                        <th>Trainer</th>
                        <th>Payment</th>
                        <th width="120"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($getPurchasedCourseList)) {
                    foreach ($getPurchasedCourseList as $purchsedList) {
                    $course = $this->db->query("SELECT * FROM courses WHERE id = '".$purchsedList->course_id."'")->row();
                    ?>
                    <tr>
                        <td class="fw-bold align-middle">
                            <p style="margin: 0px;"><?= $course->course_name; ?> <br/><?= $course->course_name1; ?></p>
                            <a href="<?= base_url('course/course_details?course_code='.base64_encode($course->course_code))?>" class="text-warning fw-bold">Read More <i class="fas fa-arrow-right"></i></a>
                            <p>Booked Classes: <?php $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$purchsedList->course_id."'")->row();
                            if(!empty($getBookingData->transaction_id)){
                                $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
                                echo count($getBookingSlots)."/".$course->course_class;
                            } ?>
                            </p>
                        </td>
                        <td class="align-middle">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <?php
                            $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$course->id."'")->row();
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
                            <?php if(!empty($purchsedList->trainer_id)) {
                            $getTrainer = $this->db->query("SELECT * FROM users WHERE id = '".$purchsedList->trainer_id."'")->row();
                            echo $getTrainer->salutation." ".$getTrainer->first_name." ".$getTrainer->last_name;
                            } else {
                                echo "Trainer Not Assigned";
                            } ?>
                        </td>
                        <td class="align-middle">
                            <?php if($purchsedList->status != '1') { ?>
                            <a href="<?= base_url() ?>payment-details?ctitle=<?= base64_encode($course->course_name)?>&uid=<?= base64_encode($purchsedList->user_id)?>&bookingID=<?= base64_encode($purchsedList->id)?>" class="drivschol-btn w-100">Complete this payment</a>
                            <?php } else { ?>
                            <span class="d-inline-block px-3 py-1 rounded text-white text-xs bg-success">Payment Completed</span>
                            <?php } ?>
                        </td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php if(!empty($getBookingData->transaction_id)) { ?>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="bookedSlotData(<?= @$getBookingData->id ?>, <?= @$course->id ?>)">Booked Slot</a>
                                        <?php } else { ?>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="completePayment(<?= @$getBookingData->id ?>)">Book Slot for pending classes</a></li>
                                        <?php } ?>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="changePickupAddress(<?= @$getBookingData->id; ?>)">Change Pickup Location</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="cancelClass(<?= @$getBookingData->id ?>, <?= @$course->id ?>)">Cancel Class</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)">Reschedule</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);" onclick="courseNote(<?= @$getBookingData->id; ?>)">Notes</a></li>
                                    <?php
                                    $assessment_data = $this->db->query("SELECT * FROM assessments WHERE student = '".@$userData->id."' AND session_type = '".@$course->id."'")->row();
                                    if(!empty($assessment_data)) { ?>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>assessment_report?courseID=<?= base64_encode(@$course->id)?>&studentID=<?= base64_encode(@$userData->id)?>" target="_blank">Assessment Report</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php } } else { ?>
                    <div class="col-lg-12 col-md-12 wow fadeInUp">No course purchased yet.</div>
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
    <div class="modal fade" id="pickupAddressModal" tabindex="-1" role="dialog" aria-labelledby="pickupAddressModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog" role="document">
            <form id="pickupAddressForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pickupAddressModalLabel">Change Pickup Address</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="background: #08224b; color: #fff; border-radius: 10px; border: none;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="modalBookingId" name="booking_id">
                        <div class="form-group">
                            <textarea class="form-control" id="pickup_address" name="pickup_address" placeholder="Pickup Address" required rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: none; padding-top: 0;">
                        <p id="updatemsg" class="text-center"></p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Booking Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" id="bookedSlotDataContent">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="staticBackdropcancelclass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fw-bold fs-5" id="staticBackdropLabel">Booking Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3" id="bookedSlotDatacancelclassContent"></div>
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
    $('#pickupAddressForm').on('submit', function(e) {
        e.preventDefault();
        var bookingId = $('#modalBookingId').val();
        var pickupAddress = $('#pickup_address').val();
        $.ajax({
        url: '<?= base_url("users/Dashboard/changePickupAddress") ?>',
        type: 'POST',
        data: {
            booking_id: bookingId,
            pickup_address: pickupAddress
        },
        success: function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
                $('#updatemsg').text(response.message).css('color', 'green');
                setTimeout(function() {
                    $('#pickupAddressModal').modal('hide');
                }, 3000);
                setTimeout(function() {
                    location.reload();
                }, 4000);
            } else {
                $('#updatemsg').text(response.message).css('color', 'red');
            }
        },
        error: function() {
            alert('An error occurred while changing the pickup address.');
        }
        });
    });
    window.changePickupAddress = changePickupAddress;

    $('#courseNotesubmit').on('submit', function(e) {
        e.preventDefault();
        var bookingId = $('#modalBookingId').val();
        var course_note = $('#course_note').val();
        $.ajax({
            url: '<?= base_url("users/Dashboard/course_note") ?>',
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

function changePickupAddress(bookingId) {
    $('#modalBookingId').val(bookingId);
    $('#pickupAddressModal').modal('show');
}

function courseNote(bookingId) {
    $('#modalBookingId').val(bookingId);
    $('#staticBackdrop').modal('show');
}

function cancelClass (bookingId, courseId) {
    //$('#modalCancelClassId').val(bookingId);
    $('#staticBackdropcancelclass').modal('show');
    $.ajax({
        url: '<?= base_url("users/Dashboard/BookigDataForCancelClass") ?>',
        type: 'POST',
        data: {
            booking_id: bookingId,
            courseId: courseId
        },
        dataType: 'html',
        success: function(response) {
            $('#bookedSlotDatacancelclassContent').empty();
            $('#bookedSlotDatacancelclassContent').html(response);
        },
        error: function() {
            alert('An error occurred while submitting you note');
        }
    });
}

function bookedSlotData(bookingId, courseId) {
    $('#staticBackdrop1').modal('show');
    $.ajax({
        url: '<?= base_url("users/Dashboard/BookigData") ?>',
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
        url: '<?= base_url("users/Dashboard/updateBookingStatus") ?>',
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