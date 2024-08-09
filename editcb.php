<?php

    // NIM : 2257401057
    // NAMA : Sofiatul Ulya
    // KELAS MI22B

    include 'koneksi.php';

        $id         = "";
        $nama       = "";
        $kategori   = "";
        $deskripsi  = "";
        $sukses     = "";
        $error      = "";

    if (isset($_GET['op'])) {
        $op = $_GET['op'];
    } else {
        $op = "";
    }

    if ($op == 'edit') {
        $id         = $_GET['id'];
        $sql       = "select * from tbl_produk where kode_produk = '$id'";
        $q1         = mysqli_query($koneksi, $sql);
        $r1         = mysqli_fetch_array($q1);
        $id        = $r1['kode_produk'];
        $nama       = $r1['nama_produk'];
        $kategori   = $r1['kategori'];
        $deskripsi  = $r1['deskripsi'];
        
        if ($id == '') {
            $error = "Data tidak ditemukan";
        }
    }
    if (isset($_POST['simpan'])) {
        
        $nama       = $_POST['nama'];
        $kategori     = $_POST['kategori'];
        $deskripsi   = $_POST['deskripsi'];
        $gambar   = $_POST['gambar'];

        if ($nama && $kategori && $deskripsi) {
            if ($op == 'edit') { 
                $sql       = "update tbl_produk set kode_produk = '$id', nama_produk='$nama', kategori = '$kategori', deskripsi='$deskripsi' where kode_produk = '$id'";
                $q1         = mysqli_query($koneksi, $sql);
                if ($q1) {
                    $sukses = "Data berhasil diupdate";
                } else {
                    $error  = "Data gagal diupdate";
                }
            } else {
                $sql   = "insert into tbl_produk(nama_produk, kategori, deskripsi, gambar) values ('$nama','$kategori','$deskripsi')";
                $q1     = mysqli_query($koneksi, $sql);
                if ($q1) {
                    $sukses     = "Berhasil memasukkan data baru";
                } else {
                    $error      = "Gagal memasukkan data";
                }
            }
        } else {
            $error = "Silakan masukkan semua data";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Produk</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <style>
            .mx-auto {
                width: 800px
            }

            .card {
                margin-top: 10px;
            }
        </style>
    </head>

    <body>
        <div class="mx-auto">
            <div class="card">
                <div class="card-header">
                    Create Data
                </div>
                <div class="card-body">

                    <?php
                        if ($error) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error ?>
                            </div>
                        <?php
                            header("refresh:5;url=editcb.php");
                        }
                    ?>

                    <?php
                        if ($sukses) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $sukses ?>
                            </div>
                        <?php
                            header("refresh:5;url=editcb.php");
                        }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="kode" class="col-sm-2 col-form-label">Kode Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kode" name="kode" value="<?php echo $id ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kategori" id="kategori">
                                    <option value="">- Pilih Kategori -</option>
                                    <option value="Aksesoris" <?php if ($kategori == "Aksesoris") echo "selected" ?>>Aksesoris</option>
                                    <option value="ATK" <?php if ($kategori == "ATK") echo "selected" ?>>ATK</option>
                                    <option value="Alat Mandi" <?php if ($kategori == "Alat Mandi") echo "selected" ?>>Alat Mandi</option>
                                    <option value="Perkakas" <?php if ($kategori == "Perkakas") echo "selected" ?>>Perkakas</option>
                                    <option value="Pakaian" <?php if ($kategori == "Pakaian") echo "selected" ?>>Pakaian</option>
                                    <option value="Elektronik" <?php if ($kategori == "Elektronik") echo "selected" ?>>Elektronik</option>
                                    <option value="Makanan" <?php if ($kategori == "Makanan") echo "selected" ?>>Makanan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Mahasiswa
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Fakultas</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $sql   = "select * from tbl_produk order by kode_produk desc";
                                $q2     = mysqli_query($koneksi, $sql);
                                $urut   = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id         = $r2['kode_produk'];
                                    $nama       = $r2['nama_produk'];
                                    $kategori   = $r2['kategori'];
                                    $deskripsi  = $r2['deskripsi'];
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nama ?></td>
                                    <td scope="row"><?php echo $kategori ?></td>
                                    <td scope="row"><?php echo $deskripsi ?></td>
                                    <td scope="row">
                                        <a href="editcb.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                                
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>