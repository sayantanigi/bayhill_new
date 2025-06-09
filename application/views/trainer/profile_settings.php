<section class="enrollPnl">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12">
                <div class="text-success-msg f-20">
                    <?php if ($this->session->flashdata('message')) {
                        echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: green; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('message').'</p>';
                        unset($_SESSION['message']);
                    } ?>
                    <?php if ($this->session->flashdata('error')) {
                        echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: red; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('error').'</p>';
                        unset($_SESSION['error']);
                    } ?>
                </div>
                <h3 class="h3 fw-bold mb-2  wow fadeInUp">Profile Settings</h3>
                <form action="<?= base_url()?>trainer/saveProfileData" method="post" id="profileForm" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="user_type" id="user_type" value="1" />
                        <div class="col-lg-12">
                            <h2 class="subtitle wow fadeInUp mt-4">Trainer Information</h2>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your first name" name="first_name" id="first_name" value="<?= @$getUserDetails->first_name; ?>"/>
                            <div id="vld_first_name"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your last name" name="last_name" id="last_name" value="<?= @$getUserDetails->last_name; ?>"/>
                            <div id="vld_last_name"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Phone No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your phone number" name="phone" id="phone" value="<?= @$getUserDetails->phone; ?>"/>
                            <div id="vld_phone"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" value="<?= @$getUserDetails->email; ?>"/>
                            <div id="vld_email"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your username" name="username" id="username" value="<?= @$getUserDetails->username; ?>" readonly/>
                            <div id="vld_username"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Date of Birth  <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="dob" id="dob" value="<?= @$getUserDetails->dob; ?>"/>
                            <div id="vld_dob"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <label class="mb-2">Gender <span class="text-danger">*</span></label>
                            <select class="form-control form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" <?php if(@$getUserDetails->gender == "Male") {echo "selected"; }?>>Male</option>
                                <option value="Female" <?php if(@$getUserDetails->gender == "Female") {echo "selected"; }?>>Female</option>
                                <option value="Other" <?php if(@$getUserDetails->gender == "Other") {echo "selected"; }?>>Other</option>
                            </select>
                            <div id="vld_gender"></div>
                        </div>
                        <div class="col-lg-6">
                            <label class="mb-2">Profile Picture <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="profile_pic" id="profile_pic" accept=".jpg, .jpeg, .png"/>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <div id="vld_profile_pic"></div>
                            <div class="profilepic">
                                <img id="profile_pic_preview" src="<?= !empty(@$getUserDetails->image) && file_exists('uploads/student/profilePic/'.@$getUserDetails->image) ? base_url('uploads/student/profilePic/'.@$getUserDetails->image) : base_url('assets/images/profile_default.png'); ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h2 class="subtitle wow fadeInUp mt-4" style="margin-bottom: 0px;">Contact Information</h2>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2 pfirst_namelbl">Parents First Name</label>
                            <input type="text" class="form-control" placeholder="Parents First Name" name="pfirst_name" id="pfirst_name" value="<?= @$getUserDetails->pfirst_name;?>"/>
                            <div id="vld_pfirst_name"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2 plast_namelbl">Parents Last Name</label>
                            <input type="text" class="form-control" placeholder="Parents Last Name" name="plast_name" id="plast_name" value="<?= @$getUserDetails->plast_name;?>"/>
                            <div id="vld_plast_name"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2 pemaillbl">Parents Email</label>
                            <input type="email" class="form-control" placeholder="Parents Email" name="pemail" id="pemail" value="<?= @$getUserDetails->pemail;?>"/>
                            <div id="vld_pemail"></div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-3">
                            <label class="mb-2 pphonelbl">Parents Phone Number</label>
                            <input type="text" class="form-control" placeholder="Parents Phone Number" name="pphone" id="pphone" value="<?= @$getUserDetails->phone_2; ?>"/>
                            <div id="vld_pphone"></div>
                        </div>
                        <div class="col-lg-12">
                            <h2 class="subtitle wow fadeInUp mt-4">Address Information</h2>
                        </div>
                        <div class="col-lg-12 col-md-6 mb-3">
                            <label class="mb-2">Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Street Address" name="address" id="address" value="<?= @$getUserDetails->address; ?>"/>
                            <div id="vld_address"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">State <span class="text-danger">*</span> </label>
                            <select class="form-control form-select" name="state" id="state">
                                <?php
                                if($state_list) {
                                foreach ($state_list as $state) { ?>
                                <option value="<?= $state->id?>"><?= $state->name?></option>
                                <?php } } ?>
                            </select>
                            <div id="vld_state"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">City <span class="text-danger">*</span> </label>
                            <?php $getcityData = $this->db->query("SELECT * FROM cities WHERE id = '".@$getUserDetails->city."'")->row(); ?>
                            <input type="text" class="form-control" placeholder="Enter Your City" name="city" id="city" value="<?= @$getcityData->name; ?>"/>
                            <div id="vld_city"></div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <label class="mb-2">Zip Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter Zip Code" name="zipcode" id="zipcode" value="<?= @$getUserDetails->zipcode; ?>"/>
                            <div id="vld_zipcode"></div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <button class="enrollbtn" type="submit" id="enrollbtn">Update Profile</button>
                            <input type="hidden" name="user_id" id="user_id" value="<?= @$getUserDetails->id; ?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<style>
#main-form{border: 1px solid #eee; box-shadow: 0 0 10px #014599; border-radius: 12px; padding: 15px 0px 0px; margin-top: 20px;}
#billing-address-fields{border: 1px solid rgb(238, 238, 238); box-shadow: rgb(1, 69, 153) 0px 0px 10px; border-radius: 12px; padding: 15px 0px 0px; margin-top: 20px;}
</style>
<script>
$(document).ready(function() {
    $('.permit').hide();

    $('.custom-cursor__cursor').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
    });

    $('#email').on('keyup', function(e) {
        var email = $('#email').val();
        if(email === '') {
            $('#vld_email').text('This field is required').css('color', 'red').show();
            $('#email').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_email").hide(); }, 5000);
            e.preventDefault();
        } else {
            $("#vld_email").hide();
            $('#email').focus().css('border', '1px solid green');
            $.ajax({
                type: "POST",
                url: "<?= base_url('Home/checkuseremail')?>",
                data: {email: email},
                dataType:'json',
                beforeSend : function() {},
                success:function(returndata) {
                    if(returndata.result === 'success') {
                        $('#vld_email').fadeIn().html(returndata.data).css({'color':'green','margin-bottom':'5px'});
                        $("#enrollbtn").prop("disabled", false);
                    } else {
                        $('#vld_email').fadeIn().html(returndata.data).css({'color':'red','margin-bottom':'5px'});
                        setTimeout(function(){$("#vld_email").html("");},3000);
                        $('#email').focus().css('border', '1px solid red');
                        $("#email").focus();
                        $("#enrollbtn").prop("disabled", true);
                        return false;
                    }
                }
            });
        }
    });

    /*$('#dob').on('change', function() {
        var dob = $('#dob').val();
        if (dob) {
            var dobDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - dobDate.getFullYear();
            var monthDifference = today.getMonth() - dobDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }
            if (age <= 18) {
                $("#pfirst_name").prop("disabled", false);
                $("#pfirst_name").prop("required", true);
                $(".pfirst_namelbl").html('Parents First Name <span class="text-danger">*</span>');

                $("#plast_name").prop("disabled", false);
                $("#plast_name").prop("required", true);
                $(".plast_namelbl").html('Parents Last Name <span class="text-danger">*</span>');

                $("#pemail").prop("disabled", false);
                $("#pemail").prop("required", true);
                $(".pemaillbl").html('Parents Email <span class="text-danger">*</span>');

                $("#pphone").prop("disabled", false);
                $("#pphone").prop("required", true);
                $(".pphonelbl").html('Parents Phone Number <span class="text-danger">*</span>');
            } else {
                $("#pfirst_name").prop("disabled", true);
                $("#pfirst_name").prop("required", false);
                $(".pfirst_namelbl").html('Parents First Name');

                $("#plast_name").prop("disabled", true);
                $("#plast_name").prop("required", false);
                $(".plast_namelbl").html('Parents Last Name');

                $("#pemail").prop("disabled", true);
                $("#pemail").prop("required", false);
                $(".pemaillbl").html('Parents Email');

                $("#pphone").prop("disabled", true);
                $("#pphone").prop("required", false);
                $(".pphonelbl").html('Parents Phone Number');
            }
        } else {
            $('#vld_dob').html('Please select a valid date of birth.');
        }
    });*/

    $('#profile_pic').on('change', function(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile_pic_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

});

$("#profileForm").submit(function (e) {
    var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if ($('#first_name').val() === '') {
        $('#vld_first_name').text('This field is required').css('color', 'red').show();
        $('#first_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_first_name").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#first_name').focus().css('border', '1px solid green');
    }

    if ($('#last_name').val() === '') {
        $('#vld_last_name').text('This field is required').css('color', 'red').show();
        $('#last_name').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_last_name").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#last_name').focus().css('border', '1px solid green');
    }

    if ($('#phone').val() === '') {
        $('#vld_phone').text('This field is required').css('color', 'red').show();
        $('#phone').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_phone").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#phone').focus().css('border', '1px solid green');
    }

    if ($('#email').val() === '') {
        $('#vld_email').text('This field is required').css('color', 'red').show();
        $('#email').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_email").hide(); }, 5000);
        e.preventDefault();
    } else {
        if(!emailRegex.test($('#email').val())) {
            $('#vld_email').text('Please enter a valid email').css('color', 'red').show();
            $('#email').focus().css('border', '1px solid red');
            setTimeout(function () { $("#vld_email").hide(); }, 5000);
            e.preventDefault();
        } else {
            $('#email').focus().css('border', '1px solid green');
        }
    }

    if ($('#dob').val() === '') {
        $('#vld_dob').text('This field is required').css('color', 'red').show();
        $('#dob').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_dob").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#dob').focus().css('border', '1px solid green');
    }

    var dob = $('#dob').val();
    const year = dob.split('-')[0];
    if (year.length !== 4 || isNaN(year)) {
        $('#vld_dob').text('Year must be exactly 4 digits.').css('color', 'red').show();
        $('#dob').focus().css('border', '1px solid red');
        $("#enrollbtn").prop("disabled", true);
        setTimeout(function () { $("#vld_dob").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#vld_dob').text(''); // Clear validation message
        $('#dob').focus().css('border', '1px solid green');
        $("#enrollbtn").prop("disabled", false);
    }

    if ($('#gender').val() === '') {
        $('#vld_gender').text('This field is required').css('color', 'red').show();
        $('#gender').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_gender").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#gender').focus().css('border', '1px solid green');
    }

    if ($('#address').val() === '') {
        $('#vld_address').text('This field is required').css('color', 'red').show();
        $('#address').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_address").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#address').focus().css('border', '1px solid green');
    }

    if ($('#state').val() === '') {
        $('#vld_state').text('This field is required').css('color', 'red').show();
        $('#state').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_state").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#state').focus().css('border', '1px solid green');
    }

    if ($('#city').val() === '') {
        $('#vld_city').text('This field is required').css('color', 'red').show();
        $('#city').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_city").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#city').focus().css('border', '1px solid green');
    }

    if ($('#zipcode').val() === '') {
        $('#vld_zipcode').text('This field is required').css('color', 'red').show();
        $('#zipcode').focus().css('border', '1px solid red');
        setTimeout(function () { $("#vld_zipcode").hide(); }, 5000);
        e.preventDefault();
    } else {
        $('#zipcode').focus().css('border', '1px solid green');
    }
});
</script>