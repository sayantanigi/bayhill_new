<?php $settings = $this->Adminmodel->get('settings', true, 'settingId', 1); ?>
<style>
    body,html{display:flex;align-items:center;justify-content:center;background:#eee;font-family:Arial,sans-serif}
</style>
<body>
    <div class="login-card">
        <img src="<?= base_url('uploads/logos/'.@$settings->logo) ?>" alt="Logo">
        <h2>Sign In</h2>
        <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php $this->session->unset_userdata('success'); }
        if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php $this->session->unset_userdata('error'); }
            $err = validation_errors();
            if ($err) {
        ?>
        <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $err; ?>
        </div>
        <?php } ?>
        <?php if (!empty($this->session->flashdata('already_account'))): ?>
        <?=$this->session->flashdata('already_account') ?>
        <?php endif ?>

        <?php if (!empty($msg)): ?>
        <?=$msg ?>
        <?php endif ?>
        <form action="" method="POST" class="exvent-form">
            <div class="input-field">
                <label for="role">Email</label>
                <input type="email" placeholder="Enter email" name="username" id="username" autocomplete="off" value="<?php if(!empty($_COOKIE["loginId"])) { echo $_COOKIE["loginId"]; } ?>">
                <span class="icon fa fa-envelope"></span>
            </div>

            <div class="input-field">
                <label for="role">Password</label>
                <input type="password" placeholder="Enter password" name="password" id="password" autocomplete="off" value="<?php if(!empty($_COOKIE["loginPass"])) { echo $_COOKIE["loginPass"]; } ?>">
                <span class="icon fa fa-lock"></span>
            </div>
            <a href="<?=base_url('forgetpassword')?>" class="forgot-password">Forgot your password?</a>
            <button type="submit" class="submit_btn fw-semibold login-button">Log in</button>
        </form>
        <div class="signup-link">Don’t have an account yet? <a href="<?=base_url('signup')?>">Sign Up</a></div>
        <a href="<?=base_url('home')?>" class="forgot-password" style="margin-top: 15px;margin-bottom: 0;">Back to homepage</a>
    </div>
</body>
</html>