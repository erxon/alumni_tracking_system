<?php
$result = $users->getUsers();
$rows = $result->fetch_all();
?>

<div class="mb-3">
  <h3 style="margin-right: 10px;">Users</h3>
  <form id="search-user-form" class="d-flex">
    <select name="search-filter" class="form-select form-select-sm me-2" aria-label="Default select example">
      <option selected value="username">Username</option>
      <option value="firstName">First name</option>
      <option value="lastName">Last name</option>
    </select>
    <div class="input-group input-group-sm flex-nowrap me-2">
      <span class="input-group-text bg-white text-secondary" id="addon-wrapping"><i class="fas fa-search"></i></span>
      <input name="search-user" class="form-control border-start-0" placeholder="Search" />
    </div>
    <button id="search-user-submit" class="btn btn-sm btn-dark"><i class="fas fa-search me-1"></i>Search</button>
  </form>
</div>
<div style="display: none; position: absolute" id="search-user-result-container-error"></div>
<div style="display: none;" id="search-user-result-container" class="rounded shadow bg-white p-3 mb-3">

</div>
<div class="table-responsive-lg users-table">
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
    <tbody>
      <?php foreach ($rows as $row) { ?>
        <tr class="row-hover">
          <?php foreach ($row as $item) { ?>
            <td><?php echo $item ?></td>
          <?php } ?>
          <td class="actions">
            <a role="button" class="btn btn-sm btn-light" href=<?php echo "/thesis/users?id=" . $row[0] ?>>View</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>