<section class="innerBanner" style="background-image: url(./assets/images/innerbanner.jpg);">
    <div class="container">
        <h2 class="text-center title">FAQ</h2>
    </div>
</section>
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
<section class="whychoose" style="background-image: url(<?= base_url(); ?>assets/images/bg-cover-01.jpg);">
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h2 class="maintitle text-white mb-4">Why Take California Driver Ed With Us?</h2>
                <p>Bay Hill Driving School, established in 2010, offers high-quality driver education designed to help you become a safe and confident driver in California. Our DMV-approved instructors are fully licensed and bring years of behind-the-wheel experience, providing patient, supportive training for both teens and adults. We pride ourselves on professional, courteous instruction tailored to your needs—whether you're just starting out, brushing up your skills, or preparing for the DMV driving test.</p>
                <div class="mt-5">
                    <a href="<?= base_url('faq'); ?>" class="enrollbtn text-uppercase">Course FAQ</a>
                </div>
            </div>
        </div>
    </div>
</section>