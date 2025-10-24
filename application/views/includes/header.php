<div class="header">
    <div class="welcome">
        <h1>Welcome,</h1>
        <span class="user"><?= ucfirst($this->session->userdata('username')); ?></span>
    </div>
    <div class="logout">
        <a href="<?= base_url('login/logout'); ?>">Logout</a>
    </div>
</div>

<style>
.header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    background: rgba(0,0,0,0.45);
    color: white;
    z-index: 1001;
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    font-family: Arial, sans-serif;
}
.welcome {
    display: flex;
    align-items: center;
    gap: 8px;
}
.welcome h1 {
    margin: 0;
    font-size: 22px;
}
.user {
    font-size: 18px;
    font-weight: 500;
}
.logout a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    margin-right: 50px;
}
.logout a:hover {
    text-decoration: underline;
}
</style>
