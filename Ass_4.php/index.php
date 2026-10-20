<?php
// Start a session so we can pass data to result.php
session_start();

// List of all form fields (field name => label)
$fields = [
    'name' => 'Name', 'pob' => 'Place of Birth', 'dob' => 'Date of Birth',
    'address' => 'Address', 'gender' => 'Gender', 'telephone' => 'Telephone', 'email' => 'Email',
    'parent_name' => 'Parent Name', 'parent_telephone' => 'Parent Telephone', 'relationship' => 'Relationship',
    'student_id' => 'Student ID', 'faculty' => 'Faculty', 'department' => 'Department',
    'class' => 'Class', 'reg_date' => 'Registration Date',
];

// Store what the user typed (empty at the start)
$data = array_fill_keys(array_keys($fields), '');

// Store the error messages (empty at the start)
$errors = [];

// Run only when the Register button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check every field is filled, otherwise add an error
    foreach ($fields as $key => $label) {
        $data[$key] = trim($_POST[$key] ?? '');
        if ($data[$key] === '') {
            $errors[$key] = "Please enter your $label.";
        }
    }

    // Name must contain only letters and spaces
    if (!isset($errors['name']) && !preg_match('/^[A-Za-z\s]+$/', $data['name'])) {
        $errors['name'] = 'Name must contain only letters and spaces.';
    }

    // Parent name must contain only letters and spaces
    if (!isset($errors['parent_name']) && !preg_match('/^[A-Za-z\s]+$/', $data['parent_name'])) {
        $errors['parent_name'] = 'Parent name must contain only letters and spaces.';
    }

    // Check the email has a valid format
    if (!isset($errors['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address (e.g. name@example.com).';
    }

    // Check both phone numbers are valid (7-15 digits)
    foreach (['telephone', 'parent_telephone'] as $t) {
        if (!isset($errors[$t]) && !preg_match('/^\+?[0-9\s\-]{7,15}$/', $data[$t])) {
            $errors[$t] = 'Enter a valid phone number (7-15 digits).';
        }
    }

    // If there are no errors, save the data and go to result.php
    if (empty($errors)) {
        $_SESSION['student'] = $data;
        header('Location: result.php');
        exit;
    }
}

// Return a field's value safely so it stays in the form after an error
function val($k) { global $data; return htmlspecialchars($data[$k]); }

// Return the Bootstrap class: red if error, green if correct
function cls($k) {
    global $errors;
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return '';
    return isset($errors[$k]) ? 'is-invalid' : 'is-valid';
}

// Show the error message under a field
function err($k) {
    global $errors;
    return isset($errors[$k]) ? '<div class="invalid-feedback">' . htmlspecialchars($errors[$k]) . '</div>' : '';
}

// Get the first field with an error (the cursor will go there)
$firstError = $errors ? array_key_first($errors) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Registration</title>
<!-- Load Bootstrap CSS (needs internet) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card shadow">
    <!-- Form title -->
    <div class="card-header bg-primary text-white text-center">
      <h3 class="mb-0">Student Registration Form</h3>
    </div>
    <div class="card-body">

      <!-- The form (novalidate: PHP does the validation, not the browser) -->
      <form method="post" action="index.php" novalidate>

        <!-- Section 1: Personal Information -->
        <h5 class="text-primary border-bottom pb-2">Personal Information</h5>
        <div class="row g-3 mb-4">

          <!-- Name field -->
          <div class="col-md-6">
            <label class="form-label" for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control <?= cls('name') ?>" value="<?= val('name') ?>">
            <?= err('name') ?>
          </div>

          <!-- Place of Birth field -->
          <div class="col-md-6">
            <label class="form-label" for="pob">Place of Birth (POB)</label>
            <input type="text" id="pob" name="pob" class="form-control <?= cls('pob') ?>" value="<?= val('pob') ?>">
            <?= err('pob') ?>
          </div>

          <!-- Date of Birth field -->
          <div class="col-md-6">
            <label class="form-label" for="dob">Date of Birth (DOB)</label>
            <input type="date" id="dob" name="dob" class="form-control <?= cls('dob') ?>" value="<?= val('dob') ?>">
            <?= err('dob') ?>
          </div>

          <!-- Address field -->
          <div class="col-md-6">
            <label class="form-label" for="address">Address</label>
            <input type="text" id="address" name="address" class="form-control <?= cls('address') ?>" value="<?= val('address') ?>">
            <?= err('address') ?>
          </div>

          <!-- Gender: radio buttons (Male / Female) -->
          <div class="col-md-6">
            <label class="form-label d-block" id="gender">Gender</label>
            <?php foreach (['Male', 'Female'] as $g): ?>
              <div class="form-check form-check-inline">
                <input class="form-check-input <?= isset($errors['gender']) ? 'is-invalid' : '' ?>" type="radio" name="gender" id="g_<?= $g ?>" value="<?= $g ?>" <?= $data['gender'] === $g ? 'checked' : '' ?>>
                <label class="form-check-label" for="g_<?= $g ?>"><?= $g ?></label>
              </div>
            <?php endforeach; ?>
            <?php if (isset($errors['gender'])): ?><div class="text-danger small"><?= $errors['gender'] ?></div><?php endif; ?>
          </div>

          <!-- Telephone field -->
          <div class="col-md-6">
            <label class="form-label" for="telephone">Telephone</label>
            <input type="text" id="telephone" name="telephone" class="form-control <?= cls('telephone') ?>" value="<?= val('telephone') ?>">
            <?= err('telephone') ?>
          </div>

          <!-- Email field -->
          <div class="col-md-12">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control <?= cls('email') ?>" value="<?= val('email') ?>">
            <?= err('email') ?>
          </div>
        </div>

        <!-- Section 2: Parent Information -->
        <h5 class="text-primary border-bottom pb-2">Parent Information</h5>
        <div class="row g-3 mb-4">

          <!-- Parent Name field -->
          <div class="col-md-4">
            <label class="form-label" for="parent_name">Parent Name</label>
            <input type="text" id="parent_name" name="parent_name" class="form-control <?= cls('parent_name') ?>" value="<?= val('parent_name') ?>">
            <?= err('parent_name') ?>
          </div>

          <!-- Parent Telephone field -->
          <div class="col-md-4">
            <label class="form-label" for="parent_telephone">Parent Telephone</label>
            <input type="text" id="parent_telephone" name="parent_telephone" class="form-control <?= cls('parent_telephone') ?>" value="<?= val('parent_telephone') ?>">
            <?= err('parent_telephone') ?>
          </div>

          <!-- Relationship: dropdown list -->
          <div class="col-md-4">
            <label class="form-label" for="relationship">Relationship</label>
            <select id="relationship" name="relationship" class="form-select <?= cls('relationship') ?>">
              <option value="">-- Select --</option>
              <?php foreach (['Father', 'Mother', 'Brother', 'Sister', 'Uncle', 'Aunt', 'Guardian'] as $r): ?>
                <option <?= $data['relationship'] === $r ? 'selected' : '' ?>><?= $r ?></option>
              <?php endforeach; ?>
            </select>
            <?= err('relationship') ?>
          </div>
        </div>

        <!-- Section 3: Academic Information -->
        <h5 class="text-primary border-bottom pb-2">Academic Information</h5>
        <div class="row g-3 mb-4">

          <!-- Student ID field -->
          <div class="col-md-4">
            <label class="form-label" for="student_id">Student ID</label>
            <input type="text" id="student_id" name="student_id" class="form-control <?= cls('student_id') ?>" value="<?= val('student_id') ?>">
            <?= err('student_id') ?>
          </div>

          <!-- Faculty: dropdown list -->
          <div class="col-md-4">
            <label class="form-label" for="faculty">Faculty</label>
            <select id="faculty" name="faculty" class="form-select <?= cls('faculty') ?>">
              <option value="">-- Select --</option>
              <?php foreach (['Computer & IT', 'Engineering', 'Business Administration', 'Education', 'Health Sciences'] as $f): ?>
                <option <?= $data['faculty'] === $f ? 'selected' : '' ?>><?= $f ?></option>
              <?php endforeach; ?>
            </select>
            <?= err('faculty') ?>
          </div>

          <!-- Department field -->
          <div class="col-md-4">
            <label class="form-label" for="department">Department</label>
            <input type="text" id="department" name="department" class="form-control <?= cls('department') ?>" value="<?= val('department') ?>">
            <?= err('department') ?>
          </div>

          <!-- Class field -->
          <div class="col-md-6">
            <label class="form-label" for="class">Class</label>
            <input type="text" id="class" name="class" class="form-control <?= cls('class') ?>" value="<?= val('class') ?>">
            <?= err('class') ?>
          </div>

          <!-- Registration Date field -->
          <div class="col-md-6">
            <label class="form-label" for="reg_date">Registration Date</label>
            <input type="date" id="reg_date" name="reg_date" class="form-control <?= cls('reg_date') ?>" value="<?= val('reg_date') ?>">
            <?= err('reg_date') ?>
          </div>
        </div>

        <!-- Register button that submits the form -->
        <div class="text-center">
          <button type="submit" class="btn btn-primary btn-lg px-5">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if ($firstError): ?>
<script>
  // If there is an error, scroll to the first wrong field and put the cursor there
  const el = document.getElementById(<?= json_encode($firstError) ?>);
  if (el) { el.scrollIntoView({behavior: 'smooth', block: 'center'}); el.focus(); }
</script>
<?php endif; ?>
</body>
</html>