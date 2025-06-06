<?php $site_setting = $this->db->query("select * from  settings")->row(); ?>
<?php //if (current_url() != base_url('faq') && current_url() != base_url('courses') && current_url() != base_url('course/course_details') && current_url() != base_url('booking_slot') && current_url() != base_url('instructor-slot') && current_url() != base_url('login') && current_url() != base_url('login') && current_url() != base_url('complete-payment')) { ?>
<section class="howitworkspnl <?php if (current_url() == base_url('contact')) { echo 'd-none'; }?>">
    <div class="container">
        <h3 class="mb-5 text-white wow fadeInUp animated h3 fw-bold text-center">" Bay Area’s trusted choice since 2010, driven by excellence and community care."</h3>
        <div class="row align-items-center ">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="500ms">
                <div class="d-flex mb-4 gap-4 worksPnl">
                    <div>
                        <img src="<?= base_url(); ?>assets/images/icon/steering-wheel.png" />
                    </div>
                    <div>
                        <h5 class="fw-semibold text-warning"> Schedule Your Driving Lessons Online 24/7!</h5>
                        <p class="text-white">Schedule your Driving Lessons online 24/7 at your preferred date and time based on availability, including free pick-up and drop-off.</p>
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
                <div class="videoBg position-relative wow fadeInRight" data-wow-delay="500ms">
                        <img src="assets/images/carimg.gif" />
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
<section class="satisfactionPnl <?php if (current_url() == base_url('contact')) { echo 'd-none'; }?>">
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
<section class="whychoose" style="background-image: url(<?= base_url(); ?>assets/images/bg-cover-01.jpg); <?php if (current_url() == base_url('contact')) { echo 'd-none'; }?>">
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h2 class="maintitle text-white mb-4">Why Take California Driver Ed With Us?</h2>
                <p>Bay Hill Driving School, established in 2010, offers high-quality driver education designed to help you become a safe and confident driver in California. Our DMV-approved instructors are fully licensed and bring years of behind-the-wheel experience, providing patient, supportive training for both teens and adults. We pride ourselves on professional, courteous instruction tailored to your needs—whether you're just starting out, brushing up your skills, or preparing for the DMV driving test.</p>
                <div class="mt-5">
                    <a href="<?= base_url('/'); ?>" class="enrollbtn text-uppercase">Register Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonials-one">
    <div class="testimonials-one__bg" style="background-image: url();"></div>
    <div class="container">
        <div class="sec-title2  text-center wow fadeInUp" data-wow-duration='300ms'>
            <h3 class="maintitle ">
                <a href="https://g.page/r/CRwffcsmrin8EAE/review" target="_blank"><img src="<?= base_url(); ?>assets/images/google-review.png" height="100"></a></h3>
        </div>
        <div class="testimonials-one__carousel1 drivschol-owl__carousel drivschol-owl__carousel--with-shadow drivschol-owl__carousel--basic-nav owl-carousel"
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
                            <p class="testimonials-card__top__designation">My instructors name was Stacey and she was extremely helpful for every lesson I had her with. She would do visual demonstrations, give tips, pointers and more. Her tips have helped me not only pass my driving test, but also become a safer driver as well. I recommend anybody deciding on taking Bay Hill Driving School to request Stacey as your instructor because she is a very nice and good driving instructor.</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/travis.png" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Travis</a></h5>
                                <span class="testimonials-card__author__degeneration">2 weeks ago</span>
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
                            <p class="testimonials-card__top__designation">I was really nervous about learning to drive, but Bay Hill Driving School made the experience so smooth and encouraging. My instructor was patient, supportive, and always believed in me. Thanks to them, I passed my test with confidence. I’m truly grateful and highly recommend them to anyone learning to drive.</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/profile_default.png" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Manpreet Aulakh</a></h5>
                                <span class="testimonials-card__author__degeneration">a week ago</span>
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
                            <p class="testimonials-card__top__designation">Hi, I took classes from Stacey. I had license but due to personal health issues I did not drive many years. I was very scared. She is so wonderful and gave me much confidence about driving. She gave me valuable tips, guidance and joy for driving. She is a gem. I strongly recommend taking classes from her. You will be winner in driving.</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/sriparna.png" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Sriparna</a></h5>
                                <span class="testimonials-card__author__degeneration">a week ago</span>
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
                            </div>
                            <p class="testimonials-card__top__designation">Overall I recommend Bay Hill! My first driving instructor wasn't very helpful, but I requested a different instructor for my second lesson. Stacey's lessons were really helpful. She taught the essential driving rules and pointed out my mistakes. The third lesson was super helpful since she told me everything I needed to know for the driving test, including giving you a sample score sheet (I passed on the first try!) On the third lesson, we also did a practice drive test and practiced parallel parking (not on the test but still good to know). She is very friendly and also has great stories that are fun to listen to while you drive. :) If you're going to do behind-the-wheel lessons with Bayhill, I recommend that you request Stacey!</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/maya.png" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Maya Shih</a></h5>
                                <span class="testimonials-card__author__degeneration">a month ago</span>
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
                            <p class="testimonials-card__top__designation">Had a session with John and I really recommend him! He’s extremely knowledgeable, personable, and competent instructor. He taught me well and even brought to my attention some things I had never considered before, like for example why placing your hands straight on the steering wheel is the ideal placement.</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/ishita.png" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Ishita Singh</a></h5>
                                <span class="testimonials-card__author__degeneration">2 weeks ago</span>
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
                            <p class="testimonials-card__top__designation">I had a great experience learning to drive with Bay Hill Driving school! Their instructors are extremely knowledgeable and helpful. They patiently explain the rules and techniques required to learn and pass the DMV exam! Highly recommend them to anyone looking for a good driving school!</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/Kriti.png" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Kriti Gangahar</a></h5>
                                <span class="testimonials-card__author__degeneration">2 weeks ago</span>
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
                            <p class="testimonials-card__top__designation">I highly recommend Bay Hill Driving School! I passed my Behind the Wheel Test today March 13, 2025 on a rainy day with only 2 points deduction. This is all possible because my instructors are very patient with me, professionals beyond compare and very detailed on what do on the road and during the test. Miss Veronica is exceptional doing my final practise before the test. Thank you Bay Hill Driving School!</p>
                        </div>
                        <div class="testimonials-card__author">
                            <div class="testimonials-card__author__image">
                                <img src="<?= base_url(); ?>assets/images/profile_default.png" alt="Theresa Webb">
                            </div>
                            <div class="testimonials-card__author__content">
                                <h5 class="testimonials-card__author__name"><a href="#">Thomas Sandoval</a></h5>
                                <span class="testimonials-card__author__degeneration">a month ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="yelpreview  wow fadeInUp <?php if (current_url() == base_url('contact')) { echo 'd-none'; }?>">
    <div class="container">
        <div class="sec-title2  text-center wow fadeInUp" data-wow-duration='300ms'>
            <h3 class="maintitle text-white"><a href="https://www.yelp.com/biz/bay-hill-driving-school-fremont#reviews" target="_blank"> <img src="<?= base_url(); ?>assets/images/yelp-review.png" height="140"> </a></h3>
        </div>
        <div class="">
            <div class="testimonials-one__carousel drivschol-owl__carousel drivschol-owl__carousel--with-shadow drivschol-owl__carousel--basic-nav owl-carousel" data-owl-options='{
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
                                <p class="testimonials-card__top__designation">Jasniel Singh was a professional and great driving teacher for my son, James. He was on time and taught my son avoiding all the mistakes that others had. My son passed the driving test at the Fremont DMV for the first time.</p>
                            </div>
                            <div class="testimonials-card__author">
                                <div class="testimonials-card__author__image">
                                    <img src="<?= base_url(); ?>assets/images/profile_default.png" alt="Theresa Webb">
                                </div>
                                <div class="testimonials-card__author__content">
                                    <h5 class="testimonials-card__author__name"><a href="#"> Vivian H.</a></h5>
                                    <span class="testimonials-card__author__degeneration">Union City, CA</span>
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
                                <p class="testimonials-card__top__designation">So far so good. Preparation and course for written test was good and simple enough for my son to go through. Just paid for the required driving course so we'll see how that goes...</p>
                            </div>
                            <div class="testimonials-card__author">
                                <div class="testimonials-card__author__image">
                                    <img src="<?= base_url(); ?>assets/images/JeffD.jpg" alt="Theresa Webb">
                                </div>
                                <div class="testimonials-card__author__content">
                                    <h5 class="testimonials-card__author__name"><a href="#">Jeff D.</a></h5>
                                    <span class="testimonials-card__author__degeneration">Fremont, CA</span>
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
                                <p class="testimonials-card__top__designation">They did a great job preparing my 16-year old son for his driver's license test. The folks at the office were very cordial and flexible with scheduling his lessons. A big shout out to Saurab whom my son called a great driving instructor and is recommending to his friends.</p>
                            </div>
                            <div class="testimonials-card__author">
                                <div class="testimonials-card__author__image">
                                    <img src="<?= base_url(); ?>assets/images/EricD.jpg" alt="Theresa Webb">
                                </div>
                                <div class="testimonials-card__author__content">
                                    <h5 class="testimonials-card__author__name"><a href="#">Eric D.</a></h5>
                                    <span class="testimonials-card__author__degeneration">Fremont, CA</span>
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
                                <p class="testimonials-card__top__designation">Super easy and straightforward class for your traffic ticket needs. Signed up for in-person class, was good and simple.</p>
                            </div>
                            <div class="testimonials-card__author">
                                <div class="testimonials-card__author__image">
                                    <img src="<?= base_url(); ?>assets/images/MayA.jpg" alt="Theresa Webb">
                                </div>
                                <div class="testimonials-card__author__content">
                                    <h5 class="testimonials-card__author__name"><a href="#">May A</a></h5>
                                    <span class="testimonials-card__author__degeneration">Fremont, CA</span>
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
                                <p class="testimonials-card__top__designation">Great driving school with wonderful instructors. Had both of them and each one care. They made me feel comfortable behind the wheel. Taught me how to be a better driver. With their assistance, I passed the driving test. I highly recommend this school. Thanks Bay Hill!</p>
                            </div>
                            <div class="testimonials-card__author">
                                <div class="testimonials-card__author__image">
                                    <img src="<?= base_url(); ?>assets/images/SamsonW.jpg" alt="Theresa Webb">
                                </div>
                                <div class="testimonials-card__author__content">
                                    <h5 class="testimonials-card__author__name"><a href="#">Samson W.</a></h5>
                                    <span class="testimonials-card__author__degeneration">Milpitas, CA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="usefullLink" id="usefullLinks <?php if (current_url() == base_url('contact')) { echo 'd-none'; }?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-8  wow fadeInUp">
                <h2 class="subtitle">Useful Links</h2>
                <h3 class="maintitle mb-5">Training Videos, Permit Information, and More for Your Driving Success</h3>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="linkBox mb-4  wow fadeInUp leftLinkbox">
                    <span class="linkboxtitle">DMV Useful Links</span>
                    <div class="linkFlex">
                    <?php if(!empty($DMV_links->link_name_data)) {
                        $link_name_data = unserialize(@$DMV_links->link_name_data);
                        foreach ($link_name_data as $key) { ?>
                        <div class="linkdesign"><a href="<?= $key['link_dmv']; ?>" target="_blank"><?= $key['link_name_dmv']; ?></a></div>
                        <?php } } ?>
                    </div>
                </div>
                <div class="linkBox  wow fadeInUp leftLinkbox">
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
<?php //} ?>

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
                                        <li><a href="<?= base_url('')?>#usefullLinks">DMV Useful Links</a></li>
                                        <li><a href="https://bayhilldrivingschool.com/register.php" target="_blank">Register For Drivers Ed</a></li>
                                        <li><a href="<?= base_url('')?>">Register For Driving School</a></li>
                                        <li><a href="https://bayhilltrafficschool.com/" target="_blank">BayHill Traffic School</a></li>
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
                                        <li><a href="<?= base_url('driver-ed-faq')?>">FAQ Drivers Ed</a></li>
                                        <li><a href="<?= base_url('driving-school-faq')?>">FAQ Driving School</a></li>
                                        <li><a href="<?= base_url('/')?>">In-Car Driving Lessons</a></li>
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
                    <a href="<?= base_url('terms')?>" class="text-dark">Terms & Conditions</a>
                </div>
                <p class="main-footer__copyright order-lg-1"> &copy; Copyright <span class="dynamic-year"></span> BayHill. All Rights Reserved. Designed and Developed by <a href="https://www.goigi.com/" target="_blank" class="fw-semibold text-primary">GOIGI.COM</a></p>
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
document.addEventListener("DOMContentLoaded", function () {
    const wordLimit = 38;
    const testimonials = document.querySelectorAll(".testimonials-card__top__designation");
    testimonials.forEach(paragraph => {
        const fullText = paragraph.textContent.trim();
        const words = fullText.split(/\s+/);
        if (words.length <= wordLimit) return;
        const shortText = words.slice(0, wordLimit).join(" ") + "...";
        const showMoreBtn = document.createElement("a");
        showMoreBtn.href = "#";
        showMoreBtn.className = "show-more-btn";
        showMoreBtn.style.color = "#007bff";
        showMoreBtn.style.display = "inline-block";
        showMoreBtn.style.marginTop = "0px";
        showMoreBtn.style.marginLeft = "10px";
        showMoreBtn.textContent = " Show More";
        let expanded = false;
        // Replace text with short version initially
        paragraph.textContent = shortText;
        paragraph.appendChild(showMoreBtn);
        showMoreBtn.addEventListener("click", function (e) {
            e.preventDefault();
            expanded = !expanded;
            paragraph.textContent = expanded ? fullText : shortText;
            paragraph.appendChild(showMoreBtn);
            showMoreBtn.textContent = expanded ? " Show Less" : " Show More";
        });
    });
});
</script>
</body>
</html>