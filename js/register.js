const form = document.getElementById('form');
const User = document.getElementById('User');
const fName = document.getElementById('fName');
const lName = document.getElementById('lName');
const pwd = document.getElementById('pwd');
const cPwd = document.getElementById('cPwd');
const register = document.getElementById('register');


fName.addEventListener('blur',function () {
    const fNameValue = fName.value.trim();
    if(fNameValue === '') {
        setError(fName, 'Firstname is required');
    }
    else if(!fNameValue.match(/^[a-zA-Z]+$/)) {
        setError(fName, 'Please enter only letters.');
    }
    else {
        setSuccess(fName);
    }
});

lName.addEventListener('blur',function () {
    const lNameValue = lName.value.trim();
    if(lNameValue === '') {
        setError(lName, 'Lastname is required');
    } 
    else if(!lNameValue.match(/^[a-zA-Z]+$/)) {
        setError(lName, 'Please enter only letters.');
    }
    else {
        setSuccess(lName);
    }
});

User.addEventListener('blur',function () {
    const UserValue = User.value.trim();
    if(UserValue === '') {
        setError(User, 'Username is required');
    }
    else if(!UserValue.match(/^[a-zA-Z]+$/)) {
        setError(User, 'Please enter only letters.');
    }
    else {
        setSuccess(User);
    }
});

pwd.addEventListener('blur',function () {
    const pwdValue = pwd.value.trim();
    if(pwdValue === '') {
        setError(pwd, 'Password is required');
    } 
    else if (pwdValue.length < 8 ) {
        setError(pwd, 'Password must be at least 8 character.')
    } 
    else {
        setSuccess(pwd);
    }
});
cPwd.addEventListener('blur',function () {
    const pwdValue = pwd.value.trim();
    const cPwdValue = cPwd.value.trim();
    if(cPwdValue === '') {
        setError(cPwd, 'Please confirm your password');
    } 
    else if (cPwdValue !== pwdValue) {
        setError(cPwd, "Passwords doesn't match");
    } 
    else {
        setSuccess(cPwd);
    }
});

User.addEventListener('input', re);
fName.addEventListener('input', re);
lName.addEventListener('input', re);
User.addEventListener('input', re);
pwd.addEventListener('input', re);
cPwd.addEventListener('input', re);
function re() {
    const fNameValue = fName.value.trim();
    const lNameValue = lName.value.trim();
    const UserValue = User.value.trim();
    const pwdValue = pwd.value.trim();
    const cPwdValue = cPwd.value.trim();
    if (fNameValue !== '' && lNameValue !== '' && UserValue !== '' && pwdValue !== '' && cPwdValue !== '' && cPwdValue == pwdValue) {
        register.disabled = false;
        register.style.cursor = 'pointer';
        register.style.backgroundColor = 'dodgerblue';
        register.style.color = 'white';
        register.style.fontSize = '16px';
        register.style.opacity = 1;
      } else {
        register.disabled = true;
        register.style.cursor = 'not-allowed';
        register.style.opacity = 0.5;
      }
}
const validateInputs = () => {
    const fNameValue = fName.value.trim();
    const lNameValue = lName.value.trim();
    const UserValue = User.value.trim();
    const pwdValue = pwd.value.trim();
    const cPwdValue = cPwd.value.trim();

    if(fNameValue === '') {
        setError(fName, 'Firstname is required');
    }
    else {
        setSuccess(fName);
    }
    if(lNameValue === '') {
        setError(lName, 'Lastname is required');
    } 
    else {
        setSuccess(lName);
    }
    if(UserValue === '') {
        setError(User, 'Username is required');
    } 
    else {
        setSuccess(User);
    }
    if(pwdValue === '') {
        setError(pwd, 'Password is required');
    } 
    else if (pwdValue.length < 8 ) {
        setError(pwd, 'Password must be at least 8 character.')
    } 
    else {
        setSuccess(pwd);
    }

    if(cPwdValue === '') {
        setError(cPwd, 'Please confirm your password');
    } 
    else if (cPwdValue !== passwordValue) {
        setError(cPwd, "Passwords doesn't match");
    } 
    else {
        setSuccess(cPwd);
    }

};
const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}
const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

