<?php
include '../../koneksi.php'; // Pastikan path ke koneksi benar

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambahdokumen'])) {
    $id_siswa = mysqli_real_escape_string($conn, $_POST['ID_SISWA']);
    $upload_dir = 'Master Data/dokumen/'; // Direktori penyimpanan dokumen

    // Pastikan direktori upload ada, jika tidak, buat
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $upload_status = true;
    $upload_messages = [];
    $uploaded_files = [
        'AKTA' => '',
        'KARTU_KELUARGA' => '',
        'IJAZAH' => '',
        'SKL' => '',
        'BUKU_PIP' => '',
    ];

    $file_inputs = [
        'AKTA' => 'AKTA',
        'KARTU_KELUARGA' => 'KARTU_KELUARGA',
        'IJAZAH' => 'IJAZAH',
        'SKL' => 'SKL',
        'BUKU_PIP' => 'BUKU_PIP',
    ];

    // Debugging output untuk melihat data $_FILES
    echo "<pre>FILES Array:\n";
    var_dump($_FILES);
    echo "</pre>";

    foreach ($file_inputs as $input_name => $db_column) {
        if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] == 0) {
            $file_name = $_FILES[$input_name]['name'];
            $tmp_name = $_FILES[$input_name]['tmp_name'];
            $file_size = $_FILES[$input_name]['size'];
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $new_file_name = $db_column . '_' . $id_siswa . '_' . time() . '.' . $file_extension;
            $target_file = $upload_dir . $new_file_name;

            // Batasan ukuran file (contoh 25MB)
            if ($file_size > 25000000) {
                $upload_status = false;
                $upload_messages[] = "Ukuran file untuk $db_column ($file_name) terlalu besar (maks. 25MB).";
            }

            if ($upload_status) {
                if (move_uploaded_file($tmp_name, $target_file)) {
                    $uploaded_files[$db_column] = $new_file_name;
                } else {
                    $upload_status = false;
                    $upload_messages[] = "Gagal mengunggah file $db_column ($file_name).";
                }
            }
        } elseif (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] != 4) {
            // Error lain saat upload
            $upload_status = false;
            $upload_messages[] = "Terjadi kesalahan saat mengunggah file untuk $db_column.";
        }
    }

    // Debugging output untuk melihat data $uploaded_files dan $upload_messages
    echo "<pre>Uploaded Files Array:\n";
    var_dump($uploaded_files);
    echo "\nUpload Messages Array:\n";
    var_dump($upload_messages);
    echo "</pre>";

    if ($upload_status) {
        // Cek dokumen yang sudah ada
        $sql_check = "SELECT * FROM dokumen WHERE ID_SISWA = '$id_siswa'";
        $result_check = mysqli_query($conn, $sql_check);
        $existing_docs = mysqli_fetch_assoc($result_check);

        if ($existing_docs) {
            // Update dokumen yang sudah ada
            $update_sql = "UPDATE dokumen SET 
                AKTA = IF('$uploaded_files[AKTA]' != '', '$uploaded_files[AKTA]', AKTA),
                KARTU_KELUARGA = IF('$uploaded_files[KARTU_KELUARGA]' != '', '$uploaded_files[KARTU_KELUARGA]', KARTU_KELUARGA),
                IJAZAH = IF('$uploaded_files[IJAZAH]' != '', '$uploaded_files[IJAZAH]', IJAZAH),
                SKL = IF('$uploaded_files[SKL]' !=                 '', '$uploaded_files[SKL]', SKL),
                BUKU_PIP = IF('$uploaded_files[BUKU_PIP]' != '', '$uploaded_files[BUKU_PIP]', BUKU_PIP)
                WHERE ID_SISWA = '$id_siswa'";

            if (mysqli_query($conn, $update_sql)) {
                header('Location: ../index.php?ke=dashboard&id=' . $id_siswa . '&pesan=berhasil_update_dokumen');
                exit();
            } else {
                echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
                // Mungkin perlu menghapus file yang sudah diupload jika terjadi error database
                foreach ($uploaded_files as $file) {
                    if (!empty($file) && file_exists($upload_dir . $file)) {
                        unlink($upload_dir . $file);
                    }
                }
            }
        } else {
            // Jika dokumen belum ada, insert dokumen baru
            $akta = mysqli_real_escape_string($conn, $uploaded_files['AKTA']);
            $kartu_keluarga = mysqli_real_escape_string($conn, $uploaded_files['KARTU_KELUARGA']);
            $ijazah = mysqli_real_escape_string($conn, $uploaded_files['IJAZAH']);
            $skl = mysqli_real_escape_string($conn, $uploaded_files['SKL']);
            $buku_pip = mysqli_real_escape_string($conn, $uploaded_files['BUKU_PIP']);

            $sql = "INSERT INTO dokumen (ID_SISWA, AKTA, KARTU_KELUARGA, IJAZAH, SKL, BUKU_PIP)
                    VALUES ('$id_siswa', '$akta', '$kartu_keluarga', '$ijazah', '$skl', '$buku_pip')";

            if (mysqli_query($conn, $sql)) {
                header('Location: ../index.php?ke=dashboard&id=' . $id_siswa . '&pesan=berhasil_upload_dokumen');
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                // Mungkin perlu menghapus file yang sudah diupload jika terjadi error database
                foreach ($uploaded_files as $file) {
                    if (!empty($file) && file_exists($upload_dir . $file)) {
                        unlink($upload_dir . $file);
                    }
                }
            }
        }
    } else {
        echo '<div class="alert alert-danger">';
        foreach ($upload_messages as $message) {
            echo $message . '<br>';
        }
        echo '</div>';
        // Anda mungkin ingin menambahkan link kembali ke form atau halaman sebelumnya
    }

    mysqli_close($conn);
} else {
    // Jika bukan POST request atau tombol submit tidak ditekan
    header('Location: ../index.php?ke=dashboard'); // Redirect ke halaman siswa
    exit();
}
?>