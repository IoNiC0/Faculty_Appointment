<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="./img/login.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h1,
    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .registration-form {
        /* display: none; */
        max-width: 500px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="password"],
    .form-group input[type="email"] {
        width: 85%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .registration-form {
        border: 1px solid #ccc;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="password"]:focus,
    .form-group input[type="email"]:focus {
        border-color: #4CAF50;
    }

    #mybutton {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        display: block;
        margin: 0 auto;
        transition: background-color 0.3s ease;
    }

    #mybutton:hover {
        background-color: #3e8e41;
    }

    .navbar {
        background-color: #333;
        overflow: hidden;
    }

    .navbar a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .navbar a:hover {
        background-color: #4CAF50;
        color: white;
    }

    .navbar a.active {
        background-color: #4CAF50;
        color: white;
    }

    .navbar {
        display: flex;
        justify-content: center;
    }

    .navbar a {
        margin: 0 10px;
    }


    .navbar a.active {
        border-bottom: 2px solid white;
    }

    @media screen and (max-width: 600px) {
        .navbar {
            flex-direction: column;
        }

        .navbar a {
            margin: 5px 0;
        }
    }
    .password-input-wrapper {
            position: relative;
        }

        .show-password-btn {
            position: absolute;
            right: 10px;
            top: 60%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            cursor: pointer;
            outline: none;
            font-size: 16px;
            color: #555;
        }

        .show-password-btn i {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="./f_view.php">Faculty Members</a>
        <a href="./std_view.php">Student Details</a>
        <a href="./show_app.php">Appointment Details</a>
    </div>
    <h3></h3>
    <div class="registration-form">
        <select id="loginType" onchange="toggleLoginForm()">
            <option value="">-- Select Your Role --</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <form method="post" action="sent_otp.php" autocomplete="off" style="display: none;" id="userLoginForm">
            <h2>Student Login</h2>
            <div class="form-group" id="userROll">
                <label for="email">Email:<sup style="color:red">*</sup></label>
                <input type="email" id="email" name="semail" placeholder="Enter Your Email" required>
            </div>
            <div class="form-group">
                <button type="submit" id="mybutton">Send OTP</button>
            </div>
        </form>
        
</form>

        <form method="post" action="login_data_admin.php" autocomplete="off" style="display: none;" id="adminLoginForm">
            <div class="form-group">
                <h2>Admin Login</h2>
                <label for="email">Email:<sup style="color:red">*</sup></label>
                <input type="email" placeholder="Enter Your Email" id="email" name="email"><br><br>
                <div class="form-group password-input-wrapper">
                <label for="password">Password:<sup style="color:red">*</sup></label>
                <div style="position: relative; display: flex;">
                    <input type="password" id="password" name="password" placeholder="Enter Your Password" required
                        oninput="toggleShowPasswordButton()">
                    <button type="button" class="show-password-btn" onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            </div>
            <div class="form-group">
                <button type="submit" id="mybutton">Login</button>
            </div>
        </form>
    </div>
    <script>
         function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const showPasswordBtn = document.querySelector('.show-password-btn');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }

        function toggleShowPasswordButton() {
            const passwordInput = document.getElementById('password');
            const showPasswordBtn = document.querySelector('.show-password-btn');

            if (passwordInput.value.length > 0) {
                showPasswordBtn.classList.add('active');
            } else {
                showPasswordBtn.classList.remove('active');
            }
        }
    function toggleLoginForm() {
        var loginType = document.getElementById("loginType").value;
        var otpForm = document.getElementById("otpForm");

        if (loginType === "user") {
            document.getElementById("userLoginForm").style.display = "block";
            document.getElementById("adminLoginForm").style.display = "none";
           
        } else if (loginType === "admin") {
            document.getElementById("userLoginForm").style.display = "none";
            document.getElementById("adminLoginForm").style.display = "block";
            
        }
    }
    </script>
</body>

</html>