async function validateFirstPage(formData) {
  if (
    formData.get("alumni_photo").name === "" ||
    formData.get("first-name") === "" ||
    formData.get("last-name") === "" ||
    formData.get("contact-number") === "" ||
    formData.get("email") === "" ||
    formData.get("address") === "" ||
    formData.get("birthdate") === "" ||
    formData.get("age") === "" ||
    formData.get("gender") === "" ||
    formData.get("track") === "" ||
    formData.get("strand") === "" ||
    formData.get("year-graduated") === "" ||
    formData.get("present-status") === ""
  ) {
    throw new Error("Please fill all required fields");
    return;
  }

  switch (formData.get("present-status")) {
    case "University Student":
      if (
        (formData.get("inst-name-cavite") === "" &&
          formData.get("inst-name-cavite-other") == "" &&
          formData.get("inst-name-outside-cavite") === "" &&
          formData.get("inst-name-outside-cavite-other") === "") ||
        formData.get("school-type") === "" ||
        formData.get("school-location") === "" ||
        formData.get("program") === "" ||
        (formData.get("course") === "" &&
          formData.get("course-other") === "" &&
          formData.get("graduate-course") === "" &&
          formData.get("graduate-course-other") === "") ||
        formData.get("graduation-date") === ""
      ) {
        throw new Error("Please fill all required fields");
        return;
      }
      break;
    case "Employed":
      if (
        formData.get("work-location") === "" ||
        formData.get("job-industry") === "" ||
        formData.get("org-type") === "" ||
        formData.get("employment-type") === "" ||
        formData.get("job-level") === "" ||
        formData.get("date-hired") === "" ||
        formData.get("salary-range") === "" ||
        formData.get("company-contact") === "" ||
        formData.get("work-setup") === ""
      ) {
        throw new Error("Please fill all required fields");
        return;
      }
  }
}

async function validateSecondPage(formData) {
  if (formData.get("curriculum-exit") === "") {
    throw new Error("Please select a curriculum exit");
    return;
  }
  switch (formData.get("curriculum-exit")) {
    case "Higher Education":
      if (
        (formData.get("curriculum-exit-inst-name-cavite") === "" &&
          formData.get("curriculum-exit-inst-name-cavite-other") &&
          formData.get("curriculum-exit-inst-name-outside-cavite") &&
          formData.get("curriculum-exit-inst-name-outside-cavite-other")) ||
        formData.get("curriculum-exit-school-type") === "" ||
        formData.get("curriculum-exit-school-location") === "" ||
        formData.get("curriculum-exit-graduation-date") === "" ||
        formData.get("curriculum-exit-undergraduate-selection-college") ===
          "" ||
        formData.get("curriculum-exit-undergraduate-selection-course") === ""
      ) {
        throw new Error("Please fill all required fields");
        return;
      }

      break;
    case "Employment":
      if (
        formData.get("curriculum-exit-work-location") === "" ||
        formData.get("curriculum-exit-job-industry") === "" ||
        formData.get("curriculum-exit-org-type") === "" ||
        formData.get("curriculum-exit-employment-type") === "" ||
        formData.get("curriculum-exit-job-level") === "" ||
        formData.get("curriculum-exit-date-hired") === "" ||
        formData.get("curriculum-exit-salary-range") === "" ||
        formData.get("curriculum-exit-company-contact") === "" ||
        formData.get("curriculum-exit-work-setup") === ""
      ) {
        throw new Error("Please fill all required fields");
        return;
      }
      break;
    case "Entrepreneurship":
      if (formData.get("entrepreneurship") === "") {
        throw new Error("Please fill all required fields");
        return;
      }
      break;
    case "Middle-level skills development":
      if (formData.get("mid-level-skills") === "") {
        throw new Error("Please fill all required fields");
        return;
      }
      break;
    case "None":
      if (formData.get("curriculum-exit-none-reason") === "") {
        throw new Error("Please fill all required fields");
        return;
      }
      break;
  }
}

async function validateThirdPage(formData) {
  if (
    !formData.has("tracer_survey_answer_1") ||
    !formData.has("tracer_survey_answer_2") ||
    !formData.has("tracer_survey_answer_3") ||
    !formData.has("tracer_survey_answer_4")
  ) {
    throw new Error("Please fill all required fields");
    return;
  }
}

async function validation(formData, currentPage) {
  console.log(currentPage);
  if (currentPage === 1) {
    try {
      await validateFirstPage(formData);
    } catch (error) {
      throw new Error(error.message);
    }
  } else if (currentPage === 2) {
    try {
      await validateSecondPage(formData);
    } catch (error) {
      throw new Error(error.message);
    }
  } else if (currentPage === 3) {
    try {
      await validateThirdPage(formData);
    } catch (error) {
      throw new Error(error.message);
    }
  }
}
