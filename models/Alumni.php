<?php

require("/xampp/htdocs/thesis/models/utilities/AlumniUtility.php");
class Alumni extends AlumniUtility
{

    public function signupUser($username, $first_name, $last_name, $email, $type, $password)
    {
        //Signup code goes here
        try {
            $this->checkIfEmpty($username, $first_name, $last_name, $email, $type, $password);
            $this->usernameExists($username);

            $hash = $this->validatePassword($password);
            $sql = "INSERT INTO user (username, firstName, lastName, email, password, type) VALUES ('$username', '$first_name', '$last_name', '$email', '$hash', '$type')";

            $this->db->query($sql);
            $userId = $this->db->getId();
            return $userId;
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

        $this->db->query($insertUndergrad);
        $undergradId = $this->db->getId();

        return $undergradId;
    }

    public function insertCurriculumExitQuestions($values, $alumniId)
    {
        for ($i = 1; $i < 6; $i++) {
            $question = $values["question$i"];
            $answer = $values["answer$i"];

            if ($answer != "") {
                $sql = "INSERT INTO curriculum_exit_questions (question, answer, alumni) VALUES ('$question', '$answer', '$alumniId')";
                $this->db->query($sql);
            }
        }
    }

    public function insertTracerStudy($values, $alumniId)
    {
        $tracerSurveyAnswer1 = $values["tracerSurveyAnswer1"];
        $tracerSurveyAnswer2 = $values["tracerSurveyAnswer2"];
        $tracerSurveyAnswer3 = $values["tracerSurveyAnswer3"];
        $tracerSurveyAnswer4 = $values["tracerSurveyAnswer4"];

        $query = "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ('$alumniId', 1, '$tracerSurveyAnswer1');";
        $query .= "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ('$alumniId', 2, '$tracerSurveyAnswer2');";
        $query .= "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ('$alumniId', 3, '$tracerSurveyAnswer3');";
        $query .= "INSERT INTO tracer_survey_answers (alumni, question, answer) VALUES ('$alumniId', 4, '$tracerSurveyAnswer4')";

        $this->db->multi_query($query);
    }

    public function addAlumni($values, $userId, $isUndergrad)
    {
        $photo = $values["photo"];
        $firstName = $values["firstName"];
        $middleName = $values["middleName"];
        $lastName = $values["lastName"];
        $contactNumber = $values["contactNumber"];
        $email = $values["email"];
        $address = $values["address"];
        $gender = $values["gender"];
        $age = $values["age"];
        $birthday = $values["birthday"];
        $dateGraduated = $values["dateGraduated"];
        $trackFinished = $values["trackFinished"];
        $strandFinished = $values["strandFinished"];
        $presentStatus = $values["presentStatus"];
        $curriculumExit = $values["curriculumExit"];

        if ($isUndergrad) {
            //get values for undergraduate
            $undergradId = $this->insertUndergradAlumni($values);
            $sql = "INSERT INTO alumni (
                userAccountID,
                photo,
                firstName, 
                middleName,
                lastName,
                contactNumber,
                email,
                address,
                gender,
                age,
                birthday,
                dateGraduated,
                trackFinished,
                strandFinished,
                presentStatus,
                curriculumExit,
                undergraduate
                ) VALUES (
                    $userId,
                    '$photo',
                    '$firstName',
                    '$middleName',
                    '$lastName',
                    '$contactNumber',
                    '$email',
                    '$address',
                    '$gender',
                    '$age',
                    '$birthday',
                    '$dateGraduated',
                    '$trackFinished',
                    '$strandFinished',
                    '$presentStatus',
                    '$curriculumExit',
                    $undergradId
                )";

            $result = $this->db->query($sql);
            $alumniId = $this->db->getId();

            $this->insertCurriculumExitQuestions($values, $alumniId);
            $this->insertTracerStudy($values, $alumniId);

            $this->db->close();

            return $result;
        } else {
            $insertAlumni = "INSERT INTO alumni (
                userAccountID,
                photo,
                firstName, 
                middleName,
                lastName,
                contactNumber,
                email,
                address,
                gender,
                age,
                birthday,
                dateGraduated,
                trackFinished,
                strandFinished,
                presentStatus,
                curriculumExit
                ) VALUES (
                    $userId,
                    '$photo',
                    '$firstName',
                    '$middleName',
                    '$lastName',
                    '$contactNumber',
                    '$email',
                    '$address',
                    '$gender',
                    '$age',
                    '$birthday',
                    '$dateGraduated',
                    '$trackFinished',
                    '$strandFinished',
                    '$presentStatus',
                    '$curriculumExit'
                )";

            $result = $this->db->query($insertAlumni);
            $alumniId = $this->db->getId();

            $this->insertCurriculumExitQuestions($values, $alumniId);
            $this->insertTracerStudy($values, $alumniId);

            $this->db->close();

            return $result;
        }
    }

    public function getAlumniByUserId($userId)
    {
        $sql = "SELECT * FROM alumni a WHERE userAccountID='$userId'";
        $result = $this->db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }

    public function getAlumniById($id)
    {
        $sql = "SELECT * FROM alumni WHERE id='$id'";
        $result = $this->db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }

    public function getCurriculumExitQuestions($alumni)
    {
        $sql = "SELECT question, answer FROM curriculum_exit_questions WHERE alumni='$alumni'";
        $result = $this->db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }

    public function getUndergradDetails($undergraduate)
    {
        $sql = "SELECT * FROM undergraduatestudent WHERE id='$undergraduate'";
        $result = $this->db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_assoc();
            return $rows;
        }
    }

    public function getAllAlumni()
    {
        $sql = "SELECT id, photo, firstName, middleName, lastName, contactNumber, email, status, userAccountID FROM alumni WHERE status='active' ORDER BY dateCreated ASC";
        $result = $this->db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_all();
            return $rows;
        }
    }

    public function getAllAlumniEmail()
    {
        $sql = "SELECT email, firstName, lastName FROM alumni";
        $result = $this->db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function getAlumniEmailByTrack($track)
    {
        $sql = "SELECT email, firstName, lastName FROM alumni WHERE trackFinished='$track'";
        $result = $this->db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function getAlumniEmailByBatch($batch)
    {
        $sql = "SELECT email, firstName, lastName FROM alumni WHERE dateGraduated='$batch'";
        $result = $this->db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function curriculumExitQuestions($alumni)
    {
        $sql = "SELECT question, answer FROM curriculum_exit_questions WHERE alumni=$alumni";
        $result = $this->db->query($sql);

        if (isset($result)) {
            return $result->fetch_all();
        }
    }

    public function undergraduate($id)
    {
        $sql = "SELECT * FROM undergraduatestudent WHERE id=$id";
        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }
    public function searchName($query)
    {
        $sql = "SELECT 
            id,
            firstName, 
            middleName, 
            lastName,
            trackFinished,
            strandFinished,
            dateGraduated
            FROM alumni WHERE firstName='$query' OR middleName='$query' OR lastName='$query'";

        $result = $this->db->query($sql);
        if (isset($result)) {
            return $result;
        }

        $this->db->close();
    }

    public function searchAlumni($name, $track, $strand, $batch)
    {
        $sql = "SELECT * FROM alumni 
        WHERE (firstName='$name' OR 
        middleName='$name' OR 
        lastName='$name') OR
        (trackFinished='$track' OR
        strandFinished='$strand' OR
        dateGraduated='$batch') LIMIT 3";

        $result = $this->db->query($sql);
        $this->db->close();

        if ($result->num_rows > 0) {
            return array("response" => $result->fetch_all(), "success" => true);
        } else {
            return array("response" => "Alumni not found", "success" => false);
        }
    }

    public function editAlumni()
    {
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

            $this->db->query($queryForUndergraduate);
        } else {
            $instName = $_POST["instName"];
            $instAddress = $_POST["instAddress"];
            $specialization = $_POST["specialization"];
            $program = $_POST["program"];
            $expGraduationDate = $_POST["expGraduationDate"];

            $queryForUndergraduate = "INSERT INTO undergraduatestudent 
            (instName, instAddress, specialization, program, expGraduationDate) 
            VALUES ('$instName', '$instAddress', '$specialization', '$program', '$expGraduationDate')";

            $this->db->query($queryForUndergraduate);

            $undergraduateId = $this->db->getId();
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

        $result = $this->db->query($sql);

        return $result;
    }

    public function deleteAlumni($id, $userAccountID)
    {
        $sql = "DELETE FROM alumni WHERE id=$id;";
        $sql .= "DELETE FROM user WHERE id=$userAccountID";

        $result = $this->db->multi_query($sql);

        return $result;
    }

    public function addPhotoToUser($user_id, $file)
    {
        $sql = "UPDATE user SET photo='$file' WHERE id=$user_id";
        $this->db->query($sql);
    }

    public function getAlumniUserProfile($id)
    {
        $sql = "SELECT * FROM user WHERE id='$id'";

        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }

    protected function isProfilePictureNew($user_id)
    {
        $user = $this->getAlumniUserProfile($user_id);

        if (empty($user["photo"])) {
            return true;
        } else {
            return false;
        }
    }

    protected function uploadFile($user_id, $alumni_id)
    {
        $tempname = $_FILES["profilePhoto"]["tmp_name"];
        $target_file = "./public/images/profile/" . basename($_FILES["profilePhoto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $file = $user_id . '.' . $imageFileType;
        $folder = "./public/images/profile/" . $user_id . '.' . $imageFileType;

        $sql = "UPDATE alumni SET photo='$file' WHERE id=$alumni_id";
        $this->db->query($sql);
        $this->addPhotoToUser($user_id, $file);

        return move_uploaded_file($tempname, $folder);
    }

    protected function changeFile($user_id, $alumni_id)
    {
        $user = $this->getAlumniUserProfile($user_id);
        $photo = $user["photo"];

        unlink("/xampp/htdocs/thesis/public/images/profile/$photo");

        $this->uploadFile($user_id, $alumni_id);
    }

    public function uploadProfilePhoto($user_id, $alumni_id)
    {
        if ($this->isProfilePictureNew($user_id)) {
            $this->uploadFile($user_id, $alumni_id);
        } else {
            $this->changeFile($user_id, $alumni_id);
        }
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
        $query = "SELECT * FROM alumni WHERE status='pending'";

        $result = $this->db->query($query);
        $this->db->close();

        return $result;
    }

    public function setStatus($status, $id)
    {
        $query = "UPDATE alumni SET status='$status' WHERE id='$id'";

        $result = $this->db->query($query);

        return $result;
    }

    public function searchByAlumniName($firstName, $middleName, $lastName){
        $query = "SELECT * FROM alumni 
        WHERE firstName='$firstName' OR middleName='$middleName' OR lastName='$lastName'"; 

        $result = $this->db->query($query);

        return $result;
    }

    public function searchByTrackStrandYearGrad($track, $strand, $yearGraduated){
        $query = "SELECT * FROM alumni 
        WHERE trackFinished='$track' OR strandFinished='$strand' OR dateGraduated='$yearGraduated'"; 

        $result = $this->db->query($query);

        return $result;
    }
}
