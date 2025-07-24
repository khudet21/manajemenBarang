<?php
session_start(); // harus di baris pertama
include '../config/db.php';
include '../views/header.php';
?>

<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<script>
    // Setelah halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert');

        if (alert) {
            // Tunggu 1 detik (1000ms), lalu sembunyikan alert
            setTimeout(() => {
                // Tambahkan class 'fade out' dan kemudian hapus elemen
                alert.classList.remove('show');
                alert.classList.add('hide'); // Untuk animasi Bootstrap
                setTimeout(() => {
                    alert.remove(); // Hapus dari DOM
                }, 500); // Tunggu animasi selesai (0.5 detik)
            }, 1000);
        }
    });
</script>


<?php
include '../views/form.php';
include '../views/footer.php';
?>