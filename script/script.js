const reader = new FileReader();
const fileInput = document.getElementById("gambar");
const img = document.getElementById("img");
reader.onload = e => {
    img.src = e.target.result;
}
fileInput.addEventListener('change', e => {
    const f = e.target.files[0];
    reader.readAsDataURL(f);
});

function myFunction() {
    if (document.body.style.color == "#f8f8f8") {
        let label = document.getElementById('label');
        label.innerHTML = "light?"
    } else {
        label.innerHTML = "dark?"
    }
    let element = document.body;
    element.classList.toggle("dark-mode"); //class toggle
    let card = document.getElementsByClassName('card')
    for (var i = 0; i < card.length; i++) {
        card[i].classList.toggle('dark-mode');
    }
    // card.classList.toggle('dark-mode');
}

let search = document.getElementById('search');
search.addEventListener('mouseover', () => {
    search.style.width = '100% !important'
});
search.addEventListener('mouseout', () => {
    search.style.width = "10% !important";
});

function mode() {
    var element = document.body;
    element.classList.toggle("dark-mode");
}
// Swal.fire({
//     position: 'top-end',
//     icon: 'info',
//     title: 'Selamat datang di Svvebs,Svvebs adalah website untuk Berbagi karya,Selamat menikmati semoga anda dapat terinspirasi dan juga menginspirasi pengguna lain melalui karya anda ',
//     showConfirmButton: false,
//     timer: 4000
// })
function kirim() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Uploaded'
    })
};