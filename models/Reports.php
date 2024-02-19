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

    public function getAlumniRatingsPerQuestion()
    {
        $questions = array();

        for ($question = 1; $question < 5; $question++) {
            $answers = $this->alumniRating($question);
            array_push($questions, $answers);
        }

        return $questions;
    }
}
