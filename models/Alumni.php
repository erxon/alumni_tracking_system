<?php

require("/xampp/htdocs/thesis/models/utilities/AlumniUtility.php");
class Alumni extends AlumniUtility
{

    public function signupUser($email, $type)
    {
        //Signup code goes here
        $db = new Database();

        try {
            $this->checkIfEmpty($email, $type);
            $sql = "INSERT INTO user (email, type) VALUES ('$email', '$type')";

            $result = $db->query($sql);

            if ($result) {
                return $db->getId();
            }
        } catch (Exception $e) {
            $this->displayError($e);
            die();
        }
    }

    public function createSession($id, $username, $firstName, $lastName, $email, $type)
    {
        $_SESSION["user_id"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["first_name"] = $firstName;
        $_SESSION["last_name"] = $lastName;
        $_SESSION["email"] = $email;
        $_SESSION["type"] = $type;
    }

    public function insertUndergradAlumni($values)
    {
        $db = new Database();

        $instName = $values["instName"];
        $instAddress = $values["instAddress"];
        $specialization = $values["specialization"];
        $program = $values["program"];
        $expGraduationDate = $values["expGraduationDate"];

        $insertUndergrad = "INSERT INTO 
        undergraduatestudent (
            instName, 
            instAddress, 
            specialization, 
            program, 
            expGraduationDate
            ) VALUES (
                '$instName',
                '$instAddress',
                '$specialization',
                '$program',
                '$expGraduationDate'
            )";

        $db->query($insertUndergrad);

        $undergradId = $db->getId();

        return $undergradId;
    }

    public function insertCurriculumExitQuestions($values, $alumniId)
    {
        $db = new Database();

        for ($i = 1; $i < 7; $i++) {
            $question = $values["question$i"];
            $answer = $values["answer$i"];

            if ($answer != "") {
                $sql = "INSERT INTO curriculum_exit_questions (question, answer, alumni) VALUES ('$question', '$answer', '$alumniId')";
                $db->query($sql);
            }
        }
    }

    public function insertTracerStudy($alumniID)
    {
        $db = new Database();

        $tracerSurveyAnswer1 = $_POST["tracer_survey_answer_1"];
        $tracerSurveyAnswer2 = $_POST["tracer_survey_answer_2"];
        $tracerSurveyAnswer3 = $_POST["tracer_survey_answer_3"];
        $tracerSurveyAnswer4 = $_POST["tracer_survey_answer_4"];

        $query = "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ($alumniID, 1, '$tracerSurveyAnswer1');";
        $query .= "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ($alumniID, 2, '$tracerSurveyAnswer2');";
        $query .= "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ($alumniID, 3, '$tracerSurveyAnswer3');";
        $query .= "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ($alumniID, 4, '$tracerSurveyAnswer4')";

        $result = $db->multi_query($query);
        $db->close();

        return $result;
    }

    protected function insertAlumniPersonalInformation($db, $userId, $photo)
    {
        $firstName = $_POST["first-name"];
        $middleName = $_POST["middle-name"];
        $lastName = $_POST["last-name"];
        $contactNumber = $_POST["contact-number"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $birthdate = $_POST["birthdate"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];

        $query = "INSERT INTO alumni (
            userAccountID,
            photo,
            firstName,
            middleName,
            lastName,
            contactNumber,
            email,
            address,
            birthday,
            age,
            gender
            ) VALUES (
                $userId,
                '$photo',
                '$firstName',
                '$middleName',
                '$lastName',
                '$contactNumber',
                '$email',
                '$address',
                '$birthdate',
                $age,
                '$gender'
            )";

        $result = $db->query($query);

        if ($result) {
            return $db->getId();
        } else {
            throw new Exception($db->error());
        }
    }

    public function addAlumni($photo, $userId)
    {
        try {
            $db = new Database();

            //Personal information
            $alumniID = $this->insertAlumniPersonalInformation($db, $userId, $photo);

            //Information
            $track = $_POST["track"];
            $strand = $_POST["strand"];
            $specialization = $this->filterValue("specialization");
            $isCertified = $this->filterValue("isCertified");
            $certifications = $this->filterValue("certifications");

            //Alumni present status
            $presentStatus = $_POST["present-status"];
            $curriculumExit = $_POST["curriculum-exit"];
            $yearGraduated = $_POST["year-graduated"];

            $query = "INSERT INTO alumni_school_history (
                alumniID,
                track,
                strand,
                specialization,
                isCertified,
                certifications,
                yearGraduated
            ) VALUES (
                $alumniID,
                '$track',
                '$strand',
                '$specialization',
                '$isCertified',
                '$certifications',
                '$yearGraduated'
            );";

            $query .= "INSERT INTO alumni_present_status (
                alumniID,
                presentStatus
            ) VALUES (
                $alumniID,
                '$presentStatus'
            );";

            $query .= "INSERT INTO alumni_pursued_curriculum_exits (
                alumniID,
                pursuedCurriculumExit
            ) VALUES (
                $alumniID, 
                '$curriculumExit'
            ); ";

            switch ($presentStatus) {
                case "University Student":
                    $schoolType = $_POST['school-type'];
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
                    $graduateDate = $_POST["graduation-date"];

                    $query .= "INSERT INTO alumni_present_status_student (
                            alumniID,
                            schoolType,
                            schoolLocation,
                            schoolName,
                            program,
                            college,
                            course,
                            graduateDate
                        ) VALUES (
                            $alumniID,
                            '$schoolType',
                            '$schoolLocation',
                            '$schoolName',
                            '$program',
                            '$college',
                            '$course',
                            '$graduateDate'
                        );";
                    break;
                case "Employed":
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
                    $dateHired = $this->filterValue("date-hired");
                    $workSetup = $this->filterValue("work-setup");
                    $salaryRange = $this->filterValue("salary-range");

                    $query .= "INSERT INTO alumni_present_status_employed (
                        alumniID,
                        workLocation,
                        region,
                        municipality,
                        city,
                        details,
                        country,
                        jobIndustry,
                        orgType,
                        employmentType,
                        jobLevel,
                        companyName,
                        dateHired,
                        workSetup,
                        salaryRange
                    ) VALUES (
                        $alumniID,
                        '$workLocation',
                        '$region',
                        '$municipality',
                        '$city',
                        '$details',
                        '$country',
                        '$jobIndustry',
                        '$orgType',
                        '$employmentType',
                        '$jobLevel',
                        '$companyName',
                        '$dateHired',
                        '$workSetup',
                        '$salaryRange'
                    ); ";

                    break;
            }

            switch ($curriculumExit) {
                case "Higher Education":
                    $schoolType = $this->filterValue("curriculum-exit-school-type");
                    $schoolLocation = $this->filterValue("curriculum-exit-school-location");
                    $schoolName = $this->forParentFields(
                        $schoolLocation,
                        [
                            "Cavite" => "curriculum-exit-inst-name-cavite",
                            "Outside Cavite" => "curriculum-exit-inst-name-outside-cavite"
                        ]
                    );
                    $college = $this->withOtherField("curriculum-exit-undergraduate-selection-college");
                    $course = $this->withOtherField("curriculum-exit-undergraduate-selection-course");
                    $graduateDate = $this->filterValue("curriculum-exit-graduation-date");

                    $query .= "INSERT INTO alumni_pursued_curriculum_exits_higher_education (
                        alumniID,  
                        schoolType,
                        schoolLocation,
                        schoolName,
                        college,
                        course,
                        graduateDate
                    ) VALUES (
                        $alumniID,
                        '$schoolType',
                        '$schoolLocation',
                        '$schoolName',
                        '$college',
                        '$course',
                        '$graduateDate'
                    );";

                    break;
                case "Employment":
                    $workLocation = $this->filterValue("curriculum-exit-work-location");
                    $region = $this->filterValue("curriculum-exit-work-local-region");
                    $municipality = $this->filterValue("curriculum-exit-work-local-municipality");
                    $city = $this->filterValue("curriculum-exit-work-local-city");
                    $details = $this->filterValue("curriculum-exit-work-local-details");
                    $country = $this->withOtherField("curriculum-exit-work-international-country");
                    $jobIndustry = $this->filterValue("curriculum-exit-job-industry");
                    $orgType = $this->filterValue("curriculum-exit-org-type");
                    $employmentType = $this->filterValue("curriculum-exit-employment-type");
                    $jobLevel = $this->filterValue("curriculum-exit-job-level");
                    $companyName = $this->filterValue("curriculum-exit-company-name");
                    $dateHired = $this->filterValue("curriculum-exit-date-hired");
                    $workSetup = $this->filterValue("curriculum-exit-work-setup");
                    $salaryRange = $this->filterValue("curriculum-exit-salary-range");

                    $query .= "INSERT INTO alumni_pursued_curriculum_exits_employment (
                        alumniID,
                        workLocation,
                        region,
                        municipality,
                        city,
                        details,
                        country,
                        jobIndustry,
                        orgType,
                        employmentType,
                        jobLevel,
                        companyName,
                        dateHired,
                        workSetup,
                        salaryRange
                    ) VALUES (
                        $alumniID,
                        '$workLocation',
                        '$region',
                        '$municipality',
                        '$city',
                        '$details',
                        '$country',
                        '$jobIndustry',
                        '$orgType',
                        '$employmentType',
                        '$jobLevel',
                        '$companyName',
                        '$dateHired',
                        '$workSetup',
                        '$salaryRange'
                    ); ";
                    break;
                case "Entrepreneurship":
                    $value = $_POST["entrepreneurship"];

                    $query .= "INSERT INTO alumni_pursued_curriculum_exits_entrepreneurship (
                        alumniID,
                        value
                    ) VALUES (
                        $alumniID,
                        '$value'
                    ); ";

                    break;
                case "Middle-level skills development":
                    $value = $_POST["mid-level-skills"];

                    $query .= "INSERT INTO alumni_pursued_curriculum_exits_mid_level_skills_development (
                        alumniID,
                        value
                    ) VALUES (
                        $alumniID,
                        '$value'
                    ); ";
                    break;
                case "None":
                    $value = $_POST["curriculum-exit-none-reason"];

                    $query .= "INSERT INTO alumni_pursued_curriculum_exits_none (
                        alumniID,
                        value
                    ) VALUES (
                        $alumniID,
                        '$value'
                    ); ";
                    break;
            }
            $result = $db->multi_query($query);

            if ($result) {
                $db->close();
                return $alumniID;
            } else {
                $db->close();
                return false;
            }
        } catch (Exception $error) {
            $db->close();
            return $error;
        }
    }

    public function getAlumniByUserId($userId)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni WHERE userAccountID='$userId'";
        $result = $db->query($sql);


        $rows = $result->fetch_assoc();
        return $rows;
    }

    public function getAlumniSchoolHistory($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_school_history WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getPresentStatus($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_present_status WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getCurriculumExit($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_pursued_curriculum_exits WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getPresentStatusUniversityStudent($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_present_status_student WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getPresentStatusStudent($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_present_status_student WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getPresentStatusEmployed($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_present_status_employed WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getCurriculumExitHigherEducation($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_pursued_curriculum_exits_higher_education WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getCurriculumExitEmployment($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_pursued_curriculum_exits_employment WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getCurriculumExitEntrepreneurship($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_pursued_curriculum_exits_entrepreneurship WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getCurriculumExitMidLevelSkills($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_pursued_curriculum_exits_mid_level_skills_development WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getCurriculumExitNone($alumniID)
    {
        $db = new Database();

        $sql = "SELECT * FROM alumni_pursued_curriculum_exits_none WHERE alumniID = $alumniID";
        $result = $db->query($sql);

        $rows = $result->fetch_assoc();
        $db->close();
        return $rows;
    }

    public function getAlumniById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM alumni WHERE id='$id'";
        $result = $db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }

    public function getCurriculumExitQuestions($alumni)
    {
        $db = new Database();
        $sql = "SELECT question, answer FROM curriculum_exit_questions WHERE alumni='$alumni'";
        $result = $db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }

    public function getUndergradDetails($undergraduate)
    {
        $db = new Database();

        $sql = "SELECT * FROM undergraduatestudent WHERE id='$undergraduate'";
        $result = $db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }

    public function getAllAlumni()
    {
        $db = new Database();
        $sql = "SELECT id, photo, firstName, middleName, lastName, contactNumber, email, status, userAccountID FROM alumni WHERE status='active' ORDER BY dateCreated DESC";
        $result = $db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_all();
            return $rows;
        }
    }

    public function getAllAlumniEmail()
    {
        $db = new Database();
        $sql = "SELECT email, firstName, lastName FROM alumni";
        $result = $db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function getAlumniEmailByTrack($track)
    {
        $db = new Database();
        $sql = "SELECT alumni.email, alumni.firstName, alumni.lastName 
        FROM alumni 
        JOIN alumni_school_history ON alumni_school_history.alumniID = alumni.id WHERE alumni_school_history.track='$track'";
        $result = $db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function getAlumniEmailByBatch($batch)
    {
        $db = new Database();
        $sql = "SELECT alumni.email, alumni.firstName, alumni.lastName 
        FROM alumni 
        JOIN alumni_school_history ON alumni_school_history.alumniID = alumni.id WHERE alumni_school_history.yearGraduated='$batch'";
        $result = $db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function curriculumExitQuestions($alumni)
    {
        $db = new Database();
        $sql = "SELECT question, answer FROM curriculum_exit_questions WHERE alumni=$alumni";
        $result = $db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function undergraduate($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM undergraduatestudent WHERE id=$id";
        $result = $db->query($sql);

        return $result->fetch_assoc();
    }
    public function searchName($query)
    {
        $db = new Database();
        $sql = "SELECT 
            id,
            firstName, 
            middleName, 
            lastName,
            trackFinished,
            strandFinished,
            dateGraduated
            FROM alumni WHERE firstName='$query' OR middleName='$query' OR lastName='$query'";

        $result = $db->query($sql);
        if (isset($result)) {
            return $result;
        }

        $db->close();
    }

    public function searchAlumni($name, $track, $strand, $batch)
    {
        $db = new Database();
        $sql = "SELECT * FROM alumni 
        WHERE (firstName='$name' OR 
        middleName='$name' OR 
        lastName='$name') OR
        (trackFinished='$track' OR
        strandFinished='$strand' OR
        dateGraduated='$batch') LIMIT 3";

        $result = $db->query($sql);
        $db->close();

        if ($result->num_rows > 0) {
            return array("response" => $result->fetch_all(), "success" => true);
        } else {
            return array("response" => "Alumni not found", "success" => false);
        }
    }



    public function editAlumni()
    {
        $db = new Database();

        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
        $firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $middleName = filter_input(INPUT_POST, "middle_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_SPECIAL_CHARS);
        $contactNumber = filter_input(INPUT_POST, "contact_number", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, "age");
        $birthday = filter_input(INPUT_POST, "birthday");
        $address = filter_input(INPUT_POST, "address");
        $trackFinished = filter_input(INPUT_POST, "track_finished", FILTER_SANITIZE_SPECIAL_CHARS);
        $strandFinished = filter_input(INPUT_POST, "strand_finished", FILTER_SANITIZE_SPECIAL_CHARS);
        $yearGraduated = filter_input(INPUT_POST, "date_graduated", FILTER_SANITIZE_SPECIAL_CHARS);
        $presentStatus = filter_input(INPUT_POST, "present_status", FILTER_SANITIZE_SPECIAL_CHARS);
        $undergraduateId = $_POST["undergraduateId"];

        if (isset($undergraduateId)) {
            $instName = $_POST["instName"];
            $instAddress = $_POST["instAddress"];
            $specialization = $_POST["specialization"];
            $program = $_POST["program"];
            $expGraduationDate = $_POST["expGraduationDate"];

            $queryForUndergraduate = "UPDATE undergraduatestudent 
            SET instName='$instName', 
            instAddress='$instAddress', 
            specialization='$specialization',
            program='$program',
            expGraduationDate='$expGraduationDate '
            WHERE id=$undergraduateId";

            $db->query($queryForUndergraduate);
        } else {
            $instName = $_POST["instName"];
            $instAddress = $_POST["instAddress"];
            $specialization = $_POST["specialization"];
            $program = $_POST["program"];
            $expGraduationDate = $_POST["expGraduationDate"];

            $queryForUndergraduate = "INSERT INTO undergraduatestudent 
            (instName, instAddress, specialization, program, expGraduationDate) 
            VALUES ('$instName', '$instAddress', '$specialization', '$program', '$expGraduationDate')";

            $db->query($queryForUndergraduate);

            $undergraduateId = $db->getId();
        }

        $sql = "UPDATE alumni SET 
        firstName='$firstName',
        middleName='$middleName',
        lastName='$lastName',
        contactNumber='$contactNumber',
        email='$email',
        gender='$gender',
        age='$age',
        birthday='$birthday',
        address='$address',
        trackFinished='$trackFinished',
        strandFinished='$strandFinished',
        dateGraduated='$yearGraduated',
        presentStatus='$presentStatus',
        undergraduate='$undergraduateId'
        WHERE id=$id";

        $result = $db->query($sql);

        if (isset($_POST["additional-field"]) && $_POST["additional-field"]) {
            $getAdditionalFields = "SELECT * FROM field";
            $additionalFields = $db->query($getAdditionalFields)->fetch_all();
            $updateAdditionalFieldQuery = "";

            foreach ($additionalFields as $field) {
                $fieldID = $field[0];
                $fieldValue = $_POST["field-" . $fieldID];

                $updateAdditionalFieldQuery .= "UPDATE answer 
                SET value='$fieldValue' 
                WHERE alumniID=$id AND fieldID=$fieldID;";
            }

            $db->multi_query($updateAdditionalFieldQuery);
        }

        return $result;
    }

    public function deleteAlumni($id, $userAccountID)
    {
        $db = new Database();

        $archiveAlumni = "UPDATE alumni SET status='archive' WHERE id=$id";
        $archiveAlumniResult = $db->query($archiveAlumni);

        if ($archiveAlumniResult) {
            $delete = "DELETE FROM user WHERE id=$userAccountID;";
            $delete .= "DELETE FROM answer WHERE alumniID=$id";
            $result = $db->multi_query($delete);

            return $result;
        }
    }

    public function addPhotoToUser($user_id, $file)
    {
        $db = new Database();
        $sql = "UPDATE user SET photo='$file' WHERE id=$user_id";
        $db->query($sql);
    }

    public function getAlumniUserProfile($id)
    {
        $db = new Database();

        $sql = "SELECT * FROM user WHERE id='$id'";

        $result = $db->query($sql);

        return $result->fetch_assoc();
    }

    protected function uploadFile($alumniID)
    {
        $db = new Database();

        $str = rand();
        $uniqueFilename = md5($str);

        $tempname = $_FILES["profilePhoto"]["tmp_name"];
        $target_file = "./public/images/alumni/" . basename($_FILES["profilePhoto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $file = $uniqueFilename . '.' . $imageFileType;
        $folder = "./public/images/alumni/" . $file;

        $sql = "UPDATE alumni SET photo='$file' WHERE id=$alumniID";
        $db->query($sql);

        return move_uploaded_file($tempname, $folder);
    }

    public function changeProfilePhoto($alumniID, $alumniPhoto)
    {
        unlink("/xampp/htdocs/thesis/public/images/alumni/$alumniPhoto");
        $this->uploadFile($alumniID);
    }

    public function sendDeleteEmail($emailAddress, $name)
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("ericson.es@outlook.com", "ATS - Administrator");
        $email->setSubject("Your account has been deleted");
        $email->addTo($emailAddress, $name);
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html",
            "
            <h1>Hello $name,</h1>
            <p>We're sorry to inform you that your account has been deleted by the admin.</p> 
            <p>Thank you for kind understanding.</p>
            "
        );

        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

        try {
            $sendgrid->send($email);
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    public function unregisteredAlumni()
    {
        $db = new Database();
        $query = "SELECT alumni.id, 
        alumni.firstName, 
        alumni.middleName, 
        alumni.lastName, 
        alumni_school_history.yearGraduated, 
        alumni_school_history.track,
        alumni_school_history.strand
        FROM alumni JOIN alumni_school_history ON 
        alumni.id = alumni_school_history.alumniID WHERE status='pending';";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function setStatus($status, $id)
    {
        $db = new Database();

        $query = "UPDATE alumni SET status='$status' WHERE id='$id'";

        $result = $db->query($query);

        return $result;
    }

    public function searchByAlumniName($firstName, $middleName, $lastName)
    {
        $db = new Database();

        $query = "SELECT 
        alumni.id, alumni.userAccountID, alumni.photo, alumni.firstName, alumni.middleName, alumni.lastName,
        alumni.contactNumber, alumni.email, alumni.address, alumni.gender, alumni.age, alumni.birthday,
        alumni.dateCreated, alumni.dateModified, alumni.status, alumni_school_history.track, alumni_school_history.strand, 
        alumni_school_history.yearGraduated
        FROM alumni 
        JOIN alumni_school_history ON alumni.id = alumni_school_history.alumniID
        WHERE (alumni.firstName = '$firstName' OR alumni.middleName = '$middleName' OR alumni.lastName = '$lastName')
        AND alumni.status='active'";

        $result = $db->query($query);

        return $result;
    }

    public function searchByTrackStrandYearGrad($track, $strand, $yearGraduated)
    {
        $db = new Database();

        $query = "SELECT 
        alumni.id, alumni.userAccountID, alumni.photo, alumni.firstName, alumni.middleName, alumni.lastName,
        alumni.contactNumber, alumni.email, alumni.address, alumni.gender, alumni.age, alumni.birthday,
        alumni.dateCreated, alumni.dateModified, alumni.status, alumni_school_history.track, alumni_school_history.strand, 
        alumni_school_history.yearGraduated
        FROM alumni 
        JOIN alumni_school_history ON alumni.id = alumni_school_history.alumniID
        WHERE (alumni_school_history.track='$track' 
        OR alumni_school_history.strand='$strand' OR alumni_school_history.yearGraduated='$yearGraduated')
        AND alumni.status='active'";

        $result = $db->query($query);

        return $result;
    }

    public function additionalFieldAnswer($alumniID)
    {
        $db = new Database();

        $query = "";

        for ($i = 0; $i < $_POST["additionalFields"]; $i++) {
            $fieldID = (int) $_POST["field-id-$i"];
            $answer = $_POST["field-$i"];

            $query .= "INSERT INTO answer (alumniID, fieldID, value) 
            VALUES ($alumniID, $fieldID, '$answer'); ";
        }
        $result = $db->multi_query($query);

        $db->close();

        return $result;
    }

    public function getAdditionalFieldAnswers($alumniID)
    {
        $db = new Database();

        $query = "SELECT answer.id, answer.value, field.field, field.type, field.formType, field.id
        FROM answer JOIN field ON field.id=answer.fieldID 
        WHERE alumniID='$alumniID';";

        $result = $db->query($query);

        return $result;
    }

    public function getAdditionalFieldChoices($fieldID)
    {
        $db = new Database();

        $query = "SELECT * FROM choice WHERE fieldID=$fieldID";

        $result = $db->query($query);

        return $result;
    }

    public function getChoiceName($id)
    {
        $db = new Database();

        $query = "SELECT choiceName FROM choice WHERE id=$id";

        $result = $db->query($query);
        $choice = $result->fetch_assoc();

        return $choice["choiceName"];
    }
}
