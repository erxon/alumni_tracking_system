<div class="rounded p-3 bg-white mx-auto">
    <h5>Search</h5>
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