const zoomableImages = document.querySelectorAll('.img-all');
const overlay = document.getElementById('overlay');
const zoomedImage = document.getElementById('zoomed-image');

let dropdownBtn = document.getElementById("dropdownBtn");
let dropdown = document.getElementById("myDropdown");

if(dropdownBtn){
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
}
  
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

let thisPage = 1;
let limit = 3;
let list = document.querySelectorAll('.cont');
function loadItem(){
    let beginGet = limit * (thisPage-1);
    let endGet = limit * thisPage - 1;
    list.forEach((item,key)=>{
        if(key >= beginGet && key <= endGet){
            item.style.display = 'flex';
        }
        else{
            item.style.display = 'none';
        }
    })
    listPage();
}

loadItem();
function listPage(){
    let count = Math.ceil(list.length/limit);
    document.querySelector('.previous-next').innerHTML = '';
    if(thisPage != 1){
        let prev = document.createElement('a');
        prev.innerHTML = 'PREV';
        prev.setAttribute('onclick',"changPage("+(thisPage-1)+")");
        document.querySelector('.previous-next').appendChild(prev);
    }
    for(let i = 1;i<=count;i++){
        let newPage = document.createElement('a');
        newPage.innerHTML = i;
        if(i == thisPage){
            newPage.classList.add('a1');
        }
        newPage.setAttribute('onclick',"changPage("+i+")");
        document.querySelector('.previous-next').appendChild(newPage);
    }
    if(thisPage != count){
        let next = document.createElement('a');
        next.innerHTML = 'NEXT';
        next.setAttribute('onclick',"changPage("+(thisPage+1)+")");
        document.querySelector('.previous-next').appendChild(next);
    }
}
function changPage(i){
    thisPage = i;
    loadItem();
}