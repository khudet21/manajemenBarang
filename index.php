<?php
session_start();
?>

<?php include 'config/db.php'; ?>
<?php include 'views/header.php'; ?>

<div class="container mt-4 mb-4" id="alerts-wrapper">
    <?php if (isset($_SESSION['alerts'])): ?>
        <?php foreach ($_SESSION['alerts'] as $alert): ?>
            <div class="alert alert-<?= $alert['type']; ?> alert-dismissible fade show" role="alert">
                <?= $alert['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const alerts = document.querySelectorAll('#alerts-wrapper .alert');
                    alerts.forEach((alertBox, i) => {
                        setTimeout(() => {
                            alertBox.style.opacity = '0';
                            setTimeout(() => {
                                alertBox.remove();
                            }, 500);
                        }, 1200 + i * 7000); // Delay bertahap per alert
                    });
                });
            </script>
        <?php endforeach; ?>
        <?php unset($_SESSION['alerts']); ?>
    <?php endif; ?>

    <form action="control/import.php" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <input type="file" class="form-control input-group-text" name="excel_file" accept=".xlsx,.xls" required>
            <button type="submit" class="btn btn-outline-secondary input-group-text" id="basic-addon2">Upload</button>
        </div>
    </form>

    <h2 class="mt-4 mb-4">Daftar Barang</h2>
    <a href="control/add.php" class="btn btn-primary mb-3">Tambah Barang</a>

    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query('SELECT * FROM barang');
            $detailData = [];
            while ($row = $result->fetch_assoc()):
                $collapseId = 'detail-' . $row['id'];
                $bahan_result = $conn->query('SELECT * FROM bahan_baku WHERE id_barang = ' . $row['id']);
                $bahan_list = [];
                while ($bahan = $bahan_result->fetch_assoc()) {
                    $bahan_list[] = $bahan;
                }

                $detailData[] = [
                    'id' => $row['id'],
                    'collapse_id' => $collapseId,
                    'nama_barang' => $row['nama_barang'],
                    'bahan' => $bahan_list
                ];
            ?>
                <tr>
                    <td><?= $row['kode_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td>
                        <a class="btn btn-sm btn-info toggle-collapse" data-target="#<?= $collapseId ?>" role="button">
                            👁️
                        </a>
                        <a href="control/add.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                        <a href="control/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">🗑️</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div id="collapseWrapper">
        <?php foreach ($detailData as $detail): ?>
            <div class="collapse mt-3 mb-4" id="<?= $detail['collapse_id'] ?>" data-bs-parent="#collapseWrapper">
                <div class="card card-body">
                    <h5>Detail Bahan untuk <strong><?= $detail['nama_barang'] ?></strong></h5>
                    <?php if (count($detail['bahan'])): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Bahan</th>
                                    <th>Nama Bahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail['bahan'] as $bahan): ?>
                                    <tr>
                                        <td><?= $bahan['kode_bahan'] ?></td>
                                        <td><?= $bahan['nama_bahan'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning">Tidak ada bahan baku.</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    const buttons = document.querySelectorAll('.toggle-collapse');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const target = document.querySelector(targetId);
            const isShown = target.classList.contains('show');

            document.querySelectorAll('.collapse.show').forEach(el => {
                bootstrap.Collapse.getOrCreateInstance(el).hide();
            });

            if (!isShown) {
                bootstrap.Collapse.getOrCreateInstance(target).show();
            }
        });
    });
</script>

<?php include 'views/footer.php'; ?>