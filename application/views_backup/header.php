<?php $settings = $this->Adminmodel->get('settings', true, 'settingId', 1); ?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <title><?= @$title ?> | <?= @$page ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>assets/images/favicon.png">
   
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/animate/animate.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/jarallax/jarallax.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/nouislider/nouislider.pips.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/tiny-slider/tiny-slider.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/icons/style.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/owl-carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class="custom-cursor">
    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>
    <div class="preloader">
        <div class="preloader__image" style="background-image: url(<?= base_url()?>assets/images/loader.png);"></div>
    </div>
    <div class="page-wrapper">
        <header class="main-header main-header--three sticky-header sticky-header--normal">
            <div class="container">
                <div class="main-header__inner">
                    <div class="main-header__logo">
                        <a href="<?= base_url()?>">
                            <img src="<?= base_url('uploads/logos/' . @$settings->logo) ?>" alt="<?= @$settings->title?>">
                        </a>
                    </div>
                    <nav class="main-header__nav main-menu">
                        <ul class="main-menu__list">
                            <li><a href="<?= base_url() ?>" class="<?= (current_url() == base_url()) ? 'active' : '' ?>">In-Car Driving Lessons</a></li>
                            <li><a href="<?= base_url('drivers-ed') ?>" class="<?= (current_url() == base_url('drivers-ed')) ? 'active' : '' ?>">Drivers Ed</a></li>
                            <li><a href="<?= base_url('faq') ?>" class="<?= (current_url() == base_url('faq')) ? 'active' : '' ?>">FAQ</a></li>
                            <li><a href="<?= base_url('contact') ?>" class="<?= (current_url() == base_url('contact')) ? 'active' : '' ?>">Contact</a></li>
                        </ul>
                        <div class="mobile-nav__btn mobile-nav__toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </nav>
                </div>
            </div>
        </header>