<?php
// Start a session to read the data saved by index.php
session_start();

// If there is no data, send the user back to the form
if (empty($_SESSION['student'])) {
    header('Location: index.php');
    exit;
}

// Get the student data
$s = $_SESSION['student'];

// Delete the data so a page refresh does not show it again
unset($_SESSION['student']);

// Short function to print a value safely (prevents XSS)
$h = fn($k) => htmlspecialchars($s[$k]);

// Split the data into three sections (section => [field => label])
$sections = [
    'Personal Information' => ['name' => 'Name', 'pob' => 'Place of Birth', 'dob' => 'Date of Birth', 'address' => 'Address', 'gender' => 'Gender', 'telephone' => 'Telephone', 'email' => 'Email'],
    'Parent Information' => ['parent_name' => 'Name', 'parent_telephone' => 'Telephone', 'relationship' => 'Relationship'],
    'Academic Information' => ['student_id' => 'Student ID', 'faculty' => 'Faculty', 'department' => 'Department', 'class' => 'Class', 'reg_date' => 'Registration Date'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration Details</title>
<!-- Load Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

  <!-- Success message -->
  <div class="alert alert-success text-center">Registration completed successfully!</div>

  <div class="card shadow">
    <!-- Page title -->
    <div class="card-header bg-primary text-white text-center">
      <h3 class="mb-0">Submitted Student Information</h3>
    </div>
    <div class="card-body">

      <!-- Table showing the student information -->
      <table class="table table-bordered table-striped">

        <!-- First loop: go through each section (Personal, Parent, Academic) -->
        <?php foreach ($sections as $title => $rows): ?>

          <!-- Section heading -->
          <thead class="table-dark"><tr><th colspan="2"><?= $title ?></th></tr></thead>

          <!-- Second loop: print each row (label and value) -->
          <tbody>
            <?php foreach ($rows as $key => $label): ?>
              <tr><th style="width:30%"><?= $label ?></th><td><?= $h($key) ?></td></tr>
            <?php endforeach; ?>
          </tbody>

        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>