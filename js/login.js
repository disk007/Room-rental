const form = document.getElementById('form');
const User = document.getElementById('User');
const fName = document.getElementById('fName');
const lName = document.getElementById('lName');
const pwd = document.getElementById('pwd');
const cPwd = document.getElementById('cPwd');

fName.addEventListener('blur',function () {
    const fNameValue = fName.value.trim();
    if(fNameValue === '') {
        setError(fName, 'Firstname is required');
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
    else {
        setSuccess(lName);
    }
});

User.addEventListener('blur',function () {
    const UserValue = User.value.trim();
    if(UserValue === '') {
        setError(User, 'Username is required');
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
    const cPwdValue = cPwd.value.trim();
    if(cPwdValue === '') {
        setError(cPwd, 'Please confirm your password');
    } 
    else if (cPwdValue !== passwordValue) {
        setError(cPwd, "Passwords doesn't match");
    } 
    else {
        setSuccess(cPwd);
    }
});
// form.addEventListener('submit', e => {
//     e.preventDefault();

//     validateInputs();
// });
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

