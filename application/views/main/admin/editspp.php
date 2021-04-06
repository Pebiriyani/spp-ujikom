<div class="main" style="margin-top: 9%;">
    <div class="prev">
        <a href="javascript:window.history.go(-1);" class="previous round">&laquo;</a>
    </div>
    <div class="container" style="width: 70%; ">

        <center>
            <h3 style="margin-bottom: 15px;">Ubah Data spp</h3>
        </center>
        <hr>
        <form action="" method="POST">
            <input type="hidden" name="id_spp" value="<?= $spp['id_spp']; ?>">

            <div class="form-group">
                <input type="text" class="form-control" id="inputusername" placeholder="tahun" name="tahun"
                    value="<?= $spp['tahun']; ?>">

            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                    placeholder="nominal" name="nominal" value="<?= $spp['nominal']; ?>">

            </div>

            <div class="modal-footer">
                <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>