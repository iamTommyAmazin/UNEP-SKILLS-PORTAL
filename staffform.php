<?php
// To connect to the mysql database Database connection
require_once '../config/db.php';

// Get the deatails from database
$educationLevels = $pdo->query("SELECT * FROM education_levels")->fetchAll();
$dutyStations = $pdo->query("SELECT * FROM duty_stations")->fetchAll();
$softwareOptions = $pdo->query("SELECT * FROM software_expertise")->fetchAll();
$languages = $pdo->query("SELECT * FROM languages")->fetchAll();
$responsibilityLevels = ['Junior', 'Mid-level', 'Senior', 'Manager', 'Director'];
$expertiseLevels = ['Beginner', 'Intermediate', 'Advanced', 'Expert'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UNEP Staff Information Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="form-container">
        <h1>Staff Information Form</h1>
        
        <form action="process_staff.php" method="POST" id="staffForm">
            <!-- Basic Information Section -->
            <fieldset>
                <legend>Personal Information</legend>
                
                <div class="form-group">
                    <label for="indexNumber">Index Number:*</label>
                    <input type="text" id="indexNumber" name="indexNumber" required>
                </div>
                
                <div class="form-group">
                    <label for="fullNames">Full Names:*</label>
                    <input type="text" id="fullNames" name="fullNames" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:*</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="currentLocation">Current Location:</label>
                    <input type="text" id="currentLocation" name="currentLocation">
                </div>
            </fieldset>
            
            <!-- Education and Position Section -->
            <fieldset>
                <legend>Education & Position</legend>
                
                <div class="form-group">
                    <label for="education">Highest Level of Education:*</label>
                    <select id="education" name="education" required>
                        <option value="">-- Select --</option>
                        <?php foreach ($educationLevels as $level): ?>
                            <option value="<?= $level['id'] ?>"><?= htmlspecialchars($level['level_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="dutyStation">Duty Station:*</label>
                    <select id="dutyStation" name="dutyStation" required>
                        <option value="">-- Select --</option>
                        <?php foreach ($dutyStations as $station): ?>
                            <option value="<?= $station['id'] ?>"><?= htmlspecialchars($station['station_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Availability for Remote Work:</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="remoteWork" value="1"> Yes
                        </label>
                        <label>
                            <input type="radio" name="remoteWork" value="0" checked> No
                        </label>
                    </div>
                </div>
            </fieldset>
            
            <!-- Skills Section -->
            <fieldset>
                <legend>Skills & Expertise</legend>
                
                <div class="form-group">
                    <label for="software">Software Expertise:*</label>
                    <select id="software" name="software" required>
                        <option value="">-- Select --</option>
                        <?php foreach ($softwareOptions as $software): ?>
                            <option value="<?= $software['id'] ?>"><?= htmlspecialchars($software['software_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="expertiseLevel">Expertise Level:*</label>
                    <select id="expertiseLevel" name="expertiseLevel" required>
                        <option value="">-- Select --</option>
                        <?php foreach ($expertiseLevels as $level): ?>
                            <option value="<?= $level ?>"><?= $level ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="language">Language:*</label>
                    <select id="language" name="language" required>
                        <option value="">-- Select --</option>
                        <?php foreach ($languages as $lang): ?>
                            <option value="<?= $lang['id'] ?>"><?= htmlspecialchars($lang['language_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                 <div class="form-group">
                    <label for="responsibility">Level of Responsibility:*</label>
                    <select id="responsibility" name="responsibility" required>
                        <option value="">-- Select --</option>
                        <?php foreach ($responsibilityLevels as $level): ?>
                            <option value="<?= $level ?>"><?= $level ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </fieldset>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">Save Information</button>
                <button type="reset" class="btn-reset">Clear Form</button>
            </div>
        </form>
    </div>

    <script src="newskillportal.js"></script>
</body>
</html>
