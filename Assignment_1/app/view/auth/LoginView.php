<?php require_once __DIR__ . "/../layout/header.php"; ?>
<div class="login">
<h2>Login</h2>
    
    <form method="POST" action="<?= $_SERVER["PHP_SELF"] ?>">
        <div>
            <label>Email</label><br>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login_user">Login</button>
    </form>

    <p>
        Don’t have an account?
        <a href="<?= $_SERVER["PHP_SELF"] ?>?page=register">Register</a>
    </p>
</div>

<?php require_once __DIR__ . "/../layout/footer.php"; ?>