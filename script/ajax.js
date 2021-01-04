// select element

let keyword = document.getElementById('search');
let change = document.getElementById('change');

keyword.addEventListener('keyup', () => {
    // buat objek ajax
    let ajax = new XMLHttpRequest();
    //cek kesiapan ajax
    ajax.onreadystatechange = () => {
        if (ajax.status == 200 && ajax.readyState == 4) {
            change.innerHTML = ajax.responseText;
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
            progressively.render();
        }


    }
    ajax.open('GET', 'ajax/waipu.php?keyword=' + keyword.value, true);
    ajax.send();
})