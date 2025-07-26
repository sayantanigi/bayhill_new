<style>
.form-grid,
.skills-grid {
    gap: 20px;
    grid-template-columns: 1fr 1fr
}
.form-grid,
.report-skills,
.skills-grid {
    grid-template-columns: 1fr 1fr
}
.section-title,
.skill-name,
label {
    color: #333;
    font-weight: 700
}
.form-section {
        padding: 30px;
    background: #ffffff;
    border: 2px solid #eee;
}
.section-title {
    background-color: #f8f8f8;
    padding: 15px 20px;
    margin-bottom:20px;
    border-bottom: 3px solid #4caf50;
    font-size: 18px
}
.form-grid {
    display: grid;
    margin-bottom: 30px
}
.form-group {
    display: flex;
    flex-direction: column
}
.form-group.full-width {
    grid-column: 1/-1
}
label {
    margin-bottom: 5px;
    font-size: 14px
}
input,
select,
textarea {
    padding: 10px;
    border: 2px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    transition: border-color .3s
}
input:focus,
select:focus,
textarea:focus {
    outline: 0;
    border-color: #4caf50
}
.notes-section,
.skills-assessment {
    margin-top: 30px
}
.skills-grid {
    display: grid;
    margin-top: 20px
}
.skill-card {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    background-color: #fafafa
}
.skill-name {
    margin-bottom: 10px;
    font-size: 14px
}
.skill-inputs {
    display: flex;
    gap: 10px;
    align-items: center
}
.skill-inputs select {
    flex: 1;
    min-width: 80px
}
.skill-inputs input[type=text] {
    flex: 1;
    min-width: 60px
}
.status-indicator {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 2px solid #ddd;
    margin-left: 10px
}
.status-proficient {
    background-color: #4caf50;
    border-color: #4caf50
}
.status-needs-focus {
    background-color: #ffc107;
    border-color: #ffc107
}
.status-not-covered {
    background-color: #9e9e9e;
    border-color: #9e9e9e
}
textarea {
    min-height: 100px;
    resize: vertical
}
.button-group {
    display: flex;
    gap: 15px;
    justify-content: center;
    padding: 30px;
    background-color: #f8f8f8;
    margin: 30px -30px -30px
}
.report-header,
.report-info {
    padding: 15px;
    text-align: center
}
button {
    padding: 12px 30px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color .3s
}
.btn-preview {
    background-color: #4caf50;
    color: #fff
}
.btn-preview:hover {
    background-color: #45a049
}
.btn-save {
    background-color: #2196f3;
    color: #fff
}
.btn-save:hover {
    background-color: #1976d2
}
.btn-clear {
    background-color: #f44336;
    color: #fff
}
.btn-clear:hover {
    background-color: #d32f2f
}
.report-preview {
    display: none;
    margin-top: 30px;
    border: 3px solid #4caf50;
    border-radius: 8px;
    background-color: #fff
}
.report-header {
    background: linear-gradient(135deg, #4caf50, #45a049);
    color: #fff
}
.report-info {
    background-color: #f8f8f8;
    border-bottom: 1px solid #ddd
}
.session-details {
    display: flex;
    justify-content: space-around;
    margin: 10px 0;
    flex-wrap: wrap;
    font-size: 14px
}
.status-badge {
    background-color: #4caf50;
    color: #fff;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 700
}
.report-skills {
    display: grid;
    gap: 0;
    padding: 20px
}
.report-skill {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #eee
}
.report-skill-indicator {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    margin-right: 10px
}
.report-notes {
    background-color: #f8f8f8;
    padding: 15px;
    margin: 15px;
    border-radius: 5px;
    border: 1px solid #ddd
}
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
</style>
<section class="py-3">
<div class="container mt-3">
    <div class="header">
        <h1 class="maintitle mb-2 text-center">Bay Hill Driving School</h1>
        <p class="h5 text-center">Trainer Assessment Form</p>
    </div>
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
                <select id="sessionType" name="sessionType">
                    <option value="Behind The Wheel Lessons">Behind The Wheel Lessons</option>
                    <option value="Classroom Theory">Classroom Theory</option>
                    <option value="Practice Test">Practice Test</option>
                    <option value="Road Test Prep">Road Test Prep</option>
                </select>
            </div>
            <div class="form-group">
                <label for="instructor">Instructor:</label>
                <input type="text" id="instructor" name="instructor" placeholder="Name - ID" required>
            </div>
            <div class="form-group full-width">
                <label for="vehicle">Vehicle:</label>
                <input type="text" id="vehicle" name="vehicle" placeholder="e.g., Honda Civic, Toyota Corolla" required>
            </div>
        </div>
        <div class="skills-assessment">
            <div class="section-title">Skills Assessment</div>
            <div class="skills-grid" id="skillsGrid" name="skillsGrid">
                <!-- Skills will be populated by JavaScript -->
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
            <button type="button" class="btn-save" onclick="saveAssessment()">Save Assessment</button>
            <button type="button" class="btn-clear" onclick="clearForm()">Clear Form</button>
        </div>
    </div>
    <div class="report-preview" id="reportPreview">
        <!-- Report preview will be generated here -->
    </div>
</div>
 </section>
<script>
    const skills = [
        'Changing Lanes', 'Following Distance', 'Left Turns', 'Right Turns',
        'Staying Centered', 'General Parking', 'Straight Line Reversing', 'Intersections',
        'Acceleration (Smooth/Gradual)', 'Braking (Smooth)', 'Blind Spots (Proper Checks)',
        'Freeway Driving', 'Proper Bike Lane Merge', 'Unprotected Left Turn'
    ];
    function initializeForm() {
        const skillsGrid = document.getElementById('skillsGrid');
        skillsGrid.innerHTML = '';
        skills.forEach((skill, index) => {
            const skillCard = document.createElement('div');
            skillCard.className = 'skill-card';
            skillCard.innerHTML = `
                <div class="skill-name">${skill}</div>
                <div class="skill-inputs">
                    <select id="status_${skill}" onchange="updateIndicator(${index})">
                        <option value="proficient">Proficient</option>
                        <option value="needs-focus">Needs Focus</option>
                        <option value="not-covered">Not Covered</option>
                    </select>
                    <input type="text" id="grade_${index}" placeholder="Grade" maxlength="3">
                    <div class="status-indicator status-proficient" id="indicator_${index}"></div>
                </div>
            `;
            skillsGrid.appendChild(skillCard);
        });
        // Set today's date
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('sessionDate').value = today;
    }
    function updateIndicator(index) {
        const select = document.getElementById(`status_${index}`);
        const indicator = document.getElementById(`indicator_${index}`);
        indicator.className = 'status-indicator';
        indicator.classList.add(`status-${select.value}`);
    }
    function generatePreview() {
        const preview = document.getElementById('reportPreview');
        const sessionDate = document.getElementById('sessionDate').value;
        const startTime = document.getElementById('startTime').value;
        const endTime = document.getElementById('endTime').value;
        const instructor = document.getElementById('instructor').value;
        const vehicle = document.getElementById('vehicle').value;
        const sessionType = document.getElementById('sessionType').value;
        const sessionStatus = document.getElementById('sessionStatus').value;
        const notes = document.getElementById('notes').value;
        let skillsHTML = '';
        skills.forEach((skill, index) => {
            const status = document.getElementById(`status_${index}`).value;
            const grade = document.getElementById(`grade_${index}`).value || '--';
            skillsHTML += `
                <div class="report-skill">
                    <div class="report-skill-indicator status-${status}"></div>
                    <div>
                        <div style="font-weight: bold; font-size: 13px;">${skill}</div>
                        <div style="font-size: 11px; color: #666;">Grade: ${grade}</div>
                        <div style="font-size: 11px; color: #888;">${status.replace('-', ' ')}</div>
                    </div>
                </div>
            `;
        });
        const formatDate = (dateStr) => {
            const date = new Date(dateStr + 'T00:00:00');
            return date.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        };
        const formatTime = (timeStr) => {
            const [hours, minutes] = timeStr.split(':');
            const hour12 = hours % 12 || 12;
            const ampm = hours >= 12 ? 'pm' : 'am';
            return `${hour12}:${minutes} ${ampm}`;
        };
        preview.innerHTML = `
            <div class="report-header">
                <h2 style="margin: 0;">Bay Hill Driving School</h2>
            </div>
            <div class="report-info">
                <h3 style="margin: 0 0 10px 0;">Report card for session on ${formatDate(sessionDate)}</h3>
                <span class="status-badge">${sessionStatus}</span>
                <div class="session-details">
                    <div><strong>From:</strong> ${formatTime(startTime)} to ${formatTime(endTime)}</div>
                    <div><strong>Session Type:</strong> ${sessionType}</div>
                    <div><strong>Instructor:</strong> ${instructor}</div>
                    <div><strong>Vehicle:</strong> ${vehicle}</div>
                </div>
            </div>
            <div class="report-skills">
                ${skillsHTML}
            </div>
            <div class="report-notes">
                <div style="font-size: 11px; color: #666; margin-bottom: 8px;">
                    Notes (These notes are visible to the office, other instructors, and the students and guardians)
                </div>
                <div style="font-size: 13px; color: #333; font-weight: 500;">
                    ${notes || 'No additional notes provided.'}
                </div>
            </div>
        `;
        preview.style.display = 'block';
        preview.scrollIntoView({ behavior: 'smooth' });
    }
    async function saveAssessment() {
        const data = {
            sessionDate: document.getElementById('sessionDate').value,
            sessionStatus: document.getElementById('sessionStatus').value,
            startTime: document.getElementById('startTime').value,
            endTime: document.getElementById('endTime').value,
            sessionType: document.getElementById('sessionType').value,
            instructor: document.getElementById('instructor').value,
            vehicle: document.getElementById('vehicle').value,
            skills: getSkillsAssessment(), // Make sure this returns an array/object
            notes: document.getElementById('notes').value
        };
        try {
            const response = await fetch('/assessmentSave', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if(result.status === "success"){
                alert("Assessment saved!");
            } else {
                alert("Save failed: " + (result.message || "Unknown error"));
            }
        } catch(err) {
            alert("Save failed: " + err.message);
        }
        alert('Assessment saved successfully! (This would connect to your database in a real application)');
    }
    function clearForm() {
        if (confirm('Are you sure you want to clear all form data?')) {
            document.querySelectorAll('input, select, textarea').forEach(element => {
                if (element.type === 'date') {
                    element.value = new Date().toISOString().split('T')[0];
                } else if (element.type === 'time') {
                    if (element.id === 'startTime') element.value = '10:30';
                    else if (element.id === 'endTime') element.value = '12:30';
                    else element.value = '';
                } else {
                    element.value = element.defaultValue || '';
                }
            });
            // Reset all indicators to proficient (default)
            skills.forEach((_, index) => {
                updateIndicator(index);
            });
            document.getElementById('reportPreview').style.display = 'none';
        }
    }
    // Initialize the form when the page loads
    document.addEventListener('DOMContentLoaded', initializeForm);
</script>