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
                <p class="mb-1" style="#000; font-style: italic;">Purchased Course Count: <?= @$getPurchasedCourseListCount->count; ?></p>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp animated">
                <div class="package-card" style="height: 45%; margin-top: 30px;">
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
        <div class="row g-4">
            <?php
            if (!empty($getPurchasedCourseList)) {
            foreach ($getPurchasedCourseList as $purchsedList) {
            $course = $this->db->query("SELECT * FROM courses WHERE id = '".$purchsedList->course_id."'")->row();
            ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="package-card">
                    <div class="package-card__head">
                        <div class="package-card__head__item">
                            <span class="discountBox">Save $<?= (int)$course->course_price - (int)$course->offer_price; ?></span>
                            <span class="package-card__head__item__price"> <sub>$</sub>
                            <?= $course->offer_price; ?></span>
                            <div class="package-card__head__item__shape__one">
                                <svg width="90" height="95" viewBox="0 0 90 95" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M90 -0.000350952L0 69.6066L90 94.9996V-0.000350952Z" fill="" fill-opacity="0.06" />
                                </svg>
                            </div>
                            <div class="package-card__head__item__shape__two">
                                <svg width="60" height="64" viewBox="0 0 60 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.789585 63.2843L59.4571 16.7158L0.00060816 0.747339L0.789585 63.2843Z" fill="" fill-opacity="0.06" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="package-card__body">
                        <h3 class="package-card__body__title"><?= $course->course_name; ?></h3>
                        <div class="pt-3">
                            <ul class="listBoxcourse">
                                <?php
                                $decodedContent = htmlspecialchars_decode($course->course_short_description);
                                echo $cleanedContent = str_replace(['<ul>', '</ul>'], '', $decodedContent);
                                ?>
                            </ul>
                            <div class="text-center mt-3"><a href="<?= base_url('course/course_details?cttle='.base64_encode($course->course_name))?>" class="text-warning fw-bold">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                        <?php if($purchsedList->status != '1') { ?>
                        <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                            <a href="<?= base_url() ?>payment-details?ctitle=<?= base64_encode($course->course_name)?>&uid=<?= base64_encode($purchsedList->user_id)?>&bookingID=<?= base64_encode($purchsedList->id)?>" class="drivschol-btn w-100">Complete this payment</a>
                        </div>
                        <?php } else { ?>
                        <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                            <a href="javascript:void(0)" class="drivschol-btn w-100">Payment Complete</a>
                        </div>
                        <?php } ?>
                        <?php if(!empty($purchsedList->trainer_id)) {
                        $getTrainer = $this->db->query("SELECT * FROM users WHERE id = '".$purchsedList->trainer_id."'")->row();
                        ?>
                        <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                            <a href="javascript:void(0)" class="drivschol-btn w-100">Assigned To <?= $getTrainer->salutation." ".$getTrainer->first_name." ".$getTrainer->last_name; ?></a>
                        </div>
                        <?php } else { ?>
                        <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                            <a href="javascript:void(0)" class="drivschol-btn w-100">Trainer Not assigned</a>
                        </div>
                        <?php } ?>
                        <?php
                        $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$course->id."'")->row();
                        if(!empty($getBookingData->transaction_id)){
                            $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
                            if($course->course_class > count($getBookingSlots)) { ?>
                            <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                                <a href="<?= base_url() ?>booking_slot?course_code=<?= base64_encode($course->course_code)?>&uid=<?= base64_encode($_SESSION['bayhill']['user_id'])?>&bookingid=<?= base64_encode($getBookingData->id)?>" class="drivschol-btn w-100">Book slot for pending classes</a>
                                <div class="col-lg-12 col-md-12 wow fadeInUp" style="text-align: left; margin-top: 15px;border: 1px solid #f59b24;border-radius: 18px;">
                                    <div style="margin-left: 10px;">
                                    <?php
                                    if(!empty($getBookingSlots)) {
                                        $i = 1;
                                        foreach ($getBookingSlots as $slot) { ?>
                                        <p style="margin: 0px;font-size: 14px;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time; ?></p>
                                    <?php $i++; } } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="col-lg-12 col-md-12 wow fadeInUp" style="text-align: left; margin-top: 15px;border: 1px solid #f59b24;border-radius: 18px;">
                                <div style="margin-left: 10px;">
                                <?php
                                if(!empty($getBookingSlots)) {
                                    $i = 1;
                                    foreach ($getBookingSlots as $slot) { ?>
                                    <p style="margin: 0px;font-size: 14px;">Slot-<?= $i.": ".date('d-m-Y', strtotime($slot->booking_date))." ".$slot->booking_time; ?></p>
                                <?php $i++; } } ?>
                                </div>
                            </div>
                            <?php }
                        } else { ?>
                        <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                            <a href="javascript:void(0)" onclick="completePayment(<?= @$getBookingData->id ?>)" class="drivschol-btn w-100">Book slot for pending classes</a>
                        </div>
                        <div class="completePayment_<?= @$getBookingData->id ?>" style="display: none;text-align: left; margin-top: 20px; color: #ed1c24; font-size: 15px;">Please complete your payment first for this course to book pending slots.</div>
                        <?php } ?>
                        <div class="package-card__body__btn text-center" style="margin-top: 10px;">
                            <a href="javascript:void(0)" class="drivschol-btn w-100" onclick="changePickupAddress(<?= @$getBookingData->id; ?>)">Change Pickup Location</a>
                        </div>
                        <?php if(!empty($getBookingData->pickup_address)) { ?>
                        <div class="package-card__body__btn text-center" style="margin-top: 10px; !important;">
                            <a href="javascript:void(0)" class="drivschol-btn w-100"><?= $getBookingData->pickup_address; ?></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } } else { ?>
            <div class="col-lg-12 col-md-12 wow fadeInUp">No course purchased yet.</div>
            <?php } ?>
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
                            <label for="pickup_address">Pickup Address</label>
                            <textarea class="form-control" id="pickup_address" name="pickup_address" required rows="6"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: none; padding-top: 0;">
                        <p id="updatemsg" class="text-center">kmlmllkmlkmlk </p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
    function changePickupAddress(bookingId) {
        $('#modalBookingId').val(bookingId);
        $('#pickupAddressModal').modal('show');
    }

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

    // Expose the function globally if needed
    window.changePickupAddress = changePickupAddress;
});
</script>
</script>