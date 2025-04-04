<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
	.template_faq {
		background: #edf3fe none repeat scroll 0 0;
	}

	.panel-group {
		background: #fff none repeat scroll 0 0;
		border-radius: 3px;
		box-shadow: 0 5px 30px 0 rgba(0, 0, 0, 0.04);
		margin-bottom: 0;
		padding: 30px;
	}

	#accordion .panel {
		border: medium none;
		border-radius: 0;
		box-shadow: none;
		margin: 0 0 15px 10px;
	}

	#accordion .panel-heading {
		border-radius: 30px;
		padding: 0;
	}

	#accordion .panel-title a {
		background: #f7931e none repeat scroll 0 0;
		border: 1px solid transparent;
		border-radius: 30px;
		color: #fff;
		display: block;
		font-size: 18px;
		font-weight: 600;
		padding: 12px 20px 12px 50px;
		position: relative;
		transition: all 0.3s ease 0s;
	}

	#accordion .panel-title a.collapsed {
		background: #fff none repeat scroll 0 0;
		border: 1px solid #ddd;
		color: #333;
	}

	#accordion .panel-title a::after, #accordion .panel-title a.collapsed::after {
		background: #f7931e none repeat scroll 0 0;
		border: 1px solid transparent;
		border-radius: 50%;
		box-shadow: 0 3px 10px rgba(0, 0, 0, 0.58);
		color: #fff;
		content: "";
		font-family: fontawesome;
		font-size: 25px;
		height: 55px;
		left: -20px;
		line-height: 55px;
		position: absolute;
		text-align: center;
		top: -5px;
		transition: all 0.3s ease 0s;
		width: 55px;
	}

	#accordion .panel-title a.collapsed::after {
		background: #fff none repeat scroll 0 0;
		border: 1px solid #ddd;
		box-shadow: none;
		color: #333;
		content: "";
	}

	#accordion .panel-body {
		background: transparent none repeat scroll 0 0;
		border-top: medium none;
		padding: 20px 25px 10px 9px;
		position: relative;
	}

	#accordion .panel-body p {
		border-left: 1px dashed #8c8c8c;
		padding-left: 25px;
	}
	ul, ol {
		padding: 0 !important;
		list-style: auto;
		margin: 0 !important;
	}

</style>


<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

<div class="section exvent-hero-section d-lg-flex d-block align-items-center inner-page-hero" style="background-image: url(<?=base_url('assets/images/')?>bg/about_page_bg.jpg);">
	<img class="shape-1 img-fluid" src="<?=base_url('assets/images/')?>shape/hero_shape1.png" alt="">
	<img class="shape-2 img-fluid" src="<?=base_url('assets/images/')?>shape/hero_shape2.png" alt="">

	<div class="container">
		<div class="row exvent-hero-row justify-content-center">
			<div class="col-lg-8 text-center">
				<div class="page-title">
					<h2 class="section-title"><?=@$page?></h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="about-section about-page section-padding-03">
	<div>
		<div class="container">
			<div class="row">				
				<div class="col-md-12">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<?php $faq = !empty($faqs) ? $faqs : '';
					if (is_array($faq) || is_object($faq)) {
					$i = 1 ;
					foreach($faq as $getfaq): ?>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading<?php echo !empty($i) ? $i : ''; ?>">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo !empty($i) ? $i : ''; ?>" aria-expanded="<?php echo ($i == 1) ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo !empty($i) ? $i : ''; ?>" class="<?php echo ($i == 1) ? '' : 'collapsed'; ?>">
										<?php echo !empty($getfaq->question) ? $getfaq->question : ''; ?>
									</a>
								</h4>
							</div>
							<div id="collapse<?php echo !empty($i) ? $i : ''; ?>" class="panel-collapse collapse <?php echo ($i == 1) ? 'in' : ''; ?> <?php echo ($i == 1) ? 'show' : ''; ?>" role="tabpanel" aria-labelledby="heading<?php echo !empty($i) ? $i : ''; ?>">
								<div class="panel-body">
									<?php echo !empty($getfaq->answer) ? $getfaq->answer : ''; ?> 
								</div>
							</div>
						</div>
					<?php $i++; endforeach; } ?> 
					</div>
				</div><!--- END COL -->		
			</div><!--- END ROW -->			
        </div>
	</div>
</div>  
 
<script>
(function($) {
	'use strict';
	jQuery(document).on('ready', function(){
			$('a.page-scroll').on('click', function(e){
				var anchor = $(this);
				$('html, body').stop().animate({
					scrollTop: $(anchor.attr('href')).offset().top - 50
				}, 1500);
				e.preventDefault();
			});		
	}); 	
})(jQuery);
</script>	 