<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>    
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
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
.img-cover{width:800px;height:140px}
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
                    <form id="submitform" action="<?= base_url('admin/course/add_course')?>" method="post" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="card shadow rounded">
                                    <div class="card-body">
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Course Name</label>
                                            <input type="text" class="form-control" name="course_name" id="course_name" required autocomplete="off">
                                        </div>
                                        <small id="course_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Course Description</label>
                                            <textarea class="form-control" name="course_description" id="course_description" required autocomplete="off"></textarea>
                                        </div>
                                        <small id="coursedesc_error"></small>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Address</label>
                                            <input type="text" class="form-control" name="address" id="autocomplete" value="">
                                            <input type="hidden" placeholder="Near"  name="latitude" id="latitude" >
                                            <input type="hidden" placeholder="Near" name="longitude" id="longitude" >
                                        </div>
                                        <small id="address_error"></small>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Country</label>
                                                    <input type="text" class="form-control" name="country" id="country" value="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">State</label>
                                                    <input type="text" class="form-control" name="state" id="state" value="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">City</label>
                                                    <input type="text" class="form-control" name="city" id="city">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Zip Code</label>
                                                    <input type="text" class="form-control" name="pincode" id="pincode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Course Duration</label>
                                                    <input type="text" class="form-control" name="course_week" id="course_week" required autocomplete="off">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Classes per Week</label>
                                                    <input type="text" class="form-control" name="class_week" id="class_week" required autocomplete="off">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Course Price</label>
                                                    <input type="text" class="form-control" name="course_price" id="course_price" required autocomplete="off">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="fw-semibold  text-black">Course Image</label>
                                                    <input type="file" class="form-control" name="upload_image"  id="upload_image" >
                                                    <input type="hidden" class="form-control" name="profileImg"  id="profileImg" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="fw-semibold  text-black">Status</label>
                                            <select class="form-control" name="status" required id="userstatus">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <small id="status_error"></small>
                                        </div>
                                        <div class="form-group mt-3 mb-2">
                                            <button class="btn btn-success text-uppercase px-5 shadow">Submit</button>
                                            <a class="btn btn-danger waves-effect waves-light m-l-30" href="javascript:history.go(-1)">Back</a>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="card shadow rounded">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="container">
                                                <div class="col-md-12">
                                                    <div class="profile clearfix">                            
                                                        <div class="image item" id="Cover-Image">
                                                            <img src="<?= !empty(@$user->cover_image) ? base_url('uploads/cover_image/' . @$user->cover_image . '') : base_url('uploads/bnr.jpg'); ?>" class="img-cover" id="blah">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <div class="card rounded">
                                                    <div class="card-body">
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Course Name: </b><p class="text-muted" id="coursename" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Course Description: </b><p class="text-muted" id="coursedescription" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Course Duration: </b><p class="text-muted" id="courseweek" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Classes per Week: </b><p class="text-muted" id="classweek" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Course Price: </b><p class="text-muted" id="courseprice" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3" style="margin-top: 5px !important;">
                                                            <div class="tx-11 font-weight-bold mb-0 ">
                                                                <b>Status: </b><p class="text-muted" id="individual_status" style="display: contents"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<link href='<?php echo base_url(); ?>assets/chosen/chosen.min.css' rel='stylesheet' type='text/css'>
<script src='<?php echo base_url(); ?>assets/chosen/chosen.jquery.min.js' type='text/javascript'></script> 
<script>
$(document).ready(function() {
    $('#course_description').summernote();
    // Monitor changes to the editor
    $('#course_description').on('summernote.change', function (we, contents, $editable) {
        var plainText = $($('#course_description').summernote('code')).text();
        if (plainText.trim()) {
            $("#coursedescription").text(plainText);
            $("#coursedesc_error").text("");
        } else {
            $("#coursedesc_error").text("Description cannot be empty.");
        }
    });
});
$(document).on('keyup', '#course_name', function (e) {
    var course_name = $(this).val();
    if (course_name) {
        $("#c_name").text(course_name);
        $("#coursename").text(course_name);
    } else {
        //$("#course_error").text('Please enter course name').css("color", "red");
    }
});
$(document).on('keyup', '#course_week', function (e) {
    var cweek = $(this).val();
    if (cweek) {
        $("#courseweek").text(cweek);
    } else {
        $("#durarion_error").text('Please enter course duration');
    }
});
$(document).on('keyup', '#class_week', function (e) {
    var classweek = $(this).val();
    if (classweek) {
        $("#classweek").text(classweek);
    } else {
        $("#classw_error").text('Please enter classes per week');
    }
});
$(document).on('keyup', '#course_price', function (e) {
    var cprice = $(this).val();
    if (cprice) {
        $("#courseprice").text(cprice);
    } else {
        $("#course_price").text('Please enter course price');
    }
});
$(document).on('change', '#userstatus', function (e) {
    var status = $(this).val();
    if (status == 1) {
        $("#individual_status").text('Active');
    }
    if (status == 0) {
        $("#individual_status").text('Inactive');
    }
});
upload_image.onchange = evt => {
    const [file] = upload_image.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}
</script>