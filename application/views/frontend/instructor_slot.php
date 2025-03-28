<?php
$getinstructor_data = $this->db->query("SELECT * FROM users WHERE id = '".$instructorID."'")->row();
?>
<section class="enrollPnl">
    <div class="container">
        <h2 class="subtitle  wow fadeInUp">Book Instructor Slot</h2>
        <h3 class="maintitle mb-5  wow fadeInUp">Plan your reservation based on<br/> your preferences</h3>
        <div class="boxDateSchdule">
            <form action="payment-details.html">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-lg-5 p-3">
                            <div id="calendar-container" class="mt-0">
                                <div id="calendar"></div>
                                <ul class="mt-30 sloatsInfo">
                                    <li><span style="background-color: #d4edda;"></span> Available Time Slots</li>
                                    <li><span style="background-color: #f0d0d0;"></span> No available slots</li>
                                    <li><span style="background-color: #f5f6fa;"></span> Expired slots</li>
                                </ul>
                            </div>
                            <div id="slot-container" style="display: none;">
                                <div class="text-start"><a href="#" class="text-warning" id="back-to-calendar"><i class="fas fa-chevron-left me-1"></i> Back to Calendar</a></div>
                                <h5 class="h6" id="selected-date">Selected Date:</h5>
                                <div id="slots"></div>
                                <ul class="mt-30 sloatsInfo">
                                    <li><span style="background-color: #d4edda;"></span> Available Time Slots</li>
                                    <li><span style="background-color: #f0d0d0;"></span> No available slots</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-lg-5 p-3 h-100 boxoutput">
                            <p class="text-muted mb-0">Instructor Name</p>
                            <h2 class="h4 mb-15 fw-semibold"><?= $getinstructor_data->salutation." ".$getinstructor_data->first_name." ".$getinstructor_data->last_name; ?></h2>

                            <div class="mt-30 mb-50">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3>4</h3>
                                                <h4>Days In a Week</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-id-card-alt"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3>8</h3>
                                                <h4>Hours Per Week</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3>$ 500</h3>
                                                <h4>Price</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3 class="boxdate">15 Dec, 2024</h3>
                                                <h5 class="boxtime">10:00 am - 12:00 pm</h5>
                                                <h4>Date</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="enrollbtn">Confirm Book Slot</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="whychoose" style="background-image: url(<?= base_url()?>/assets/images/serv-bg-03.jpg);">
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h2 class="maintitle text-white mb-4">Why Take California Driver Ed With Us?</h2>
                <p>Bayhill Driving school established in 2013, have designed an Driving Lessons proven to give you quality driver education, provides a solid foundation of knowledge and skills that can help you to become a safe driver in California. Instructors are fully licensed by the State of California with extensive Behind The Wheel experience. We pride ourselves on providing a patient and supportive style when working with both teens and adults. Each instructor is License and approved by the DMV. All our Instructors act in a professional and courteous manner when giving instructions.</p>
                <div class="mt-5">
                    <a href="<?= base_url()?>faq" class="enrollbtn text-uppercase">Course FAQ</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
const slots = [
    { time: '09:00 am - 11:00 am', status: 'available' },
    { time: '11:00 am - 01:00 pm', status: 'available' },
    { time: '01:00 pm - 02:00 pm', status: 'available' },
    { time: '02:00 pm - 03:00 pm', status: 'available' },
    { time: '03:00 pm - 05:00 pm', status: 'unavailable' },
    { time: '05:00 pm - 07:00 pm', status: 'available' },
    { time: '07:00 pm - 09:00 pm', status: 'available' },
    { time: '09:00 pm - 11:00 pm', status: 'available' },
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
            } else if (month === 5 && (day === 20 || day === 21)) {
                dayElement.addClass('blocked');
            } else {
                dayElement.addClass('available');
                dayElement.click(() => {
                    selectedDate = date.toDateString();
                    const formattedDate = date.toLocaleDateString('default', { day: '2-digit', month: 'short', year: 'numeric' });
                    const formattedSDate = date.toLocaleDateString().split('T')[0];
                    $('.boxdate').text(formattedDate);
                    $('#selected_date').val(formattedSDate);
                    $('#selected-date').text(`Selected Date: ${formattedDate}`);
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
                .change(() => selectSlot(slotElement, slot.time));
            const label = $('<span></span>').text(slot.time);
            slotElement.append(radioButton, label);
            slotsElement.append(slotElement);
        });
    }

    function selectSlot(slotElement, time) {
        selectedSlot = time;
        $('#slots label').removeClass('selected');
        slotElement.addClass('selected');
        $('#selected_time').val(selectedSlot);
        $('.boxtime').text(selectedSlot);
    }

    $('#back-to-calendar').click(function() {
        $('#slot-container').hide();
        $('#calendar-container').show();
    });

    // Set the initial date on load
    selectedDate = today.toDateString();
    const formattedDate = today.toLocaleDateString('default', { day: '2-digit', month: 'short', year: 'numeric' });
    const formattedSDate = today.toLocaleDateString().split('T')[0];
    $('#selected_date').val(formattedSDate);
    $('.boxdate').text(formattedDate);
    $('#selected-date').text(`Selected Date: ${formattedDate}`);
    renderCalendar(today.getMonth(), today.getFullYear());
});
</script>