<div class="add-user-form">
  <form id="create-user">
    <div class="row mb-3">
      <div class="col">
        <div class="form-floating">
          <input hidden name="action" value="createUser" />
          <input id="firstName" class="form-control" type="text" placeholder="First name" name="first_name" />
          <label for="firstName">First Name</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating">
          <input id="lastName" class="form-control" type="text" placeholder="Last name" name="last_name" />
          <label for="lastName">Last Name</label>
        </div>
      </div>
    </div>
    <div class="form-floating">
      <input class="form-control" type="text" placeholder="username" name="username" /><br />
      <label for="lastName">Username</label>
    </div>
    <div class="form-floating">
      <input class="form-control" type="text" placeholder="email" name="email" /><br />
      <label for="lastName">Email Address</label>
    </div>
    <div class="form-floating">
      <input id="password" class="form-control" type="text" placeholder="password" name="password" /><br />
      <label for="password">Password</label>
    </div>
    <div class="user-type">
      <div class="radio">
        <input class="form-check-input" type="radio" id="teacher" name="type" value="teacher" />
        <label class="form-check-label" for="teacher">Teacher</label><br />
      </div>
      <div class="radio">
        <input class="form-check-input" type="radio" id="principal" name="type" value="principal" />
        <label class="form-check-label" for="principal">Principal</label><br />
      </div>
    </div>
    <button class="btn btn-primary my-3" type="submit" data-bs-dismiss="modal">Add</button>
  </form>
</div>