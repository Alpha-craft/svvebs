// select element

let keyword = document.getElementById('search');
let change = document.getElementById('change');

keyword.addEventListener('keypress', () => {
    // buat objek ajax
    let ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = () => {
        if (ajax.status == 200 && ajax.readyState == 4) {
            console.log("gud")
            change.innerHTML = ajax.responseText;
        }


    }
    ajax.open('GET', 'ajax/waipu.php?keyword=' + keyword.value, true);
    ajax.send();
})