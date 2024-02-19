<div>
    <!--Move to admin dashboard-->
    <!-- <button data-bs-toggle="modal" data-bs-target="#sendEmail" class="btn btn-outline-dark btn-sm"><i class="fas fa-at"></i> Send email</button> -->
    <form id="search" class="mb-3">
        <div class="d-flex">
            <input hidden id="name-search-firstName" value="" />
            <input hidden id="name-search-middleName" value="" />
            <input hidden id="name-search-lastName" value="" />
            <input id="alumni-name-search" name="name" class="form-control me-2" placeholder="Name" />
            <select id="alumni-track" name="track" class="form-select me-2">
                <option selected>Track</option>
                <option value="Academic">Academic</option>
                <option value="TVL">Technical Vocational</option>
                <option value="Sports and Arts">Sports and Recreation</option>
            </select>
            <select id="alumni-track" name="strand" class="form-select me-2">
                <option selected>Strand</option>
                <option value="GA">General Academic</option>
                <option value="HUMSS">Humanities and Social Sciences</option>
                <option value="STEM">Science, Technology, Engineering, and Mathematics</option>
                <option value="ABM">Accountancy, Business and Management</option>
                <option value="Agri-Fishery Arts">Agri-Fishery Arts</option>
                <option value="Home Economics">Home Economics</option>
                <option value="Industrial Arts">Industrial Arts</option>
                <option value="ICT">Information Communications Technology</option>
                <option value="others">Others</option>
            </select>
            <select id="alumni-batch" name="batch" class="form-select me-3">
                <option selected>Batch</option>
                <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
                <option value="<?php echo date("Y") - 1; ?>"><?php echo date("Y") - 1; ?></option>
                <option value="<?php echo date("Y") - 2; ?>"><?php echo date("Y") - 2; ?></option>
                <option value="<?php echo date("Y") - 3; ?>"><?php echo date("Y") - 3; ?></option>
                <option value="<?php echo date("Y") - 4; ?>"><?php echo date("Y") - 4; ?></option>
                <option value="<?php echo date("Y") - 5; ?>"><?php echo date("Y") - 5; ?></option>
            </select>
            <button id="search-button" type="submit" class="flex-fill btn btn-sm btn-dark"><i class="fas fa-search"></i> Search</button>
        </div>
        <div id="search-result-container"></div>
    </form>
    <table class="table table-responsive-lg table-hover align-middle">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Photo</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumniAccounts as $account) { ?>
                <tr class="row-hover">
                    <?php for ($i = 0; $i < count($account); $i++) { ?>
                        <?php if ($i == 1) { ?>
                            <?php if (isset($account[$i])) {
                                $file = $account[$i];
                                echo "<td><img class='avatar' src='/thesis/public/images/profile/$file' /></td>";
                            } else { ?>
                                <td>No photo</td>
                            <?php } ?>
                        <?php } else { ?>
                            <td><?php echo $account[$i]; ?></td>
                        <?php } ?>
                    <?php } ?>
                    <td class="actions">
                        <a role="button" class="btn btn-link" href=<?php echo "/thesis/alumni?id=" . $account[0] ?>>View</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


