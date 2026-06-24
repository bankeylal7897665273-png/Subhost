<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Ai hero</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
        body { background-color: #ffffff; color: #333; display: flex; justify-content: center; min-height: 100vh; padding: 20px; opacity: 0; animation: fadeIn 0.8s forwards; }
        @keyframes fadeIn { to { opacity: 1; } }
        .container { width: 100%; max-width: 400px; margin-top: 30px; }
        .logo { color: #1a73e8; font-size: 24px; font-weight: bold; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .logo-icon { width: 30px; height: 30px; background: #1a73e8; color: white; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-weight: bold; }
        .btn-outline { width: 100%; padding: 14px; border: 1px solid #1a73e8; border-radius: 24px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; background: #1a73e8; color: #fff; display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 20px; }
        .btn-outline:hover { background: #1557b0; }
        .divider { text-align: center; margin: 20px 0; color: #888; font-size: 14px; position: relative; }
        .divider::before, .divider::after { content: ""; position: absolute; top: 50%; width: 45%; height: 1px; background: #eee; }
        .divider::before { left: 0; }
        .divider::after { right: 0; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 14px; margin-bottom: 8px; color: #555; }
        .form-control { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 16px; transition: all 0.3s ease; }
        .form-control:focus { border-color: #1a73e8; outline: none; box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2); }
        .btn-primary { width: 100%; padding: 14px; border: none; border-radius: 24px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; background-color: #a8c7fa; color: #fff; margin-top: 10px; }
        .btn-primary.active { background-color: #1a73e8; }
        .btn-primary:hover.active { background-color: #1557b0; }
        .error-msg { color: #d93025; font-size: 14px; margin-bottom: 15px; display: none; }
        .login-link { text-align: center; margin-top: 20px; font-size: 14px; }
        .login-link a { color: #1a73e8; text-decoration: none; }
    </style>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth-compat.js"></script>
    <?php include 'config.php'; ?>
</head>
<body>
    <div class="container">
        <div class="logo">
            <div class="logo-icon">Ai</div> Ai hero
        </div>
        
        <button class="btn-outline" id="googleBtn">Sign Up with Google</button>
        
        <div class="divider">Or</div>
        
        <div class="error-msg" id="errorMsg"></div>

        <div class="form-group">
            <label>* Email</label>
            <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label>* Password</label>
            <input type="password" id="password" class="form-control" placeholder="Enter password" required>
        </div>

        <button class="btn-primary active" id="signupBtn">Sign Up for Free</button>
        
        <div class="login-link">
            Already have an account? <a href="login.php">Sign in</a>
        </div>
    </div>

    <script>
        firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();

        auth.onAuthStateChanged(user => {
            if (user) window.location.href = 'index.php';
        });

        document.getElementById('signupBtn').addEventListener('click', () => {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorMsg = document.getElementById('errorMsg');
            
            if(!email || !password) {
                errorMsg.innerText = "Please fill all fields.";
                errorMsg.style.display = "block";
                return;
            }

            document.getElementById('signupBtn').innerText = "Creating Account...";
            auth.createUserWithEmailAndPassword(email, password)
                .catch(error => {
                    errorMsg.innerText = error.message;
                    errorMsg.style.display = "block";
                    document.getElementById('signupBtn').innerText = "Sign Up for Free";
                });
        });

        document.getElementById('googleBtn').addEventListener('click', () => {
            const provider = new firebase.auth.GoogleAuthProvider();
            auth.signInWithPopup(provider).catch(error => {
                document.getElementById('errorMsg').innerText = error.message;
                document.getElementById('errorMsg').style.display = "block";
            });
        });
    </script>
</body>
</html>
