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
$totalQuery = "SELECT COUNT(*) as total FROM datasiswa WHERE (STATUS = 'BELUM DIVERIFIKASI' OR STATUS = 'DITOLAK') AND (NAMA_LENGKAP LIKE '%$searchTerm%' OR NAMA_PANGGILAN LIKE '%$searchTerm%')";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $resultsPerPage);

// Query to get the data with pagination and search
$query = "
    SELECT ID_SISWA, NAMA_LENGKAP, NAMA_PANGGILAN, TGL_LAHIR, JENIS_KELAMIN, STATUS 
    FROM datasiswa 
    WHERE (STATUS = 'BELUM DIVERIFIKASI' OR STATUS = 'DITOLAK') AND (NAMA_LENGKAP LIKE '%$searchTerm%' OR NAMA_PANGGILAN LIKE '%$searchTerm%' OR STATUS LIKE '%$searchTerm%')
    LIMIT $offset, $resultsPerPage
";

$data = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Siswa</h3>
                <p class="text-subtitle text-muted">Data siswa yang mendaftar</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?ke=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
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
                                <input type="hidden" name="ke" value="datasiswa">
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
                                    <th>Status Verifikasi</th>
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
                                            <td><?= htmlspecialchars($row['TGL_LAHIR']); ?></td>
                                            <td><?= htmlspecialchars($row['JENIS_KELAMIN']); ?></td>
                                            <td>
                                                <?php
                                                if ($row['STATUS'] == 'BELUM DIVERIFIKASI') {
                                                    echo '<span class="badge bg-primary">BELUM DIVERIFIKASI</span>';
                                                } elseif ($row['STATUS'] == 'DITOLAK') {
                                                    echo '<span class="badge bg-secondary">DITOLAK</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center" width="100px">
                                                <div style="display: flex; gap: 10px;">
                                                    <a href="index.php?ke=detailData&id=<?= htmlspecialchars($row['ID_SISWA']); ?>" class="btn btn-warning my-2" title="Detail">
                                                        <svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                            <path d="M572.5 241.4C518.3 135.6 410.9 64 288 64S57.7 135.6 3.5 241.4a32.4 32.4 0 0 0 0 29.2C57.7 376.4 165.1 448 288 448s230.3-71.6 284.5-177.4a32.4 32.4 0 0 0 0-29.2zM288 400a144 144 0 1 1 144-144 143.9 143.9 0 0 1 -144 144zm0-240a95.3 95.3 0 0 0 -25.3 3.8 47.9 47.9 0 0 1 -66.9 66.9A95.8 95.8 0 1 0 288 160z"/>
                                                        </svg>
                                                    </a>
                                                    <a href="index.php?ke=verifikasi&id=<?= htmlspecialchars($row['ID_SISWA']); ?>" class="btn btn-primary my-2" title="DIVERIFIKASI">
                                                        <svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M173.9 439.4l-166.4-166.4c-10-10-10-26.2 0-36.2l36.2-36.2c10-10 26.2-10 36.2 0L192 312.7 432.1 72.6c10-10 26.2-10 36.2 0l36.2 36.2c10 10 10 26.2 0 36.2l-294.4 294.4c-10 10-26.2 10-36.2 0z"/>
                                                        </svg>
                                                    </a>
                                                    <a href="index.php?ke=ditolak&id=<?= htmlspecialchars($row['ID_SISWA']); ?>" class="btn btn-secondary my-2" title="DITOLAK">
                                                        <svg fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                                            <path d="M242.7 256l100.1-100.1c12.3-12.3 12.3-32.2 0-44.5l-22.2-22.2c-12.3-12.3-32.2-12.3-44.5 0L176 189.3 75.9 89.2c-12.3-12.3-32.2-12.3-44.5 0L9.2 111.5c-12.3 12.3-12.3 32.2 0 44.5L109.3 256 9.2 356.1c-12.3 12.3-12.3 32.2 0 44.5l22.2 22.2c12.3 12.3 32.2 12.3 44.5 0L176 322.7l100.1 100.1c12.3 12.3 32.2 12.3 44.5 0l22.2-22.2c12.3-12.3 12.3-32.2 0-44.5L242.7 256z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="7" class="text-center">Tidak ada data siswa yang ditemukan.</td></tr>';
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
                                    <a href="index.php?ke=datasiswa&page=<?= $currentPage - 1; ?>&entries=<?= $resultsPerPage; ?>&search=<?= urlencode($searchTerm); ?>" class="page-link">‹</a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?= ($i === $currentPage) ? 'active' : ''; ?>">
                                    <a href="index.php?ke=datasiswa&page=<?= $i; ?>&entries=<?= $resultsPerPage; ?>&search=<?= urlencode($searchTerm); ?>" class="page-link"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($currentPage < $totalPages) : ?>
                                <li class="page-item">
                                    <a href="index.php?ke=datasiswa&page=<?= $currentPage + 1; ?>&entries=<?= $resultsPerPage; ?>&search=<?= urlencode($searchTerm); ?>" class="page-link">›</a>
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