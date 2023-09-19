<div class="input">
    <div>
        <h5>Pilih Lokasi</h5>
    </div>
    <hr>
    <div>
        <a>1. Silahkan memilih titik awal pada dengan cara klik lokasi yang anda ingin kan.</a>
    </div>
    <hr>
    <form>
    <div class="form-group">
        <label for="lokasiakhir">2. Silahkan memilih titik akhir</label>
        <select class="form-control" id="lokasiakhir" placeholder="Titik Akhir"></select>
    </div>
    <a>Jarak Jarak berdasarkan Metode Haversine: <h6><div id='distance-info'></div></h6></a>
    <hr>
    <button type="button" class="btn btn-primary" id="RouteButton">Cari Rute</button>
    <button type="button" class="btn btn-success" id="calculateRouteButton">Buka Google Maps</button>
    </form>
    <hr>
    <div>
    <a href="<?=site_url('tabel')?>" style="color:black;"> 
    <i class="fa fa-sign-in" style="color:black;font-size: 1.8vh; padding: 0vh 1vh 0vh 1vh;"></i>
    Silahkhan login disini ...
    </a>
    </div>
</div>



