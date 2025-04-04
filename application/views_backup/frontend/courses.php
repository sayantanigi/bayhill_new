<section class="courseListpnl">
    <div class="container">
        <h2 class="subtitle wow fadeInUp">Course List</h2>
        <h3 class="maintitle mb-4 wow fadeInUp">Driving Course Details and Offerings</h3>
        <div class=" wow fadeInUp">
            <form>
                <div class="d-flex zipsearch mb-5">
                    <input type="text" placeholder="Enter ZIP Code" name="pincode" id="pincode" title="Please enter a valid ZIP code" value="<?= htmlspecialchars($pincode) ?>" />
                    <button class="flex-fill" type="button" onclick="searchByPincode()">Search by ZIP Code</button>
                </div>
            </form>
        </div>
        <div id="loader" style="display:none; text-align: center; position: absolute; z-index: 1; width: 100%;">
            <img src="<?= base_url()?>assets/images/loader.gif" alt="Loading...">
        </div>
        <div class="row g-4" id="course_data_list" style="position: relative;">
            <?php 
            if(!empty($course_list)) { 
            foreach ($course_list as $course) { ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="package-card">
                    <div class="package-card__head">
                        <div class="package-card__head__item">
                            <span class="package-card__head__item__price"> <sub>$</sub> <?= $course->course_price; ?></span>
                            <div class="package-card__head__item__shape__one">
                                <svg width="90" height="95" viewBox="0 0 90 95" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M90 -0.000350952L0 69.6066L90 94.9996V-0.000350952Z" fill="" fill-opacity="0.06" />
                                </svg>
                            </div>
                            <div class="package-card__head__item__shape__two">
                                <svg width="60" height="64" viewBox="0 0 60 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.789585 63.2843L59.4571 16.7158L0.00060816 0.747339L0.789585 63.2843Z" fill="" fill-opacity="0.06" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="package-card__body">
                        <h3 class="package-card__body__title"><?= $course->course_name; ?></h3>
                        <div class="pt-3">
                            <h5 class="h6 text-center mb-3 fw-bold text-primary">This Package Includes  </h5>
                            <ul class="listBoxcourse">
                                <?php 
                                $decodedContent = htmlspecialchars_decode($course->course_description); 
                                echo $cleanedContent = str_replace(['<ul>', '</ul>'], '', $decodedContent);
                                ?>
                            </ul>
                        </div>
                        <form method="POST" action="<?= base_url() ?>student_form" class="package-card__body__btn text-center">
                            <input type="hidden" name="course_id" value="<?= $course->id?>">
                            <button type="submit" class="drivschol-btn w-100">Select Package</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php } } else { ?>
            <div class="col-lg-12 col-md-12 wow fadeInUp">No data found related to <?= htmlspecialchars($pincode) ?> zipcode.</div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="cta-one">
    <div class="cta-one__wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="cta-one__content wow fadeInUp" data-wow-delay='200ms'>
                        <h3 class="cta-one__title">Book by Trainer</h3>
                        <a href="student_form" class="drivschol-btn"><span>Book Now</span></a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="cta-one__thumb">
                        <div class="cta-one__thumb__one wow fadeInUp" data-wow-delay="300ms">
                            <div class="cta-one__thumb__one__thumb">
                                <img src="<?= base_url()?>assets/images/car.png" alt="drivschol">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cta-one__element">
            <img src="<?= base_url()?>assets/images/pattern.png" alt>
        </div>
    </div>
</section>
<style>
.drivschol-btn {padding: 12px 46px; font-size: 16px; font-style: normal; font-weight: 700; line-height: 162.5%; border-radius: 30px;}
.package-card__body__btn button::after {
  background-color: var(--theme-primary, #EC2526);
}
.package-card__body__btn button:hover {
  color: var(--drivschol-white, #fff);
}
</style>
<script>
function searchByPincode() {
    var pincode = $('#pincode').val();
    if(pincode != ''){
        $('#pincode').css({'border': '1px solid #000'});
        $.ajax({
            url:  "<?= base_url('search_course')?>",
            type: 'POST',
            data: {pincode: pincode},
            //dataType: 'json',
            beforeSend: function () {
                $('#course_data_list').html('');
                $('#loader').show();
                $('#loader').css('position','unset');
            },
            success: function (returndata) {
                setTimeout(() => {
                    $('#loader').hide();
                    $('#course_data_list').html(returndata).fadeIn(2000);
                }, 5000);
                
            }
        });
    } else {
        $('#pincode').css({'color':'red', 'border': '1px solid red'});
        $('#pincode').prop('placeholder','Enter a valid ZIP code');
    }
}
</script>