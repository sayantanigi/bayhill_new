<section class="position-relative d-md-flex justify-content-end">
    <div class="slidebanner">
        <div class="owl-carousel owl-theme" id="bannerslide">
            <div class="item">
                <div class="imgbox">
                    <img src="<?= base_url()?>assets/images/img-01.jpg"/>
                </div>
            </div>
            <div class="item">
                <div class="imgbox">
                    <img src="<?= base_url()?>assets/images/img-02.jpg"/>
                </div>
            </div>
        </div>
    </div>
    <div class="bannerform">
        <div class="container">
            <div class="bannercontent">
                <div class="boxcontent">
                    <h3>Behind the wheel Driving lessons</h3>
                    <p>DMV Approved Driving Lessons License # E4716</p>
                </div>
                <div class="bannerenroll mt-4">
                    <form>
                        <div class="px-4">
                            <p>Get started by choosing in car lessons or a course</p>
                        </div>
                        <div class="row px-4 formbanner">
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><img src="<?= base_url()?>assets/images/icon/car-icon.png"/></span>
                                    <select class="form-control form-select" id="drivinglesson">
                                        <option value="">Driving Lessons</option>
                                        <option value="teenclasses">Lessons for Teen Classes</option>
                                        <option value="adultclasses">Lessons for Adult Classes</option>
                                    </select>
                                    <span id="err_lesson"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><img src="<?= base_url()?>assets/images/icon/graduate-cap.png"/></span>
                                    <input type="text" class="form-control" placeholder="Drivers Ed">
                                </div>
                            </div>
                        </div>
                        <div class="bnrtopbox finBtn mb-4">
                            <h2><span>Financing available</span></h2>
                        </div>
                        <button type="button" class="btnenroll" id="enroll_now">Enroll Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="lessonsModal" tabindex="-1" aria-labelledby="lessonsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-4">
                    <div class="text-center mb-4">
                        <h2 class="h2 fw-bold">Lessons for Teen Classes</h2>
                        <p>Enter your zip code to locate nearby courses</p>
                    </div>
                    <form action="<?= base_url()?>courses" method="POST">
                        <div class="d-flex zipsearch mb-3 mx-auto">
                            <input type="text" placeholder="Enter ZIP Code" name="pincode" id="pincode" title="Please enter a valid ZIP code" required />
                            <button class="flex-fill" type="submit">Search by ZIP Code</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="howitworkspnl">
    <div class="container">
        <h2 class="subtitle  wow fadeInUp">How It Works?</h2>
        <h3 class="maintitle mb-5  wow fadeInUp">" Since 2010 , our commitment to serving the Bay Area community with diligence and dedication "</h3>
        <div class="row align-items-center ">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="500ms">
                <div class="d-flex mb-4 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url()?>assets/images/icon/steering-wheel.png"/>
                    </div>
                    <div>
                        <h5 class="fw-semibold"> Ready to get behind the wheel?</h5>
                        <p>Call us and we’ll help to schedule your lessons at desired date and time based on the availability, free pick-up and drop-off.</p>
                    </div>
                </div>
                <div class="d-flex mb-4 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url()?>assets/images/icon/driving.png"/>
                    </div>
                    <div>
                        <h5 class="fw-semibold"> Start Driving</h5>
                        <p>Our driving school instructor will guide you through everything from starting the car to mastering vehicle control.</p>
                    </div>
                </div>
                <div class="d-flex mb-1 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url()?>assets/images/icon/identity.png"/>
                    </div>
                    <div>
                        <h5 class="fw-semibold"> Now Get Your License</h5>
                        <p>Pass the official driving exam and get your license. Be a safe and responsible driver after.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="videoBg position-relative wow fadeInRight" data-wow-delay="500ms">
                    <a href="https://www.youtube.com/watch?v=aMLNYwwNLPQ" class="popup-youtube">
                        <img src="<?= base_url()?>assets/images/videobg.png"/>
                        <span class="playicon"><i class="fas fa-play-circle"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="satisfactionPnl">
    <div class="container-fluid">
        <div class="row justify-content-center text-center ">
            <div class="col-lg-6  wow fadeInUp">
                <h2 class="subtitle">User satisfaction</h2>
                <h3 class="maintitle mb-5">Trusted by thousands of California drivers</h3>
            </div>
        </div>
        <div class="servboxlist">
            <div class="servblocksize  wow fadeInUp"  style="background-image: url(./assets/images/serv-bg-01.jpg);">
                <div class="servBox">
                    <img src="<?= base_url()?>assets/images/serviceicon/serv-01.png"/>
                    <h2>Private One-On-One Lessons</h2>
                    <p>In order to provide our full attention to you, the student, we like our behind the wheel training sessions to consist of two people in the car. That means the instructor, and the student will be the only two present while training. This ensures full confidence in each student to ask any questions. This privacy also allows the student to learn at a pace they have set themselves.</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp" style="background-image: url(./assets/images/serv-bg-02.jpg);">
                <div class="servBox">
                    <img src="<?= base_url()?>assets/images/serviceicon/serv-02.png"/>
                    <h2>Free Pickup and Drop Off</h2>
                    <p>We understand that our students or their families may have busy lifestyles, that's why we have no problem picking you up and dropping you off before and after each training session. This means that we can ensure you get the training you need, when you need it and put an end to missed lessons or rescheduling due to transportation issues.</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp" style="background-image: url(./assets/images/serv-bg-03.jpg);">
                <div class="servBox">
                    <img src="<?= base_url()?>assets/images/serviceicon/serv-03.png"/>
                    <h2>Clean & Maintained Vehicles</h2>
                    <p>We chose the clean and newer as our training vehicles. They have great safety ratings which come in handy in the event of the student wanting to test those safety ratings. Our vehicles are always up to date on their regular maintenance schedules. We also feel a clean environment is a great one to learn in, so our vehicles are kept clean.</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp" style="background-image: url(./assets/images/serv-bg-04.jpg);">
                <div class="servBox">
                    <img src="<?= base_url()?>assets/images/serviceicon/serv-04.png"/>
                    <h2>Experienced Instructors</h2>
                    <p>Our instructors have not only been driving for years but training as well. Every instructor is certified and licensed by the DMV and has completed an intensive training course.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="usefullLink">
    <div class="container">
        <div class="row">
            <div class="col-lg-8  wow fadeInUp">
                <h2 class="subtitle">Useful Links</h2>
                <h3 class="maintitle mb-5">Training Videos, Permit Information, and More for Your Driving Success</h3>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="linkBox mb-4  wow fadeInUp">
                    <span class="linkboxtitle">DMV Useful Links</span>
                    <div class="linkFlex">
                        <div class="linkdesign"><a href="#">DMV Home Page</a></div>
                        <div class="linkdesign"><a href="#">Make DMV Driving Test Appointment</a></div>
                        <div class="linkdesign"><a href="#">DMV Appointment System</a></div>
                        <div class="linkdesign"><a href="#">Preparing for Your Driving Test (Information)</a></div>
                        <div class="linkdesign"><a href="#">Instruction Permits if you are under 18 year</a></div>
                        <div class="linkdesign"><a href="#">Parent-Teen Training Guide</a></div>
                        <div class="linkdesign"><a href="#">Driver License Information for New Drivers</a></div>
                    </div>
                </div>
                <div class="linkBox  wow fadeInUp">
                    <span class="linkboxtitle">Useful Video Links For New Drivers</span>
                    <div class="linkFlex">
                        <div class="linkdesign"><a href="#">Top 10 Reasons for Behind-the-Wheel Failures</a></div>
                        <div class="linkdesign"><a href="#">A to Z Rules of Road Video</a></div>
                        <div class="linkdesign"><a href="#">DMV useful Videos Links</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="linkBox  wow fadeInUp">
                    <span class="linkboxtitle">DMV Permit Practice Test</span>
                    <div class="linkFlex">
                        <div class="linkdesign"><a href="#">Class C Test #1 (English)</a></div>
                        <div class="linkdesign"><a href="#">Class C Test #2 (English)</a></div>
                        <div class="linkdesign"><a href="#">Class C Test #3 (English)</a></div>
                        <div class="linkdesign"><a href="#">Class C Test #4 (English)</a></div>
                        <div class="linkdesign"><a href="#">Class C Test #5 (English)</a></div>
                        <div class="linkdesign"><a href="#">Class C Test #6 (English)</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="downloadBox">
    <div class="container">
        <div class="downloadapp" style="background-image: url(./assets/images/appbg.png);">
            <div class="appcontent  wow fadeInUp">
                <p class="text-white mb-2">Get App</p>
                <h3 class="text-white mb-4">Get our app right now</h3>
                <div class="d-flex gap-3 align-items-center appicon">
                    <div>
                        <a href="#"><img src="<?= base_url()?>assets/images/appstore.png"/></a>
                    </div>
                    <div>
                        <a href="#"><img src="<?= base_url()?>assets/images/google-play.png"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$('#enroll_now').click(function(){
    lesson_type = $('#drivinglesson').val();
    if(lesson_type == ''){
        $('#drivinglesson').prop('required', true);
        $('#err_lesson').text('Please choose an option').css('color', 'red');
        setTimeout(function(){$('#err_lesson').text('');}, 3000);
    } else {
        $('#err_lesson').text('');
        if(lesson_type == 'teenclasses') {
            $('#lessonsModal').modal('show');
        } else {
            window.location.href = '<?= base_url('student_form')?>';
        }
    }
})
</script>