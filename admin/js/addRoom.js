
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
const typeRoom = document.getElementById('typeRoom');
const typebed = document.getElementById('typebed');
const price = document.getElementById('price');
const img = document.getElementById('img');
const imgDetail = document.getElementById('imgDetail');
const detail = document.getElementById('detail');
const add = document.getElementById('add');


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
typeRoom.addEventListener('blur',function () {
  const typeRoomValue = typeRoom.value.trim();
  if(typeRoomValue === '') {
      setError(typeRoom, 'typeroom is required');
  }
  else {
      setSuccess(typeRoom);
  }
});
typebed.addEventListener('blur',function () {
  const typebedValue = typebed.value.trim();
  if(typebedValue === '') {
      setError(typebed, 'typebed is required');
  }
  else {
      setSuccess(typebed);
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
img.addEventListener('blur',function () {
  const imgValue = img.value.trim();
  if(imgValue === '') {
      setError(img, 'img is required');
  }
  else {
      setSuccess(img);
  }
});
imgDetail.addEventListener('blur',function () {
  const imgDetailValue = imgDetail.value.trim();
  if(imgDetailValue === '') {
      setError(imgDetail, 'imgDetail is required');
  }
  else {
      setSuccess(imgDetail);
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
typeRoom.addEventListener('input', re);
typebed.addEventListener('input', re);
price.addEventListener('input', re);
img.addEventListener('input', re);
imgDetail.addEventListener('input', re);
detail.addEventListener('input', re);
function re() {
  const nameRoomValue = nameRoom.value.trim();
  const typeRoomValue = typeRoom.value.trim();
  const typebedValue = typebed.value.trim();
  const priceValue = price.value.trim();
  const imgValue = img.value.trim();
  const imgDetailValue = imgDetail.value.trim();
  const detailValue = detail.value.trim();

  if (nameRoomValue !== '' && typeRoomValue !== '' && typebedValue !== '' && priceValue !== '' && imgValue!== '' && imgDetailValue !== '' && detailValue !== '') {
      add.disabled = false;
      add.style.cursor = 'pointer';
      add.style.backgroundColor = 'dodgerblue';
      add.style.color = 'white';
      add.style.fontSize = '16px';
      add.style.opacity = 1;
    } else {
      add.disabled = true;
      add.style.cursor = 'not-allowed';
      add.style.opacity = 0.5;
    }
}
const validateInputs = () => {
  const nameRoomValue = nameRoom.value.trim();
  const typeRoomValue = typeRoom.value.trim();
  const typebedValue = typebed.value.trim();
  const priceValue = price.value.trim();
  const imgValue = img.value.trim();
  const imgDetailValue = imgDetail.value.trim();
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
  if(typebedValue === '') {
      setError(typebed, 'typebed is required');
  } 
  else {
      setSuccess(typebed);
  }
  if(priceValue === '') {
    setError(price, 'price is required');
  } 
  else {
    setSuccess(price);
  }
  if(imgValue === '') {
    setError(img, 'img is required');
  } 
  else {
    setSuccess(img);
  }
  if(imgDetailValue === '') {
    setError(imgDetail, 'imgDetail is required');
  } 
  else {
    setSuccess(imgDetail);
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

