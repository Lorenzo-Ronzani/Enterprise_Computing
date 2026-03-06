<?php
$BASE_URL = $_SERVER["PHP_SELF"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student App</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    nav a { margin-right: 10px; }
    .msg { padding: 10px; background: #f3f3f3; border: 1px solid #ddd; margin: 10px 0; }
    .card { border: 1px solid #ddd; padding: 15px; margin-top: 10px; }
    input { padding: 8px; margin: 5px 0; width: 280px; }
    button { padding: 8px 12px; cursor: pointer; }
    table { border-collapse: collapse; width: 100%; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
  </style>
</head>
<body>

<nav>
  <?php if (isset($_SESSION["user_id"])): ?>
    <strong>Welcome, <?= htmlspecialchars($_SESSION["username"] ?? "User") ?></strong> |
    <a href="<?= $BASE_URL ?>?page=students">Students</a>
    <a href="<?= $BASE_URL ?>?page=students_create">Create Student</a>
    <form method="POST" action="<?= $BASE_URL ?>" style="display:inline;">
      <button type="submit" name="logout_user">Logout</button>
    </form>
  <?php else: ?>
    <a href="<?= $BASE_URL ?>?page=login">Login</a>
    <a href="<?= $BASE_URL ?>?page=register">Register</a>
  <?php endif; ?>
</nav>

<?php if (!empty($_SESSION["message"])): ?>
  <div class="msg"><?= htmlspecialchars($_SESSION["message"]) ?></div>
  <?php unset($_SESSION["message"]); ?>
<?php endif; ?>

<hr />