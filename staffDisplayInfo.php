<?php
// Database connection and authentication check
require_once '../config/db.php';
require_once '../includes/auth_check.php';

// Fetch all staff with their education and duty station info
$query = "SELECT s.id, s.index_number, s.full_names, s.email, s.current_location, 
                 e.level_name AS education, d.station_name AS duty_station
          FROM staff s
          LEFT JOIN education_levels e ON s.highest_education_id = e.id
          LEFT JOIN duty_stations d ON s.duty_station_id = d.id
          ORDER BY s.full_names";

$staffMembers = $pdo->query($query)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UNEP Staff Directory</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Staff Directory</h1>
        
        <!-- Add New Staff Button -->
        <div class="action-bar">
            <a href="add.php" class="btn-add">
                <i class="fas fa-plus"></i> Add New Staff
            </a>
        </div>
        
        <!-- Staff Listing Table -->
        <table class="staff-table">
            <thead>
                <tr>
                    <th>Index Number</th>
                    <th>Full Names</th>
                    <th>Email</th>
                    <th>Current Location</th>
                    <th>Highest Education</th>
                    <th>Duty Station</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($staffMembers) > 0): ?>
                    <?php foreach ($staffMembers as $staff): ?>
                    <tr>
                        <td><?= htmlspecialchars($staff['index_number']) ?></td>
                        <td><?= htmlspecialchars($staff['full_names']) ?></td>
                        <td><a href="mailto:<?= htmlspecialchars($staff['email']) ?>"><?= htmlspecialchars($staff['email']) ?></a></td>
                        <td><?= htmlspecialchars($staff['current_location']) ?></td>
                        <td><?= htmlspecialchars($staff['education']) ?></td>
                        <td><?= htmlspecialchars($staff['duty_station']) ?></td>
                        <td class="actions">
                            <a href="edit.php?id=<?= $staff['id'] ?>" class="btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete.php?id=<?= $staff['id'] ?>" class="btn-delete" title="Delete" 
                               onclick="return confirm('Are you sure you want to delete this staff record?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="no-records">No staff records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <!-- Status message display -->
        <?php if (isset($_GET['msg'])): ?>
            <div class="status-msg <?= $_GET['msg'] === 'deleted' ? 'error' : 'success' ?>">
                <?php
                switch ($_GET['msg']) {
                    case 'added':
                        echo "New staff record added successfully!";
                        break;
                    case 'updated':
                        echo "Staff record updated successfully!";
                        break;
                    case 'deleted':
                        echo "Staff record deleted successfully!";
                        break;
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Confirm before delete
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (!confirm('Are you sure you want to delete this record?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
