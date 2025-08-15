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
                        <div class="col-lg-4 mb-0">
                            <div class="card shadow rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="container">
                                            <div class="col-md-12">
                                                <div class="profile clearfix">
                                                    <div class="image item" id="Cover-Image">
                                                        <img src="<?= !empty($studentData->coverImage) ? base_url('uploads/student/cover_image/' . $studentData->coverImage . '') : base_url('uploads/bnr.jpg'); ?>" class="img-cover" id="cblah">
                                                    </div>
                                                    <div class="user clearfix">
                                                        <div class="avatar item" id="item">
                                                            <?php if(!empty($studentData->image) && file_exists('uploads/student/profilePic/'.$studentData->image)) { ?>
                                                            <img src="<?= base_url('uploads/student/profilePic/'.$studentData->image) ?>" class="img-thumbnail img-profile" id="pblah">
                                                            <?php } else { ?>
                                                            <img src="<?= base_url('uploads/unnamed.jpg') ?>" class="img-thumbnail img-profile" id="pblah">
                                                            <?php } ?>
                                                        </div>
                                                        <h2>
                                                            <span id="slttn"><?= $studentData->salutation; ?></span>
                                                            <span id="f-name"><?= $studentData->first_name; ?></span>
                                                            <span id="l-name"><?= $studentData->last_name; ?></span>
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
                                                            <b>Full Name: </b><p class="text-muted" id="sltatn" style="display: contents"><?= @$studentData->salutation." ".@$studentData->first_name." ".@$studentData->last_name; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Username: </b><p class="text-muted" id="first_name" style="display: contents"><?= @$studentData->username; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Email: </b><p class="text-muted" id="individual_email" style="display: contents"><?= @$studentData->email; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Gender: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->gender; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>DOB: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->dob; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Phone: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->phone; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Parents First Name: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->pfirst_name; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Parents Last Name: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->plast_name; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Parents Email: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->pemail; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Parents Phone Number: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->phone_2; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Street Address: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->address; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Zipcode: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->zipcode; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Background With Degrees: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->degree; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Languages: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->languages; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Certificates: </b><p class="text-muted" id="last_name" style="display: contents"><?= @$studentData->certificates; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3" style="margin-top: 5px !important;">
                                                        <div class="tx-11 font-weight-bold mb-0 ">
                                                            <b>Status: </b><p class="text-muted" id="individual_status" style="display: contents"><?php if($studentData->status == '1') { echo "Active"; } else { echo "Inactive"; } ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 mb-0">
                            <div class="card shadow rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mt-3 purchased-table">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>SL No</th>
                                                        <th>Course Name</th>
                                                        <th>Price</th>
                                                        <th>Discount</th>
                                                        <th>To be Paid</th>
                                                        <th>Trainer</th>
                                                        <th>Payment</th>
                                                        <th>Status</th>
                                                        <th>View Slot</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($getPurchasedCourseList)) {
                                                        $i = 1;
                                                    foreach ($getPurchasedCourseList as $purchsedList) {
                                                    $course = $this->db->query("SELECT * FROM courses WHERE id = '".$purchsedList->course_id."'")->row();
                                                    ?>
                                                    <tr>
                                                        <td><?= $i; ?></td>
                                                        <td class="fw-bold align-middle">
                                                            <p style="margin: 0px;"><?= $course->course_name; ?> <br/><?= $course->course_name1; ?></p>
                                                            <!-- <a href="<?= base_url('course/course_details?course_code='.base64_encode($course->course_code))?>" class="text-warning fw-bold">Read More <i class="fas fa-arrow-right"></i></a>
                                                            <p>Booked Classes: <?php $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$studentData->id."' AND course_id = '".@$purchsedList->course_id."'")->row();
                                                            if(!empty($getBookingData->transaction_id)){
                                                                $getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
                                                                echo count($getBookingSlots)."/".$course->course_class;
                                                            } ?>
                                                            </p> -->
                                                        </td>
                                                        <td>
                                                            <p>
                                                                <?php if(!empty($course->course_price)) {
                                                                    echo "$".$course->course_price;
                                                                } else {
                                                                    echo "Free";
                                                                } ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p><?= "$".$course->course_price - $course->offer_price; ?></p>
                                                        </td>
                                                        <td>
                                                            <p>
                                                                <?php if(!empty($course->offer_price)) {
                                                                    echo "$".$course->offer_price;
                                                                } else {
                                                                    echo "$".$course->course_price;
                                                                } ?>
                                                            </p>
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
                                                            <?php if($purchsedList->status != '1') {
                                                                echo '<i class="fas fa-exclamation me-2 text-pending" style="background: #fdc12d; width: 25px; border-radius: 50px; height: 25px; display: flex; flex-direction: row; justify-content: center; align-items: center; color: #fff !important;"></i>';
                                                                echo "Pending";
                                                            } else {
                                                                echo '<i class="fas fa-check-circle me-2 text-success"></i>';
                                                                echo "Active";
                                                            } ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php
                                                            $getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$studentData->id."' AND course_id = '".@$course->id."'")->row();
                                                            if($getBookingData->status == '0') {
                                                                echo '<i class="fas fa-exclamation me-2 text-pending" style="background: #fdc12d; width: 25px; border-radius: 50px; height: 25px; display: flex; flex-direction: row; justify-content: center; align-items: center; color: #fff !important;"></i>';
                                                                echo "Pending";
                                                            } else if($getBookingData->status == '1') {
                                                                echo '<i class="fas fa-check-circle me-2 text-success"></i>';
                                                                echo "Active";
                                                            } else {
                                                                echo '<i class="fa fa-close me-2 text-danger" style="background: red; width: 25px; border-radius: 50px; height: 25px; display: flex; flex-direction: row; justify-content: center; align-items: center; color: #fff !important;">&#xf00d;</i>';
                                                                echo "Inactive";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <a class="dropdown-item" href="javascript:void(0)" onclick="bookedSlotData(<?= @$getBookingData->id ?>, <?= @$course->id ?>, <?= @$studentData->id ?>)" style="background: #f1a728; color: #fff; padding: 8px 15px 8px 15px; border-radius: 10px;">View Slots</a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; } } else { ?>
                                                    <tr>No course purchased yet.</tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
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
</div>
<script>
function bookedSlotData(bookingId, courseId, student_id) {
    $('#staticBackdrop1').modal('show');
    $.ajax({
        url: '<?= base_url("admin/Student/BookigData") ?>',
        type: 'POST',
        data: {
            booking_id: bookingId,
            courseId: courseId,
            student_id: student_id,
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
</script>