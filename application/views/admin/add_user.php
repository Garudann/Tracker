<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add New User</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: url(https://i.redd.it/cdb8iertk00f1.png) no-repeat center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .main-content {
            position: relative;
            margin-left: 250px;
            padding-top: 80px;
            padding-left: 20px;
            padding-right: 20px;
            min-height: calc(100vh - 80px);
            color: white;
        }

        .container {
            backdrop-filter: blur(3px);
            border-radius: 10px;
            padding: 30px;
            max-width: 6000px;
            margin: 0 auto;
            background: 'transparent';
            animation: fadeIn 1.2s ease-in-out;
        }

        h2 {
            text-align: left;
            margin-bottom: 30px;
            color: white;
            font-size: 28px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        ::placeholder {
            color: #ccc;
        }
        .create_user-table td {
            padding: 10px;
        }
        .create-user-table label {
            color: white !important;
            font-weight: bold;
        }
        .create-user-table{
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 50px;
        }
        .input{
            position: relative;
            width: 100%;
            height: 30px;
            margin: 0px;
            background: transparent;
        }
        .input.input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgb(255,255,225,.2);
            border-radius: 40px;
            font-size: 15px;
            color: #fff;
            padding: 20px 45px 20px 20px;
        }
        .input.input::placeholder{
            color: #fff;
        }
        .btn{
            width: 20%;
            height: 35px;
            margin-top: 10px;
            background-color: transparent;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgb(0, 0, 0 .1);
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            border-color: black;
            border-width: 2px;
            border-radius: 15px;
            border-style: solid;
            align-items: center;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 30px;
        }
        #profile{
            background: transparent;
            color: #fff;
            border: 1px solid #555;
            border-radius: 15px;
            padding: 15px;
            font-size: 14px;
            cursor: pointer;
            width: 100%;
            outline: none;
        }
        #profile option{
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php $this->load->view('includes/header'); ?>
    <?php $this->load->view('includes/sidebar'); ?>
    <div class="main-content">
        <h2>Add New User</h2>
        <div class="container"> 
            <form action="#" method="POST" id="userForm">
                <table style="width:100%; gap:15px;" class="create-user-table">
                    <tr>
                        <td><label for="fname">first Name *</label></td>
                        <td><input type="text" id="fname" name="title" required placeholder="Enter First name" class="input"/></td>
                    </tr>
                    <tr>
                        <td><label for="lname">last Name *</label></td>
                        <td><input type="text" id="lname" name="title" required placeholder="Enter Last name" class="input"/></td>
                    </tr>
                    <tr>
                        <td><label for="mail">Email *</label></td>
                        <td><input type="text" id="mail" name="mail" required placeholder="Enter Your Mail ID" class="input"></td>
                    </tr>
                    <tr>
                        <td><label for="mail">Mobile *</label></td>
                        <td><input type="text" id="mobile" name="mobile" required placeholder="Enter Your Mobile Number" class="input"></td>
                    </tr>
                    <tr>
                        <td><label for="username">Username *</label></td>
                        <td><input type="text" id="username" name="username" required placeholder="Enter username" class="input"></td>
                    </tr>
                    <tr>
                        <td><label for="username">Password *</label></td>
                        <td><input type="password" id="pasword" name="password" required placeholder="Enter password" class="input"></td>
                    </tr>
                    <tr>
                        <td><label for="profile">Profile *</label></td>
                        <td><select name="profile" id="profile">
                            <option value="0">Super Admin</option>
                            <option value="1">Admin</option>
                        </select></td>
                    </tr>
                </table>
                <div class="btn-group">
                    <button type="submit" class="btn btn-submit" id="createuserBtn" style="background-color: #739674ff; color: white;">Create user</button>
                    <button type="button" class="btn btn-cancel" id="canceluserBtn" style="background-color: #56577cff; color: white;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
<script>
var base_url = "<?= base_url(); ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/general.js'); ?>"></script>