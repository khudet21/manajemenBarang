<?php
include __DIR__ . '/../config/db.php';

$isEdit = isset($_GET['id']);
$id = $isEdit ? intval($_GET['id']) : null;
$barang = ['kode_barang' => '', 'nama_barang' => '', 'kategori' => ''];
$bahan_list = [];

if ($isEdit) {
    // Ambil data barang
    $stmt = $conn->prepare("SELECT * FROM barang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $barang = $stmt->get_result()->fetch_assoc();

    // Ambil data bahan baku
    $stmt_bahan = $conn->prepare("SELECT * FROM bahan_baku WHERE id_barang = ?");
    $stmt_bahan->bind_param("i", $id);
    $stmt_bahan->execute();
    $bahan_list = $stmt_bahan->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<div class="container mt-4">
    <h2><?= $isEdit ? 'Edit' : 'Tambah' ?> Barang</h2>

    <form method="post" action="create.php<?= $isEdit ? '?id=' . $id : '' ?>">
        <button class="btn btn-primary mb-3" type="button" onclick="window.location.href='../index.php'">Kembali</button>
        <button class="btn btn-success mb-3" type="submit">Simpan</button>

        <div class="mb-3">
            <label>Kode Barang</label>
            <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($barang['kode_barang']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($barang['nama_barang']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($barang['kategori']) ?>" required>
        </div>

        <h4>Bahan Baku</h4>
        <button type="button" class="btn btn-secondary mb-3" id="add-form">Tambah Bahan</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Bahan</th>
                    <th>Nama Bahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="form-container">
                <?php if ($isEdit && count($bahan_list)): ?>
                    <?php foreach ($bahan_list as $index => $bahan): ?>
                        <tr class="form-item">
                            <td><input type="text" name="kode_bahan[]" class="form-control" value="<?= htmlspecialchars($bahan['kode_bahan']) ?>" required></td>
                            <td><input type="text" name="nama_bahan[]" class="form-control" value="<?= htmlspecialchars($bahan['nama_bahan']) ?>" required></td>
                            <td>
                                <?php if ($index >= 3): ?>
                                    <button type="button" class="btn btn-danger btn-remove">🗑️</button>
                                <?php else: ?>
                                    <span class="text-muted">🔒</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="form-item">
                        <td><input type="text" name="kode_bahan[]" class="form-control" placeholder="Kode Bahan" required></td>
                        <td><input type="text" name="nama_bahan[]" class="form-control" placeholder="Nama Bahan" required></td>
                        <td><span class="text-muted">🔒</span></td>
                    </tr>
                    <tr class="form-item">
                        <td><input type="text" name="kode_bahan[]" class="form-control" placeholder="Kode Bahan" required></td>
                        <td><input type="text" name="nama_bahan[]" class="form-control" placeholder="Nama Bahan" required></td>
                        <td><span class="text-muted">🔒</span></td>
                    </tr>
                    <tr class="form-item">
                        <td><input type="text" name="kode_bahan[]" class="form-control" placeholder="Kode Bahan" required></td>
                        <td><input type="text" name="nama_bahan[]" class="form-control" placeholder="Nama Bahan" required></td>
                        <td><span class="text-muted">🔒</span></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('add-form');
        const formContainer = document.getElementById('form-container');

        addBtn.addEventListener('click', function() {
            const row = document.createElement('tr');
            row.classList.add('form-item');
            row.innerHTML = `
            <td><input type="text" name="kode_bahan[]" class="form-control" placeholder="Kode Bahan" required></td>
            <td><input type="text" name="nama_bahan[]" class="form-control" placeholder="Nama Bahan" required></td>
            <td><button type="button" class="btn btn-danger btn-remove">🗑️</button></td>
        `;
            formContainer.appendChild(row);
        });

        formContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove')) {
                const row = e.target.closest('.form-item');
                row.remove();
            }
        });
    });
</script>