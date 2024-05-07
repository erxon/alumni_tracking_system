<?php
class Reports
{

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function alumni()
    {
        $query = "SELECT * FROM alumni WHERE status='active'";
        $result = $this->db->query($query);

        return $result->num_rows;
    }

    protected function alumniRating($question)
    {
        $query = "SELECT tracer_survey_answers.answer, COUNT(*) 
        FROM tracer_survey_answers 
        JOIN alumni ON alumni.id=tracer_survey_answers.alumni
        WHERE alumni.status = 'active' AND tracer_survey_answers.question='$question'
        GROUP BY answer DESC";
        $result = $this->db->query($query);

        return $result->fetch_all();
    }

    // protected function alumniRatingPerCategory($question)
    // {
    //     $numberOfAnswersPerCategory = array("Strongly Agree" => 0, "Agree" => 0, "Fairly Agree" => 0, "Disagree" => 0);
    //     $categories = array("Strongly Agree" => 4, "Agree" => 3, "Fairly Agree" => 2, "Disagree" => 1);

    //     foreach ($categories as $category => $value) {
    //         $numberOfAnswersPerCategory[$category] = $this->alumniRating($question, $value);
    //     }

    //     return $numberOfAnswersPerCategory;
    // }

    public function getCurriculumExits($batch)
    {
        $dataPoints = array();

        $query = "";

        if ($batch == 0) {
            $query = "SELECT alumni_pursued_curriculum_exits.pursuedCurriculumExit, COUNT(*) 
            FROM alumni_pursued_curriculum_exits 
            JOIN alumni ON alumni.id = alumni_pursued_curriculum_exits.alumniID 
            WHERE alumni.status='active' 
            GROUP BY alumni_pursued_curriculum_exits.pursuedCurriculumExit;";
        } else {
            $query = "SELECT alumni_pursued_curriculum_exits.pursuedCurriculumExit, COUNT(*) 
            FROM alumni_pursued_curriculum_exits
            JOIN alumni 
            ON alumni.id = alumni_pursued_curriculum_exits.alumniID
            JOIN alumni_school_history 
            ON alumni_pursued_curriculum_exits.alumniID = alumni_school_history.alumniID
            WHERE alumni.status='active' AND alumni_school_history.yearGraduated='$batch'
            GROUP BY alumni_pursued_curriculum_exits.pursuedCurriculumExit";
        }

        $result = $this->db->query($query);

        foreach ($result->fetch_all() as $row) {
            array_push($dataPoints, array("label" => $row[0], "y" => (int)$row[1]));
        }

        return $dataPoints;
    }

    public function getAlumniByTrack($batch, $track)
    {
        //return 

        $query = "";

        if ($batch == 0) {
            $query = "SELECT alumni_school_history.track, alumni_school_history.strand, COUNT(*)
            FROM alumni_school_history 
            JOIN alumni ON alumni.id = alumni_school_history.alumniID 
            WHERE alumni.status='active' AND alumni_school_history.track='$track'
            GROUP BY alumni_school_history.strand";
        } else {
            $query = "SELECT alumni_school_history.track, alumni_school_history.strand, COUNT(*)
        FROM alumni_school_history
        JOIN alumni
        ON alumni.id = alumni_school_history.alumniID
        WHERE alumni.status='active' AND alumni_school_history.yearGraduated='$batch' AND alumni_school_history.track='$track'
        GROUP BY alumni_school_history.strand";
        }

        $result = $this->db->query($query);

        return $result->fetch_all();
    }

    public function getCurriculumExitsUnformatted($batch, $track)
    {
        $query = "";

        $curriculumExits = array(
            "Higher Education" => "higher_education",
            "Employment" => "employment",
            "Middle-level skills development" => "middle_level_skills_development",
            "Entrepreneurship" => "entrepreneurship",
            "None" => "none"
        );

        $curriculumExitsUnformatted = array(
            "higher_education" => 0,
            "employment" => 0,
            "middle_level_skills_development" => 0,
            "entrepreneurship" => 0,
            "none" => 0
        );

        if ($batch == 0) {
            $query = "SELECT alumni_pursued_curriculum_exits.pursuedCurriculumExit, COUNT(*) 
            FROM alumni_pursued_curriculum_exits
            JOIN alumni 
            ON alumni.id = alumni_pursued_curriculum_exits.alumniID
            JOIN alumni_school_history
            ON alumni_school_history.alumniID = alumni_pursued_curriculum_exits.alumniID
            WHERE alumni.status='active' AND alumni_school_history.track='$track'
            GROUP BY alumni_pursued_curriculum_exits.pursuedCurriculumExit;";
        } else {
            $query = "SELECT alumni_pursued_curriculum_exits.pursuedCurriculumExit, COUNT(*) 
            FROM alumni_pursued_curriculum_exits
            JOIN alumni 
            ON alumni.id = alumni_pursued_curriculum_exits.alumniID
            JOIN alumni_school_history
            ON alumni_school_history.alumniID = alumni_pursued_curriculum_exits.alumniID
            WHERE alumni.status='active' AND alumni_school_history.track='$track' AND alumni_school_history.yearGraduated='$batch'
            GROUP BY alumni_pursued_curriculum_exits.pursuedCurriculumExit;";
        }

        $result = $this->db->query($query);

        foreach ($result->fetch_all() as $row) {
            $curriculumExitsUnformatted[$curriculumExits[$row[0]]] = (int)$row[1];
        }

        return $curriculumExitsUnformatted;
    }

    public function getAlumniRatingsPerQuestion()
    {
        $questions = array();

        for ($question = 1; $question < 5; $question++) {
            $answers = $this->alumniRating($question);
            array_push($questions, $answers);
        }

        return $questions;
    }

    public function numberOfAlumniPerYear()
    {
        $dataPoints = array();
        $query = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni.id = alumni_school_history.alumniID WHERE alumni.status = 'active' 
        GROUP BY yearGraduated";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($dataPoints, array("label" => $row[0], "y" => $row[1]));
            }
        }

        return $dataPoints;
    }

    public function alumniAccordingToTrackPercentage()
    {
        $dataPoints = array();
        $query = "SELECT alumni_school_history.track, COUNT(*) 
        FROM alumni_school_history JOIN alumni ON alumni.id = alumni_school_history.alumniID 
        WHERE status='active' GROUP BY alumni_school_history.track";

        $result = $this->db->query($query);
        $totalNumberOfAlumni = $this->alumni();

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($dataPoints, array("label" => $row[0], "y" => (((int)$row[1] / $totalNumberOfAlumni) * 100)));
            }
        }

        return $dataPoints;
    }

    public function alumniAccordingToTrackNumeric()
    {
        $dataPoints = array();
        $query = "SELECT alumni_school_history.track, COUNT(*) 
        FROM alumni_school_history JOIN alumni ON alumni.id=alumni_school_history.alumniID
        WHERE status='active' 
        GROUP BY alumni_school_history.track";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                $dataPoints[$row[0]] = $row[1];
            }
        }

        return $dataPoints;
    }
    public function alumniAccordingToStrand()
    {
        $data = array("TVL" => array(), "Academic" => array());
        $queryTVL = "SELECT alumni_school_history.strand, COUNT(*) 
        FROM alumni_school_history JOIN alumni ON alumni.id=alumni_school_history.alumniID 
        WHERE alumni_school_history.track='Technical-Vocational and Livelihood' AND alumni.status='active' 
        GROUP BY alumni_school_history.strand";
        $queryAcademic = "SELECT alumni_school_history.strand, COUNT(*) 
        FROM alumni_school_history JOIN alumni ON alumni.id=alumni_school_history.alumniID 
        WHERE alumni_school_history.track='Academic' AND alumni.status='active' 
        GROUP BY alumni_school_history.strand";

        $resultTVL = $this->db->query($queryTVL);
        $resultAcademic = $this->db->query($queryAcademic);
        $alumniAccordingToTrackNumeric = $this->alumniAccordingToTrackNumeric();

        if ($resultTVL->num_rows > 0) {
            foreach ($resultTVL->fetch_all() as $row) {
                array_push($data["TVL"], array("label" => $row[0], "name" => $row[0], "y" => (((int) $row[1] / $alumniAccordingToTrackNumeric["Technical-Vocational and Livelihood"]) * 100)));
            }
        }

        if ($resultAcademic->num_rows > 0) {
            foreach ($resultAcademic->fetch_all() as $row) {
                array_push($data["Academic"], array("label" => $row[0], "y" => (((int)$row[1] / $alumniAccordingToTrackNumeric["Academic"]) * 100)));
            }
        }

        return $data;
    }

    public function getBatches()
    {
        $data = [];

        $query = "SELECT yearGraduated, COUNT(*) FROM alumni_school_history GROUP BY yearGraduated";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($data, $row[0]);
            }
        }
        return $data;
    }

    public function getStrands()
    {
        $query = "SELECT * FROm strands";
        $result = $this->db->query($query);

        return $result->fetch_all();
    }

    public function getTracks()
    {
        $query = "SELECT * FROM tracks";

        $result = $this->db->query($query);

        return $result->fetch_all();
    }

    public function graduatesPerStrand($batch, $track, $strand)
    {
        $data = [];
        $query = "";
        $params = "";

        if ($batch !== "") {
            $params .= " AND alumni_school_history.yearGraduated = '$batch' ";
        }
        if ($track !== "") {
            $params .= " AND alumni_school_history.track = '$track' ";
        }
        if ($strand !== "") {
            $params .= " AND alumni_school_history.strand = '$strand' ";
        }

        $query = "SELECT alumni_school_history.strand, COUNT(*) FROM alumni_school_history 
            JOIN alumni ON alumni.id = alumni_school_history.alumniID 
            WHERE alumni.status='active'" . $params . "GROUP BY alumni_school_history.strand";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($data, ["label" => $row[0], "y" => $row[1]]);
            }
        }

        return $data;
    }

    public function yearGraduatedTrend()
    {
        $data = ["TVL" => [], "ACAD" => []];


        $tvl = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        WHERE alumni.status = 'active' AND alumni_school_history.track = 'Technical-Vocational and Livelihood' 
        GROUP BY alumni_school_history.yearGraduated";

        $academic = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        WHERE alumni.status = 'active' AND alumni_school_history.track = 'Academic' 
        GROUP BY alumni_school_history.yearGraduated";

        $resultTvl = $this->db->query($tvl);
        $resultAcademic = $this->db->query($academic);

        if ($resultTvl->num_rows > 0) {
            foreach ($resultTvl->fetch_all() as $row) {
                array_push($data["TVL"], ["label" => $row[0], "y" => $row[1]]);
            }
        }

        if ($resultAcademic->num_rows > 0) {
            foreach ($resultAcademic->fetch_all() as $row) {
                array_push($data["ACAD"], ["label" => $row[0], "y" => $row[1]]);
            }
        }

        return $data;
    }

    public function yearGraduatedTrendTracks($track, $strand)
    {
        $data = [];

        $params = "";

        if ($track !== "") {
            $params .= " AND alumni_school_history.track = '$track' ";
        }
        if ($strand !== "") {
            $params .= " AND alumni_school_history.strand = '$strand' ";
        }

        $query = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni.id = alumni_school_history.alumniID
        WHERE alumni.status = 'active'" . $params . "GROUP BY alumni_school_history.yearGraduated";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($data, ["label" => $row[0], "y" => $row[1]]);
            }
        }

        return $data;
    }

    public function yearGraduatedPresentStatusAll()
    {
        $data = ["employed" => [], "university_student" => [], "unemployed" => []];


        $employed = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_present_status ON alumni_present_status.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_present_status.presentStatus = 'Employed' 
        GROUP BY alumni_school_history.yearGraduated";

        $universityStudent = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_present_status ON alumni_present_status.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_present_status.presentStatus = 'University Student' 
        GROUP BY alumni_school_history.yearGraduated";

        $unemployed = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_present_status ON alumni_present_status.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_present_status.presentStatus = 'Unemployed' 
        GROUP BY alumni_school_history.yearGraduated";

        $resultEmployed = $this->db->query($employed);

        if ($resultEmployed->num_rows > 0) {
            foreach ($resultEmployed->fetch_all() as $row) {
                array_push($data["employed"], ["label" => $row[0], "y" => $row[1]]);
            }
        }

        $resultUniversityStudent = $this->db->query($universityStudent);

        if ($resultUniversityStudent->num_rows > 0) {
            foreach ($resultUniversityStudent->fetch_all() as $row) {
                array_push($data["university_student"], ["label" => $row[0], "y" => $row[1]]);
            }
        }

        $resultUnemployed = $this->db->query($unemployed);

        if ($resultUnemployed->num_rows > 0) {
            foreach ($resultUnemployed->fetch_all() as $row) {
                array_push($data["unemployed"], ["label" => $row[0], "y" => $row[1]]);
            }
        }

        return $data;
    }

    public function yearGraduatedPresentStatus($presentStatus)
    {
        $data = [];

        $query = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_present_status ON alumni_present_status.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_present_status.presentStatus = '$presentStatus' 
        GROUP BY alumni_school_history.yearGraduated";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($data, ["label" => $row[0], "y" => $row[1]]);
            }
        }

        return $data;
    }

    public function yearGraduatedCurriculumExitAll()
    {
        $data = [
            "employment" => [],
            "higher_education" => [],
            "entrepreneurship" => [],
            "mid_level" => [],
            "none" => []
        ];

        $employment = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_pursued_curriculum_exits ON alumni_pursued_curriculum_exits.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_pursued_curriculum_exits.pursuedCurriculumExit = 'Employment' 
        GROUP BY alumni_school_history.yearGraduated";

        $higherEducation = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_pursued_curriculum_exits ON alumni_pursued_curriculum_exits.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_pursued_curriculum_exits.pursuedCurriculumExit = 'HigherEducation' 
        GROUP BY alumni_school_history.yearGraduated";

        $entrepreneurship = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_pursued_curriculum_exits ON alumni_pursued_curriculum_exits.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_pursued_curriculum_exits.pursuedCurriculumExit = 'Entrepreneurship' 
        GROUP BY alumni_school_history.yearGraduated";

        $midLevel = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_pursued_curriculum_exits ON alumni_pursued_curriculum_exits.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_pursued_curriculum_exits.pursuedCurriculumExit = 'Middle-level skills development' 
        GROUP BY alumni_school_history.yearGraduated";

        $none = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_pursued_curriculum_exits ON alumni_pursued_curriculum_exits.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_pursued_curriculum_exits.pursuedCurriculumExit = 'None' 
        GROUP BY alumni_school_history.yearGraduated";

        $resultEmployment = $this->db->query($employment);

        if($resultEmployment->num_rows > 0){
            foreach($resultEmployment->fetch_all() as $row){
                array_push($data["employment"], ["label" => $row[0], "y"=>$row[1]]);
            }
        }

        $resultHigherEducation = $this->db->query($higherEducation);

        if($resultHigherEducation->num_rows > 0){
            foreach($resultHigherEducation->fetch_all() as $row){
                array_push($data["higher_education"], ["label" => $row[0], "y"=>$row[1]]);
            }
        }

        $resultEntrepreneurship = $this->db->query($entrepreneurship);

        if($resultEntrepreneurship->num_rows > 0){
            foreach($resultEntrepreneurship->fetch_all() as $row){
                array_push($data["entrepreneurship"], ["label" => $row[0], "y"=>$row[1]]);
            }
        }

        $midLevel = $this->db->query($midLevel);

        if($midLevel->num_rows > 0){
            foreach($midLevel->fetch_all() as $row){
                array_push($data["mid_level"], ["label" => $row[0], "y"=>$row[1]]);
            }
        }

        $none = $this->db->query($none);

        if($none->num_rows > 0){
            foreach($none->fetch_all() as $row){
                array_push($data["none"], ["label" => $row[0], "y"=>$row[1]]);
            }
        }

        return $data;

    }

    public function yearGraduatedCurriculumExits($curriculumExit){
        $data = [];

        $query = "SELECT alumni_school_history.yearGraduated, COUNT(*) 
        FROM alumni_school_history 
        JOIN alumni ON alumni_school_history.alumniID = alumni.id 
        JOIN alumni_pursued_curriculum_exits ON alumni_pursued_curriculum_exits.alumniID = alumni_school_history.alumniID
        WHERE alumni.status = 'active' AND alumni_pursued_curriculum_exits.pursuedCurriculumExit = '$curriculumExit' 
        GROUP BY alumni_school_history.yearGraduated";

        $result = $this->db->query($query);

        if($result->num_rows > 0){
            foreach($result->fetch_all() as $row){
                array_push($data, ["label" => $row[0], "y" => $row[1]]);
            }
        }

        return $data;
    }

    public function gender($batch, $track, $strand)
    {
        $data = [];

        $params = "";

        if ($batch !== "") {
            $params .= " AND alumni_school_history.yearGraduated = '$batch'";
        }
        if ($track !== "") {
            $params .= " AND alumni_school_history.track = '$track' ";
        }
        if ($strand !== "") {
            $params .= " AND alumni_school_history.strand = '$strand' ";
        }

        $query = "SELECT alumni.gender, COUNT(*) FROM alumni
        JOIN alumni_school_history ON alumni_school_history.alumniID = alumni.id
        WHERE alumni.status='active'" . $params . "GROUP BY alumni.gender";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($data, ["label" => $row[0], "y" => $row[1]]);
            }
        }

        return $data;
    }

    public function alumniAccordingToStrandNumeric()
    {
        $data = array("TVL" => array(), "Academic" => array());
        $queryTVL = "SELECT alumni_school_history.strand, COUNT(*) 
        FROM alumni_school_history JOIN alumni ON alumni.id = alumni_school_history.alumniID 
        WHERE alumni_school_history.track='Technical-Vocational and Livelihood' AND status='active' 
        GROUP BY alumni_school_history.strand";
        $queryAcademic = "SELECT alumni_school_history.strand, COUNT(*) 
        FROM alumni_school_history JOIN alumni ON alumni.id = alumni_school_history.alumniID 
        WHERE alumni_school_history.track='Academic' AND status='active' 
        GROUP BY alumni_school_history.strand";

        $resultTVL = $this->db->query($queryTVL);
        $resultAcademic = $this->db->query($queryAcademic);

        if ($resultTVL->num_rows > 0) {
            foreach ($resultTVL->fetch_all() as $row) {
                array_push($data["TVL"], array("label" => $row[0], "y" => (int) $row[1]));
            }
        }

        if ($resultAcademic->num_rows > 0) {
            foreach ($resultAcademic->fetch_all() as $row) {
                array_push($data["Academic"], array("label" => $row[0], "y" => (int)$row[1]));
            }
        }

        return $data;
    }

    public function alumniAccordingToPresentStatus($batch, $track, $strand)
    {
        $dataPoints = array();

        $params = "";

        if ($batch !== "") {
            $params .= " AND alumni_school_history.yearGraduated='$batch' ";
        }
        if ($track !== "") {
            $params .= " AND alumni_school_history.track='$track' ";
        }
        if ($strand !== "") {
            $params .= " AND alumni_school_history.strand='$strand' ";
        }

        $query = "SELECT alumni_present_status.presentStatus, COUNT(*) 
        FROM alumni_present_status 
        JOIN alumni 
        ON alumni.id = alumni_present_status.alumniID 
        JOIN alumni_school_history
        ON alumni_school_history.alumniID = alumni_present_status.alumniID
        WHERE alumni.status='active'" . $params . "GROUP BY alumni_present_status.presentStatus";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($dataPoints, array("label" => $row[0], "y" => $row[1]));
            }
        }

        return $dataPoints;
    }

    public function alumniAccordingToGender()
    {
        $dataPoints = array();

        $query = "SELECT gender, COUNT(*) FROM `alumni` WHERE status='active' GROUP BY gender";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($dataPoints, array("label" => $row[0], "y" => $row[1]));
            }
        }

        return $dataPoints;
    }

    public function curriculumExit($batch, $track, $strand)
    {
        $dataPoints = array();

        $params = "";

        if ($batch !== "") {
            $params .= " AND alumni_school_history.yearGraduated = '$batch' ";
        }
        if ($track !== "") {
            $params .= " AND alumni_school_history.track = '$track' ";
        }
        if ($strand !== "") {
            $params .= " AND alumni_school_history.strand = '$strand' ";
        }

        $query = "SELECT alumni_pursued_curriculum_exits.pursuedCurriculumExit, COUNT(*) 
        FROM alumni_pursued_curriculum_exits 
        JOIN alumni ON alumni.id = alumni_pursued_curriculum_exits.alumniID 
        JOIN alumni_school_history ON alumni_school_history.alumniID = alumni_pursued_curriculum_exits.alumniID
        WHERE alumni.status='active'" . $params . "GROUP BY alumni_pursued_curriculum_exits.pursuedCurriculumExit";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            foreach ($result->fetch_all() as $row) {
                array_push($dataPoints, array("label" => $row[0], "y" => $row[1]));
            }
        }

        return $dataPoints;
    }

    public function getPendingAlumni()
    {
        $query = "SELECT * FROM `alumni` WHERE status='pending'";

        $result = $this->db->query($query);

        return $result->num_rows;
    }

    public function getRelevantSkills()
    {
        $dataPoints = [
            "Strongly Agree" => [],
            "Agree" => [],
            "Fairly Agree" => [],
            "Disagree" => []
        ];

        $answer = [
            "Disagree",
            "Fairly Agree",
            "Agree",
            "Strongly Agree"
        ];

        $label = [
            "Information, media and technology skills",
            "Learning and innovation skills",
            "Effective communication skills",
            "Life and career skills"
        ];

        for ($i = 1; $i < 5; $i++) {
            for ($j = 1; $j < 5; $j++) {
                $query = "SELECT COUNT(*) FROM tracer_survey_answers WHERE answer=$i AND question=$j;";
                $result = $this->db->query($query);

                $count = $result->fetch_all();
                array_push($dataPoints[$answer[$i - 1]], ["label" => $label[$j - 1], "name" => $answer[$i - 1], "y" => $count[0][0]]);
            }
        }

        return $dataPoints;
    }
}
