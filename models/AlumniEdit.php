<?php

require("/xampp/htdocs/thesis/models/utilities/AlumniUtility.php");
class AlumniEdit extends AlumniUtility
{
    public function updatePresentStatusStudent()
    {
        $db = new Database();

        $alumniID = $_POST["alumniID"];
        $schoolType = $this->filterValue("school-type");
        $schoolLocation = $this->filterValue("school-location");
        $schoolName = $this->forParentFields(
            $schoolLocation,
            [
                "Cavite" => "inst-name-cavite",
                "Outside Cavite" => "inst-name-outside-cavite"
            ]
        );
        $program = $this->filterValue("program");
        $college = $this->filterValue("college");
        $course = $this->forParentFields($program, [
            "Undergraduate" => "course",
            "Graduate" => "graduate-course"
        ]);

        $graduateDate = $this->filterValue("graduation-date");

        $query = "UPDATE alumni_present_status_student SET schoolType = '$schoolType',
            schoolLocation = '$schoolLocation',
            schoolName = '$schoolName',
            program = '$program',
            college = '$college',
            course = '$course',
            graduateDate = '$graduateDate' WHERE alumniID = $alumniID";

        $result = $db->query($query);
        return $result;
    }

    public function updatePresentStatusEmployed()
    {
        $db = new Database();

        $alumniID = $_POST["alumniID"];

        $workLocation = $this->filterValue("work-location");
        $region = $this->filterValue("region");
        $municipality = $this->filterValue("municipality");
        $city = $this->filterValue("city");
        $details = $this->filterValue("details");
        $country = $this->withOtherField("country");
        $jobIndustry = $this->filterValue("job-industry");
        $orgType = $this->filterValue("org-type");
        $employmentType = $this->filterValue("employment-type");
        $jobLevel = $this->filterValue("job-level");
        $companyName = $this->filterValue("company-name");
        $companyContact = $this->filterValue("company-contact");
        $dateHired = $this->filterValue("date-hired");
        $workSetup = $this->filterValue("work-setup");
        $salaryRange = $this->filterValue("salary-range");

        $query = "UPDATE alumni_present_status_employed SET 
        workLocation = '$workLocation',
        region = '$region',
        municipality = '$municipality',
        city = '$city',
        details = '$details',
        country = '$country',
        jobIndustry = '$jobIndustry',
        orgType = '$orgType',
        employmentType = '$employmentType',
        jobLevel = '$jobLevel',
        companyName = '$companyName',
        companyContact = '$companyContact',
        dateHired = '$dateHired',
        workSetup = '$workSetup',
        salaryRange = '$salaryRange' WHERE alumniID=$alumniID";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updateCurriculumExitEmployment()
    {
        $db = new Database();
        $alumniID = $_POST["alumniID"];

        $workLocation = $this->filterValue("work-location");
        $region = $this->filterValue("region");
        $municipality = $this->filterValue("municipality");
        $city = $this->filterValue("city");
        $details = $this->filterValue("details");
        $country = $this->withOtherField("country");
        $jobIndustry = $this->filterValue("job-industry");
        $orgType = $this->filterValue("org-type");
        $employmentType = $this->filterValue("employment-type");
        $jobLevel = $this->filterValue("job-level");
        $companyName = $this->filterValue("company-name");
        $companyContact = $this->filterValue("company-contact");
        $dateHired = $this->filterValue("date-hired");
        $workSetup = $this->filterValue("work-setup");
        $salaryRange = $this->filterValue("salary-range");

        $query = "UPDATE alumni_pursued_curriculum_exits_employment SET 
        workLocation = '$workLocation',
        region = '$region',
        municipality = '$municipality',
        city = '$city',
        details = '$details',
        country = '$country',
        jobIndustry = '$jobIndustry',
        orgType = '$orgType',
        employmentType = '$employmentType',
        jobLevel = '$jobLevel',
        companyName = '$companyName',
        companyContact = '$companyContact',
        dateHired = '$dateHired',
        workSetup = '$workSetup',
        salaryRange = '$salaryRange' WHERE alumniID=$alumniID";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updateCurriculumExitHigherEducation()
    {
        $db = new Database();

        $alumniID = $_POST["alumniID"];
        $schoolType = $this->filterValue("school-type");
        $schoolLocation = $this->filterValue("school-location");
        $schoolName = $this->forParentFields(
            $schoolLocation,
            [
                "Cavite" => "inst-name-cavite",
                "Outside Cavite" => "inst-name-outside-cavite"
            ]
        );
        $college = $this->filterValue("college");
        $course = $this->filterValue("course");
        $graduateDate = $this->filterValue("graduation-date");

        $query = "UPDATE alumni_pursued_curriculum_exits_higher_education 
            SET schoolType = '$schoolType',
            schoolLocation = '$schoolLocation',
            schoolName = '$schoolName',
            college = '$college',
            course = '$course',
            graduateDate = '$graduateDate' 
            WHERE alumniID = $alumniID";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updateCurriculumExitEntrepreneurship()
    {
        $db = new Database();

        $alumniID = $_POST["alumniID"];
        $answer = $_POST["answer"];

        $query = "UPDATE alumni_pursued_curriculum_exits_entrepreneurship SET
        value='$answer' WHERE alumniID = $alumniID;";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updateCurriculumExitMiddleLevelSkillsDevelopment()
    {
        $db = new Database();

        $alumniID = $_POST["alumniID"];
        $answer = $_POST["answer"];

        $query = "UPDATE alumni_pursued_curriculum_exits_mid_level_skills_development SET
        value='$answer' WHERE alumniID = $alumniID;";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updateCurriculumExitNone()
    {
        $db = new Database();

        $alumniID = $_POST["alumniID"];
        $answer = $this->withOtherField("answer");

        $query = "UPDATE alumni_pursued_curriculum_exits_none SET
        value='$answer' WHERE alumniID = $alumniID;";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updatePersonalInformation()
    {
        $db = new Database();

        $alumniID = $_POST["alumniID"];

        $firstName = $this->filterValue("first_name");
        $middleName = $this->filterValue("middle_name");
        $lastName = $this->filterValue("last_name");
        $contactNumber = $this->filterValue("contact_number");

        $query = "UPDATE alumni SET
        firstName='$firstName',
        middleName='$middleName',
        lastName='$lastName',
        contactNumber='$contactNumber' WHERE id = $alumniID;";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updatePersonalInformation2(){
        $db = new Database();

        $alumniID = $_POST["alumniID"];

        $gender =$this->filterValue("gender");
        $age = $this->filterValue("age");
        $birthday = $this->filterValue("birthday");
        $address = $this->filterValue("address");

        $query = "UPDATE alumni 
        SET gender='$gender',
        age='$age',
        birthday='$birthday',
        address='$address' WHERE id='$alumniID'";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updateAlumniSchoolHistory(){
        $db = new Database();

        $alumniID = $_POST["alumniID"];

        $track =$this->filterValue("track");
        $strand =$this->filterValue("strand");
        $specialization =$this->filterValue("specialization");
        $dateGraduated =$this->filterValue("date_graduated");

        $query = "UPDATE alumni_school_history 
        SET track='$track',
        strand='$strand',
        specialization='$specialization',
        yearGraduated='$dateGraduated'
        WHERE alumniID=$alumniID;";

        $result = $db->query($query);
        $db->close();

        return $result;
    }
}
