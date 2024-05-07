<div class="rounded p-3 bg-white mx-auto mb-2">
    <div class="rounded border p-2 mb-2">
        <form id="alumni-by-name">
            <div class="d-flex flex-row align-items-center">
                <p class="m-0 me-1 fw-bold" style="width: 100%;">Search by name</p>
                <input class="form-control me-2" type="text" placeholder="first name" name="firstName" value="" />
                <input class="form-control me-2" type="text" placeholder="middle name" name="middleName" value="" />
                <input class="form-control me-2" type="text" placeholder="last name" name="lastName" value="" />
                <button class="btn btn-sm btn-dark" type="submit">Search</button>
            </div>
        </form>
    </div>
    <div class="rounded border p-2">
        <form id="alumni-by-track-strand-year-grad">
            <div class="d-flex flex-row align-items-center">
                <p class="m-0 me-1 fw-bold" style="width: 100%;">Search by School Information</p>
                <select id="track" name="track" class="me-2 form-select form-select" aria-label="Small select example">
                    <option selected value="">Track</option>
                    <option value="Academic">Academic</option>
                    <option value="TVL">Technical-Vocational-Livelihood</option>
                </select>
                <select id="strand" name="strand" class="me-2 form-select form-select" aria-label="Small select example">
                    <option selected id="strand-select-placeholder" value="">Select a strand</option>
                    <option class="strands-for-academic" value="HUMSS">Humanities and Social Sciences</option>
                    <option class="strands-for-academic" value="STEM">Science, Technology, Engineering, and Mathematics</option>
                    <option class="strands-for-academic" value="ABM">Accountancy, Business and Management</option>
                    <option class="strands-for-tvl" value="Home Economics">Home Economics</option>
                    <option class="strands-for-tvl" value="Industrial Arts">Industrial Arts</option>
                    <option class="strands-for-tvl" value="ICT">Information, Communication and Technology</option>
                </select>
                <input id="year-graduated" type="number" class="form-control me-2" name="year_graduated" placeholder="Year graduated" />
                <button class="btn btn-sm btn-dark" type="submit">Search</button>
            </div>

        </form>
    </div>
</div>