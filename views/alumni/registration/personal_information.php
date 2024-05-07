<div class="d-flex flex-row mb-3">
    <div class="form-floating flex-fill me-2">
        <input id="first-name" type="text" class="form-control me-1" name="first-name" placeholder="First Name" required />
        <label for="first-name">First name</label>
    </div>
    <div class="form-floating flex-fill me-2">
        <input id="middle-name" type="text" class="form-control me-1" name="middle-name" placeholder="Middle Name" />
        <label for="middle-name">Middle name</label>
    </div>
    <div class="form-floating flex-fill me-2">
        <input id="last-name" type="text" class="form-control" name="last-name" placeholder="Last Name" required />
        <label for="last-name">Last name</label>
    </div>
</div>
<hr class="my-3" />
<div class="d-flex mb-3">
    <div class="form-floating flex-fill me-2">
        <input id="contact-number" type="text" class="form-control" name="contact-number" placeholder="Contact Number" required />
        <label for="contact-number">Contact number <i>(+63)</i></label>
    </div>
    <div class="form-floating flex-fill">
        <input id="email" type="email" class="form-control" name="email" placeholder="Email" required />
        <label for="email">Email <i>(@gmail.com)</i></label>
        <div style="display: none" id="email-already-exists" class="invalid-feedback">
            Email already exists
        </div>
    </div>
</div>
<div class="form-floating">
    <input id="address" type="text" class="mb-3 form-control" name="address" placeholder="Complete address" required />
    <label for="address">Complete address <i>(House number, Street name, Barangay, Municipality)
        </i></label>
</div>
<hr class="my-3" />
<div class="d-flex mb-3 align-items-center">
    <div class="form-floating flex-fill me-2">
        <input id="birthdate" type="text" name="birthdate" class="form-control" placeholder="Birthdate" required />
        <label for="birthdate">Birthdate</label>
    </div>
    <div class="form-floating flex-fill me-2">
        <input id="age" type="number" name="age" class="form-control" placeholder="Age" readonly />
        <label for="age">Age</label>
    </div>
    <div class="form-floating flex-fill me-2">
        <select id="gender" name="gender" class="form-select" aria-label="Small select example" required>
            <option selected value="">Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <label for="gender">Gender</label>
    </div>
</div>