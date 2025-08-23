<style>
  .member-login-container {
    max-width: 400px;
    margin: 100px auto;
    padding: 2rem;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    background: #FFFFFF;
  }

  .member-login-container h2 {
    text-align: center;
    margin-bottom: 1.5rem;
  }

  .member-login-container label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .member-login-container input[type="text"],
  .member-login-container input[type="password"] {
    width: 100%;
    padding: 0.7rem;
    margin-bottom: 1rem;
    border: 1px solid #CCCCCC;
    border-radius: 5px;
  }

  .member-login-container button {
    width: 100%;
    padding: 0.8rem;
    background-color: #0073aa;
    color: white;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
  }

  .member-login-container button:hover {
    background-color: #005177;
  }

  .member-login-container .member-login-message {
    text-align: center;
    margin-top: 1rem;
    color: red;
  }
</style>

<div class="member-login-container">
  <h2>Member Login</h2>

  <form method="post">
    <label for="member_username">Username</label>
    <input type="text" name="member_username" id="member_username" required />

    <label for="member_password">Password</label>
    <input type="password" name="member_password" id="member_password" required />

    <button type="submit">Log In</button>
  </form>

  <?php if (!empty($_GET['login']) && $_GET['login'] === 'failed') : ?>
    <div class="member-login-message">Invalid username or password.</div>
  <?php endif; ?>
</div>