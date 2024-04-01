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
            </select>
            <select id="alumni-track" name="strand" class="form-select me-2">
                <option selected>Strand</option>
                <option value="HUMSS">Humanities and Social Sciences</option>
                <option value="STEM">Science, Technology, Engineering, and Mathematics</option>
                <option value="ABM">Accountancy, Business and Management</option>
                <option value="Home Economics">Home Economics</option>
                <option value="Industrial Arts">Industrial Arts</option>
                <option value="ICT">Information Communications Technology</option>
                <option value="others">Others</option>
            </select>
            <input id="alumni-batch" name="batch" class="form-control me-3" type="number" />
            <button id="search-button" type="submit" class="flex-fill btn btn-sm btn-dark"><i class="fas fa-search"></i>
                Search</button>
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
            <?php for ($j = $min - 1; $j < $max; $j++) { ?>
                <tr class="row-hover">
                    <?php for ($i = 0; $i < count($alumniAccounts[$j]) - 1; $i++) {
                        $account = $alumniAccounts[$j];
                        ?>
                        <?php if ($i == 1) {
                            $photo = $account[1];
                            ?>
                            <?php if (!empty ($photo)) {
                                echo "<td><img class='avatar' src='/thesis/public/images/alumni/$photo' /></td>";
                            } else { ?>
                                <td>No photo</td>
                            <?php } ?>
                        <?php } else { ?>
                            <td>
                                <?php echo $account[$i]; ?>
                            </td>
                        <?php } ?>
                    <?php } ?>
                    <td class="actions">
                        <a role="button" class="btn btn-sm btn-light" href=<?php echo "/thesis/alumni?id=" . $account[0] ?>>View</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    $numberOfPages = ceil(count($alumniAccounts) / 5);
    ?>
    <p class="mb-1 text-secondary" style="font-size: 14px;">Page
        <?php echo "$page out of $numberOfPages"; ?>
    </p>
    <nav aria-label="...">
        <ul class="pagination">
            <?php if ($page > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="/thesis/alumni/index?page=<?php echo $page - 1 ?>">Previous</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            <?php } ?>

            <?php for ($i = 1; $i < $numberOfPages + 1 && $i < 3; $i++) { ?>
                <li class="page-item"><a class="page-link" href="/thesis/alumni/index?page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a></li>
            <?php } ?>

            <?php if ($page < $numberOfPages) { ?>
                <li class="page-item">
                    <a class="page-link" href="/thesis/alumni/index?page=<?php echo $page + 1; ?>">Next</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>