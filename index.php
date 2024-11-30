<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coploot - Signup & Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        :root {
            --primary-color: #0072ff;
            --secondary-color: #00c6ff;
            --text-dark: #333;
            --text-light: #555;
            --white: #ffffff;
        }
        body {
            font-family: 'Inter', 'Arial', sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
            overflow: hidden;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            max-width: 600px;
            padding: 0 20px;
        }
        .form-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 60px 50px;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1), 0 5px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            transform: rotateX(-10deg) scale(0.9);
            opacity: 0;
            animation: fadeInUp 0.8s forwards;
        }
        @keyframes fadeInUp {
            to {
                transform: rotateX(0) scale(1);
                opacity: 1;
            }
        }
        .logo {
            width: 180px;
            margin-bottom: 40px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }
        h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color: var(--text-dark);
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .description {
            font-size: 22px;
            margin-bottom: 40px;
            color: var(--text-light);
            line-height: 1.6;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            width: 100%;
        }
        .btn {
            background-color: var(--primary-color);
            color: var(--white);
            font-size: 20px;
            padding: 18px 40px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            width: 220px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        .btn i {
            font-size: 24px;
            transition: transform 0.3s ease;
        }
        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 114, 255, 0.3);
        }
        .btn:hover i {
            transform: translateX(5px);
        }
        .btn:active {
            transform: scale(0.95) translateY(0);
        }
        .footer {
            margin-top: 40px;
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            animation: fadeIn 1s delay 0.5s backwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @media (max-width: 600px) {
            .button-container {
                flex-direction: column;
                align-items: center;
            }
            .btn {
                width: 100%;
                max-width: 300px;
            }
            h1 {
                font-size: 32px;
            }
            .description {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <img src="https://www.cnet.com/a/img/resize/2526e6bcbbf40798d060fce84b8a0dc75a7eb511/hub/2023/09/22/fa93b5eb-81f5-4601-8421-779132ffc8fd/copilot-logo-1.jpg?auto=webp&fit=crop&height=1200&width=1200" alt="Coploot Logo" class="logo">
            
            <h1>Welcome to Copilot</h1>
            <p class="description">Choose how you want to get started with your account</p>
            <div class="button-container">
                <button class="btn" id="signup-btn">
                    <i class="fas fa-user-plus"></i>
                    Signup
                </button>
                <button class="btn" id="login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </button>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; 2024 Coploot. All Rights Reserved.</p>
        </div>
    </div>
    <script>
        document.getElementById('signup-btn').addEventListener('click', function() {
            window.location.href = 'signup.php';
        });
        document.getElementById('login-btn').addEventListener('click', function() {
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>