<style>
.form-grid,.report-skills,.skills-grid{grid-template-columns:1fr 1fr}.form-grid,.skills-grid{gap:20px}.section-title,.skill-name,label{color:#333;font-weight:700}.form-section{padding:30px;background:#fff;border:2px solid #eee}.section-title{background-color:#f8f8f8;padding:15px 20px;margin-bottom:20px;border-bottom:3px solid #4caf50;font-size:18px}.form-grid{display:grid;margin-bottom:30px}.form-group{display:flex;flex-direction:column}.form-group.full-width{grid-column:1/-1}label{margin-bottom:5px;font-size:14px}input,select,textarea{padding:10px;border:2px solid #ddd;border-radius:5px;font-size:14px;transition:border-color .3s}input:focus,select:focus,textarea:focus{outline:0;border-color:#4caf50}.notes-section,.skills-assessment{margin-top:30px}.skills-grid{display:grid;margin-top:20px}.skill-card{border:2px solid #e0e0e0;border-radius:8px;padding:15px;background-color:#fafafa}.skill-name{margin-bottom:10px;font-size:14px}.skill-inputs{display:flex;gap:10px;align-items:center}.skill-inputs select{flex:1;min-width:80px}.skill-inputs input[type=text]{flex:1;min-width:60px}.status-indicator{width:20px;height:20px;border-radius:50%;border:2px solid #ddd;margin-left:10px}.status-proficient{background-color:#4caf50;border-color:#4caf50}.status-needs-focus{background-color:#ffc107;border-color:#ffc107}.status-not-covered{background-color:#9e9e9e;border-color:#9e9e9e}textarea{min-height:100px;resize:vertical}.button-group{display:flex;gap:15px;justify-content:center;padding:30px;background-color:#f8f8f8;margin:30px -30px -30px}.report-header,.report-info{padding:15px;text-align:center}button{padding:12px 30px;border:none;border-radius:5px;font-size:16px;font-weight:700;cursor:pointer;transition:background-color .3s}.btn-preview{background-color:#4caf50;color:#fff}.btn-preview:hover{background-color:#45a049}.btn-save{background-color:#2196f3;color:#fff}.btn-save:hover{background-color:#1976d2}.btn-clear{background-color:#f44336;color:#fff}.btn-clear:hover{background-color:#d32f2f}.report-preview{display:none;margin-top:30px;border:3px solid #4caf50;border-radius:8px;background-color:#fff}.report-header{background:linear-gradient(135deg,#4caf50,#45a049);color:#fff}.report-info{background-color:#f8f8f8;border-bottom:1px solid #ddd}.session-details{display:flex;justify-content:space-around;margin:10px 0;flex-wrap:wrap;font-size:14px}.status-badge{background-color:#4caf50;color:#fff;padding:3px 10px;border-radius:15px;font-size:12px;font-weight:700}.report-skills{display:grid;gap:0;padding:20px}.report-skill{display:flex;align-items:center;padding:10px;border-bottom:1px solid #eee}.report-skill-indicator{width:16px;height:16px;border-radius:50%;margin-right:10px}.report-notes{background-color:#f8f8f8;padding:15px;margin:15px;border-radius:5px;border:1px solid #ddd}
@media (max-width:768px) {
    .form-grid,
    .report-skills,
    .skills-grid {
        grid-template-columns: 1fr
    }
    .skill-inputs {
        flex-direction: column;
        align-items: stretch
    }
    .button-group {
        flex-direction: column
    }
}
#aftersubmitMSG{text-align: center; font-size: 16px; padding: 12px; width: 100%;}
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
                                <div class="header">
                                    <h1 class="maintitle mb-2 text-center">Bay Hill Driving School</h1>
                                    <p class="h5 text-center">Trainer Assessment Form</p>
                                </div>
                                <div class="form-section">
                                    <div class="section-title">Session Information</div>
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <label for="sessionDate">Session Date:</label>
                                            <input type="text" value="<?= date('d-m-Y', strtotime(@$assessment_data->session_date)); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="sessionDate">Session Status:</label>
                                            <input type="text" value="<?= @$assessment_data->session_status; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="startTime">Start Time:</label>
                                            <input type="text" value="<?= date('h:i A', strtotime(@$assessment_data->start_time)); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="endTime">End Time:</label>
                                            <input type="text" value="<?= date('h:i A', strtotime(@$assessment_data->end_time)); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="sessionType">Session Type:</label>
                                            <input type="text" value="<?= @$course_details->course_name." ".@$course_details->course_name1; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="instructor">Student:</label>
                                            <input type="text" value="<?= @$student_details->salutation." ".@$student_details->first_name." ".@$student_details->last_name ?>" readonly>
                                        </div>
                                        <div class="form-group full-width">
                                            <label for="instructor">Trainer:</label>
                                            <input type="text" value="<?= @$trainer_details->salutation." ".@$trainer_details->first_name." ".@$trainer_details->last_name ?>" readonly>
                                        </div>
                                        <div class="form-group full-width">
                                            <label for="instructor">Vehicle:</label>
                                            <input type="text" value="<?= @$assessment_data->vehicle; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="skills-assessment">
                                        <div class="section-title">Skills Assessment</div>
                                        <div class="skills-grid" id="skillsGrid" name="skillsGrid">
                                            <div class="skill-card">
                                                <div class="skill-name">Changing Lanes</div>
                                                <div class="skill-inputs">
                                                    <input type="text" value="<?= @$assessment_data->changing_lane; ?>" readonly>
                                                    <input type="text" value="<?= @$assessment_data->changing_lane_grade; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Following Distance</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->following_distance; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->following_distance_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Left Turns</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->left_turns; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->left_turns_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Right Turns</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->right_turns; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->right_turns_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Staying Centered</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->staying_centered; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->staying_centered_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">General Parking</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->general_parking; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->general_parking_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Straight Line Reversing</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->straight_line_reversing; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->straight_line_reversing_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Intersections</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->intersections; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->intersections_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Acceleration (Smooth/Gradual)</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->acceleration; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->acceleration_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Breaking (Smooth)</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->breaking; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->breaking_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Blind Spots (Proper Checks)</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->blind_spot; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->blind_spot_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Freeway Driving</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->freeway_driving; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->freeway_driving_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Proper Bike Lane Merge</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->proper_bike_lane; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->proper_bike_lane_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="skill-card">
                                                <div class="skill-name">Unprotected Left Turn</div>
                                                <div class="skill-inputs">
                                                    <div class="skill-inputs">
                                                        <input type="text" value="<?= @$assessment_data->unprotected_left_turn; ?>" readonly>
                                                        <input type="text" value="<?= @$assessment_data->unprotected_left_turn_grade; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notes-section">
                                        <div class="section-title">Instructor Notes</div>
                                        <div class="form-group">
                                            <label for="notes">Notes (visible to office, other instructors, students and guardians):</label>
                                            <textarea readonly><?= @$assessment_data->notes; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>