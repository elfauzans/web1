<div class="text-center mt-5">
    <h3>INFORMASI FILM</h3>
</div>

<a href="menu.php?hal=pengaduan">
    <input class="btn btn-danger" type="submit" name="submit" value="Tambah Data film">
</a>

<div class="row mt-2" style="padding: 20px;">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Gambar Film</th>
                <!-- <th>Nama User</th>
                <th>Nama Film</th> -->
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php  
             $cekPengaduan = mysqli_query($conn, "SELECT a.*, b.nama FROM pengaduan a
             LEFT JOIN masyarakat b on a.nik = b.nik
             WHERE a.nik = '$nik'
             ORDER BY a.tgl_pengaduan DESC") ;
             $no = 1;
             while ($a = mysqli_fetch_array($cekPengaduan)) {
                $id_pengaduan = $a['id_pengaduan'];
                $tgl_pengaduan = $a['tgl_pengaduan'];
                $isi_laporan = $a['isi_laporan'];
                $foto = $a['foto'];
                // $nama = $a['nama'];
                // $nik = $a['nik'];
                
            ?>

                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $tgl_pengaduan; ?></td>
                    <td><?= $isi_laporan; ?></td>
                    <td><img src="images/<?= $foto; ?>" height="100" width="100"></td>
                    <!-- <td><?= $nama; ?></td>
                    <td><?= $nik; ?></td> -->
                    <td><a href="detail_pengaduan.php?id=<?= $id_pengaduan; ?>" class="btn btn-primary">Lihat</a></td>
                </tr>

                <?php  
                $no++;
                } ?>
        </tbody>
    </table>
</div>