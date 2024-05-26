<?php

include "/xampp/htdocs/thesis/models/SchoolInformation.php";

$schoolInformation = new SchoolInformation();
$tracks = $schoolInformation->getTracks();
$strands = $schoolInformation->getStrands();
?>
<div class="rounded p-3 bg-white mx-auto mb-2">
    <form id="search-alumni">
        <div class="d-flex">
            <div class="p-2 rounded border me-2">
                <div class="align-items-center">
                    <p class="m-0 me-1 label">Search by name</p>
                    <div class="d-flex">
                        <input class="form-control me-2" type="text" placeholder="first name" name="firstName" value="" />
                        <input class="form-control me-2" type="text" placeholder="middle name" name="middleName" value="" />
                        <input class="form-control me-2" type="text" placeholder="last name" name="lastName" value="" />
                    </div>
                </div>
            </div>
            <div class="align-items-center p-2 rounded border">
                <p class="m-0 me-1 label" style="width: 100%;">Track, Strand, and Year Graduated</p>
                <div class="d-flex">
                    <select id="track" name="track" class="me-2 form-select form-select" aria-label="Small select example">
                        <option selected value="">Track</option>
                        <?php foreach ($tracks as $track) { ?>
                            <option value="<?php echo $track[2] ?>"><?php echo $track[2] ?></option>
                        <?php } ?>
                    </select>
                    <select id="strand" name="strand" class="me-2 form-select form-select" aria-label="Small select example">
                        <option selected id="strand-select-placeholder" value="">Select a strand</option>
                        <?php foreach ($strands as $strand) { ?>
                            <option value="<?php echo $strand[1] ?>"><?php echo $strand[1] ?></option>
                        <?php } ?>
                    </select>
                    <input id="year-graduated" type="number" class="form-control me-2" name="year_graduated" placeholder="Year graduated" />
                </div>
            </div>
        </div>
        <button class="btn btn-sm btn-dark mt-3" type="submit">Search</button>
    </form>

</div>