<p><i class="fas fa-user"></i> Basic information</p>
<form id="basic-information">
    <div class="form-floating mb-1">
        <input id="username" class="form-control" type="text" name="username" placeholder="username" value=<?php echo $rows["username"]; ?> readonly />
        <label for="username">username</label>
    </div>
    <div class="form-floating mb-1">
        <input id="first_name" class="form-control" type="text" name="first_name" placeholder="first name" value=<?php echo $rows["firstName"] ?> readonly />
        <label for="first_name">first name</label>
    </div>
    <div class="form-floating mb-1">
        <input id="last_name" class="form-control" type="text" name="last_name" placeholder="last name" value=<?php echo $rows["lastName"] ?> readonly />
        <label for="last_name">last name</label>
    </div>
    <div class="form-floating mb-3">
        <input id="email" class="form-control" type="email" name="email" placeholder="email" value=<?php echo $rows["email"] ?> readonly />
        <label for="email">Email</label>
    </div>
</form>