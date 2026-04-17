/* ── Authentication JS (Student 1) ──────────────────────
   Handles:
   - URL param alerts (error/success from PHP redirects)
   - Client-side form validation before submit
   - Password visibility toggle                          */

document.addEventListener('DOMContentLoaded', function () {

  /* ── Show alert from URL params ── */
  const params  = new URLSearchParams(window.location.search);
  const error   = params.get('error');
  const success = params.get('success');
  const alertEl = document.getElementById('alert');

  if (alertEl) {
    if (error) {
      alertEl.textContent = error;
      alertEl.className   = 'alert error';
      alertEl.style.display = 'block';
    } else if (success) {
      alertEl.textContent = success;
      alertEl.className   = 'alert success';
      alertEl.style.display = 'block';
    }
  }

  /* ── Password toggle ── */
  const toggleBtn = document.getElementById('togglePwd');
  const pwdInput  = document.getElementById('password');
  if (toggleBtn && pwdInput) {
    toggleBtn.addEventListener('click', function () {
      pwdInput.type = (pwdInput.type === 'password') ? 'text' : 'password';
      this.textContent = (pwdInput.type === 'password') ? '\uD83D\uDC41' : '\uD83D\uDE48';
    });
  }

  /* ── Login form validation ── */
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
      let valid = true;

      const email    = document.getElementById('email');
      const password = document.getElementById('password');
      const emailErr = document.getElementById('emailErr');
      const pwdErr   = document.getElementById('pwdErr');

      emailErr.textContent = '';
      pwdErr.textContent   = '';
      email.classList.remove('invalid');
      password.classList.remove('invalid');

      if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        emailErr.textContent = 'Enter a valid email address.';
        email.classList.add('invalid');
        valid = false;
      }

      if (password.value.length < 1) {
        pwdErr.textContent = 'Please enter your password.';
        password.classList.add('invalid');
        valid = false;
      }

      if (!valid) e.preventDefault();
    });
  }

  /* ── Signup form validation ── */
  const signupForm = document.getElementById('signupForm');
  if (signupForm) {
    signupForm.addEventListener('submit', function (e) {
      let valid = true;

      const name      = document.getElementById('name');
      const email     = document.getElementById('email');
      const password  = document.getElementById('password');
      const confirm   = document.getElementById('confirm');

      const nameErr    = document.getElementById('nameErr');
      const emailErr   = document.getElementById('emailErr');
      const pwdErr     = document.getElementById('pwdErr');
      const confirmErr = document.getElementById('confirmErr');

      [nameErr, emailErr, pwdErr, confirmErr].forEach(el => el.textContent = '');
      [name, email, password, confirm].forEach(el => el.classList.remove('invalid'));

      if (name.value.trim().length < 2) {
        nameErr.textContent = 'Name must be at least 2 characters.';
        name.classList.add('invalid');
        valid = false;
      }

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        emailErr.textContent = 'Enter a valid email address.';
        email.classList.add('invalid');
        valid = false;
      }

      if (password.value.length < 6) {
        pwdErr.textContent = 'Password must be at least 6 characters.';
        password.classList.add('invalid');
        valid = false;
      }

      if (confirm.value !== password.value) {
        confirmErr.textContent = 'Passwords do not match.';
        confirm.classList.add('invalid');
        valid = false;
      }

      if (!valid) e.preventDefault();
    });
  }

});
