<div class="d-flex mb-3">
    <div class="form-floating flex-fill me-2">
        <select id="track" name="track" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
            <option selected value="">Select a track</option>
            <?php foreach ($tracks as $track) { ?>
                <option value="<?php echo $track[2] ?>"><?php echo $track[2] ?></option>
            <?php } ?>
        </select>
        <label for="track">Track</label>
    </div>
    <div class="form-floating flex-fill me-2">
        <select disabled id="strand" name="strand" class="me-2 form-select form-select-sm" aria-label="Small select example" required>
            <option selected id="strand-select-placeholder" value="">Select a strand</option>
            <?php foreach ($strands as $strand) { ?>
                <option class="<?php echo $strand[3] ?>" value="<?php echo $strand[1] ?>">
                    <?php echo $strand[1] ?>
                </option>
            <?php } ?>
        </select>
        <label for="strand">Strand</label>
    </div>
    <div class="form-floating flex-fill me-2">
        <select class="form-select" disabled id="specialization" name="specialization">
            <option selected value="">Select a specialization</option>
            <?php foreach ($specializations as $specialization) { ?>
                <option hidden class="<?php echo $specialization[4]; ?>" value="<?php echo $specialization[3] ?>"><?php echo $specialization[3] ?></option>
            <?php } ?>
        </select>
        <label for="specialization">Specialization</label>
    </div>
    <div class="form-floating flex-fill me-2">
        <input id="year-graduated" type="text" class="form-control" name="year-graduated" placeholder="Year graduated" required />
        <label for="year-graduated">Year graduated</label>
    </div>
</div>
<div class="mb-3">
    <div class="d-flex mb-2">
        <p class="m-0 me-2">Do you have certifications?</p>
        <div class="form-check me-2">
            <input value="true" class="form-check-input is_certified" type="radio" name="isCertified" id="is_certified_true">
            <label class="form-check-label" for="isCertified">
                Yes
            </label>
        </div>
        <div class="form-check me-2">
            <input value="false" class="form-check-input is_certified" type="radio" name="isCertified" id="is_certified_false">
            <label class="form-check-label" for="isCertified">
                No
            </label>
        </div>
    </div>
    <div class="form-floating" id="certification" hidden>
        <input type="text" class="mb-3 form-control" name="certifications" default placeholder="What kind of certification did you acquired?" />
        <label for="certifications">What kind of certification did you acquired?</label>
    </div>
</div>
<div class="border border-1 rounded p-3 flex-fill me-2">
    <div id="image-preview"></div>
    <p class="m-0 mb-1 text-secondary" style="font-size: 14px;">Digital photograph 2x2 (White
        background)</p>
    <p class="m-0 mb-1 text-secondary" style="font-size: 14px;">Only accepts photo in .jpg, jpeg, and .png format</p>
    <input id="alumni_photo" accept="image/jpg, image/png, image/jpeg" type="file" name="alumni_photo" class="form-control" required />
    <div style="display: none" class="alert alert-danger mt-3" id="error" role="alert"> </div>
</div>