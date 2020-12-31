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
    let element = document.body;
    element.classList.toggle("dark-mode"); //class toggle
    let card = document.getElementsByClassName('card')
    for (var i = 0; i < card.length; i++) {
        card[i].classList.toggle('dark-mode');
    }
    // card.classList.toggle('dark-mode');
}

function Scrolldown() {
    window.scroll(0, 300);
}

window.onload = Scrolldown;


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
        timer: 2000,
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

// lozad('.lozad', {
//     load: function(el) {
//         el.src = el.dataset.src;
//         el.onload = function() {
//             el.classList.add('fade')
//         }
//     }
// }).observe()

// const observer = lozad('.lozad', {
//     rootMargin: '10px 0px', // syntax similar to that of CSS Margin
//     threshold: 0.1, // ratio of element convergence
//     enableAutoReload: true // it will reload the new image when validating attributes changes
// });
// observer.observe();

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

progressively.init({
    delay: 50,
    throttle: 300,
    smBreakpoint: 600,
    onLoad: function(elem) {
        console.log(elem);
    },
    onLoadComplete: function() {
        console.log('All images have finished loading!');
    }
});
progressively.render()