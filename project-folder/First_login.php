<?php
    session_start();
    $error = $_SESSION['error'] ?? false;
    unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>-Login- Hidden Side</title>
    <link rel="stylesheet" href="login.css" />
    <link rel="icon" href="images/TheHiddenSide.png" />
</head>

<body>
<button class="about-btn" onclick="window.location.href='about.html'">About</button>

<div class="top-controls">
    <select id="languageSwitcher" onchange="changeLanguage()">
        <option value="fr">FR</option>
        <option value="en">EN</option>
        <option value="ar">AR</option>
    </select>
    <button class="theme-toggle" onclick="toggleTheme()">🌙</button>
</div>

<div class="container"  id="loginContainer">
    <h2 id="title">Connexion</h2>
    <?php if($error): ?>
        <div class="login-error" id="errorMsg" style="display: <?= $error ? 'block' : 'none' ?>;"></div> 
    <?php endif; ?>   
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="regNumber" id="regLabel">Numéro d'inscription</label>
            <input type="text" name="registration_no" id="regNumber" placeholder="Entrez votre numéro" required />
        </div>

        <div class="form-group password-group">
            <label for="password" id="passLabel">Mot de passe</label>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required />
                <label class="show-password-checkbox">
                    <input type="checkbox" id="showPassword"> Afficher
                </label>
            </div>
        </div>

        <button type="submit" id="loginBtn">Se connecter</button>
    </form>
</div>

<script>
        /* Theme toggle */
        function toggleTheme() {
            document.body.classList.toggle("dark");
            const btn = document.querySelector(".theme-toggle");
            btn.textContent = document.body.classList.contains("dark") ? "☀️" : "🌙";
        }


        const errorDiv = document.getElementById("errorMsg");
        const errorMessages = {
            fr: "Numéro d'inscription ou mot de passe incorrect",
            en: "Registration number or password is incorrect",
            ar: "رقم التسجيل أو كلمة المرور غير صحيحة"
        };


        /* Language */
        function changeLanguage() {
            const lang = document.getElementById("languageSwitcher").value;
            document.body.classList.remove("rtl");

            if(lang === "fr"){
                document.getElementById("title").textContent = "Connexion";
                document.getElementById("regLabel").textContent = "Numéro d'inscription";
                document.getElementById("regNumber").placeholder = "Entrez votre numéro";
                document.getElementById("passLabel").textContent = "Mot de passe";
                document.getElementById("password").placeholder = "Entrez votre mot de passe";
                document.querySelector(".show-password-checkbox").lastChild.textContent = "Afficher";
                document.getElementById("loginBtn").textContent = "Se connecter";
            }
            else if(lang === "en"){
                document.getElementById("title").textContent = "Login";
                document.getElementById("regLabel").textContent = "Registration Number";
                document.getElementById("regNumber").placeholder = "Enter your number";
                document.getElementById("passLabel").textContent = "Password";
                document.getElementById("password").placeholder = "Enter your password";
                document.querySelector(".show-password-checkbox").lastChild.textContent = "Show";
                document.getElementById("loginBtn").textContent = "Login";
            }
            else if(lang === "ar"){
                document.body.classList.add("rtl");
                document.getElementById("title").textContent = "تسجيل الدخول";
                document.getElementById("regLabel").textContent = "رقم التسجيل";
                document.getElementById("regNumber").placeholder = "أدخل رقم التسجيل";
                document.getElementById("passLabel").textContent = "كلمة المرور";
                document.getElementById("password").placeholder = "أدخل كلمة المرور";
                document.querySelector(".show-password-checkbox").lastChild.textContent = "إظهار";
                document.getElementById("loginBtn").textContent = "دخول";
            }
            // تحديث رسالة الخطأ
            if(errorDiv){
                if(errorDiv.style.display !== "none"){ // إذا كان هناك خطأ
                    errorDiv.textContent = errorMessages[lang];
                }
            }
        }

        /* Show/hide password */
        const passwordField = document.getElementById("password");
        const showCheckbox = document.getElementById("showPassword");
        showCheckbox.addEventListener("change", function(){
            passwordField.type = this.checked ? "text" : "password";
        });

/* عند تحميل الصفحة */
window.addEventListener("DOMContentLoaded", () => {
    changeLanguage();

    const error = <?= $error ? 'true' : 'false' ?>;

    if(error && errorDiv){
        errorDiv.style.display = "block";// عرض الرسالة
        loginContainer.addEventListener("click", () => {// إخفاء الرسالة فقط عند الضغط داخل صندوق login
            errorDiv.style.display = "none";
        });
    }
});
</script>

</body>
</html>
