// Highlight active nav link
document.querySelectorAll('.nav-links a').forEach(link => {
    if (link.href === location.href) link.classList.add('active');
});

// Show alert helper
function showAlert(id, type, message) {
    const el = document.getElementById(id);
    if (!el) return;
    el.className = 'alert ' + type;
    el.textContent = message;
    el.style.display = 'block';
}

// Show alerts based on URL query params (set by PHP redirects)
const params = new URLSearchParams(location.search);

if (params.get('error') === '1') {
    if (document.getElementById('signinAlert'))
        showAlert('signinAlert', 'error', 'Invalid username or password. Please try again.');
    if (document.getElementById('signupAlert'))
        showAlert('signupAlert', 'error', 'Sign-up failed. Check your details and try again.');
    if (document.getElementById('contactAlert'))
        showAlert('contactAlert', 'error', 'Message could not be sent. Please check your details.');
}

if (params.get('registered') === '1' && document.getElementById('signinAlert'))
    showAlert('signinAlert', 'success', 'Account created successfully! Please sign in.');

if (params.get('sent') === '1' && document.getElementById('contactAlert'))
    showAlert('contactAlert', 'success', 'Message sent! We will get back to you soon.');

// Sign-in client validation
const signinForm = document.getElementById('signinForm');
if (signinForm) {
    signinForm.addEventListener('submit', function (e) {
        const user = this.username.value.trim();
        const pass = this.password.value;
        if (user.length < 3) {
            e.preventDefault();
            showAlert('signinAlert', 'error', 'Username must be at least 3 characters.');
        } else if (pass.length < 6) {
            e.preventDefault();
            showAlert('signinAlert', 'error', 'Password must be at least 6 characters.');
        }
    });
}

// Sign-up client validation
const signupForm = document.getElementById('signupForm');
if (signupForm) {
    signupForm.addEventListener('submit', function (e) {
        const age  = parseInt(this.age.value);
        const pass = this.password.value;
        if (age < 18 || age > 100) {
            e.preventDefault();
            showAlert('signupAlert', 'error', 'Age must be between 18 and 100.');
            return;
        }
        if (pass.length < 6) {
            e.preventDefault();
            showAlert('signupAlert', 'error', 'Password must be at least 6 characters.');
        }
    });
}

// Contact client validation
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
        const msg = this.message.value.trim();
        if (msg.length < 10) {
            e.preventDefault();
            showAlert('contactAlert', 'error', 'Message must be at least 10 characters.');
        }
    });
}
