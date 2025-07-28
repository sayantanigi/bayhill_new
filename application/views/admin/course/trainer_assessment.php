<style>
.form-check {display: flex; align-items: center;}
.form-check label {margin-left: 10px; font-size: 18px; font-weight: 500;}
.form-switch .form-check-input[type=checkbox] {border-radius: 2em; height: 50px; width: 100px;}
small > p{color:red;}
p strong{font-weight: 600 !important; color: black !important;}
.sa-confirm-button-container button{background-color: #146c43 !important; border-color: #146c43 !important;}
.loaderData{display: block !important; background: #00000096 !important;}
.loaderDatastatus{display: block !important;}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= @$page ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <div class="">
                                <table id="datatable" class="table table-bordered w-100">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Student Name</th>
                                            <th>Trainer Name</th>
                                            <th>Session Date</th>
                                            <th>Session Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (is_array($assessment_list) || is_object($assessment_list)) { ?>
                                            <?php foreach ($assessment_list as $key => $v): ?>
                                                <?php
                                                $courseData = $this->db->query("SELECT * FROM courses WHERE id = '".@$v->session_type."'")->row();
                                                ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td>
                                                        <p><?= @$courseData->course_name."</br>".@$courseData->course_name1; ?></p>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $userData = $this->db->query("SELECT * FROM users WHERE id = '".@$v->student."'")->row();
                                                        echo @$userData->salutation." ".@$userData->first_name." ".@$userData->last_name;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $trainerData = $this->db->query("SELECT * FROM users WHERE id = '".@$v->instructor."'")->row();
                                                        if(!empty($trainerData)) {
                                                            echo @$trainerData->salutation." ".@$trainerData->first_name." ".@$trainerData->last_name;
                                                        } else {
                                                            echo "No trainer assigned yet";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="font-size: 12px;"><?= @$v->session_date; ?></td>
                                                    <td><?= @$v->session_status; ?></td>
                                                    <td>
                                                        <a href="<?= base_url("admin/course/assessment_details/".base64_encode(@$v->id))?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>