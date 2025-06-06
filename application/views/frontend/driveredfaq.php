<!-- <section class="innerBanner" style="background-image: url(./assets/images/innerbanner.jpg);">
    <div class="container">
        <h2 class="text-center title">FAQ</h2>
    </div>
</section> -->
<section class="pt-5 pb-0 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 class="h2 fw-bold  mb-4"> California Online Drivers Education</h2>
                  <h3 class="h5 fw-bold mb-3 text-primary">DMV Approved Online Drivers Ed – <span class="text-danger">LICENSE # E4716</span></h3>
                <ul class="list-unstyled service-details__list mb-4">
                    <li> <i class="fa fa-check-circle text-success"></i> DMV Certificate of Completion for Driver's Ed</li>
                    <li> <i class="fa fa-check-circle text-success"></i> Self Paced Lessons - No Timers</li>
                    <li> <i class="fa fa-check-circle text-success"></i> DMV Practice Tests at no extra cost </li>
                    <li> <i class="fa fa-check-circle text-success"></i> FAST Shipping of DMV Certificate </li>
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
                    <div class="testimonials-two__carousel__item h4 fw-bold text-center text-white justify-content-center" data-hash="item1">DMV Practice Tests at no extra cost</div>
                    <div class="testimonials-two__carousel__item h4 fw-bold text-center text-white justify-content-center" data-hash="item2">DMV Certificate of Completion</div>
                    <div class="testimonials-two__carousel__item h4 fw-bold text-center text-white justify-content-center" data-hash="item3">FAST Shipping of DMV Certificate</div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-md-flex align-items-center text-center gap-4 text-white justify-content-center">
                    <div class="mb-3 mb-md-0">
                        <a href="#usefullLinks" class="btn btn-warning fw-bold py-2 px-4 rounded-pill">Useful Links</a>
                    </div>
                    <div class="mb-3 mb-md-0">
                        <h2 class="mb-0 fw-bold text-white">$24.99</h2>
                    </div>
                    <div>
                        <h3 class="mb-0 blinking-text h5 text-center"> No Hidden<br> Charges</h3>
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
            <?php if(!empty($driveredfaq_list)) {
            $i = 1;
            foreach ($driveredfaq_list as $faq) { ?>
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