let btn_bk = document.querySelectorAll('.btn-bk');

btn_bk.forEach(c=>{
    c.addEventListener('click',()=>{
    Swal.fire({
        title: 'คุณต้องแก้ไขเป็นชำระแล้ว ?',
        text: "คุณจะไม่สามารถแก้ไขได้อีกครั้ง",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่'
    }).then((result) => {
        if (result.isConfirmed) {
                console.log(c);
                console.log(c.getAttribute("idBooking"));
                c.innerHTML = "ชำระแล้ว";
                let formData = new FormData();
                formData.append('id', c.getAttribute('id'));
                formData.append('idBooking', c.getAttribute('idBooking'));

                fetch('./php/confirmBooking.php',{
                    method: 'POST',
                    body: formData
                })
                .then((response)=>{
                    if(!response.ok) {
                        throw new Error('Error');
                    }
                    return response.text();
                })
                .catch(error =>{
                    console.error(error);
                })
                c.classList.remove("btn-warning");
                c.classList.add("btn-success");
                c.disabled = true;
        }
    });
})
})
// btn_bk.forEach(c=>{
//     c.addEventListener('click',()=>{
//         c.innerHTML = "ชำระแล้ว";
//         let formData = new FormData();
//         formData.append('id', c.getAttribute('id'));
//         fetch('./php/confirmBooking.php',{
//             method: 'POST',
//             body: formData
//         })
//         .then((response)=>{
//             if(!response.ok) {
//                 throw new Error('Error');
//             }
//             return response.text();
//         })
//         .catch(error =>{
//             console.error(error);
//         })
            
//     })
// })