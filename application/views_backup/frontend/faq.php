<section class="innerBanner" style="background-image: url(./assets/images/innerbanner.jpg);">
    <div class="container">
        <h2 class="text-center title">FAQ</h2>
    </div>
</section>
<section class="faqpnl">
    <div class="container">
        <h3 class="text-center mb-5 fw-semibold h2">Frequently Asked Questions</h3>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php if(!empty($faq_list)) {
            $i = 1;
            foreach ($faq_list as $faq) { ?>
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