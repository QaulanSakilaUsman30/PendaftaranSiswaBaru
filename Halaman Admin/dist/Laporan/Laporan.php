<?php
// Set the number of results per page
$resultsPerPage = isset($_GET['entries']) ? (int)$_GET['entries'] : 10;

// Get the current page number from the URL, default to 1 if not set
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Get the search term from the input
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Calculate the starting limit for the SQL query
$offset = ($currentPage - 1) * $resultsPerPage;

// Query to get the total number of records with search
$totalQuery = "SELECT COUNT(*) as total FROM datasiswa WHERE STATUS = 'DIVERIFIKASI' AND (NAMA_LENGKAP LIKE '%$searchTerm%' OR NAMA_PANGGILAN LIKE '%$searchTerm%')";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $resultsPerPage);

// Query to get the data with pagination and search
$query = "
    SELECT
        ds.ID_SISWA,
        ds.NAMA_LENGKAP,
        ds.NAMA_PANGGILAN,
        ds.TGL_LAHIR,
        ds.JENIS_KELAMIN
    FROM
        datasiswa ds
    WHERE
        ds.STATUS = 'DIVERIFIKASI' AND (NAMA_LENGKAP LIKE '%$searchTerm%' OR NAMA_PANGGILAN LIKE '%$searchTerm%' OR TGL_LAHIR LIKE '%$searchTerm%')
    ORDER BY
        ds.ID_SISWA
    LIMIT $offset, $resultsPerPage
";

$data = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Pendaftaran</h3>
                <p class="text-subtitle text-muted">Laporan Pendaftaran Siswa yang Telah diterima</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3">
                    <a href="Laporan/cetak.php" class="btn btn-warning mx-2">PDF</a>
                    <a href="Laporan/cetak_excel_tabel.php" class="btn btn-success">EXCEL</a>
                </div>
                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                    <div class="dataTable-top">
                        <div class="dataTable-dropdown">
                            <select class="dataTable-selector form-select" onchange="updateEntriesPerPage(this.value)">
                                <option value="5" <?= $resultsPerPage == 5 ? 'selected' : ''; ?>>5</option>
                                <option value="10" <?= $resultsPerPage == 10 ? 'selected' : ''; ?>>10</option>
                                <option value="15" <?= $resultsPerPage == 15 ? 'selected' : ''; ?>>15</option>
                                <option value="20" <?= $resultsPerPage == 20 ? 'selected' : ''; ?>>20</option>
                                <option value="25" <?= $resultsPerPage == 25 ? 'selected' : ''; ?>>25</option>
                            </select>
                            <label>entries per page</label>
                        </div>
                        <div class="dataTable-search">
                            <form method="GET" action="">
                                <input type="hidden" name="ke" value="laporan">
                                <input type="hidden" name="entries" value="<?= $resultsPerPage; ?>">
                                <input class="dataTable-input" name="search" placeholder="Search..." type="text" value="<?= htmlspecialchars($searchTerm); ?>" oninput="debounceSearch()">
                            </form>
                        </div>
                    </div>
                    <div class="dataTable-container">
                        <table class="table table-striped dataTable-table" id="table1">
                            <thead>
                                <tr>
                                    <th class="text-center"> No </th>
                                    <th>Nama Lengkap</th>
                                    <th>Nama Panggilan</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = $offset + 1; // Start numbering from the correct offset
                                if (mysqli_num_rows($data) > 0) { // Check if there are any rows
                                    while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['NAMA_LENGKAP']); ?></td>
                                            <td><?= htmlspecialchars($row['NAMA_PANGGILAN']); ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['TGL_LAHIR'])); ?></td>
                                            <td><?= htmlspecialchars($row['JENIS_KELAMIN']); ?></td>
                                            <td class="text-center" width="120px">
                                                <div style="display: flex; gap: 10px;">
                                                    <a href="Master Data/Siswa/cetak.php?id=<?= $row['ID_SISWA'] ?>" class="btn btn-warning my-2">
                                                        <svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                            <path d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1 .1-.2 .1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-                                                        43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"/>
                                                        </svg>
                                                    </a>
                                                    <a href="Master Data/Siswa/cetak_excel.php?id=<?= $row['ID_SISWA'] ?>" class="btn btn-success my-2">
                                                        <svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                                            <path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9zM384 121.9v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">Tidak ada data siswa yang diverifikasi.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="dataTable-bottom">
                        <div class="dataTable-info">Showing <?= $offset + 1; ?> to <?= min($offset + $resultsPerPage, $totalRecords); ?> of <?= $totalRecords; ?> entries</div>
                        <ul class="pagination pagination-primary float-end dataTable-pagination">
                            <?php if ($currentPage > 1) : ?>
                                <li class="page-item">
                                    <a href="index.php?ke=laporan&page=<?= $currentPage - 1; ?>&entries=<?= $resultsPerPage; ?>&search=<?= urlencode($searchTerm); ?>" class="page-link">‹</a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?= ($i === $currentPage) ? 'active' : ''; ?>">
                                    <a href="index.php?ke=laporan&page=<?= $i; ?>&entries=<?= $resultsPerPage; ?>&search=<?= urlencode($searchTerm); ?>" class="page-link"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($currentPage < $totalPages) : ?>
                                <li class="page-item">
                                    <a href="index.php?ke=laporan&page=<?= $currentPage + 1; ?>&entries=<?= $resultsPerPage; ?>&search=<?= urlencode($searchTerm); ?>" class="page-link">›</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function updateEntriesPerPage(entries) {
        const url = new URL(window.location.href);
        url.searchParams.set('entries', entries);
        url.searchParams.set('page', 1); // reset to first page
        window.location.href = url.toString();
    }

    let debounceTimer;
    function debounceSearch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            document.querySelector('form').submit();
        }, 500); // Tunggu 500ms setelah pengguna berhenti mengetik
    }
</script>