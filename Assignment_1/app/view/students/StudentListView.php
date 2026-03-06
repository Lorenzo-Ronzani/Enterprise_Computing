<?php include __DIR__ . "/../layout/Header.php"; ?>

<h2>Students</h2>

<?php if (empty($students)): ?>
  <p>No students yet.</p>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($students as $s): ?>
        <tr>
          <td><?= htmlspecialchars($s["student_id"]) ?></td>
          <td><?= htmlspecialchars($s["name"]) ?></td>
          <td><?= htmlspecialchars($s["email"]) ?></td>
          <td>
            <form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>" onsubmit="return confirm('Delete this student?');">
              <input type="hidden" name="id" value="<?= (int)$s["id"] ?>" />
              <button type="submit" name="delete_student">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php include __DIR__ . "/../layout/Footer.php"; ?>