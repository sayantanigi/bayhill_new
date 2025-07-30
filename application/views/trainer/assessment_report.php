<style>
.header,.report-info{padding:20px;text-align:center}.header h1,.skill-name,.status{font-weight:700}.footer,.header,.report-info{text-align:center}.header{background:linear-gradient(135deg,#4caf50,#45a049);color:#fff}.header h1{margin:0;font-size:28px}.report-info{background-color:#f8f8f8;border-bottom:1px solid #ddd}.proficient,.status{background-color:#4caf50}.report-info h2{margin:0 0 10px;font-size:18px;color:#333}.session-details{display:flex;justify-content:space-around;margin:10px 0;flex-wrap:wrap}.session-details div{margin:5px}.status{display:inline-block;color:#fff;padding:5px 15px;border-radius:20px;font-size:12px}.skills-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;padding:30px}.skill-item{display:flex;align-items:center;padding:15px 20px;border-bottom:1px solid #eee}.skill-indicator{width:20px;height:20px;border-radius:50%;margin-right:15px;flex-shrink:0}.needs-focus{background-color:#ffc107}.not-covered{background-color:#9e9e9e}.skill-content{flex-grow:1}.skill-name{color:#333;font-size:14px;margin-bottom:2px}.skill-grade{font-size:12px;color:#666;margin-bottom:2px}.skill-status{font-size:12px;color:#888}.notes-section{background-color:#f8f8f8;padding:20px;margin:20px;border-radius:5px;border:1px solid #ddd}.notes-title{font-size:12px;color:#666;margin-bottom:10px}.notes-content{font-size:14px;color:#333;font-weight:500}.footer{padding:20px;background-color:#f0f0f0;color:#666;font-size:12px}@media (max-width:600px){.skills-grid{grid-template-columns:1fr}.session-details{flex-direction:column;text-align:center}}
</style>
<section class="courseListpnl" style="padding: 25px 0;">
    <div class="mt-3 purchased-table">
        <div class="row" style=" display: flex; flex-direction: row; justify-content: center; ">
            <div class="col-xl-10">
                <div class="card custom-shadow rounded-lg border">
                    <div class="card-body">
                        <div class="">
                            <div class="header">
                                <h1 class="maintitle mb-2 text-center">Bay Hill Driving School</h1>
                                <p class="h5 text-center">Assessment Report of <b><?= @$course_details->course_name." ".@$course_details->course_name1; ?></b></p>
                            </div>
                            <div class="report-info">
                                <h2>Report card for session on <?= date('l, jS F Y', strtotime(@$assessment_data->session_date)); ?></h2>
                                <span class="status">Active</span>

                                <div class="session-details">
                                    <div><strong>From:</strong><?= date('h:i A', strtotime(@$assessment_data->start_time)); ?>to <?= date('h:i A', strtotime(@$assessment_data->end_time)); ?></div>
                                    <div><strong>Session Type:</strong><?= @$course_details->course_name." ".@$course_details->course_name1; ?></div>
                                    <div><strong>Student:</strong> <?= @$student_details->salutation." ".@$student_details->first_name." ".@$student_details->last_name ?></div>
                                    <div><strong>Instructor:</strong> <?= @$trainer_details->salutation." ".@$trainer_details->first_name." ".@$trainer_details->last_name ?></div>
                                    <div><strong>Vehicle:</strong> <?= @$assessment_data->vehicle; ?></div>
                                </div>
                            </div>

                            <div class="skills-grid">
                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Changing Lanes</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->changing_lane_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->changing_lane; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Following Distance</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->following_distance_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->following_distance; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Left Turns</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->left_turns_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->left_turns; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Right Turns</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->right_turns_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->right_turns; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Staying Centered</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->staying_centered_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->staying_centered; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">General Parking</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->general_parking_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->general_parking; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator needs-focus"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Straight Line Reversing</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->straight_line_reversing_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->straight_line_reversing; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Intersections</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->intersections_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->intersections; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Acceleration (Smooth/Gradual)</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->acceleration_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->acceleration; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Braking (Smooth)</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->breaking_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->breaking; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Blind Spots (Proper Checks)</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->blind_spot_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->blind_spot; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator not-covered"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Freeway Driving</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->freeway_driving_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->freeway_driving; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Proper Bike Lane Merge</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->proper_bike_lane_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->proper_bike_lane; ?></div>
                                    </div>
                                </div>

                                <div class="skill-item">
                                    <div class="skill-indicator proficient"></div>
                                    <div class="skill-content">
                                        <div class="skill-name">Unprotected Left Turn</div>
                                        <div class="skill-grade">Grade: <?= @$assessment_data->unprotected_left_turn_grade; ?></div>
                                        <div class="skill-status"><?= @$assessment_data->unprotected_left_turn; ?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="notes-section">
                                <div class="notes-title">Notes (These notes are visible to the office, other instructors, and the students and guardians)</div>
                                <div class="notes-content"><?= @$assessment_data->notes; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>