<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Here</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">
</head>
<body>
    <div class="wrapper">
        <form id="login_form" method="POST" action="<?= base_url('login/auth'); ?>">
            <h1>Login</h1>
            <div class="input-box">
                <label for="Username"></label>
                <input type="text" name="username" id="Username" placeholder="Username" autocomplete="off" autocorrect="off" autocapitalize="none">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <label for="Password"></label>
                <input type="password" name="password" id="Password" placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
            </div>
            <button type="submit" name="signin" class="btn">Login</button>
            <div class="ac">
                <p>Don't have an account? Please contact your admin.</p>
            </div>
        </form>
        <p id="loginStatus"></p>
    </div>
</body>