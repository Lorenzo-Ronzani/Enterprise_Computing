<?php include __DIR__ . "/../layout/Header.php"; ?>

<h2>Create Student</h2>

<div class="card">
  <form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
    <div>
      <label>Student ID</label><br />
      <input type="text" name="student_id" required />
    </div>

    <div>
      <label>Name</label><br />
      <input type="text" name="name" required />
    </div>

    <div>
      <label>Email</label><br />
      <input type="email" name="email" required />
    </div>

    <button type="submit" name="add_student">Create</button>
  </form>
</div>

<?php include __DIR__ . "/../layout/Footer.php"; ?>