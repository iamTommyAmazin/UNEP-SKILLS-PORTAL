<?php
// Database configuration
define('DB_HOST', 'localhost');     // Database server
define('DB_USER', 'unep_admin');    // Database username
define('DB_PASS', 'SecurePassword123!');  // Database password
define('DB_NAME', 'unep_skills_db');      // Database name

try {
    // Create PDO connection
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
    );

// Get dropdown options from database
$educationOptions = $pdo->query("SELECT * FROM education_levels")->fetchAll();
$stationOptions = $pdo->query("SELECT * FROM duty_stations")->fetchAll();
$softwareOptions = $pdo->query("SELECT * FROM software_expertise")->fetchAll();
$languageOptions = $pdo->query("SELECT * FROM languages")->fetchAll();

// Static dropdown options
$skillLevels = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];
$jobLevels = ['Junior', 'Mid-level', 'Senior', 'Manager', 'Director'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Registration Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="form-wrapper">
        <h1>Staff Registration</h1>
        
        <form method="POST" action="save_staff.php">
            
            <h2>Personal Details</h2>
            <div class="form-row">
                <label>Staff ID Number*</label>
                <input type="text" name="staff_id" required>
            </div>
            
            <div class="form-row">
                <label>Full Name*</label>
                <input type="text" name="full_name" required>
            </div>
            
            <div class="form-row">
                <label>Email*</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-row">
                <label>Current Location</label>
                <input type="text" name="location">
            </div>
            
            <h2>Education & Work</h2>
            <div class="form-row">
                <label>Highest Education*</label>
                <select name="education" required>
                    <option value="">Select education level</option>
                    <?php foreach($educationOptions as $option): ?>
                    <option value="<?=$option['id']?>"><?=$option['level_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-row">
                <label>Duty Station*</label>
                <select name="duty_station" required>
                    <option value="">Select duty station</option>
                    <?php foreach($stationOptions as $station): ?>
                    <option value="<?=$station['id']?>"><?=$station['station_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-row">
                <label>Available for Remote Work?</label>
                <div class="radio-options">
                    <label><input type="radio" name="remote_work" value="1"> Yes</label>
                    <label><input type="radio" name="remote_work" value="0" checked> No</label>
                </div>
            </div>
            
            <h2>Skills & Experience</h2>
            <div class="form-row">
                <label>Software Skills*</label>
                <select name="software" required>
                    <option value="">Select software</option>
                    <?php foreach($softwareOptions as $software): ?>
                    <option value="<?=$software['id']?>"><?=$software['software_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-row">
                <label>Skill Level*</label>
                <select name="skill_level" required>
                    <option value="">Select your level</option>
                    <?php foreach($skillLevels as $level): ?>
                    <option value="<?=$level?>"><?=$level?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-row">
                <label>Language*</label>
                <select name="language" required>
                    <option value="">Select language</option>
                    <?php foreach($languageOptions as $lang): ?>
                    <option value="<?=$lang['id']?>"><?=$lang['language_name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-row">
                <label>Job Level*</label>
                <select name="job_level" required>
                    <option value="">Select your level</option>
                    <?php foreach($jobLevels as $level): ?>
                    <option value="<?=$level?>"><?=$level?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-buttons">
                <button type="submit" class="submit-btn">Save Profile</button>
                <button type="reset" class="clear-btn">Start Over</button>
            </div>
        </form>
    </div>
    
</body>
</html>
