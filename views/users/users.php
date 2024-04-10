<div class="mb-3">
  <div class="mb-3">
    <button data-bs-target="#add-user-modal" data-bs-toggle="modal" class="btn btn-sm btn-dark"><i class="fas fa-plus"></i> Add</button>
    <button disabled id="reload-table" class="btn btn-outline-secondary btn-sm"><i class="fas fa-redo"></i> Reload</button>
  </div>
  <form id="search-user-form" class="d-flex">
    <select id="user-search-filter" name="search-filter" class="form-select me-2" aria-label="Default select example">
      <option selected>Filter</option>
      <option value="username">Username</option>
      <option value="firstName">First name</option>
      <option value="lastName">Last name</option>
      <option value="type">Type</option>
    </select>
    <div class="input-group flex-nowrap me-2">
      <span class="input-group-text bg-white text-secondary" id="addon-wrapping"><i class="fas fa-search"></i></span>
      <input name="search-user" class="form-control border-start-0" placeholder="Search" />
      <button id="search-user-submit" class="btn btn-sm btn-dark"><i class="fas fa-search"></i></button>
    </div>
  </form>
</div>
<div style="display: none; position: absolute" id="search-user-result-container-error"></div>
<div style="display: none;" id="search-user-result-container" class="rounded shadow bg-white p-3 mb-3">

</div>
<div class="table-responsive-lg">
  <table class="table table-hover p-4">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Username</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email</th>
        <th scope="col">Type</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody id="users-table"></tbody>
  </table>
  <nav id="page-navigation" aria-label="Page navigation example">
    <ul id="users-pagination" class="pagination">

    </ul>
  </nav>
</div>
<div class="modal fade" id="delete-confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete user</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button id="confirm-delete" type="button" data-bs-dismiss="modal" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>