<?php
session_start();
include "/xampp/htdocs/thesis/views/template/header.php"; ?>


<div style="margin-top: 5%" class="main-body-padding surveys">
    <h1>Search alumni</h1>
    <div class="rounded p-3 bg-white shadow mx-auto">
        <div class="d-flex">
            <div class="rounded border p-2 me-2">
                <form id="alumni-by-name">
                    <p class="fw-semibold">Search by name</p>
                    <div class="d-flex flex-row">
                        <input class="form-control me-2" type="text" placeholder="first name" name="firstName" value="" />
                        <input class="form-control me-2" type="text" placeholder="middle name" name="middleName" value="" />
                        <input class="form-control me-2" type="text" placeholder="last name" name="lastName" value="" />
                    </div>
                    <button class="btn btn-sm btn-dark mt-3" type="submit">Search</button>
                </form>
            </div>
            <div class="rounded border p-2">
                <form id="alumni-by-track-strand-year-grad">
                    <p class="fw-semibold">Search by track, strand, and year graduated</p>
                    <div class="d-flex flex-row">
                        <select id="track" name="track" class="me-2 form-select form-select-sm" aria-label="Small select example">
                            <option selected value="">Track</option>
                            <option value="Academic">Academic</option>
                            <option value="TVL">Technical-Vocational-Livelihood</option>
                        </select>
                        <select id="strand" name="strand" class="me-2 form-select form-select-sm" aria-label="Small select example">
                            <option selected id="strand-select-placeholder" value="">Select a strand</option>
                            <option class="strands-for-academic" value="HUMSS">Humanities and Social Sciences</option>
                            <option class="strands-for-academic" value="STEM">Science, Technology, Engineering, and Mathematics</option>
                            <option class="strands-for-academic" value="ABM">Accountancy, Business and Management</option>
                            <option class="strands-for-tvl" value="Home Economics">Home Economics</option>
                            <option class="strands-for-tvl" value="Industrial Arts">Industrial Arts</option>
                            <option class="strands-for-tvl" value="ICT">Information, Communication and Technology</option>
                        </select>
                        <input type="number" class="form-control" name="year_graduated" placeholder="Year graduated" />
                    </div>
                    <button class="btn btn-sm btn-dark mt-3" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div style="display: none;" class="mx-auto mt-3 shadow" id="search-result-table" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <table class="table">
            <thead>
                <th>id</th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>Track</th>
                <th>Strand</th>
                <th>Batch</th>
                <th>Email</th>
            </thead>
            <tbody id="search-result-content">
            </tbody>
        </table>
    </div>
</div>
<script>
    $("#alumni-by-name").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        data.append("search", "byName");

        $.ajax({
            type: "POST",
            url: "/thesis/search/server/alumni",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response) {
                    $("#search-result-content").empty();
                    $("#search-result-table").show();
                    response.result.map((alumni) => {
                        $("#search-result-content").append(`
                            <tr>
                                <td>${alumni[0]}</td>
                                <td>${alumni[3]}</td>
                                <td>${alumni[4]}</td>
                                <td>${alumni[5]}</td>
                                <td>${alumni[13]}</td>
                                <td>${alumni[14]}</td>
                                <td>${alumni[12]}</td>
                                <td>${alumni[7]}</td>
                            </tr>
                        `);
                    });
                } else {
                    const toast = new bootstrap.Toast("#response");
                    toast.show();

                    $("#toast-body").empty();
                    $("#toast-body").append(`<p>User not found</p>`);
                }
            }
        });
    });

    $("#alumni-by-track-strand-year-grad").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        data.append("search", "byTrackStrandYearGrad");

        $.ajax({
            type: "POST",
            url: "/thesis/search/server/alumni",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response) {
                    $("#search-result-content").empty();
                    $("#search-result-table").show();
                    response.result.map((alumni) => {
                        $("#search-result-content").append(`
                            <tr>
                                <td>${alumni[0]}</td>
                                <td>${alumni[3]}</td>
                                <td>${alumni[4]}</td>
                                <td>${alumni[5]}</td>
                                <td>${alumni[13]}</td>
                                <td>${alumni[14]}</td>
                                <td>${alumni[12]}</td>
                                <td>${alumni[7]}</td>
                            </tr>
                        `);
                    });
                } else {
                    $("#search-result-table").hide();
                    const toast = new bootstrap.Toast("#response");
                    toast.show();

                    $("#toast-body").empty();
                    $("#toast-body").append(`<p>User not found</p>`);
                }
            }
        });
    });
</script>



<?php include "/xampp/htdocs/thesis/views/template/footer.php"; ?>