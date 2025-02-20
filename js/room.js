const zoomableImages = document.querySelectorAll('.img-all');
const overlay = document.getElementById('overlay');
const zoomedImage = document.getElementById('zoomed-image');


const iN =  document.getElementById('in');
const out = document.getElementById('out');
const form = document.getElementById('form');
let error = document.getElementById('error');
let priceNinght = document.getElementById('priceNinght');
let price = document.getElementById('price').value;


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


form.addEventListener('submit', e => {
    validateInputs(e);
});

function calculatePriceNight() {
    const currentDate = new Date();
    const iNValue = iN.value.trim();
    const outValue = out.value.trim();
    
    function setDateTime(date) {
        date.setHours(currentDate.getHours() + 1);
        date.setMinutes(currentDate.getMinutes());
        date.setSeconds(currentDate.getSeconds());
    }

    const date1 = new Date(iNValue);
    const date2 = new Date(outValue);
    setDateTime(date1);
    setDateTime(date2);

    if (iNValue !== "" && outValue !== "" && date1 >= currentDate && date1 < date2) {
        const timeDiff = date2 - date1;
        const dayDiff = Math.round(timeDiff / (1000 * 60 * 60 * 24));
        priceNinght.innerHTML = dayDiff+" คืน = "+(dayDiff*price).toLocaleString()+" ฿";
    } else {
        priceNinght.innerHTML = "";
    }
}

out.addEventListener('change', calculatePriceNight);
iN.addEventListener('change', calculatePriceNight);


const validateInputs = (e) => {
    const currentDate = new Date();
    let iNValue = iN.value.trim();
    let outValue = out.value.trim();
    const intDataIn = iNValue;
    const intDataOut = outValue;
    const dataIn = new Date(intDataIn);
    const dataOut = new Date(intDataOut);
    dataIn.setHours(currentDate.getHours());
    dataIn.setMinutes(currentDate.getMinutes()+1);
    dataIn.setSeconds(currentDate.getSeconds());
    console.log(dataIn);
    console.log(currentDate);
    
    // let currentYear = currentDate.getFullYear();
    // let currentMonth = currentDate.getMonth() + 1;
    // let currentDay = currentDate.getDate();

    if(iNValue === '' && outValue == '') {
        error.innerHTML = "ต้องกรอกเช็คอินและเช็คเอ้าท์";
        e.preventDefault();
    }
    else if(iNValue == ''){
        error.innerHTML = "ต้องกรอกเช็คอิน";
        e.preventDefault();
    }
    else if(dataIn <= currentDate){
        error.innerHTML = "ต้องกรอกวันทีปัจจุบันหรือมากกว่าวันที่ปัจจุบัน";
        e.preventDefault();
    }
    else if(outValue == '') {
        error.innerHTML = "ต้องกรอกเช็คเอ้าท์";
        e.preventDefault();
    }
    else if(dataOut < dataIn){
        error.innerHTML = "ต้องกรอกมากกว่าวันทีเช็คอิน";
        e.preventDefault();
    }
    else{
        form.submit();
    }
};



zoomableImages.forEach((img) => {
    img.addEventListener('click', function () {
                    // Set the source of the zoomed image
        zoomedImage.src = img.src;

                // Display the overlay
         overlay.style.display = 'flex';
        });
});

overlay.addEventListener('click', function () {
    // Hide the overlay when clicked outside the image
    overlay.style.display = 'none';
});

