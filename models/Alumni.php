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
        $sql = "SELECT id, photo, firstName, middleName, lastName, contactNumber, email, status FROM alumni ORDER BY dateCreated ASC";
        $result = $this->db->query($sql);

        if (isset($result)) {
            $rows = $result->fetch_all();
            return $rows;
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
        $curriculumExit =  filter_input(INPUT_POST, "curriculum_exit", FILTER_SANITIZE_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_SPECIAL_CHARS);

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
        curriculumExit='$curriculumExit',
        status='$status'
        WHERE id=$id";

        $result = $this->db->query($sql);

        return $result;
    }

    public function deleteAlumni($id, $userAccountID)
    {
        $sql  = "DELETE FROM alumni WHERE id=$id;";
        $sql .= "DELETE FROM user WHERE id=$userAccountID";

        $result = $this->db->multi_query($sql);

        return $result;
    }

    public function addPhotoToUser($user_id, $file)
    {
        $sql = "UPDATE user SET photo='$file' WHERE id=$user_id";
        $this->db->query($sql);
    }

    public function uploadProfilePhoto($user_id, $alumni_id)
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
}
