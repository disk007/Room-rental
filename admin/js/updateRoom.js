
// Example starter JavaScript for disabling form submissions if there are invalid fields
// (function() {
//   'use strict';
//   window.addEventListener('load', function() {
//     var inputValue = document.getElementById("nameRoom").value;
//     var erorName = document.getElementById("name-error");
// // แสดงค่าที่ได้ใน console
//     // Fetch all the forms we want to apply custom Bootstrap validation styles to
//     var forms = document.getElementsByClassName('needs-validation');
//     // Loop over them and prevent submission
//     var validation = Array.prototype.filter.call(forms, function(form) {
//       form.addEventListener('submit', function(event) {
//         if (form.checkValidity() === false ) {
//           if(inputValue.match(/[!@#$%^&*(),.?":{}|<>]/)){
//             erorName.removeAttribute("hidden");
//           }
//           event.preventDefault();
//           event.stopPropagation();
//         }
//         form.classList.add('was-validated');
//       }, false);
//     });
//   }, false);
// })();

// const form = document.getElementById('form');
const nameRoom = document.getElementById('nameRoom');
const price = document.getElementById('price');
const detail = document.getElementById('detail');
const edit = document.getElementById('edit');


nameRoom.addEventListener('blur',function () {
    const nameRoomValue = nameRoom.value.trim();
    if(nameRoomValue === '') {
        setError(nameRoom, 'Firstname is required');
    }
    else if(nameRoomValue.match(/[!@#$%^&*(),.?":{}|<>]/)) {
        setError(nameRoom, 'Please enter only letters.');
    }
    else {
        setSuccess(nameRoom);
    }
});

price.addEventListener('blur',function () {
  const priceValue = price.value.trim();
  if(priceValue === '') {
      setError(price, 'Price is required');
  }
  else if(priceValue < 0) {
      setError(price, 'Please more than 0.');
  }
  else {
      setSuccess(price);
  }
});
detail.addEventListener('blur',function () {
  const detailValue = detail.value.trim();
  if(detailValue === '') {
      setError(detail, 'detail is required');
  }
  else if(detailValue.match(/[!@#$%^&*(),.?":{}|<>]/)) {
      setError(detail, 'Please enter only letters.');
  }
  else {
      setSuccess(detail);
  }
});
nameRoom.addEventListener('input', re);
price.addEventListener('input', re);
detail.addEventListener('input', re);
function re() {
  const nameRoomValue = nameRoom.value.trim();
  const priceValue = price.value.trim();
  const detailValue = detail.value.trim();

  if (nameRoomValue !== '' && !nameRoomValue.match(/[!@#$%^&*(),.?":{}|<>]/) && priceValue !== '' && detailValue !== '' && !detailValue.match(/[!@#$%^&*(),.?":{}|<>]/)) {
      edit.disabled = false;
      edit.style.cursor = 'pointer';
      edit.style.backgroundColor = 'dodgerblue';
      edit.style.color = 'white';
      edit.style.fontSize = '16px';
      edit.style.opacity = 1;
    } else {
      edit.disabled = true;
      edit.style.cursor = 'not-allowed';
      edit.style.opacity = 0.5;
    }
}
const validateInputs = () => {
  const nameRoomValue = nameRoom.value.trim();
  const priceValue = price.value.trim();
  const detailValue = detail.value.trim();

  if(nameRoomValue === '') {
      setError(nameRoom, 'nameRoom is required');
  }
  else {
      setSuccess(nameRoom);
  }
  if(typeRoomValue === '') {
      setError(typeRoom, 'typeRoom is required');
  } 
  else {
      setSuccess(typeRoom);
  }
  if(priceValue === '') {
    setError(price, 'price is required');
  } 
  else {
    setSuccess(price);
  }
  if(detailValue === '') {
    setError(detail, 'detail is required');
  } 
  else {
    setSuccess(detail);
  }

};
const setError = (element, message) => {
  const inputControl = element.parentElement;
  const errorDisplay = inputControl.querySelector('.error1');
  errorDisplay.innerText = message;
  inputControl.classList.add('error1');
  inputControl.classList.remove('success')
}
const setSuccess = element => {
  const inputControl = element.parentElement;
  const errorDisplay = inputControl.querySelector('.error1');

  errorDisplay.innerText = '';
  inputControl.classList.add('success');
  inputControl.classList.remove('error1');
};
re();

