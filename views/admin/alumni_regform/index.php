<?php
session_start();

require "/xampp/htdocs/thesis/models/Fields.php";

$field = new Fields();
$currentFields = [
    "photo" => "File",
    "First name" => "Text",
    "Middle name" => "Text",
    "Last name" => "Text",
    "Contact number" => "Text",
    "Email" => "Text",
    "Address" => "Text",
    "Gender" => "Text",
    "Age" => "Number",
    "Birthday" => "Date",
    "Date graduated" => "Date",
    "Track finished" => "Text",
    "Strand finished" => "Text",
    "Present status" => "Text"
];

require "/xampp/htdocs/thesis/views/template/header.php";

?>

<div class="d-flex">
    <div><?php require "/xampp/htdocs/thesis/views/template/admin.php"; ?></div>
    <div class="admin-views">
        <div class="mb-2 pt-5 pb-3 px-5">
            <h1>Alumni registration form</h1>
        </div>
        <div class="px-5 py-3">
            <div class="row">
                <div class="col-6">
                    <table style="font-size: 14px;" class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Field name</th>
                            <th>Type</th>
                        </thead>
                        <tbody>
                            <?php
                            $number = 1;
                            foreach ($currentFields as $fieldName => $type) {
                                ?>
                                <tr>
                                    <td><?php echo $number; ?></td>
                                    <td><?php echo $fieldName; ?></td>
                                    <td><?php echo $type; ?></td>
                                </tr>
                                <?php
                                $number++;
                            } ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <h5>Additional fields</h5>
                    <button id="add-field-collapse" class="btn btn-dark mb-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#add-field-form" aria-expanded="false" aria-controls="collapseExample">
                        Add field <span id="collapse-icon"><i class="fas fa-caret-down ms-2"></i></span>
                    </button>
                    <div class="collapse" id="add-field-form">
                        <div class="rounded p-3 bg-white shadow-sm">
                            <form id="add-field-form-main" novalidate>
                                <div class="mb-2">
                                    <label for="field-name" class="mb-2">Field name</label>
                                    <input id="field-name" class="form-control" value="" required />
                                </div>
                                <div class="mb-2">
                                    <label for="type" class="mb-2">Type</label>
                                    <select id="type" class="form-select" aria-label="Default select example" required>
                                        <option selected value="">Select type</option>
                                        <option value="string">Text</option>
                                        <option value="int">Number</option>
                                        <option value="datetime">Date</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="form-type" class="mb-2">Form type</label>
                                    <select id="form-type" class="form-select" aria-label="Default select example"
                                        required>
                                        <option selected value="">Select form type</option>
                                        <option value="multiple_choice">Multiple choice</option>
                                        <option value="user_defined">User defined input</option>
                                    </select>
                                </div>
                            </form>
                            <button id="add-new-field" class="btn btn-dark btn-sm">Add field</button>
                        </div>
                    </div>
                    <div id="added-field-container">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="edit-field-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-field-form" novalidate>
                <div class="modal-body">

                    <div class="mb-2">
                        <label for="edit-field-name" class="mb-2">Field name</label>
                        <input id="edit-field-name" class="form-control" value="" required />
                    </div>
                    <div class="mb-2">
                        <label for="edit-type" class="mb-2">Type</label>
                        <select id="edit-type" class="form-select" aria-label="Default select example" required>
                            <option selected value="">Select type</option>
                            <option value="string">Text</option>
                            <option value="int">Number</option>
                            <option value="datetime">Date</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-form-type" class="mb-2">Form type</label>
                        <select id="edit-form-type" class="form-select" aria-label="Default select example" required>
                            <option selected value="">Select form type</option>
                            <option value="multiple_choice">Multiple choice</option>
                            <option value="user_defined">User defined input</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="edit-field-submit" data-bs-dismiss="modal" type="button" class="btn btn-primary">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-field-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete field</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this field?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="confirm-delete-field" data-bs-dismiss="modal" type="button"
                    class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="choices-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Options</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input id="choice-name" placeholder="Type option name here" value="" class="form-control" />
                    <button class="btn btn-outline-secondary" type="button" id="add-choice"><i
                            class="fas fa-plus"></i></button>
                </div>
                <div id="choices"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php

require "script.php";
require "/xampp/htdocs/thesis/views/template/footer.php";