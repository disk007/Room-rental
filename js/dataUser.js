
//droplist
let dropdownBtn = document.getElementById("dropdownBtn");
let dropdown = document.getElementById("myDropdown");

  dropdownBtn.addEventListener("click", function() {
    dropdown.classList.toggle("show");
  });

  window.addEventListener("click", function(event) {
    if (!event.target.matches('.dropbtn') && !event.target.matches('#sy')) {
        let dropdowns = document.getElementsByClassName("dropdown-content");
        let i;
        for (i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
});


let editUser = document.getElementById('editUser');
let editData = document.getElementById('editData');

document.getElementById('editData').addEventListener('click', function() {
  let firstName = document.getElementById('firstName');
  let lastName = document.getElementById('lastName');
  let userName = document.getElementById('userName');

  firstName.disabled = !firstName.disabled;
  lastName.disabled = !lastName.disabled;
  userName.disabled = !userName.disabled;

  if (editUser.hasAttribute('hidden')) {
    // ถ้าปุ่ม editUser ถูกซ่อน ให้แสดงขึ้นมา
    editUser.removeAttribute('hidden');
  } else {
    // ถ้าปุ่ม editUser ถูกแสดง ให้ซ่อนลงไป
    editUser.setAttribute('hidden', true);
  }
});

document.getElementById('formEdit').addEventListener('submit', function(event) {
  event.preventDefault();
  
  // ป้องกันการ submit ฟอร์ม

  // สร้าง FormData object เพื่อเก็บข้อมูลจากฟอร์ม
  const formData = new FormData(this);

  // ใส่การตั้งค่า header ของ request
  const requestOptions = {
    method: 'POST',
    body: formData,
  };

  // ใช้ Fetch API ส่ง request
  fetch(this.action, requestOptions)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json(); // หรือ response.text(), response.blob() ตามลักษณะข้อมูลที่คุณรับ
    })
    .then(data => {
      console.log('Success:', data);
      // ทำสิ่งที่คุณต้องการหลังจากที่สำเร็จ
      window.location.href = '../php/editUser.php'; // ตัวอย่างการ redirect
    })
    .catch((error) => {
      console.error('Error:', error);
    });
});

editUser.addEventListener('click', function() {
  document.getElementById('formEdit').submit(); // ให้ submit ฟอร์มเมื่อคลิกปุ่ม editUser
});


