<div>
    <div class="p-3">
        <form class="d-flex">
            <select name="batch" class="form-select me-1">
                <option value="" selected>Batches</option>
                <?php foreach ($batches as $batch) { ?>
                    <option <?php if (isset($_GET["batch"]) && $_GET["batch"] !== "") {
                                if ($_GET["batch"] == $batch) {
                                    echo "selected";
                                }
                            } ?> value="<?php echo $batch; ?>"><?php echo $batch; ?></option>
                <?php } ?>
            </select>
            <select name="track" class="form-select me-1">
                <option value="" selected>Tracks</option>
                <?php foreach ($tracksOption as $track) { ?>
                    <option <?php if (isset($_GET["track"]) && $_GET["track"] !== "") {
                                if ($_GET["track"] == $track[2]) {
                                    echo "selected";
                                }
                            } ?> value="<?php echo $track[2]; ?>"><?php echo $track[2]; ?></option>
                <?php } ?>
            </select>
            <select name="strand" class="form-select me-1">
                <option value="" selected>Strands</option>
                <?php foreach ($strandsOption as $strand) { ?>
                    <option <?php if (isset($_GET["strand"]) && $_GET["strand"] !== "") {
                                if ($_GET["strand"] == $strand[1]) {
                                    echo "selected";
                                }
                            } ?> value="<?php echo $strand[1]; ?>"><?php echo $strand[1]; ?></option>
                <?php } ?>
            </select>
            <a role="button" href="/thesis/home" class="btn btn-dark btn-sm me-1">Reset</a>
            <button class="btn btn-dark btn-sm">Filter</button>
        </form>
    </div>
    <div class="row me-0 g-2 p-3">
        <div class="col-6">
            <div class="p-4 bg-white shadow rounded">
                <div id="batch" style="height: 300px"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-4 bg-white shadow rounded">
                <div id="curriculum-exit" style="height: 300px;"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-4 bg-white shadow rounded">
                <div id="present-status" style="height: 300px;"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="p-4 bg-white shadow rounded">
                <div id="gender" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <div class="row me-0 g-2 p-3">

        <div class="col-12">
            <div class="p-4 bg-white shadow rounded">
                <div id="skills" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>