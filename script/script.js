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

function focus(id) {
    element = document.getElementById(id);
    if (element == id) {
        element.style.background = "rgba(0, 0, 0, 0.7)"
    }
}

// let gambar = document.querySelector('.image')
// let ukuran = gambar.length;
// gambar.addEventListener('mouseover', () => {
//     // gambar.className = "spinner-grow text-muted"
//     let div = document.createElement('div');
//     div.className = "spinner-grow text-primary";
//     gambar.appendChild(div);

// })


// function load(id) {
//     element = document.getElementById(id);
//     element.className = "spinner-grow text-primary";
//     element.addEventListener('mouseout', () => {
//         element.classList.remove("spinner-grow text-primary");
//     })
// }