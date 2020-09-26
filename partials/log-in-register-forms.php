<div class="overlay"></div>

<div id="log_in_form_wrapper" class="form_wrapper">

    <div class="display_flex">
        <div></div>
        <img src="assets/other/remove-24px.svg" alt="remove">
    </div>

    <form id="log_in_form" method="post" class="small_form" action="form-actions/log-in-action.php">

        <div class="form_input form_row">
            <label for="form_email">Email address</label>
            <input required placeholder="Email address" type="email" id="log_in_email" name="log_in_email">
            <span class="alert email_alert">Invalid input</span>
        </div>

        <div class="form_input form_row">
            <label for="form_password">Password</label>
            <input required placeholder="Password" type="password" id="log_in_password" name="log_in_password">
            <span class="alert password_alert">Invalid input</span>
        </div>

        <button id="log_in_form_button" class="row_button product_button" type="submit">Log In</button>

    </form>

    <span>Do not have an account yet? <a id="register_here" href="#">Register here!</a></span>
</div>

<div id="register_form_wrapper" class="form_wrapper">

    <div class="display_flex">
        <div></div>
        <img src="assets/other/remove-24px.svg" alt="remove">
    </div>

    <form id="register_form" method="post" class="small_form" action="form-actions/register-action.php">

        <div class="form_input form_row">
            <label for="form_email">Email address</label>
            <input required placeholder="Email address" type="email" id="register_email" name="register_email">
            <span class="alert email_alert">Invalid input</span>
        </div>

        <div class="form_input form_row">
            <label for="form_password">Password</label>
            <input required placeholder="Password" type="password" id="register_password" name="register_password">
            <span class="alert password_alert">Invalid input</span>
        </div>

        <div class="form_input form_row">
            <label for="form_password">Repeat password</label>
            <input required placeholder="Repeat password" type="password" id="form_repeat_password" name="form_repeat_password">
            <span class="alert repeat_password_alert">Invalid input</span>
        </div>

        <button id="register_form_button" class="row_button product_button" type="submit">Register</button>

    </form>

    <span>Already have an account? <a id="log_in_here" href="#">Log in here!</a></span>
</div>