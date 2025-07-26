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
<section class="py-3">
    <div class="container mt-3">
        <div class="header">
            <h1 class="maintitle mb-2 text-center">Bay Hill Driving School</h1>
            <p class="h5 text-center">Trainer Assessment Form</p>
        </div>
        <form id="assessmentForm">
            <div class="form-section">
                <div class="section-title">Session Information</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="sessionDate">Session Date:</label>
                        <input type="date" id="sessionDate" name="sessionDate" required>
                    </div>
                    <div class="form-group">
                        <label for="sessionStatus">Status:</label>
                        <select id="sessionStatus" name="sessionStatus">
                            <option value="Active">Active</option>
                            <option value="Completed">Completed</option>
                            <option value="Locked">Locked</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="startTime">Start Time:</label>
                        <input type="time" id="startTime" name="startTime" value="10:30" required>
                    </div>
                    <div class="form-group">
                        <label for="endTime">End Time:</label>
                        <input type="time" id="endTime" name="endTime" value="12:30" required>
                    </div>
                    <div class="form-group">
                        <label for="sessionType">Session Type:</label>
                        <select id="sessionType" name="sessionType" required>
                            <option value="">Select Course</option>
                            <?php
                            if (!empty($getAssignedCourseList)) {
                            foreach ($getAssignedCourseList as $purchsedList) {
                            $course = $this->db->query("SELECT * FROM courses WHERE id = '".$purchsedList->course_id."'")->row();
                            ?>
                            <option value="<?= $course->id; ?>"><?= $course->course_name; ?> <br/><?= $course->course_name1; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instructor">Student:</label>
                        <select id="student" name="student" required>
                            <option value="">Select Student</option>
                            <?php
                            if (!empty($getAssignedCourseList)) {
                            foreach ($getAssignedCourseList as $purchsedList) {
                                $getUserData = $this->db->query("SELECT * FROM users WHERE id = '".$purchsedList->user_id."'")->row();
                                if(!empty($getUserData)) { ?>
                            <option value="<?= $getUserData->id?>"><?= $getUserData->salutation." ".$getUserData->first_name." ".$getUserData->last_name?></option>
                            <?php } } } else { ?>
                            <option value="">No Student Found</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="vehicle">Vehicle:</label>
                        <input type="text" id="vehicle" name="vehicle" placeholder="e.g., Honda Civic, Toyota Corolla" required>
                    </div>
                </div>
                <div class="skills-assessment">
                    <div class="section-title">Skills Assessment</div>
                    <div class="skills-grid" id="skillsGrid" name="skillsGrid">
                        <div class="skill-card">
                            <div class="skill-name">Changing Lanes</div>
                            <div class="skill-inputs">
                                <select id="dchanging_lane" name="dchanging_lane" onchange="updateIndicator(0)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="ichanging_lane" name="ichanging_lane" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_0"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Following Distance</div>
                            <div class="skill-inputs">
                                <select id="dfollowing_distance" name="dfollowing_distance" onchange="updateIndicator(1)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="ifollowing_distance" name="ifollowing_distance" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_1"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Left Turns</div>
                            <div class="skill-inputs">
                                <select id="dleft_turns" name="dleft_turns" onchange="updateIndicator(2)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="ileft_turns" name="ileft_turns" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_2"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Right Turns</div>
                            <div class="skill-inputs">
                                <select id="dright_turns" name="dright_turns" onchange="updateIndicator(3)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="iright_turns" name="iright_turns" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_3"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Staying Centered</div>
                            <div class="skill-inputs">
                                <select id="dstaying_centered" name="dstaying_centered" onchange="updateIndicator(4)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="istaying_centered" name="istaying_centered" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_4"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">General Parking</div>
                            <div class="skill-inputs">
                                <select id="dgeneral_parking" name="dgeneral_parking" onchange="updateIndicator(5)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="igeneral_parking" name="igeneral_parking" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_5"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Straight Line Reversing</div>
                            <div class="skill-inputs">
                                <select id="dstraight_line_reversing" name="dstraight_line_reversing" onchange="updateIndicator(6)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="istraight_line_reversing" name="istraight_line_reversing" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_6"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Intersections</div>
                            <div class="skill-inputs">
                                <select id="dintersections" name="dintersections" onchange="updateIndicator(7)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="iintersections" name="iintersections" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_7"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Acceleration (Smooth/Gradual)</div>
                            <div class="skill-inputs">
                                <select id="dacceleration" name="dacceleration" onchange="updateIndicator(8)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="iacceleration" name="iacceleration" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_8"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Breaking (Smooth)</div>
                            <div class="skill-inputs">
                                <select id="dbreaking" name="dbreaking" onchange="updateIndicator(9)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="ibreaking" name="ibreaking" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_9"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Blind Spots (Proper Checks)</div>
                            <div class="skill-inputs">
                                <select id="dblind_spot" name="dblind_spot" onchange="updateIndicator(10)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="iblind_spot" name="iblind_spot" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_10"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Freeway Driving</div>
                            <div class="skill-inputs">
                                <select id="dfreeway_driving" name="dfreeway_driving" onchange="updateIndicator(11)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="ifreeway_driving" name="ifreeway_driving" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_11"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Proper Bike Lane Merge</div>
                            <div class="skill-inputs">
                                <select id="dproper_bike_lane" name="dproper_bike_lane" onchange="updateIndicator(12)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="iproper_bike_lane" name="iproper_bike_lane" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_12"></div>
                            </div>
                        </div>
                        <div class="skill-card">
                            <div class="skill-name">Unprotected Left Turn</div>
                            <div class="skill-inputs">
                                <select id="dunprotected_left_turn" name="dunprotected_left_turn" onchange="updateIndicator(13)" required>
                                    <option value="proficient">Proficient</option>
                                    <option value="needs-focus">Needs Focus</option>
                                    <option value="not-covered">Not Covered</option>
                                </select>
                                <input type="text" id="iunprotected_left_turn" name="iunprotected_left_turn" placeholder="Grade" maxlength="3">
                                <div class="status-indicator status-proficient" id="indicator_13"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="notes-section">
                    <div class="section-title">Instructor Notes</div>
                    <div class="form-group">
                        <label for="notes">Notes (visible to office, other instructors, students and guardians):</label>
                        <textarea id="notes" placeholder="Enter your observations, recommendations, and feedback for the student..." name="notes"></textarea>
                    </div>
                </div>
                <div class="button-group">
                    <button type="button" class="btn-preview" onclick="generatePreview()">Generate Report Preview</button>
                    <button type="submit" class="btn-save">Save Assessment</button>
                    <button type="button" class="btn-clear" onclick="clearForm()">Clear Form</button>
                    <input type="hidden" id="instructor" name="instructor" value="<?php echo $_SESSION['bayhill']['user_id']; ?>" >
                </div>
                <div class="mt-3" id="aftersubmitMSG"></div>
            </div>
        </form>
        <div id="reportPreview">
            <!-- Report preview will be generated here -->
        </div>
    </div>
</section>
<script>
document.getElementById('assessmentForm').addEventListener('submit', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    fetch('<?php echo base_url("trainer/assessmentSave"); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            $('#aftersubmitMSG').show();
            $('#aftersubmitMSG').removeClass('btn-preview');
            $('#aftersubmitMSG').removeClass('btn-clear');
            $('#aftersubmitMSG').addClass('btn-preview');
            $('#aftersubmitMSG').text(data.message);
            this.reset();
            setTimeout(() => {
                $('#aftersubmitMSG').hide();
            }, 5000); // Hide after 5 seconds
        } else {
            $('#aftersubmitMSG').show();
            $('#aftersubmitMSG').removeClass('btn-preview');
            $('#aftersubmitMSG').removeClass('btn-clear');
            $('#aftersubmitMSG').addClass('btn-clear');
            $('#aftersubmitMSG').text(data.message).show();
            setTimeout(() => {
                $('#aftersubmitMSG').hide();
            }, 5000); // Hide after 5 seconds
        }
    })
    .catch(error => console.error('Error:', error));
});

function generatePreview() {
    // Collect session info inputs
    const sessionDate = document.getElementById('sessionDate').value;
    const sessionStatus = document.getElementById('sessionStatus').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;
    const sessionType = document.getElementById('sessionType').value;
    const instructor = document.getElementById('instructor').value;
    const vehicle = document.getElementById('vehicle').value;

    // Collect instructor notes
    const notes = document.getElementById('notes').value;

    // Define skill fields & labels matching the form
    const skills = [
        { id: 'changing_lane', label: 'Changing Lanes' },
        { id: 'following_distance', label: 'Following Distance' },
        { id: 'left_turns', label: 'Left Turns' },
        { id: 'right_turns', label: 'Right Turns' },
        { id: 'staying_centered', label: 'Staying Centered' },
        { id: 'general_parking', label: 'General Parking' },
        { id: 'straight_line_reversing', label: 'Straight Line Reversing' },
        { id: 'intersections', label: 'Intersections' },
        { id: 'acceleration', label: 'Acceleration (Smooth/Gradual)' },
        { id: 'breaking', label: 'Breaking (Smooth)' },
        { id: 'blind_spot', label: 'Blind Spots (Proper Checks)' },
        { id: 'freeway_driving', label: 'Freeway Driving' },
        { id: 'proper_bike_lane', label: 'Proper Bike Lane Merge' },
        { id: 'unprotected_left_turn', label: 'Unprotected Left Turn' }
    ];

    let skillsHtml = '<table style="width:100%; border-collapse: collapse;" border="1">';
    skillsHtml += '<thead><tr><th style="padding:8px;">Skill</th><th>Status</th><th>Grade</th></tr></thead><tbody>';

    skills.forEach(skill => {
        const status = document.getElementById('d' + skill.id).value || '-';
        const grade = document.getElementById('i' + skill.id).value.trim() || '-';
        const statusDisplay = {
            'proficient': 'Proficient',
            'needs-focus': 'Needs Focus',
            'not-covered': 'Not Covered'
        }[status] || status;

        skillsHtml += `
            <tr>
                <td style="padding:8px;">${skill.label}</td>
                <td style="padding:8px; text-align:center;">${statusDisplay}</td>
                <td style="padding:8px; text-align:center;">${grade}</td>
            </tr>
        `;
    });

    skillsHtml += '</tbody></table>';

    const reportHtml = `
        <h2>Trainer Assessment Report Preview</h2>
        <h3>Session Information</h3>
        <ul>
            <li><strong>Session Date:</strong> ${sessionDate || '-'}</li>
            <li><strong>Status:</strong> ${sessionStatus || '-'}</li>
            <li><strong>Start Time:</strong> ${startTime || '-'}</li>
            <li><strong>End Time:</strong> ${endTime || '-'}</li>
            <li><strong>Session Type:</strong> ${sessionType || '-'}</li>
            <li><strong>Instructor:</strong> ${instructor || '-'}</li>
            <li><strong>Vehicle:</strong> ${vehicle || '-'}</li>
        </ul>

        <h3>Skills Assessment</h3>
        ${skillsHtml}

        <h3>Instructor Notes</h3>
        <p>${notes ? notes.replace(/\n/g, '<br>') : '-'}</p>
    `;

    // Insert preview report into the reportPreview div
    document.getElementById('reportPreview').innerHTML = reportHtml;
}

function clearForm() {
    document.getElementById('assessmentForm').reset();

    for (let i = 0; i <= 13; i++) {
        const indicator = document.getElementById('indicator_' + i);
        if (indicator) {
            indicator.className = 'status-indicator status-proficient'; // or your default class
        }
    }

    const previewDiv = document.getElementById('reportPreview');
    if (previewDiv) {
        previewDiv.innerHTML = '';
    }
}
</script>