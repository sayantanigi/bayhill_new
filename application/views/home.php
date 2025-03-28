<section class="position-relative">
    <div class="bannerform">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="videoBg position-relative wow fadeInRight" data-wow-delay="500ms">
                        <img src="assets/images/carimg.gif" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bannercontent">
                        <div class="boxcontent">
                            <h3>We teach safe and confident drivers for life.</h3>
                            <p>Learn to drive with Bay Hill Driving School and gain the skills and confidence you need for life, whether you're a first time driver or need a refresher before your test.</p>
                        </div>
                        <div class="bannerenroll mt-4">
                            <form action="<?= base_url()?>courses" method="POST">
                                <div class="px-4">
                                    <p>Get started by choosing in car lessons or a course</p>
                                </div>
                                <div class="row px-4 pb-3 formbanner">
                                    <div class="col-lg-12">
                                        <div class="position-relative d-flex align-items-center mb-4">
                                            <div class="fw-semibold">Teen Driving Lessons</div>
                                            <label class="switch"><input type="checkbox" />
                                                <div></div>
                                            </label>
                                            <div class="fw-semibold">Adult Driving Lessons</div>
                                        </div>
                                        <input type="hidden" id="course_type" name="course_type" value="">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3 dropdown">
                                            <a href="javascript:void(0);" target="_blank" class="d-block w-100" id="search_course" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <div class="input-group driveraddbtn">
                                                    <span class="input-group-text">
                                                        <img src="assets/images/icon/car-icon.png" />
                                                    </span>
                                                    <div class="flex-fill">Driving Lessons</div>
                                                    <div class="pe-3"><i class="fas fa-angle-down"></i></div>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu zipformsrch">
                                                <h3 class="h6 fw-bold mb-3">Enter Your Zip Code Below to Get Started <span style="color: red;">*</span></h3>
                                                <div class="zipbox mb-3">
                                                    <input type="text" placeholder="Zip Code" id="zipcode" name="pincode" class="zipcode" required/>
                                                    <div id="errmsgpin"></div>
                                                </div>
                                                <input class="btn btn-secondary mb-3 text-white fe-semibold rounded-0 flex-fill findZipcode" type="submit" value="View Packages">
                                                <p>Already purchased a lesson package? </p>
                                                <p><a href="#" class="text-decoration-underline">Sign in to book your next lesson</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="https://driversedforyou.com/" target="_blank">
                                            <div class="input-group mb-3 driveraddbtn">
                                                <span class="input-group-text"><img src="assets/images/icon/graduate-cap.png" /></span>
                                                <div>Drivers Ed</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <a href="#" class="regbtn text-white px-4" data-bs-toggle="tooltip" data-bs-title="Returning Students">Student Login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="lessonsModal" tabindex="-1" aria-labelledby="lessonsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-4">
                    <div class="row px-4 pb-3 formbanner">
                        <div class="col-lg-12">
                            <div class="position-relative d-flex align-items-center mb-4">
                                <div class="fw-semibold">Teen Driving Lessons</div>
                                <label class="switch"><input type="checkbox" />
                                    <div></div>
                                </label>
                                <div class="fw-semibold">Adult Driving Lessons</div>
                            </div>
                            <input type="hidden" id="courseType" name="course_type" value="">
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group">
                                <form action="<?= base_url()?>courses" method="POST">
                                    <div class="zipformsrch w-100 shadow-none p-0">
                                        <h3 class="h6 fw-bold mb-3">Enter Your Zip Code Below to Get Started <span style="color: red;">*</span></h3>
                                        <div class="zipbox mb-3">
                                            <input type="text" placeholder="Zip Code" id="zipcode" name="pincode" class="zip_code" required/>
                                            <p id="errmsg_pin"></p>
                                        </div>
                                        <!-- <a href="<?= base_url('courses'); ?>" class="btn btn-secondary mb-3 text-white fe-semibold rounded-0">View Packages</a> -->
                                        <!-- <button class="btn btn-secondary mb-3 text-white fe-semibold rounded-0 flex-fill" type="submit">View Packages</button> -->
                                        <input class="btn btn-secondary mb-3 text-white fe-semibold rounded-0 flex-fill find_zipcode" type="submit" value="View Packages">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="enrollBg bg-primary">
    <div class="container">
        <div class="d-lg-flex justify-content-between align-items-center">
            <div class="text-start mb-4 mb-lg-0">
                <h2 class="h3 mb-lg-0 text-center">
                    <span class="text-blinkblue fw-bold">Schedule Your Driving Lessons Online 24/7! </span>
                    <span class="ms-3">or</span>
                    <span class="mb-lg-0 fw-bold h3 text-blinkblue ms-3"><i class="fas fa-phone-alt me-1"></i> 800 648 3650</span>
                    <span class="h6">(9AM-5PM Mon-Fri)</span>
                </h2>
            </div>
            <div>
                <a href="#" class="enrollbtn mt-lg-0" data-bs-toggle="modal" data-bs-target="#lessonsModal">Enroll Now</a>
            </div>
        </div>
    </div>
</section>
<style>
#zipcode{width: 170px; height: 45px; border: 1px solid #666; padding: 0 15px;}
#errmsgpin{ margin-top: 5px;}
#errmsg_pin{ margin-top: 5px;}
</style>
<script>
$('#enroll_now').click(function () {
    lesson_type = $('#drivinglesson').val();
    if (lesson_type == '') {
        $('#drivinglesson').prop('required', true);
        $('#err_lesson').text('Please choose an option').css('color', 'red');
        setTimeout(function () { $('#err_lesson').text(''); }, 3000);
    } else {
        $('#err_lesson').text('');
        if (lesson_type == 'teenclasses') {
            $('#lessonsModal').modal('show');
        } else {
            window.location.href = '<?= base_url('student_form') ?>';
        }
    }
})

$('#search_course').on('click', function(){
    var zip = $('#zipcode').val();
    if ($('.d-block.w-100').hasClass('show')) {
        $('#zipcode').val('');
        $('#errmsgpin').html('');
    }
});
$(document).ready(function() {
    var checkbox = $('label.switch input[type="checkbox"]');
    function getValueBasedOnCheckbox() {
        var value;
        if (checkbox.is(':checked')) {
            value = 1 // Adult Driving Lessons
        } else {
            value = 2 // Teen Driving Lessons
        }
        return value;
    }
    checkbox.change(function() {
        var value = getValueBasedOnCheckbox();
        $('#course_type').val(value);
        $('#courseType').val(value);
    });
    var initialValue = getValueBasedOnCheckbox();
    $('#course_type').val(initialValue);
    $('#courseType').val(initialValue);
});

$('.zipcode').on('input', function(){
    var pincode = $(this).val();
    var course_type = $('#course_type').val();
    if(pincode.length != 5){
        $('#errmsgpin').html('<p style="color: red">Please enter a valid 5 digit zip code.</p>');
        $('.findZipcode').prop('disabled', true);
    } else {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('course_zipcode') ?>',
            data: {pincode: pincode, course_type: course_type},
            success: function(response){
                data = JSON.parse(response)
                if(data.result == 'error'){
                    $('#errmsgpin').html('<p style="color: red">'+data.msg+'</p>');
                    $('.findZipcode').prop('disabled', true);
                } else {
                    $('#errmsgpin').html('<p style="color: green">'+data.msg+'</p>');
                    $('.findZipcode').prop('disabled', false);
                }
            }
        })
        $('#errmsgpin').html(''); // Clear any previous error message
        $('.findZipcode').prop('disabled', false);
    }
});

$('.zip_code').on('input', function(){
    var pincode = $(this).val();
    var course_type = $('#courseType').val();
    if(pincode.length != 5){
        $('#errmsg_pin').html('<p style="color: red">Please enter a valid 5 digit zip code.</p>');
        $('.find_zipcode').prop('disabled', true);
    } else {
        $.ajax({
            type: 'POST',
            url: '<?= base_url('course_zipcode') ?>',
            data: {pincode: pincode, course_type: course_type},
            success: function(response){
                data = JSON.parse(response)
                if(data.result == 'error'){
                    $('#errmsg_pin').html('<p style="color: red">'+data.msg+'</p>');
                    $('.find_zipcode').prop('disabled', true);
                } else {
                    $('#errmsg_pin').html('<p style="color: green">'+data.msg+'</p>');
                    $('.find_zipcode').prop('disabled', false);
                }
            }
        })
        $('#errmsg_pin').html(''); // Clear any previous error message
        $('.find_zipcode').prop('disabled', false);
    }
});
</script>