<?php $site_setting = $this->db->query("select * from  settings")->row(); ?>
<section class="yelpreview  wow fadeInUp">
    <div class="container">
        <div class="yelpBox">
            <div class="row g-5 justify-content-between align-items-center">
                <div class="col-lg-8">
                    <h2 class="h5 mb-3">Why Take California Driver Ed With Us?</h2>
                    <p>We help teens and families navigate through their first-time driver experience to ensure
                        that it is stress, worry and speedbump free. Our courses can be completed on any mobile
                        device and will automatically save your progress each time you log out. Join thousands
                        of teens who chose First Time Driver for their online driver education and get ready to earn
                        your California Learner’s Permit. Join thousands of teens who chose First Time Driver for
                        their online driver education and get ready to earn your California Learner’s Permit. Find
                        our course now.</p>
                    <div class="mt-3">
                        <a href="<?= base_url()?>faq" class="enrollbtn">Course FAQ</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <img src="<?= base_url()?>assets/images/yelp.png" class="yelplogo"/>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="main-footer">
    <div class="main-footer__top">
        <div class="container">
            <div class="main-footer__inner">
                <a href="<?= base_url()?>" class="main-footer__inner-logo">
                    <img src="<?= base_url('uploads/logos/' . @$site_setting->logo) ?>" width="174" alt="<?= @$site_setting->title?>">
                </a>
            </div>
        </div>
    </div>
    <div class="main-footer__middle">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-2">
                    <h3 class="footertitle">Helpful Stuff</h3>
                    <div class="footer-widget">
                        <div class="footer-widget--links">
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="#">DMV Useful Links</a></li>
                                <li><a href="#">Register For Drivers Ed</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-2">
                    <h3 class="footertitle">Quick Links</h3>
                    <div class="footer-widget">
                        <div class="footer-widget--links footer-widget--links2">
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="#">FAQ Drivers Ed</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-5">
                    <h3 class="footertitle">Contact Us</h3>
                    <div class="footer-widget footer-widget__right">
                        <div class="footer-widget--about">
                            <ul class="list-unstyled footer-widget__info">
                                <li> 
                                    <i class="icon-telephone-call-1" aria-hidden="true"></i> 
                                    <a href="#"><?= @$site_setting->phone?></a>
                                </li>
                                <li> 
                                    <i class="icon-envelope" aria-hidden="true"></i> 
                                    <a href="#"><?= @$site_setting->email?></a>
                                </li>
                                <li>
                                    <i class="icon-map-pin" aria-hidden="true"></i>
                                    <a href="#"><?= @$site_setting->address?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <h3 class="footertitle">Social Network</h3>
                    <div class="main-footer__inner-social">
                        <a href="<?= $site_setting->facebook; ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                        <a href="<?= $site_setting->twitter; ?>"><i class="icon-twitter" aria-hidden="true"></i></a>
                        <a href="<?= $site_setting->linkedin; ?>"><i class="fab fa-linkedin-in"></i></a>
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
                    <a href="#" class="text-dark">Privacy Policy</a>
                </div>
                <p class="main-footer__copyright order-lg-1"> &copy; Copyright <span class="dynamic-year"></span> <?= @$site_setting->title?>. All Rights Reserved. Designed and Developed by <a href="" class="fw-semibold text-primary">GOIGI.COM</a></p>
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
            <a href="<?= base_url()?>" aria-label="logo image">
                <img src="<?= base_url('uploads/logos/' . @$site_setting->logo) ?>" width="155" alt="<?= @$site_setting->title?>">
            </a>
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
document.getElementById('drivinglesson').addEventListener('change', function () {
    if (this.value === 'teenclasses') {
        $('#lessonsModal').modal('show');
    }
});
const slots = [
    { time: '09:00 - 10:30 am', status: 'available' },
    { time: '10:30 - 12:00 pm', status: 'available' },
    { time: '12:00 - 01:30 pm', status: 'available' },
    { time: '01:30 - 03:00 pm', status: 'available' },
    { time: '03:00 - 04:30 pm', status: 'unavailable' },
    { time: '04:30 - 06:00 pm', status: 'available' },
    { time: '06:00 - 07:30 pm', status: 'available' },
    { time: '07:30 - 09:00 pm', status: 'available' },
    { time: '09:00 - 10:30 pm', status: 'available' }
];

let selectedSlot = null;

$(function() {
    const calendarElement = $('#calendar');
    const today = new Date();
    let selectedDate = null;

    function renderCalendar(month, year) {
        calendarElement.empty();
        const firstDay = new Date(year, month).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const monthYearHeader = $('<div></div>').addClass('month-year-header');
        const prevButton = $('<button><i class="fas fa-chevron-left"></i></button>').click(() => {
            if (month === 0) {
                renderCalendar(11, year - 1);
            } else {
                renderCalendar(month - 1, year);
            }
        });
        const nextButton = $('<button><i class="fas fa-chevron-right"></i></button>').click(() => {
            if (month === 11) {
                renderCalendar(0, year + 1);
            } else {
                renderCalendar(month + 1, year);
            }
        });
        const monthYearText = $('<span></span>').text(`${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`);

        monthYearHeader.append(prevButton, monthYearText, nextButton);
        calendarElement.append(monthYearHeader);

        const dayNames = $('<div></div>').addClass('day-names');
        ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].forEach(day => {
            dayNames.append($('<div></div>').text(day));
        });
        calendarElement.append(dayNames);

        const daysGrid = $('<div></div>').addClass('days-grid');
        for (let i = 0; i < firstDay; i++) {
            daysGrid.append($('<div></div>'));
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            let dayElement = $('<div></div>').text(day);

            if (date < today.setHours(0, 0, 0, 0)) {
                dayElement.addClass('disabled');
            }else if (month === 5 && (day === 20 || day === 21)) {
                dayElement.addClass('blocked');
            } else {
                dayElement.addClass('available');
                dayElement.click(() => {
                    selectedDate = date.toDateString();
                    $('#selected-date').text(`Selected Date: ${selectedDate}`);
                    $('#calendar-container').hide();
                    $('#slot-container').show();
                    renderSlots();
                });
            }

            if (date.toDateString() === new Date().toDateString()) {
                dayElement.addClass('today');
            }
            daysGrid.append(dayElement);
        }
        calendarElement.append(daysGrid);
    }

    function renderSlots() {
        const slotsElement = $('#slots');
        slotsElement.empty();
        slots.forEach(slot => {
            const slotElement = $('<label></label>').addClass(slot.status);
            const radioButton = $('<input>')
                .attr('type', 'radio')
                .attr('name', 'slot')
                .attr('disabled', slot.status === 'unavailable')
                .change(() => selectSlot(slot.time));
            const label = $('<span></span>').text(slot.time);
            slotElement.append(radioButton, label);
            slotsElement
            .append(slotElement);
        });
    }

    function selectSlot(time) {
        selectedSlot = time;
    }

    $('#back-to-calendar').click(function() {
        $('#slot-container').hide();
        $('#calendar-container').show();
    });

    renderCalendar(today.getMonth(), today.getFullYear());
});
</script>
</body>
</html>