<style>
.form-check {display: flex; align-items: center;}
.form-check label {margin-left: 10px; font-size: 18px; font-weight: 500;}
.form-switch .form-check-input[type=checkbox] {border-radius: 2em; height: 50px; width: 100px;}
small > p{color:red;}
p strong{font-weight: 600 !important; color: black !important;}
.sa-confirm-button-container button{background-color: #146c43 !important; border-color: #146c43 !important;}
.loaderData{display: block !important; background: #00000096 !important;}
.loaderDatastatus{display: block !important;}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= @$page ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Course Name</th>
                                            <td><strong><?= $course_details->course_name." ".$course_details->course_name1; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <th>Booking Details</th>
                                            <td>
                                                <?php
                                                if(!empty(@$booking_details)) {
                                                    $i = 1;
                                                    foreach($booking_details as $booking) {
                                                    if($booking->status == "1") { ?>
                                                    <div id="bookingData">
                                                        <p style="margin: 0px; font-size: 14px; color:#f59b24;">Slot-<?= $i.": ".date('d-m-Y', strtotime(@$booking->booking_date))." ".@$booking->booking_time."(Pending)"; ?></p>
                                                    </div>
                                                    <?php } else if(@$booking->status == "2") { ?>
                                                    <p style="margin: 0px; font-size: 14px; color:red;">Slot-<?= $i.": ".date('d-m-Y', strtotime(@$booking->booking_date))." ".@$booking->booking_time."(Canceled)"; ?></p>
                                                    <?php } else { ?>
                                                    <p style="margin: 0px; font-size: 14px; color:green;">Slot-<?= $i.": ".date('d-m-Y', strtotime(@$booking->booking_date))." ".@$booking->booking_time."(Completed)"; ?></p>
                                                    <?php } $i++; } ?>
                                                <?php } else { ?>
                                                    <p>No booking details available.</p>;
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Student Details</th>
                                            <td>
                                                <?php if(!empty($student_details)) { ?>
                                                <p style="margin: 0;"><strong>Name: </strong><?= $student_details->salutation." ".$student_details->first_name." ".$student_details->last_name; ?></p>
                                                <p style="margin: 0;"><strong>Email: </strong><?= $student_details->email; ?></p>
                                                <p style="margin: 0;"><strong>Phone: </strong><?= $student_details->phone; ?></p>
                                                <?php } else { ?>
                                                <p style="margin: 0;"><strong>Name: </strong>Not Available</p>
                                                <p style="margin: 0;"><strong>Email: </strong>Not Available</p>
                                                <p style="margin: 0;"><strong>Phone: </strong>Not Available</p>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Trainer Details</th>
                                            <td>
                                                <?php if(!empty($trainer_details)) { ?>
                                                <p style="margin: 0;"><strong>Name: </strong><?= $trainer_details->salutation." ".$trainer_details->first_name." ".$trainer_details->last_name; ?></p>
                                                <p style="margin: 0;"><strong>Email: </strong><?= $trainer_details->email; ?></p>
                                                <p style="margin: 0;"><strong>Phone: </strong><?= $trainer_details->phone; ?></p>
                                                <?php } else { ?>
                                                <p style="margin: 0;"><strong>Name: </strong>Not Available</p>
                                                <p style="margin: 0;"><strong>Email: </strong>Not Available</p>
                                                <p style="margin: 0;"><strong>Phone: </strong>Not Available</p>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Details: </th>
                                            <td>
                                                <p style="margin: 0;"><strong>Transaction ID: </strong><?= $booking_data->transaction_id; ?></p>
                                                <p style="margin: 0;"><strong>Transaction Date: </strong><?= date('d-m-Y', strtotime($booking_data->transaction_date)); ?></p>
                                                <p style="margin: 0;"><strong>Price: </strong><?= "$".$booking_data->price; ?></p>
                                                <p style="margin: 0;"><strong>Tax: </strong><?= "$".$booking_data->tax; ?></p>
                                                <p style="margin: 0;"><strong>Total Payment: </strong><?= "$".$booking_data->total_payment; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?php if($booking_data->status == '1') {echo "Active";} else {echo "Canceled";}?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>