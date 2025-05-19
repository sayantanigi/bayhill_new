<section class="position-relative">
    <div class="bannerform">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="slidebanner">
                        <div class="owl-carousel owl-theme" id="bannerslide">
                            <div class="item">
                                <div class="imgbox">
                                    <img src="<?= base_url()?>assets/images/img-01.jpg" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="imgbox">
                                    <img src="<?= base_url()?>assets/images/img-02.jpg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bannercontent">
                        <div class="boxcontent">
                            <h3>We teach safe and confident drivers for life.
                            </h3>
                            <p>Learn to drive with Bay Hill Driving School and gain the skills and confidence you need for
                                life, whether you're a first time driver or need a refresher before your test.
                            </p>
                        </div>
                        <div class="bannerenroll mt-4">
                            <form>
                                <div class="px-4">
                                    <p>Get started by choosing in car lessons or a course</p>
                                </div>
                                <div class="row px-4 formbanner">
                                    <div class="col-lg-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <img src="<?= base_url()?>assets/images/icon/car-icon.png"/>
                                            </span>
                                            <select class="form-control form-select" id="drivinglesson">
                                                <option value="">Driving Lessons</option>
                                                <option value="teenclasses">Teen Driving Lessons</option>
                                                <option value="adultclasses">Adult Driving Lessons</option>
                                                <option value="https://driversedforyou.com/">Drivers Ed</option>
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
                                <button type="button" class="btnenroll" id="enroll_now">Enroll Now</button>
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
        <h3 class="maintitle mb-5 text-white wow fadeInUp">" Since 2010 , our commitment to serving the Bay Area community with diligence and dedication "</h3>
        <div class="row align-items-center ">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="500ms">
                <div class="d-flex mb-4 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url()?>assets/images/icon/steering-wheel.png" />
                    </div>
                    <div>
                        <h5 class="fw-semibold text-warning"> Ready to get behind the wheel?</h5>
                        <p class="text-white">Call us and we’ll help to schedule your lessons at desired date and time based on the availability, free pick-up and drop-off.</p>
                    </div>
                </div>
                <div class="d-flex mb-4 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url()?>assets/images/icon/driving.png" />
                    </div>
                    <div>
                        <h5 class="fw-semibold text-warning"> Start Driving</h5>
                        <p class="text-white">Our driving school instructor will guide you through everything from starting the car to mastering vehicle control.</p>
                    </div>
                </div>
                <div class="d-flex mb-1 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url()?>assets/images/icon/identity.png" />
                    </div>
                    <div>
                        <h5 class="fw-semibold text-warning"> Now Get Your License</h5>
                        <p class="text-white">Pass the official driving exam and get your license. Be a safe and responsible driver after.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="videoBg position-relative wow fadeInRight" data-wow-delay="500ms">
                    <img src="<?= base_url()?>assets/images/videobg.png" />
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mt-5 text-center wow fadeInUp" data-wow-delay="500ms">
                    <h3 class="h4 fw-bold text-white mb-4 text-capitalize">Get our app right now</h3>
                    <div class="d-flex gap-3 justify-content-center align-items-center appicon">
                        <div>
                            <a href="#"><img src="assets/images/appstore.png"></a>
                        </div>
                        <div>
                            <a href="#"><img src="assets/images/google-play.png"></a>
                        </div>
                    </div>
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
                <h3 class="maintitle mb-2">Trusted by thousands of California drivers</h3>
            </div>
        </div>
        <div class="servboxlist">
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-01.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/serv-01.png" />
                    <h2>Certified driving instructors </h2>
                    <p>Every instructor is certified and licensed and has completed an intensive training course
                    </p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-02.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/serv-02.png" />
                    <h2>Free Pickup and Drop Off</h2>
                    <p>We come to your house, school or work—and can even drop you off at a convenient location within 5-10 minutes of your pickup address, or meet in convenient public locations</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-03.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/mobile-app.png" />
                    <h2>Cutting-edge technology</h2>
                    <p>Online booking, secure payments and digital lesson reports—we leverage the latest tech to provide an experience you will love</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-04.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/smile.png" />
                    <h2>Customers first</h2>
                    <p>Our instructors don't run errands during your driving lessons—your time behind the wheel is your time</p>
                </div>
            </div>

        </div>
        <div class="servboxlist">
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-04.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/planning.png" />
                    <h2>Customized lesson plans</h2>
                    <p>Our driving lessons aren't for everyone, they're for you—our instructors customize every lesson to your precise needs</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-03.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/calendar.png" />
                    <h2>Transparent availability</h2>
                    <p>Our online booking system shows you all available time slots, so you can book packages knowing when we're available</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-02.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/car.png" />
                    <h2>Driving Test coaching</h2>
                    <p>We teach you the skills you need to be a great driver, and also prepare you for your road test, so you can test with confidence</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp"
                style="background-image: url(./assets/images/serv-bg-06.jpg);">
                <div class="servBox">
                    <img src="assets/images/serviceicon/customer-service.png" />
                    <h2>Dedicated support team</h2>
                    <p>Our highly trained customer support staff can answer any question—from scheduling help to the licensing process, we're here for you</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="whychoose" style="background-image: url(./assets/images/serv-bg-03.jpg);">
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h2 class="maintitle text-white mb-4">Why Take California Driver Ed With Us?</h2>
                <p>We help teens and families navigate through their first-time driver experience to ensure
                    that it is stress, worry and speedbump free. Our courses can be completed on any mobile
                    device and will automatically save your progress each time you log out. Join thousands
                    of teens who chose First Time Driver for their online driver education and get ready to
                    earn
                    your California Learner’s Permit. Join thousands of teens who chose First Time Driver
                    for
                    their online driver education and get ready to earn your California Learner’s Permit.
                    Find
                    our course now.</p>
                <div class="mt-5">
                    <a href="faq.html" class="enrollbtn text-uppercase">Course FAQ</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonials-one">
    <div class="testimonials-one__bg" style="background-image: url(assets/images/backgrounds/bg-ture.png);">
    </div>
    <div class="container">
        <div class="sec-title2  text-center wow fadeInUp" data-wow-duration='300ms'>
            <h3 class="maintitle ">Google Review</h3>
        </div>
        <div class="testimonials-one__carousel drivschol-owl__carousel drivschol-owl__carousel--with-shadow drivschol-owl__carousel--basic-nav owl-carousel"
            data-owl-options='{
                "items": 1,
                "margin": 30,
                "loop": true,
                "smartSpeed": 700,
                "nav": true,
                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                "dots": false,
                "autoplay": true,
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "767": {
                        "items": 1,
                        "margin": 30
                    },
                    "992": {
                        "items": 3,
                        "margin": 30
                    }
                }
            }'>
            <div class="item">
                <div class="testimonials-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                    <div class="testimonials-card__inner">
                        <div class="testimonials-card__top">
                            <div class="testimonials-card__top__icon">
                                <i class="icon-quite"></i>
                            </div>
                            <div class="testimonials-card__top__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="testimonials-card__top__designation">There are many variations of passages
                                of Loriem Ipsum ies available, but the majority have suffered alteturr adtion
                                form by injected humour</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="assets/images/serv-bg-03.jpg" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Theresa Webb</a>
                                </h5>
                                <span class="testimonials-card__author__degeneration">5 months ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="testimonials-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                    <div class="testimonials-card__inner">
                        <div class="testimonials-card__top">
                            <div class="testimonials-card__top__icon">
                                <i class="icon-quite"></i>
                            </div>
                            <div class="testimonials-card__top__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="testimonials-card__top__designation">There are many variations of passages
                                of Loriem Ipsum ies available, but the majority have suffered alteturr adtion
                                form by injected humour</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="assets/images/serv-bg-03.jpg" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Theresa Webb</a>
                                </h5>
                                <span class="testimonials-card__author__degeneration">2 months ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="yelpreview  wow fadeInUp">
    <div class="container">
        <div class="sec-title2  text-center wow fadeInUp" data-wow-duration='300ms'>
            <h3 class="maintitle text-white">Yelp Review</h3>
        </div>
        <div class="">
            <div class="testimonials-one__carousel drivschol-owl__carousel drivschol-owl__carousel--with-shadow drivschol-owl__carousel--basic-nav owl-carousel"
            data-owl-options='{
                "items": 1,
                "margin": 30,
                "loop": true,
                "smartSpeed": 700,
                "nav": true,
                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                "dots": false,
                "autoplay": true,
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "767": {
                        "items": 1,
                        "margin": 30
                    },
                    "992": {
                        "items": 3,
                        "margin": 30
                    }
                }
            }'>
            <div class="item">
                <div class="testimonials-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                    <div class="testimonials-card__inner">
                        <div class="testimonials-card__top">
                            <div class="testimonials-card__top__icon">
                                <i class="icon-quite"></i>
                            </div>
                            <div class="testimonials-card__top__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="testimonials-card__top__designation">There are many variations of passages
                                of Loriem Ipsum ies available, but the majority have suffered alteturr adtion
                                form by injected humour</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="assets/images/serv-bg-03.jpg" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Theresa Webb</a>
                                </h5>
                                <span class="testimonials-card__author__degeneration">5 months ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="testimonials-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                    <div class="testimonials-card__inner">
                        <div class="testimonials-card__top">
                            <div class="testimonials-card__top__icon">
                                <i class="icon-quite"></i>
                            </div>
                            <div class="testimonials-card__top__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="testimonials-card__top__designation">There are many variations of passages
                                of Loriem Ipsum ies available, but the majority have suffered alteturr adtion
                                form by injected humour</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="assets/images/serv-bg-03.jpg" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Theresa Webb</a>
                                </h5>
                                <span class="testimonials-card__author__degeneration">2 months ago</span>
                            </div>
                        </div>
                    </div>
                </div>
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
                <h3 class="maintitle mb-5">Training Videos, Permit Information, and
                    More for Your Driving Success</h3>
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
                        <div class="linkdesign"><a href="#">Preparing for Your Driving Test (Information)</a>
                        </div>
                        <div class="linkdesign"><a href="#">Instruction Permits if you are under 18 year</a>
                        </div>
                        <div class="linkdesign"><a href="#">Parent-Teen Training Guide</a></div>
                        <div class="linkdesign"><a href="#">Driver License Information for New Drivers</a></div>
                    </div>
                </div>
                <div class="linkBox  wow fadeInUp">
                    <span class="linkboxtitle">Useful Video Links For New Drivers</span>
                    <div class="linkFlex">
                        <div class="linkdesign"><a href="#">Top 10 Reasons for Behind-the-Wheel Failures</a>
                        </div>
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