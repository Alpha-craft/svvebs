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
})