<!DOCTYPE html>
<html>

<head>
    <title>Registration Form</title>
    <link rel="icon" type="image/x-icon" href="./img/1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .registration-form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 85%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .registration-form {
            border: 1px solid #ccc;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus {
            border-color: #4CAF50;
        }

        .form-group input[type="submit"] {
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .form-group .contact-number {
            display: flex;
            align-items: center;
            max-width: 90%;
        }

        .form-group .contact-number input[type="text"] {
            margin-left: 5px;
        }

        #default-number {
            max-width: 10%;
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
    <h1>Registration Form</h1>
        <form method="POST" action="reg_data.php" autocomplete="off">
            <div class="form-group">
                <label for="name">Name:<sup style="color:red">*</sup></label>
                <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
                <label for="roll">Roll Number<sup style="color:red">*</sup></label>
                <input type="text" id="roll" name="roll" placeholder="Enter Your Roll Number" required>
            </div>

            <div class="form-group">
                <label>Contact Number:<sup style="color:red">*</sup></label>
                <div class="contact-number">
                    <input type="text" value="+91" id="default-number" readonly>
                    <input type="text" id="number" name="number" placeholder="Enter your Phone Number" required>
                </div>
            </div>

            <div class="form-group">
                <label for="course">Course:<sup style="color:red">*</sup></label>
                <input type="text" id="course" name="course" placeholder="Enter Your Course" required>
            </div>

            <div class="form-group">
                <label for="address">Address:<sup style="color:red">*</sup></label>
                <input type="text" id="address" name="address" placeholder="Enter Your Address" required>
            </div>
            <div class="form-group">
                <label for="username">User Name:<sup style="color:red">*</sup></label>
                <input type="text" id="username" name="username" placeholder="Enter Your User Name" required>
            </div>

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

            <div class="form-group">
                <input type="submit" value="Register">
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
    </script>
</body>

</html>