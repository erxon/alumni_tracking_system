<div>
    <!--Move to admin dashboard-->
    <!-- <button data-bs-toggle="modal" data-bs-target="#sendEmail" class="btn btn-outline-dark btn-sm"><i class="fas fa-at"></i> Send email</button> -->
    <?php include "/xampp/htdocs/thesis/views/alumni/admin_search/search.php" ?>
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
        <tbody id="alumni-table-container">
            <?php for ($j = $min - 1; $j < $max; $j++) { ?>
                <tr class="row-hover">
                    <?php for ($i = 0; $i < count($alumniAccounts[$j]) - 1; $i++) {
                        $account = $alumniAccounts[$j];
                    ?>
                        <?php if ($i == 1) {
                            $photo = $account[1];
                        ?>
                            <?php if (!empty($photo)) {
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
                        <a role="button" class="btn btn-sm btn-light alumni-record-action" href=<?php echo "/thesis/alumni/profile?id=" . $account[0] ?>>View</a>
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
</div>

<?php include "pagination.php"; ?>
<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete alumni</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to archive this alumni?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button data-bs-dismiss="modal" id="confirm-delete-alumni" type="button" class="btn btn-danger"><i class="fas fa-archive"></i> Archive</button>
            </div>
        </div>
    </div>
</div>