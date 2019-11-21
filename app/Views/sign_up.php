<main>
    <form class='login-form' action="sign_up" method="POST" style="max-width: 400px">
        <fieldset>
        <legend>SIGN-UP</legend>
        <label for='username'>Username (*)</label>
        <input type="text" name="username" id="username" placeholder="Username..." required value="">
        <label for='name'>Full name (*)</label>
        <input type="text" name="name" id="name" placeholder="Your full name..." required value="">
        <label for='email'>Email (*)</label>
        <input type="email" name="email" id="email" placeholder="Email..." required value="">
        <label for='password'>Password (*)</label>
        <input type="password" name="password" id="password" placeholder="Password..." required>
        <label for='comfirm-password'>Re-enter password (*)</label>
        <input type="password" name="comfirm-password" id="comfirm-password"  placeholder="Re-enter password..." required>
        <button type="submit" class="submit-btn">Submit</button>
        <em>
            Already have an account?
            <a href="sign_in">Log in</a>
        </em>
        </fieldset>
    </form>
</main>