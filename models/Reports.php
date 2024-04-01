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
            $query = "SELECT curriculumExit, COUNT(*) 
        FROM alumni 
        WHERE status='active'
        GROUP BY curriculumExit";
        } else {
            $query = "SELECT curriculumExit, COUNT(*) 
        FROM alumni 
        WHERE status='active' 
        AND dateGraduated='$batch' 
        GROUP BY curriculumExit";
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
            $query = "SELECT trackFinished, strandFinished, COUNT(*)
            FROM alumni WHERE status='active' AND trackFinished='$track'
            GROUP BY strandFinished";
        } else {
            $query = "SELECT trackFinished, strandFinished, COUNT(*)
        FROM alumni WHERE status='active' AND dateGraduated='$batch' AND trackFinished='$track'
        GROUP BY strandFinished";
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
            "Entrepreneurship" => "entrepreneurship"
        );

        $curriculumExitsUnformatted = array(
            "higher_education" => 0,
            "employment" => 0,
            "middle_level_skills_development" => 0,
            "entrepreneurship" => 0
        );

        if ($batch == 0) {
            $query = "SELECT curriculumExit, COUNT(*) 
            FROM alumni 
            WHERE status='active' AND trackFinished='$track'
            GROUP BY curriculumExit;";
        } else {
            $query = "SELECT curriculumExit, COUNT(*) 
            FROM alumni 
            WHERE status='active' AND dateGraduated='$batch' AND trackFinished='$track'
            GROUP BY curriculumExit;";
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
        $query = "SELECT dateGraduated, COUNT(*) FROM alumni GROUP BY dateGraduated";

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
        $query = "SELECT trackFinished, COUNT(*) FROM alumni WHERE status='active' GROUP BY trackFinished";

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
        $query = "SELECT trackFinished, COUNT(*) FROM alumni WHERE status='active' GROUP BY trackFinished";

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
        $queryTVL = "SELECT strandFinished, COUNT(*) FROM `alumni` WHERE trackFinished='TVL' AND status='active'";
        $queryAcademic = "SELECT strandFinished, COUNT(*) FROM `alumni` WHERE trackFinished='Academic' AND status='active'";

        $resultTVL = $this->db->query($queryTVL);
        $resultAcademic = $this->db->query($queryAcademic);
        $alumniAccordingToTrackNumeric = $this->alumniAccordingToTrackNumeric();

        if ($resultTVL->num_rows > 0) {
            foreach ($resultTVL->fetch_all() as $row) {
                array_push($data["TVL"], array("label" => $row[0], "y" => (((int)$row[1] / $alumniAccordingToTrackNumeric["TVL"]) * 100)));
            }
        }

        if ($resultAcademic->num_rows > 0) {
            foreach ($resultAcademic->fetch_all() as $row) {
                array_push($data["Academic"], array("label" => $row[0], "y" => (((int)$row[1] / $alumniAccordingToTrackNumeric["Academic"]) * 100)));
            }
        }

        return $data;
    }

    public function alumniAccordingToStrandNumeric()
    {
        $data = array("TVL" => array(), "Academic" => array());
        $queryTVL = "SELECT strandFinished, COUNT(*) FROM `alumni` WHERE trackFinished='TVL' AND status='active'";
        $queryAcademic = "SELECT strandFinished, COUNT(*) FROM `alumni` WHERE trackFinished='Academic' AND status='active'";

        $resultTVL = $this->db->query($queryTVL);
        $resultAcademic = $this->db->query($queryAcademic);

        if ($resultTVL->num_rows > 0) {
            foreach ($resultTVL->fetch_all() as $row) {
                array_push($data["TVL"], array("label" => $row[0], "y" => (int)$row[1]));
            }
        }

        if ($resultAcademic->num_rows > 0) {
            foreach ($resultAcademic->fetch_all() as $row) {
                array_push($data["Academic"], array("label" => $row[0], "y" => (int)$row[1]));
            }
        }

        return $data;
    }

    public function alumniAccordingToPresentStatus(){
        $dataPoints = array();

        $query = "SELECT presentStatus, COUNT(*) FROM `alumni` WHERE status='active' GROUP BY presentStatus";

        $result = $this->db->query($query);

        if($result->num_rows > 0) {
            foreach($result->fetch_all() as $row){
                array_push($dataPoints, array("label"=>$row[0], "y"=>$row[1]));
            }
        }

        return $dataPoints;
    }

    public function alumniAccordingToGender(){
        $dataPoints = array();
        
        $query = "SELECT gender, COUNT(*) FROM `alumni` WHERE status='active' GROUP BY gender";

        $result = $this->db->query($query);

        if($result->num_rows > 0) {
            foreach($result->fetch_all() as $row){
                array_push($dataPoints, array("label"=>$row[0], "y"=>$row[1]));
            }
        }

        return $dataPoints;
    }
}
