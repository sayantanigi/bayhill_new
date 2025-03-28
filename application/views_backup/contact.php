

        <div class="section exvent-hero-section d-lg-flex d-block align-items-center inner-page-hero" style="background-image: url(<?=base_url('assets/images/')?>bg/about_page_bg.jpg);">
            <img class="shape-1 img-fluid" src="<?=base_url('assets/images/')?>shape/hero_shape1.png" alt="">
            <img class="shape-2 img-fluid" src="<?=base_url('assets/images/')?>shape/hero_shape2.png" alt="">

            <div class="container">
                <div class="row exvent-hero-row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="page-title">
                            <h2 class="section-title"><?=$page?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-form-section section-padding-02">
            <div class="container">

                <!-- Contact Form Start -->
                <div class="contact-form-wrap">
                    <form method="POST" class="contact-form" id="submitform">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="contact-info mb-4">
                                    <h4 class="contact-label"><i class="fas fa-envelope-open text-warning me-1"></i> Email Us: <a href="#" class="text-warning"><?=@$setting->email?></a></h4>
                                </div>
                                <div class="section-title-wrap text-center">
                                    <div class="section-title">
                                        <h2 class="h2 fw-bold text-uppercase">Send Us A Message</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 justify-content-center">
                            <div class="col-lg-6">
                                <input type="text" class="comment-form-input form-control" placeholder="Your Name" id="name" name="name">
								<small id="name_error"></small>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" class="comment-form-input  form-control" placeholder="Your Email" id="email" name="email">
								<small id="email_error"></small>
                            </div>
                            <div class="col-lg-6">
                                <input type="tel" class="comment-form-input  form-control" placeholder="Phone Number" id="phone" name="phone">
								<small id="phone_error"></small>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="comment-form-input form-control" placeholder="Subject" id="subject" name="subject">
								<small id="subject_error"></small>
                            </div>
                            <div class="col-12">
                                <textarea  placeholder="Your Message" class="comment-form-input  form-control" id="messege" name="messege"></textarea>

                            </div>
							<div class="col-lg-6">
								<div class="row">
									<div class="form-group col-6">
									    <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Enter Captcha" style="height: 38px;">
										<small id="captcha_error"></small>
									</div>
									<div class="form-group col-6">
										<img src="<?=base_url('page/get_captcha')?>" alt="PHP Captcha" id="captcha_img">
									</div>
								</div>
								<p><br>Need another security code? <a href="javascript:void(0)" id="reloadCaptcha" style="color: blue;font-weight: 700;">click</a></p>
							</div>
							<div class="col-lg-6">
							</div>
                            <div class="col-lg-3">
                                <button type="submit" class="submit_btn">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Contact Form End -->
            </div>
        </div>
<script>
$(document).ready(function(){
	$("#submitform").on('submit', function(e){
		e.preventDefault();
		//var form_data = new FormData();

		$.ajax({
		type: 'POST',
		url: '<?php echo base_url('page/submitcontact'); ?>',
		data: new FormData(this) ,
		dataType:"json",
		contentType: false,
		cache: false,
		processData:false,
		error:function(){
		  $('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
		},
		success: function(data){
			if(data.status == 1){
				swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			if(data.status == 0){
				swal({title: "Fail!", text: "<strong>"+data.message+"</strong>", type: "error", showConfirmButton: true, html:true}, function(){ window.location.href = " "});
			}
			if(data.vali_error == 1){


				if(data.name_error != ''){
					$('#name_error').html(data.name_error);
				}else{
					$('#name_error').html('');
				}

				if(data.email_error != ''){
					$('#email_error').html(data.email_error);
				}else{
					$('#email_error').html('');
				}

				if(data.phone_error != ''){
					$('#phone_error').html(data.phone_error);
				}else{
					$('#phone_error').html('');
				}

				if(data.subject_error != ''){
					$('#subject_error').html(data.subject_error);
				}else{
					$('#subject_error').html('');
				}

				if(data.message_error != ''){
					$('#message_error').html(data.message_error);
				}else{
					$('#message_error').html('');
				}

				if(data.captcha_error != ''){
					$('#captcha_error').html(data.captcha_error);
				}else{
					$('#captcha_error').html('');
				}


			}
		}
		});
	});

});

$(document).ready(function(){
	$("#reloadCaptcha").click(function(){
	var captchaImage = $('#captcha_img').attr('src');
	$('#captcha_img').attr('src', captchaImage);
	});
});


</script>