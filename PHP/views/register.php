<?php
require_once __DIR__ . '/inc/head.php';
?>

    <div class="main-wrapper">
        <!-- Main -->
        <div class="login-wrapper">
            <!-- Welcome image -->
            <div class="welcome-img main-col">
                <img src="views/assets/images/sign-in.png" alt="">
            </div>
            <!-- Signup -->
            <div class="main-col">
                <div class="form-wrapper">
                    <!-- Title -->
                    <header class="my-row">
                        <div>
                            <h2>Register</h2>
                        </div>
                        <div>
                            or
                            <a href="/login">log in</a>
                        </div>
                    </header>
                    <!-- Signup form -->
                    <div>
                        <form action="" method="POST">
                            <p><input class="text-input" type="text" id="username" name="username" placeholder="Username" required></p>
                            <p><input class="text-input" type="password" id="password" name="password" placeholder="Password" required></p>
                            <p><small>This page is protected by reCAPTCHA, and subject to the Google <a href="">Privacy Policy</a> and <a href="">Terms of service</a>.</small></p>
                            <div class="submit my-row">
                                <div class="checkbox"><input type="checkbox" name="agree_terms" id="cbox"><label for="cbox"><span>Agree <a href="">the terms</a>.</span></label></div>
                                <button class="btn" type="submit">Create an account</button>
                            </div>
                        </form>
                    </div>
                    <div class="or-hr">
                        or
                    </div>
                    <!-- Sign up with google -->
                    <div class="google-btn">
                        <button class="btn">
                            Sign up with Google
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>