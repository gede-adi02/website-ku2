const form = document.getElementById('pendaftaranForm');

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const nama = form.querySelector('input[type="text"]').value;

    const iyah = confirm("Apakah Anda yakin data sudah benar?");

    if (iyah) {
        alert("Terima kasih " + nama + ", Data pendaftaran Anda sudah terekam!");
        window.location.href = "form.html";
    }
});

form.addEventListener('reset', function(event) {
    event.preventDefault();
    
    const yakin = confirm("Apakah Anda yakin ingin menghapus semua data di form ini?");
    
    if (yakin) {
        alert("Data pendaftaran Anda berhasil di reset!");
        window.location.href = "form.html";
    }
});



// form.addEventListener('reset', function() {
//         console.log("Form telah dikosongkan");
// });