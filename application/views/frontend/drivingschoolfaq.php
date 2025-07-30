<!-- <section class="innerBanner" style="background-image: url(./assets/images/innerbanner.jpg);">
    <div class="container">
        <h2 class="text-center title">FAQ</h2>
    </div>
</section> -->
<section class="pt-5 pb-0 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 class="h2 fw-bold  mb-4"> BEHIND THE WHEEL DRIVING LESSONS</h2>
                  <h3 class="h5 fw-bold mb-3 text-primary">DMV Approved Driving Lesson – <span class="text-danger">LICENSE # E4716</span></h3>
                <ul class="list-unstyled service-details__list mb-4">
                    <li> <i class="fa fa-check-circle text-success"></i> Private one-on-one lessons</li>
                    <li> <i class="fa fa-check-circle text-success"></i> Clean and very well maintained Vehicles</li>
                    <li> <i class="fa fa-check-circle text-success"></i> Free pick-up and drop-off</li>
                    <li> <i class="fa fa-check-circle text-success"></i> Experienced, patient and positive instructors</li>
                </ul>
            </div>
            <div class="col-lg-5 text-center">
                <img src="<?= base_url(); ?>assets/images/faq.png">
            </div>
        </div>
    </div>
</section>
<section class="py-4 bg-primary">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="testimonials-two__carousel drivschol-owl__carousel drivschol-owl__carousel--with-shadow drivschol-owl__carousel--basic-nav owl-carousel owl-theme p-0" data-owl-options='{
                        "items": 1,
                        "margin": 0,
                        "smartSpeed": 700,
                        "loop":true,
                        "autoplay": true,
                        "nav":false,
                        "URLhashListener":true,
                        "dots":false,

                        "responsive": {
                            "0": {
                                "items": 1
                            },
                            "500": {
                                "items": 1
                            }
                        }
                    }'>
                    <div class="testimonials-two__carousel__item h4 fw-bold text-center text-white justify-content-center" data-hash="item1">Clean & well maintained Vehicles</div>
                    <div class="testimonials-two__carousel__item h4 fw-bold text-center text-white justify-content-center" data-hash="item2">Free pick-up and drop-off</div>
                    <div class="testimonials-two__carousel__item h4 fw-bold text-center text-white justify-content-center" data-hash="item3">Expereinced Instructors</div>
                    <div class="testimonials-two__carousel__item h4 fw-bold text-center text-white justify-content-center" data-hash="item4">Private one-on-one lessons</div>


                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-md-flex align-items-center text-center gap-4 text-white justify-content-center">
                    <div class="mb-3 mb-md-0">
                        <a href="<?= base_url('')?>/#enrollnow" class="btn btn-warning fw-bold py-2 px-4 rounded-pill">Register for Driving Lessons</a>
                    </div>
                    <div>
                        <h3 class="mb-0 blinking-text h5 text-center"> In-Car <br> Driving Lessons</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faqpnl">
    <div class="container">
        <h3 class="text-center mb-5 fw-bold h2">Frequently Asked Questions</h3>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php if(!empty($drivingschoolfaq_list)) {
            $i = 1;
            foreach ($drivingschoolfaq_list as $faq) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i?>" aria-expanded="false" aria-controls="flush-collapse<?= $i?>">
                        <?= @$faq->question; ?>
                    </button>
                </h2>
                <div id="flush-collapse<?= $i?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"><?= @$faq->answer; ?></div>
                </div>
            </div>
            <?php $i++; } } else { ?>
            <div id="flush-collapse" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">No FAQ Available</div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>