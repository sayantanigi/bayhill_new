<?php
$site_setting = $this->db->query("select * from  settings")->row();
?>
<?php if (current_url() != base_url('faq') && current_url() != base_url('contact') && current_url() != base_url('courses') && current_url() != base_url('course/course_details') && current_url() != base_url('booking_slot') && current_url() != base_url('instructor-slot') && current_url() != base_url('login') && current_url() != base_url('login') && current_url() != base_url('complete-payment')) { ?>
<section class="howitworkspnl">
    <div class="container">
        <h3 class="maintitle mb-5 text-white wow fadeInUp">" Since 2010 , our commitment to serving the Bay Area community with diligence and dedication "</h3>
        <div class="row align-items-center ">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="500ms">
                <div class="d-flex mb-4 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url(); ?>assets/images/icon/steering-wheel.png" />
                    </div>
                    <div>
                        <h5 class="fw-semibold text-warning"> Ready to get behind the wheel?</h5>
                        <p class="text-white">Call us and we’ll help to schedule your lessons at desired date and time based on the availability, free pick-up and drop-off.</p>
                    </div>
                </div>
                <div class="d-flex mb-4 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url(); ?>assets/images/icon/driving.png" />
                    </div>
                    <div>
                        <h5 class="fw-semibold text-warning"> Start Driving</h5>
                        <p class="text-white">Our driving school instructor will guide you through everything from starting the car to mastering vehicle control.</p>
                    </div>
                </div>
                <div class="d-flex mb-1 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url(); ?>assets/images/icon/identity.png" />
                    </div>
                    <div>
                        <h5 class="fw-semibold text-warning"> Now Get Your License</h5>
                        <p class="text-white">Pass the official driving exam and get your license. Be a safe and responsible driver after.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="slidebanner">
                    <div class="owl-carousel owl-theme" id="bannerslide">
                        <div class="item">
                            <div class="imgbox">
                                <img src="<?= base_url(); ?>assets/images/img-01.jpg" />
                                <div class="bnr-content">
                                    <h2>Drivers Training – Teenagers</h2>
                                    <h2>Individual Classes for Adults</h2>
                                    <h2>2 Hour Crash Course</h2>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="imgbox">
                                <img src="<?= base_url(); ?>assets/images/serv-bg-02.jpg" />
                                <div class="bnr-content">
                                    <h2>Drivers Training – Teenagers</h2>
                                    <h2>Individual Classes for Adults</h2>
                                    <h2>2 Hour Crash Course</h2>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="imgbox">
                                <img src="<?= base_url(); ?>assets/images/img-02.jpg" />
                                <div class="bnr-content">
                                    <h2>Drivers Training – Teenagers</h2>
                                    <h2>Individual Classes for Adults</h2>
                                    <h2>2 Hour Crash Course</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mt-5 text-center wow fadeInUp" data-wow-delay="500ms">
                    <h3 class="h4 fw-bold text-white mb-4 text-capitalize">Get our app right now</h3>
                    <div class="d-flex gap-3 justify-content-center align-items-center appicon">
                        <div>
                            <a href="#"><img src="<?= base_url(); ?>assets/images/appstore.png"></a>
                        </div>
                        <div>
                            <a href="#"><img src="<?= base_url(); ?>assets/images/google-play.png"></a>
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
            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-01.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/serv-01.png" />
                    <h2>Certified driving instructors </h2>
                    <p>Every instructor is certified and licensed and has completed an intensive training course
                    </p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-02.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/serv-02.png" />
                    <h2>Free Pickup and Drop Off</h2>
                    <p>We come to your house, school or work—and can even drop you off at a convenient location within 5-10 minutes of your pickup address, or meet in convenient public locations</p>
                </div>
            </div>

            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-04.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/planning.png" />
                    <h2>Customized lesson plans</h2>
                    <p>Our driving lessons aren't for everyone, they're for you—our instructors customize every lesson to your precise needs</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-02.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/car.png" />
                    <h2>Driving Test coaching</h2>
                    <p>We teach you the skills you need to be a great driver, and also prepare you for your road test, so you can test with confidence</p>
                </div>
            </div>
        </div>
        <div class="servboxlist">
            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-03.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/mobile-app.png" />
                    <h2>Cutting-edge technology</h2>
                    <p>Online booking, secure payments and digital lesson reports—we leverage the latest tech to provide an experience you will love</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-04.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/smile.png" />
                    <h2>Customers first</h2>
                    <p>Our instructors don't run errands during your driving lessons—your time behind the wheel is your time</p>
                </div>
            </div>
            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-03.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/calendar.png" />
                    <h2>Transparent availability</h2>
                    <p>Our online booking system shows you all available time slots, so you can book packages knowing when we're available</p>
                </div>
            </div>

            <div class="servblocksize  wow fadeInUp" style="background-image: url(<?= base_url(); ?>assets/images/serv-bg-06.jpg);">
                <div class="servBox">
                    <img src="<?= base_url(); ?>assets/images/serviceicon/customer-service.png" />
                    <h2>Dedicated support team</h2>
                    <p>Our highly trained customer support staff can answer any question—from scheduling help to the licensing process, we're here for you</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="whychoose" style="background-image: url(<?= base_url(); ?>assets/images/bg-cover-01.jpg);">
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h2 class="maintitle text-white mb-4">Why Take California Driver Ed With Us?</h2>
                <p>Bayhill Driving school established in 2013, have designed an Driving Lessons proven to give you quality driver education, provides a solid foundation of knowledge and skills that can help you to become a safe driver in California. Instructors are fully licensed by the State of California with extensive Behind The Wheel experience. We pride ourselves on providing a patient and supportive style when working with both teens and adults. Each instructor is License and approved by the DMV. All our Instructors act in a professional and courteous manner when giving instructions.</p>
                <div class="mt-5">
                    <a href="<?= base_url('faq'); ?>" class="enrollbtn text-uppercase">Course FAQ</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonials-one">
    <div class="testimonials-one__bg" style="background-image: url();"></div>
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
                                <img src="<?= base_url(); ?>assets/images/serv-bg-03.jpg" alt="Theresa Webb">
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
                            <p class="testimonials-card__top__designation">There are many variations of passages of Loriem Ipsum ies available, but the majority have suffered alteturr adtion form by injected humour</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/serv-bg-03.jpg" alt="Theresa Webb">
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
                                <p class="testimonials-card__top__designation">There are many variations of passages of Loriem Ipsum ies available, but the majority have suffered alteturr adtion form by injected humour</p>
                            </div>
                            <div class="testimonials-card__author">
                                <div class="testimonials-card__author__image">
                                    <img src="<?= base_url(); ?>assets/images/serv-bg-03.jpg" alt="Theresa Webb">
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
                                <p class="testimonials-card__top__designation">There are many variations of passages of Loriem Ipsum ies available, but the majority have suffered alteturr adtion form by injected humour</p>
                            </div>
                            <div class="testimonials-card__author">
                                <div class="testimonials-card__author__image">
                                    <img src="<?= base_url(); ?>assets/images/serv-bg-03.jpg" alt="Theresa Webb">
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
                <h3 class="maintitle mb-5">Training Videos, Permit Information, and More for Your Driving Success</h3>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="linkBox mb-4  wow fadeInUp">
                    <span class="linkboxtitle">DMV Useful Links</span>
                    <div class="linkFlex">
                    <?php if(!empty($DMV_links->link_name_data)) {
                        $link_name_data = unserialize(@$DMV_links->link_name_data);
                        foreach ($link_name_data as $key) { ?>
                        <div class="linkdesign"><a href="<?= $key['link_dmv']; ?>" target="_blank"><?= $key['link_name_dmv']; ?></a></div>
                        <?php } } ?>
                    </div>
                </div>
                <div class="linkBox  wow fadeInUp">
                    <span class="linkboxtitle">Useful Video Links For New Drivers</span>
                    <div class="linkFlex">
                    <?php if(!empty($Video_links->link_name_data)) {
                        $link_name_data1 = unserialize(@$Video_links->link_name_data);
                        foreach ($link_name_data1 as $key) { ?>
                        <div class="linkdesign"><a href="<?= $key['link_video']; ?>" target="_blank"><?= $key['link_name_video']; ?></a></div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="linkBox  wow fadeInUp">
                    <span class="linkboxtitle">DMV Permit Practice Test</span>
                    <div class="linkFlex">
                    <?php if(!empty($Permit_test->link_name_data)) {
                        $link_name_data1 = unserialize(@$Permit_test->link_name_data);
                        foreach ($link_name_data1 as $key) { ?>
                        <div class="linkdesign"><a href="<?= $key['link_permit']; ?>" target="_blank"><?= $key['link_name_permit']; ?></a></div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<footer class="main-footer">
    <div class="main-footer__middle">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 order-xl-2">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <h3 class="footertitle">Helpful Stuff</h3>
                            <div class="footer-widget">
                                <div class="footer-widget--links">
                                    <ul class="list-unstyled footer-widget__links">
                                        <li><a href="#">DMV Useful Links</a></li>
                                        <li><a href="#">Register For Drivers Ed</a></li>
                                        <li><a href="#">Register For Driving School</a></li>
                                        <li><a href="#">BayHill Traffic School</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <h3 class="footertitle">Quick Links</h3>
                            <div class="footer-widget">
                                <div class="footer-widget--links footer-widget--links2">
                                    <ul class="list-unstyled footer-widget__links">
                                        <li><a href="<?= base_url('terms')?>">Terms & Conditions</a></li>
                                        <li><a href="#">FAQ Drivers Ed</a></li>
                                        <li><a href="#">FAQ Driving School</a></li>
                                        <li><a href="#">In-Car Driving Lessons</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <h3 class="footertitle">Get our app right now</h3>
                            <div class="d-flex gap-3 align-items-center appicon">
                                <div>
                                    <a href="#"><img src="<?= base_url(); ?>assets/images/appstore.png" /></a>
                                </div>
                                <div>
                                    <a href="#"><img src="<?= base_url(); ?>assets/images/google-play.png" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-7">
                    <h3 class="footertitle">Contact Us</h3>
                    <div class="footer-widget footer-widget__right">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="footer-widget--about">
                                    <ul class="list-unstyled footer-widget__info">
                                        <li> <i class="icon-map-pin" aria-hidden="true"></i> <a href="#">3769 Peralta Blvd ,Suite # A, Fremont CA</a></li>
                                        <li> <i class="icon-telephone-call-1" aria-hidden="true"></i> <a href="#">510-943-4301</a></li>
                                        <li> <i class="icon-envelope" aria-hidden="true"></i> <a href="#">Info@bayhilldrivingschool.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer-widget--about">
                                    <ul class="list-unstyled footer-widget__info">
                                        <li> <i class="icon-map-pin" aria-hidden="true"></i> <a href="#">97 E Brokaw Rd, ,San Jose CA</a></li>
                                        <li> <i class="icon-telephone-call-1" aria-hidden="true"></i> <a href="#">408-384-4458</a></li>
                                        <li> <i class="icon-envelope" aria-hidden="true"></i> <a href="#">Info@bayhilldrivingschool.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer-widget--about">
                                    <ul class="list-unstyled footer-widget__info">
                                        <li> <i class="icon-map-pin" aria-hidden="true"></i> <a href="#">4457 Willow Rd, Pleasanton CA 94588</a></li>
                                        <li> <i class="icon-telephone-call-1" aria-hidden="true"></i> <a href="#">925-464-2899</a></li>
                                        <li> <i class="icon-envelope" aria-hidden="true"></i> <a href="#">Info@bayhilldrivingschool.com</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h3 class="footertitle">Social Network</h3>
                                <div class="main-footer__inner-social">
                                    <a href="https://facebook.com/"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                    <a href="https://twitter.com/"><i class="icon-twitter" aria-hidden="true"></i></a>
                                    <a href="https://pinterest.com/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-footer__bottom">
        <div class="container">
            <div class="main-footer__bottom__inner d-lg-flex align-items-center justify-content-between">
                <div class="d-flex gap-4  order-lg-2 mb-3 mb-lg-0">
                    <a href="#" class="text-dark">Terms & Conditions</a>
                </div>
                <p class="main-footer__copyright order-lg-1"> &copy; Copyright <span class="dynamic-year"></span> BayHill. All Rights Reserved. Designed and Developed by <a href="" class="fw-semibold text-primary">GOIGI.COM</a></p>
            </div>
        </div>
    </div>
</footer>
</div>
<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
        <div class="logo-box">
            <a href="<?= base_url(); ?>" aria-label="logo image"><img src="<?= base_url(); ?>assets/images/logo.png" width="155" alt="logo drivschol"></a>
        </div>
        <div class="mobile-nav__container"></div>
    </div>
</div>
<a href="#" data-target="html" class="scroll-to-target scroll-to-top">
    <span class="scroll-to-top__text">back top</span>
    <span class="scroll-to-top__wrapper"><span class="scroll-to-top__inner"></span></span>
</a>
<script src="<?= base_url() ?>assets/vendors/jquery/jquery-3.7.0.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jarallax/jarallax.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-ui/jquery-ui.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-appear/jquery.appear.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/nouislider/nouislider.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/tiny-slider/tiny-slider.js"></script>
<script src="<?= base_url() ?>assets/vendors/wnumb/wNumb.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/owl-carousel/js/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/wow/wow.js"></script>
<script src="<?= base_url() ?>assets/vendors/imagesloaded/imagesloaded.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/isotope/isotope.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-circleType/jquery.circleType.js"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-lettering/jquery.lettering.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>
function navigateToDrivingLesson() {
    const dropdown = document.getElementById("drivinglesson");
    const selectedValue = dropdown.value;
    if (selectedValue) {
        if (selectedValue.startsWith("http")) {
            window.location.href = selectedValue;
        } else {

        }
    }
}
$(document).ready(function () {
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
});
</script>
</body>
</html>