<script>
    const currentUser = <?php echo $_SESSION["user_id"] ?>;

    function getUsers(pageNum) {
        $("#users-table").empty();

        const offset = pageNum * 5;

        const data = new FormData();
        data.append("offset", offset);
        data.append("action", "get-users");

        $.ajax({
            type: "POST",
            url: "/thesis/users/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response)
                if (response.response) {
                    response.result.map((row, index) => {
                        $("#users-table").append(`<tr id="${index}"></tr>`);
                        row.map((item) => {
                            $(`#${index}`).append(`
                                <td>${item}</td>
                            `);
                        });

                        if (Number(row[0]) === currentUser || row[5] === "alumni") {
                            $(`#${index}`).append(`
                        <td class="actions">
                            <a role="button" class="btn btn-sm btn-light" href="/thesis/users?id=${row[0]}">View</a>
                        </td>
                            `);
                        } else {
                            $(`#${index}`).append(`
                        <td class="actions">
                            <a role="button" class="btn btn-sm btn-light" href="/thesis/users?id=${row[0]}">View</a>
                            <button onclick="deleteUser('${row[0]}', '${row[5]}')" data-bs-toggle="modal" data-bs-target="#delete-confirmation" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                            `);
                        }

                    })
                }
            }
        });
    }

    function showToast(color, message) {
        const toast = new bootstrap.Toast("#response");

        $("#toast-body").empty();
        $("#toast-body").append(message);
        $("#response").addClass(color);

        toast.show();
    }

    function pagination(page) {
        console.log(page)
        $("#users-pagination").empty()

        $.ajax({
            type: "GET",
            url: "/thesis/users/server",
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                const numberOfUsers = Number(parsedResponse.response[0][0]);
                const pageNumbers = Math.ceil(numberOfUsers / 5);

                if (page > 1) {
                    $("#users-pagination").append(`<li class="page-item"><a class="page-link" href="/thesis/users/index?page=${page - 1}">Prev</a></li>`)
                }

                for (let i = page; i < page + 3 && i < pageNumbers + 1; i++) {
                    if (page === i) {
                        $("#users-pagination").append(`
                        <li class="page-item"><a class="page-link text-bg-primary" href="/thesis/users/index?page=${i}">${i}</a></li>
                    `);
                    } else {
                        $("#users-pagination").append(`
                        <li class="page-item"><a class="page-link" href="/thesis/users/index?page=${i}">${i}</a></li>
                    `);
                    }

                }

                if (page < pageNumbers) {
                    $("#users-pagination").append(`<li class="page-item"><a class="page-link" href="/thesis/users/index?page=${page + 1}">Next</a></li>`)
                }
            }
        })
    }

    window.onload = () => {
        const pageNum = Number($("#page_num").val());

        console.log(pageNum);
        getUsers(pageNum);
        pagination(pageNum + 1);
    }

    $("#create-user").on("submit", (event) => {
        event.preventDefault();
        console.log("submitted")

        const data = new FormData(event.target);
        data.append("action", "create-user");

        $.ajax({
            type: "POST",
            url: "/thesis/users/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                if (response.response) {
                    getUsers(0);
                    pagination(1);
                    showToast("text-bg-success", "User successfully added");
                }

            }
        });
    });

    //user search
    $("#search-user-form").on("submit", (event) => {
        event.preventDefault();

        const data = new FormData(event.target);
        const searchResultContainer = $("#search-user-result-container");
        const searchResultContainerError = $("#search-user-result-container-error");
        //search_user.php

        searchResultContainerError.empty();
        searchResultContainer.empty();
        searchResultContainer.hide();
        $.ajax({
            type: "POST",
            data: data,
            url: "/thesis/admin/user/search",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                const result = JSON.parse(response);
                console.log(result);
                if (!result.success) {
                    searchResultContainerError.fadeIn();
                    searchResultContainerError.append(`
                    <div class="alert alert-danger" role="alert">
                        ${result.message}
                    </div>`);
                    return;
                } else {
                    //enable reload table button
                    $("#reload-table").prop("disabled", false);
                    $("#users-table").empty();
                    result.results.map((user) => {
                        $("#users-table").append(`<tr>
                            <td>${user[0]}</td>
                            <td>${user[1]}</td>
                            <td>${user[2]}</td>
                            <td>${user[3]}</td>
                            <td>${user[4]}</td>
                            <td>${user[5]}</td>
                            <td>
                                <a role="button" class="btn btn-sm btn-light" href="/thesis/users?id=${user[0]}">View</a>
                                <button onclick="deleteUser('${user[0]}', '${user[5]}')" data-bs-toggle="modal" data-bs-target="#delete-confirmation" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>`)
                    })
                    $("#page-navigation").prop("hidden", true);
                }
            }
        });
    });

    let userToDelete = "";
    let userToDeleteType = "";
    //reload table
    $("#reload-table").on("click", () => {
        getUsers(0);
        pagination(1);
        $("#page-navigation").prop("hidden", false);
    });

    function deleteUser(id, type) {
        userToDelete = id;
        userToDeleteType = type;
    }

    $("#confirm-delete").on("click", () => {
        console.log(userToDelete)

        const data = new FormData();
        data.append("id", userToDelete)
        data.append("action", "delete-user");
        data.append("type", userToDeleteType)

        $.ajax({
            type: "POST",
            url: "/thesis/users/server",
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                if (response.response) {
                    getUsers(0);
                    pagination(1);
                    showToast("text-bg-primary", "User successfully deleted")
                }
            }
        })
    });
</script>