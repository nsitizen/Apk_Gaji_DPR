document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');
    // Cari semua tombol dengan class .btn-delete
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            // Tampilkan dialog konfirmasi bawaan browser
            const userConfirmed = confirm('Apakah Anda yakin ingin menghapus data ini?');
            
            // Jika user menekan "Cancel", batalkan aksi default (misal: pindah halaman)
            if (!userConfirmed) {
                event.preventDefault();
            }
        });
    });
});