<?php
$result = $users->getUsers();
$rows = $result->fetch_all();
?>

<h3 style="margin-right: 10px;">Users</h3>
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
            <a role="button" class="btn btn-link" href=<?php echo "/thesis/users?id=".$row[0] ?>>View</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>