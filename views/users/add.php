<div class="add-user-form">
  <form id="create-user">
    <div class="form-floating">
      <input class="form-control" type="text" placeholder="email" name="email" /><br />
      <label for="lastName">Email Address</label>
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