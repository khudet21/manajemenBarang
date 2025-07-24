</div> <!-- Tutup container dari header.php -->

<!-- Footer (DI LUAR container agar full width) -->
<footer class="bg-dark text-white text-center py-3 mt-auto w-100">
    <small>&copy; <?= date('Y') ?> Manajemen Barang | Dibuat oleh Samsul Huda</small>
</footer>

<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Inisialisasi DataTables -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</body>
</html>
