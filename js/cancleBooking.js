let btn_bk = document.querySelectorAll('.btn-bk');
let status = document.getElementById('status');
btn_bk.forEach(c=>{
    c.addEventListener('click',()=>{
    Swal.fire({
        text: "คุณต้องยกเลิกการจอง",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่'
    }).then((result) => {
        if (result.isConfirmed) {
            
                let status = document.getElementById('status');
                console.log(c);
                let formData = new FormData();
                status.innerHTML = "ยกเลิกการจอง";
                formData.append('id', c.getAttribute('id'));
                formData.append('idBooking', c.getAttribute('idBooking'));
                console.log(c.getAttribute('idBooking'));
                fetch('../php/cancleBooking.php',{
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
                c.remove();
                
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