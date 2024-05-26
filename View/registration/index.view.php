<?php require 'View/partials/header.php'; ?>
<link rel="stylesheet" href="../View/assets/css/register.css">
<link rel="stylesheet" href="../View/assets/css/register_media.css">

<header class="header">
    <h1 class="page-title">Register to CITE's Canteen</h1>
</header>
<main>
    <form class="register-form-container" action="/index.php/registration" method="POST">
        <div class="top-form">
            <section>
                <h2 class="form-title">Personal Information</h2>
                <fieldset class="personal-information-form-container">
                    <label class="form-label top-in-the-list">
                        First name
                        <div>
                            <input name="firstname" class="form-box" type="text" required>
                        </div>
                    </label>
                    <label class="form-label">
                        Middle name
                        <div>
                            <input name="middle_name" class="form-box" type="text" required>
                        </div>
                    </label>
                    <label class="form-label">
                        Last name
                        <div>
                            <input name="lastname" class="form-box" type="text" required>
                        </div>
                    </label>
                    <label class="form-label">
                        Birthdate
                        <div>
                            <input name="birthdate" class="form-box" type="date" required>
                        </div>
                    </label>
                    <label class="form-label">
                        Email
                        <div>
                            <input name="email" class="form-box" type="email" required>
                        </div>
                    </label>
                </fieldset>
            </section>

            <section>
                <h2 class="form-title">Account Details</h2>
                <fieldset class="account-details-form-container">
                    <label class="form-label">
                        Username
                        <div>
                            <input name="username" class="form-box" type="text" required>
                        </div>
                    </label>
                    <label class="form-label">
                        Password
                        <div>
                            <input name="password" class="form-box " type="password" required>
                        </div>
                    </label>
                </fieldset>
            </section>
        </div>
        <div class="bottom-form">
            <section class="cancel-and-create-buttons-container">
                <button type="button" class="form-button cancel-button">Cancel</button>
                <button type="submit" class="form-button create-button">Create account</button>
                <a class="login-link" href="/index.php/login">Already have an account? Login now</a>
            </section>    
        </div>            
    </form>
</main>

<?php require 'View/partials/footer.php'; ?>