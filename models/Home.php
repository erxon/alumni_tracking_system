<?php
class Home
{

    public function getSurvey()
    {
        $db = new Database();
        $query = "SELECT * FROM home_page ORDER BY id ASC LIMIT 2";

        $result = $db->query($query);

        $db->close();

        if ($result->num_rows > 0) {
            return $result->fetch_all();
        } else {
            return false;
        }
    }

    public function getSurveyQuestion($id)
    {
        $db = new Database();
        $query = "SELECT * FROM survey_questions WHERE id=$id";

        $result = $db->query($query);

        $db->close();

        return $result->fetch_assoc();
    }

    public function getSurveyAnswers($id)
    {
        $db = new Database();
        $query = "SELECT * FROM survey_answers WHERE questionId=$id";
        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function surveyAnswer($userId, $answerId, $questionId)
    {
        $db = new Database();

        $query = "INSERT INTO survey_results (userId, questionId, answerId)
        VALUES ($userId, $questionId, $answerId)";

        $result = $db->query($query);

        $db->close();

        return $result;
    }

    public function userAnsweredSurvey($userId, $questionId)
    {
        $db = new Database();
        $query = "SELECT * FROM survey_results WHERE userId=$userId AND questionId=$questionId";
        $result = $db->query($query);

        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function removeSurvey($id)
    {
        $db = new Database();
        $query = "DELETE FROM home_page WHERE id=$id";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function getEventHighlight(){
        $db = new Database();

        $query = "SELECT * FROM content JOIN home_page ON home_page.eventHighlight=content.id";

        $result = $db->query($query);

        return $result->fetch_assoc();
    }
    public function getNewsHighlight(){
        $db = new Database();

        $query = "SELECT * FROM content JOIN home_page ON home_page.newsHighlight=content.id";

        $result = $db->query($query);

        return $result->fetch_assoc();
    }

    public function getNewGallery(){
        $db = new Database();

        $query = "SELECT * FROM gallery ORDER BY dateCreated DESC LIMIT 1";

        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function getNewSurvey(){
        $db = new Database();

        $query = "SELECT * FROM survey ORDER BY dateCreated DESC LIMIT 1";

        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function getEvents()
    {
        $db = new Database();
        $query = "SELECT * FROM content WHERE type='event' LIMIT 2";

        $result = $db->query($query);

        if ($result) {
            return $result->fetch_all();
        }
    }

    public function getLatestNews()
    {
        $db = new Database();
        $query = "SELECT * FROM content WHERE type='news' ORDER BY dateCreated DESC LIMIT 1";

        $result = $db->query($query);

        if ($result) {
            return $result->fetch_assoc();
        }
    }

    public function getNews()
    {
        $db = new Database();
        $query = "SELECT * FROM content WHERE type='news' ORDER BY dateCreated DESC LIMIT 3";

        $result = $db->query($query);

        if ($result) {
            return $result->fetch_all();
        }
    }

    public function getAuthor($id)
    {
        $db = new Database();
        $query = "SELECT firstName, lastName FROM user WHERE id=$id";
        $result = $db->query($query);

        if ($result) {
            return $result->fetch_assoc();
        }
    }
}
