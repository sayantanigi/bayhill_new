<?php $settings = $this->Adminmodel->get('settings', true, 'settingId', 1); ?>
<style>
    body,html{display:flex;align-items:center;justify-content:center;background:#eee;font-family:Arial,sans-serif}
</style>
<div class="form-container">
    <div class="logo">
        <img src="<?= base_url('uploads/logos/'.@$settings->logo) ?>" alt="Logo">
    </div>
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
    <h1>Create Your Account</h1>
    <form action="<?= base_url('Login/register')?>" method="POST" id="signupForm">
        <div class="input-field">
            <input type="text" name="fname" id="fname" placeholder="Enter your First name" required>
        </div>
        <div class="input-field">
            <input type="text" name="lname" id="lname" placeholder="Enter your Last name" required>
        </div>
        <div class="input-field">
            <input type="email" name="email" id="email" placeholder="Enter email" required>
            <span class="icon fa fa-envelope"></span>
        </div>
        <div class="input-field">
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            <span class="icon fa fa-lock"></span>
        </div>
        <div class="input-field">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter confirm password" required>
            <span class="icon fa fa-lock"></span>
        </div>
        <div class="input-field">
            <select name="user_type" id="user_type" required>
                <option value="">Select Role</option>
                <?php if(!empty($role_list)) {
                    foreach ($role_list as $value) { ?>
                <option value="<?= @$value->id?>"><?= @$value->name; ?></option>
                <?php } } else { ?>
                <option value="">No Data</option>
                <?php } ?>
            </select>
        </div>
        <div id="message"></div>
        <button type="submit" class="signup-button" id="signupButton">Sign Up</button>
    </form>
    <div class="signin-link">Already have an account? <a href="<?=base_url('login')?>">Sign In</a></div>
</div>
<script>
$(document).ready(function() {
    $('#confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#password').focus().css('border', '2px solid green');
            //$('#message').html('Matching').css('color', 'green');
            $('#confirm_password').focus().css('border', '2px solid green');
            document.getElementById('signupButton').disabled = false;
        } else {
            $('#password').focus().css('border', '2px solid red');
            $('#confirm_password').focus().css('border', '2px solid red');
            //$('#message').html('Password Mismatch').css('color', 'red');
            document.getElementById('signupButton').disabled = true;
        }
    });

    $('#email').on('keyup', function () {
        var email = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('Login/email_check')?>",
            data: {email: email},
            dataType:'json',
            beforeSend : function(){},
            success:function(returndata) {
                //console.log(returndata.success);
                if(returndata.success == 'Email available') {
                    $('#email').fadeIn().css('border', '2px solid green');
                    //$('#message').html(returndata.success).css('color', 'green');
                    document.getElementById('signupButton').disabled = false;
                } else {
                    $('#email').fadeIn().css('border', '2px solid red');
                    //$('#message').html(returndata.error).css('color', 'red');
                    document.getElementById('signupButton').disabled = true;
                }
            }
        })
    });

    $('#signupForm').on('submit', function (e) {
        e.preventDefault();
        var email = $('#email').val();
        var emailValid = false;
        $.ajax({
            type: "POST",
            url: "<?= base_url('Login/email_check')?>",
            data: {email: email},
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(returndata) {
                if(returndata.success == 'Email available') {
                    $('#email').fadeIn().css('border', '2px solid green');
                    $('#message').html(returndata.success).css('color', 'green');
                    document.getElementById('signupButton').disabled = false;
                    emailValid = true;
                    $('#signupForm')[0].submit();
                } else {
                    $('#email').fadeIn().css('border', '2px solid red');
                    $('#message').html(returndata.error).css('color', 'red');
                    document.getElementById('signupButton').disabled = true;
                    emailValid = false;
                }
            },
            complete: function() {
                if (!emailValid) {
                    return false;
                }
            }
        });
        return emailValid;
    });
})
</script>
