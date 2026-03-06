<?php 
require_once __DIR__ . "/../layout/header.php";
require_once __DIR__ . "/../layout/footer.php";
 ?>

<h2>Register</h2>

<div class="card">
  <form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
    <div>
      <label>Username</label><br />
      <input type="text" name="username" required />
    </div>

    <div>
      <label>Email</label><br />
      <input type="email" name="email" required />
    </div>

    <div>
      <label>Password</label><br />
      <input type="password" name="password" required />
    </div>

    <button type="submit" name="register_user">Create Account</button>
  </form>

  <p>
    Already have an account?
    <a href="<?= $_SERVER["PHP_SELF"] ?>?page=login">Login</a>
  </p>
</div>

<?php include __DIR__ . "/../layout/Footer.php"; ?>