<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Online Education</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fce0e8 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 1000px;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            background: white;
        }

        @media (min-width: 768px) {
            .login-container {
                flex-direction: row;
            }
        }

        .illustration-section {
            flex: 1;
            background: linear-gradient(135deg, #fce0e8 0%, #f8f4ff 100%);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .form-section {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (min-width: 768px) {
            .form-section {
                padding: 3rem;
            }
        }

        .title {
            color: #ec4899;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        @media (min-width: 640px) {
            .title {
                font-size: 2.5rem;
            }
        }

        .subtitle {
            color: #4b5563;
            margin-bottom: 2rem;
            max-width: 300px;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            text-align: center;
            margin-bottom: 2rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 2rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border-radius: 9999px;
            border: 2px solid #fce0e8;
            font-size: 1rem;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #ec4899;
            box-shadow: 0 0 0 2px rgba(236, 72, 153, 0.2);
        }

        .options-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .remember {
            display: flex;
            align-items: center;
        }

        .checkbox {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 2px solid #d1d5db;
            margin-right: 0.5rem;
            accent-color: #ec4899;
        }

        .forgot-link {
            color: #6b7280;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #ec4899;
        }

        .login-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #ec4899;
            color: white;
            border: none;
            border-radius: 9999px;
            font-size: 1.125rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .login-button:hover {
            background-color: #db2777;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .register-link a {
            color: #6b7280;
            text-decoration: none;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: #ec4899;
        }

        .separator {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .separator-line {
            flex: 1;
            height: 1px;
            background-color: #d1d5db;
        }

        .separator-text {
            padding: 0 1rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .social-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 9999px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
        }

        .social-button:hover {
            background-color: #f9fafb;
        }

        .social-icon {
            margin-right: 0.5rem;
        }

        .google-icon {
            color: #ef4444;
        }

        .facebook-icon {
            color: #3b82f6;
        }

        .github-icon {
            color: #000000;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            padding-left: 1rem;
        }

        .education-illustration {
            width: 100%;
            max-width: 400px;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Illustration Section -->
        <div class="illustration-section">
            <h1 class="title">ONLINE EDUCATION</h1>
            <p class="subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore</p>

            <!-- Simplified SVG Illustration -->
            <svg class="education-illustration" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
                <rect x="250" y="150" width="450" height="300" rx="20" fill="#EBF4FF" stroke="#60A5FA" stroke-width="5"/>
                <circle cx="500" cy="450" r="10" fill="#60A5FA"/>
                <path d="M400 450L450 480H350L400 450Z" fill="#60A5FA"/>
                <rect x="100" y="350" width="100" height="150" rx="15" fill="#C7D2FE" stroke="#60A5FA" stroke-width="5"/>
                <path d="M150 350L150 250" stroke="#60A5FA" stroke-width="5" stroke-linecap="round"/>
                <rect x="500" y="350" width="150" height="200" rx="15" fill="#BFDBFE" stroke="#60A5FA" stroke-width="5"/>
                <path d="M575 350L575 250" stroke="#60A5FA" stroke-width="5" stroke-linecap="round"/>

                <!-- Student Figures -->
                <circle cx="200" cy="500" r="40" fill="#D1D5DB"/>
                <rect x="160" y="460" width="80" height="60" fill="#D1D5DB" rx="10"/>
                <circle cx="600" cy="500" r="40" fill="#9CA3AF"/>
                <rect x="560" y="460" width="80" height="60" fill="#9CA3AF" rx="10"/>

                <!-- Simple Book Icons -->
                <rect x="130" y="320" width="40" height="5" fill="#60A5FA"/>
                <rect x="130" y="330" width="40" height="30" fill="#60A5FA" rx="5"/>
                <rect x="550" y="320" width="60" height="5" fill="#60A5FA"/>
                <rect x="550" y="330" width="60" height="30" fill="#60A5FA" rx="5"/>
            </svg>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <h2 class="form-title">USER LOGIN</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="input-group">
                    <i class="input-icon fas fa-user"></i>
                    <input type="email" class="form-input" id="email" name="email" placeholder="Email" required>
                    <!-- Error message example (remove display:none to show) -->
                    <div class="error-message" style="display: none;">Please enter a valid email address</div>
                </div>

                <!-- Password Field -->
                <div class="input-group">
                    <i class="input-icon fas fa-lock"></i>
                    <input type="password" class="form-input" id="password" name="password" placeholder="Password" required>
                    <!-- Error message example (remove display:none to show) -->
                    <div class="error-message" style="display: none;">Password is required</div>
                </div>

                <!-- Options -->
                <div class="options-group">
                    <label class="remember">
                        <input type="checkbox" class="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="login-button">LOGIN</button>

                <!-- Register Link -->
                <div class="register-link">
                    <p>Don't have an account? <a href="{{ route('register') }}">Create Account</a></p>
                </div>
            </form>

            <!-- Separator -->
            <div class="separator">
                <div class="separator-line"></div>
                <span class="separator-text">OR</span>
                <div class="separator-line"></div>
            </div>

            <!-- Social Login Buttons -->
            <div class="social-buttons">
                <a href="{{ route('google.login') }}" class="social-button">
                    <i class="social-icon fab fa-google google-icon"></i>
                    <span>Log in with Google</span>
                </a>
                <button class="social-button">
                    <i class="social-icon fab fa-facebook-f facebook-icon"></i>
                    <span>Log in with Facebook</span>
                </button>
                <button class="social-button">
                    <i class="social-icon fab fa-github github-icon"></i>
                    <span>Log in with GitHub</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Simple form validation example
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            let isValid = true;

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.style.display = 'none';
            });

            // Validate email
            if (!email || !/\S+@\S+\.\S+/.test(email)) {
                document.querySelector('#email + .error-message').textContent = 'Please enter a valid email address';
                document.querySelector('#email + .error-message').style.display = 'block';
                isValid = false;
            }

            // Validate password
            if (!password) {
                document.querySelector('#password + .error-message').textContent = 'Password is required';
                document.querySelector('#password + .error-message').style.display = 'block';
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
