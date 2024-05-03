<script>
    let collapse = false;
    let addedFields = [];
    let fieldToEdit = 0;
    let fieldToDelete = 0;
    let fieldWithChoices = 0;

    function editField(fieldID) {
        fieldToEdit = Number(fieldID);

        const modal = new bootstrap.Modal("#edit-field-modal");

        $.ajax({
            type: "GET",
            url: `/thesis/admin/alumni/regform/server?id=${fieldToEdit}`,
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                $("#edit-field-name").val(parsedResponse.field["field"])
                $("#edit-type").val(parsedResponse.field["type"])
                $("#edit-form-type").val(parsedResponse.field["formType"])
            }
        });

        modal.show();
    }

    $("#edit-field-submit").on("click", () => {
        const data = new FormData();

        data.append("action", "edit-field");
        data.append("id", fieldToEdit);
        data.append("field", $("#edit-field-name").val());
        data.append("type", $("#edit-type").val());
        data.append("formType", $("#edit-form-type").val());

        $.ajax({
            type: "POST",
            url: `/thesis/admin/alumni/regform/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response) {
                    successToast("Successfully saved")
                } else {
                    errorToast(response.message);
                }
                $("#added-field-container").empty();
                getFields();
            }
        })
    });

    function deleteField(id) {
        fieldToDelete = Number(id);

        const confirmDeleteModal = new bootstrap.Modal("#delete-field-modal");
        confirmDeleteModal.show();
    }

    $("#confirm-delete-field").on("click", () => {
        const data = new FormData();

        data.append("action", "delete-field")
        data.append("id", fieldToDelete);

        $.ajax({
            type: "POST",
            url: `/thesis/admin/alumni/regform/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response) {
                    successToast("Successfully deleted")
                } else {
                    errorToast(response.message);
                }
                $("#added-field-container").empty();
                getFields();
            }
        })
    });

    let choiceToEdit = 0;

    function saveEdittedChoice(fieldId, id) {
        console.log(id);
        const data = new FormData();

        data.append("action", "edit-choice");
        data.append("choiceName", $(`#${id}`).val());
        data.append("id", id);

        $.ajax({
            type: "POST",
            url: `/thesis/admin/alumni/regform/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response) {
                    successToast("Option successfully edited");

                    loadChoices(fieldId);
                } else {
                    errorToast(response.message);
                }
            }
        })
    }

    function editChoice(fieldId, id) {
        choiceToEdit = Number(id);

        $(`#${id}`).prop("readonly", false);

        const choiceValue = $(`#${id}`).val();

        $(`#choice-${id}`).append(`<button onclick="saveEdittedChoice('${fieldId}', '${id}')" class='btn btn-sm btn-success mt-2'><i class="fas fa-check"></i></button`);
        $(`#edit-choice-${id}`).prop("disabled", true);
    }

    function deleteChoice(id, fieldId){
        const data = new FormData();

        data.append("action", "delete-choice");
        data.append("id", id);

        $.ajax({
            type: "POST",
            url: `/thesis/admin/alumni/regform/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                if(response.response){
                    successToast("Option deleted");
                    loadChoices(fieldId);
                } else {
                    errorToast(response.message);
                }
            }
        })
    }

    function loadChoices(fieldId) {
        const data = new FormData();

        data.append("action", "load-choices");
        data.append("fieldId", fieldId);

        $.ajax({
            type: "POST",
            url: `/thesis/admin/alumni/regform/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                $("#choices").empty();
                response.choices.map((choice) => {
                    $("#choices").append(`
                    <div id='choice-${choice[0]}'>
                        <div class='d-flex m-0 mt-3'>
                            <input class="form-control me-2" id="${choice[0]}" value="${choice[2]}" readonly />
                            <button id="edit-choice-${choice[0]}" onclick="editChoice('${fieldId}', '${choice[0]}')" class='btn btn-light btn-sm me-2'><i class="fas fa-pen"></i></button>
                            <button onclick="deleteChoice('${choice[0]}', '${fieldId}')" class='btn btn-light btn-sm'><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    `);
                })
            }
        })
    }

    function choices(fieldId) {
        fieldWithChoices = Number(fieldId);

        const modal = new bootstrap.Modal("#choices-modal");

        loadChoices(fieldWithChoices);
        modal.show();
    }

    $("#add-choice").on("click", () => {
        console.log(fieldWithChoices);
        const data = new FormData();

        data.append("action", "add-option");
        data.append("fieldId", fieldWithChoices);
        data.append("choiceName", $("#choice-name").val());

        $.ajax({
            type: "POST",
            url: `/thesis/admin/alumni/regform/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response) {
                    loadChoices(fieldWithChoices);
                    successToast("An option was added");
                    $("#choice-name").val("")
                } else {
                    errorToast(response.message);
                }
            }
        })
    });

    function getFields() {
        $.ajax({
            type: "GET",
            url: `/thesis/admin/alumni/regform/server`,
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                console.log(parsedResponse)

                parsedResponse.fields.map((field) => {
                    if (field[3] === "multiple_choice") {
                        $("#added-field-container").append(
                            `
                        <div class="d-flex bg-white rounded p-3 shadow-sm mb-2 align-items-center">
                            <p class='m-0' style='width: 200px;'>${field[1]}</p>
                            <p class='m-0' style='width: 150px;'>Type: ${field[2]}</p>

                            <button onclick="editField('${field[0]}')" class='btn btn-sm btn-light me-2'>
                                <i class="fas fa-pen"></i>
                            </button>
                            <button onclick="deleteField('${field[0]}')" class='btn btn-sm btn-light me-2'><i class="fas fa-trash"></i></button>
                            <button onclick="choices('${field[0]}')" style='font-size: 14px;' class='btn btn-sm btn-dark'>Choices</button>
                        </div>
                        `
                        );
                    } else {
                        $("#added-field-container").append(
                            `
                        <div class="d-flex bg-white rounded p-3 shadow-sm mb-2 align-items-center">
                            <p class='m-0' style='width: 200px;'>${field[1]}</p>
                            <p class='m-0' style='width: 150px;'>Type: ${field[2]}</p>

                            <button onclick="editField('${field[0]}')" class='btn btn-sm btn-light me-2'>
                                <i class="fas fa-pen"></i>
                            </button>
                            <button onclick="deleteField('${field[0]}')" class='btn btn-sm btn-light me-2'>
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        `
                        );
                    }

                });
            }
        });
    }

    function successToast(message) {
        const toast = new bootstrap.Toast("#response");

        $("#toast-body").empty();
        $("#toast-body").append(message);
        $("#response").addClass("text-bg-success");
        toast.show();
    }

    function errorToast(message) {
        const errorToast = new bootstrap.Toast("#error-response");

        $("#error-response #toast-body").empty();

        $("#add-field-form-main").addClass("was-validated");
        $("#error-response #toast-body").append(message);

        errorToast.show();
    }

    window.onload = () => {
        getFields();
    }

    $("#add-field-collapse").on("click", () => {
        collapse = !collapse;

        if (collapse) {
            $("#collapse-icon").html(`<i class="fas fa-caret-up ms-2"></i>`);
        } else {
            $("#collapse-icon").html(`<i class="fas fa-caret-down ms-2"></i>`);
        }
    });

    $("#add-new-field").on("click", () => {
        const data = new FormData();

        data.append("field_name", $("#field-name").val());
        data.append("type", $("#type").val());
        data.append("form_type", $("#form-type").val());
        data.append("action", "create-field");

        $.ajax({
            type: "POST",
            url: `/thesis/admin/alumni/regform/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);

                if (response.response) {
                    const collapseForm = new bootstrap.Collapse("#add-field-form");
                    collapseForm.hide();

                    successToast("Field successfully added");
                    $("#added-field-container").empty();
                    getFields();
                } else {
                    errorToast(response.message);
                }

                $("#field-name").val("");
                $("#type").val("");
                $("#form-type").val("");
            }
        });
    });
</script>