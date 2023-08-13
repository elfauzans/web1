<div class="text-center mt-5">
    <h3>Informasi Film</h3>
</div>

<div class="mt-3">
    <form action="tambah_pengaduan.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Tanggal</label>
            <input type="date" name="tgl_pengaduan" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="">Judul Film</label>
            <textarea class="form-control" name="isi_laporan" required></textarea>
        </div>
        <div class="form-group mt-3">
            <label for="">Foto</label>
            <input type="file" name="foto" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>