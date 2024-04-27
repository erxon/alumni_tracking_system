<?php
include("/xampp/htdocs/thesis/models/Database.php");

class Contents
{
    public function createEvent($content, $userId)
    {
        $db = new Database();

        $eventStart = $content["eventStart"];
        $eventEnd = $content["eventEnd"];
        $title = $content["title"];
        $body = $content["body"];
        $coverImage = $content["coverImage"];
        $description = $content["description"];

        $query = "INSERT INTO content 
        (
        type, 
        title, 
        body, 
        author, 
        eventStart, 
        eventEnd, 
        coverImage,
        description) 
        VALUES (
        'event',
        '$title',
        '$body',
        $userId,
        '$eventStart',
        '$eventEnd',
        '$coverImage',
        '$description')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function createNews($content, $userId)
    {
        $db = new Database();

        $title = $content["title"];
        $body = $content["body"];
        $coverImage = $content["coverImage"];
        $description = $content["description"];

        $query = "INSERT INTO content 
        (type, 
        title, 
        body, 
        author, 
        coverImage,
        description) 
        VALUES (
        'news',
        '$title',
        '$body',
        $userId,
        '$coverImage',
        '$description')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function getContents($type)
    {
        $db = new Database();
        $query = "SELECT title, body, eventStart, eventEnd, coverImage, id, description FROM content WHERE type='$type' ORDER BY eventStart DESC";
        $events = $db->query($query);

        if (!empty($events)) {
            return $events->fetch_all();
        } else {
            throw new Exception("There were no events yet.");
        }
    }

    public function getEventsByTitle($title)
    {
        $db = new Database();
        $query = "SELECT title, body, eventStart, eventEnd, coverImage, id, description FROM content WHERE type='event' AND title='$title' ORDER BY eventStart DESC";
        $events = $db->query($query);

        if (!empty($events)) {
            return $events->fetch_all();
        } else {
            throw new Exception("Event not found");
        }
    }

    public function getEvents($filter)
    {
        $db = new Database();
        $query = "";
        if ($filter == "DESC") {
            $query = "SELECT title, body, eventStart, eventEnd, coverImage, id, description FROM content WHERE type='event' ORDER BY eventStart DESC";
        } else if ($filter == "ASC") {
            $query = "SELECT title, body, eventStart, eventEnd, coverImage, id, description FROM content WHERE type='event' ORDER BY eventStart ASC";
        }

        $events = $db->query($query);

        if (!empty($events)) {
            return $events->fetch_all();
        } else {
            throw new Exception("There were no events yet.");
        }
    }

    public function getAuthor($id)
    {
        $db = new Database();
        $query = "SELECT firstName, lastName FROM user WHERE id='$id'";
        $result = $db->query($query);
        $author = $result->fetch_assoc();

        $db->close();

        if ($author) {
            return $author;
        }
    }

    public function getNews()
    {
        $db = new Database();
        $query = "SELECT title, body, coverImage, id, dateCreated, description FROM content WHERE type='news' ORDER BY dateCreated DESC";
        $events = $db->query($query);

        if (!empty($events)) {
            return $events->fetch_all();
        } else {
            throw new Exception("There were no events yet.");
        }
    }

    public function getNewsByTitle($title)
    {
        $db = new Database();
        $query = "SELECT title, body, coverImage, id, dateCreated, description 
        FROM content WHERE type='news' AND title='$title' 
        ORDER BY dateCreated DESC";
        
        $events = $db->query($query);

        if (!empty($events)) {
            return $events->fetch_all();
        } else {
            throw new Exception("There were no events yet.");
        }
    }

    public function getSortedNews($filter)
    {
        $db = new Database();
        $query = "";

        if ($filter == "ASC") {
            $query = "SELECT title, body, coverImage, id, dateCreated, description FROM content WHERE type='news' ORDER BY dateCreated ASC";
        } else if ($filter == "DESC"){
            $query = "SELECT title, body, coverImage, id, dateCreated, description FROM content WHERE type='news' ORDER BY dateCreated DESC";
        }
        
        $news = $db->query($query);

        if (!empty($news)) {
            return $news->fetch_all();
        } else {
            throw new Exception("There were no events yet.");
        }
    }

    public function getContent($id)
    {
        $db = new Database();
        $query = "SELECT * FROM content WHERE id=$id";
        $result = $db->query($query);
        $db->close();

        return $result->fetch_assoc();
    }

    public function updateEvent($id, $values)
    {
        $db = new Database();
        $title = $values["title"];
        $body = $values["body"];
        $coverImage = $values["coverImage"];
        $eventStart = $values["eventStart"];
        $eventEnd = $values["eventEnd"];

        $query = "UPDATE content 
        SET title='$title', 
        body='$body', 
        coverImage='$coverImage',
        eventStart='$eventStart',
        eventEnd='$eventEnd' WHERE id=$id";

        $result = $db->query($query);

        $db->close();

        return $result;
    }
    public function updateNews($id, $values)
    {
        $db = new Database();

        $title = $values["title"];
        $body = $values["body"];
        $coverImage = $values["coverImage"];

        $query = "UPDATE content 
        SET title='$title', 
        body='$body', 
        coverImage='$coverImage' WHERE id=$id";

        $result = $db->query($query);

        $db->close();

        return $result;
    }


    public function deleteContent($id)
    {
        $db = new Database();
        $query = "DELETE FROM content WHERE id=$id";

        $result = $db->query($query);
        $db->close();

        return $result;
    }



    public function createSurvey($values)
    {
        $db = new Database();

        $title = $values["title"];
        $description = $values["description"];
        $coverImage = $values["coverImage"];

        $query = "INSERT INTO survey (title, description, coverImage) 
        VALUES ('$title', '$description', '$coverImage')";

        $db->query($query);

        $id = $db->getId();

        return $id;
    }

    public function getSurvey($id)
    {
        $db = new Database();

        $query = "SELECT * FROM survey WHERE id=$id";
        $result = $db->query($query);

        return $result->fetch_assoc();
    }

    public function updateSurvey($values)
    {
        $db = new Database();

        $id = $values["id"];
        $title = $values["title"];
        $description = $values["description"];
        $coverImage = $values["coverImage"];

        $query = "UPDATE survey 
        SET title='$title', description='$description', coverImage='$coverImage' 
        WHERE id='$id'";

        $result = $db->query($query);

        return $result;
    }


    public function deleteSurvey($id)
    {
        $db = new Database();
        $query = "DELETE FROM survey WHERE id=$id;";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function createQuestion($surveyId, $question)
    {
        $db = new Database();
        $query = "INSERT INTO survey_question (survey, question) VALUES ($surveyId, '$question');";

        $db->query($query);
        $questionId = $db->getId();

        return $questionId;
    }
    protected function deleteAnswers($questionId, $db)
    {
        $deleteAnswers = "DELETE FROM survey_answers WHERE questionId=$questionId";
        $result = $db->query($deleteAnswers);

        if (!$result) {
            throw new Exception("Something went wrong");
        }
    }

    public function insertNewAnswers($numberOfAnswers, $db, $questionId)
    {
        //insert new answers
        $insertAnswer = "";
        for ($i = 0; $i < $numberOfAnswers; $i++) {
            $answer = $_POST["answer_$i"];
            $insertAnswer .= "INSERT INTO survey_answers (questionId, answer) 
            VALUES ($questionId, '$answer');";
        }
        $result = $db->multi_query($insertAnswer);

        if (!$result) {
            throw new Exception("Something went wrong");
        }
    }
    public function updateQuestion($questionId, $question, $numberOfAnswers)
    {
        $db = new Database();

        try {
            $updateQuestion = "UPDATE survey_question SET question='$question' WHERE id=$questionId";
            $db->query($updateQuestion);
            //delete the answers for the question
            $this->deleteAnswers($questionId, $db);
            //insert new answers for the question
            $this->insertNewAnswers($numberOfAnswers, $db, $questionId);

            return "success";
        } catch (Exception $error) {
            return "failed";
        }
    }

    public function deleteQuestion($questionId)
    {
        $db = new Database();

        $query = "DELETE FROM survey_question WHERE id=$questionId;";
        $query .= "DELETE FROM survey_answers WHERE questionId=$questionId;";

        $result = $db->multi_query($query);

        return $result;
    }

    public function vote($questionId, $answerId, $userId, $surveyId)
    {
        $db = new Database();

        $query = "INSERT INTO survey_results (surveyId, userId, questionId, answerId)
        VALUES ($surveyId, $userId, $questionId, $answerId);";

        $result = $db->query($query);

        return $result;
    }
    public function hasVoted($userId, $surveyId)
    {
        $db = new Database();

        $query = "SELECT * FROM survey_results WHERE userId='$userId' AND surveyId='$surveyId'";

        $result = $db->query($query);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getVotes($surveyId)
    {
        $db = new Database();

        $query = "SELECT userId, COUNT(*) FROM `survey_results` WHERE surveyId=$surveyId GROUP BY userId;";

        $result = $db->query($query);

        if ($result->num_rows > 0) {
            return $result->num_rows;
        } else {
            return 0;
        }
    }
    public function getVotesByAnswer($answerId)
    {
        $db = new Database();

        $query = "SELECT * FROM survey_results WHERE answerId='$answerId'";

        $result = $db->query($query);

        if ($result->num_rows > 0) {
            return $result->num_rows;
        } else {
            return 0;
        }
    }
    public function getSurveyQuestions($surveyId)
    {
        $db = new Database();

        $query = "SELECT id, question FROM survey_question WHERE survey=$surveyId";
        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function getSurveyAnswers($questionId)
    {
        $db = new Database();
        $query = "SELECT survey_question.question, survey_answers.answer, survey_answers.id, survey_question.id FROM survey_question 
        JOIN survey_answers ON survey_question.id=survey_answers.questionId WHERE survey_question.id = $questionId";

        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function addAnswers($questionId, $numberOfAnswers)
    {
        $db = new Database();
        $query = "";

        for ($i = 0; $i < $numberOfAnswers; $i++) {
            $answer = $_POST["answer_$i"];

            $query .= "INSERT INTO survey_answers (questionId, answer)
                VALUES ($questionId, '$answer');";
        }

        $result = $db->multi_query($query);

        return $result;
    }

    public function getSurveys()
    {
        $db = new Database();
        $query = "SELECT * FROM survey";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function getSortedSurveys($filter){
        $db = new Database();
        $query = "";

        if ($filter == "ASC"){
            $query = "SELECT * FROM survey ORDER BY dateCreated ASC";
        } else if ($filter == "DESC") {
            $query = "SELECT * FROM survey ORDER BY dateCreated DESC";
        }

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function getSurveyByTitle($title)
    {
        $db = new Database();
        $query = "SELECT * FROM survey WHERE title='$title'";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }
    public function getSurveyQuestion($id)
    {
        $db = new Database();
        $query = "SELECT * FROM survey_questions WHERE id=$id";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_assoc();
    }

    public function getSurveyVotes($surveyId)
    {
        $db = new Database();
        $query = "SELECT id, COUNT(*) FROM survey_results WHERE surveyId=$surveyId";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function updateSurveyQuestion($coverImageUpdated)
    {
        $db = new Database();
        $id = $_POST["id"];
        $question = $_POST["question"];
        $body = $_POST["body"];
        $coverImage = $coverImageUpdated;

        $query = "UPDATE 
        survey_questions 
        SET question='$question',
        body='$body',
        coverImage='$coverImage'
        WHERE id=$id";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function updateSurveyAnswers()
    {
        $db = new Database();
        $id = $_POST["id"];
        $query = "";
        $deleteQuery = "DELETE FROM survey_answers WHERE questionId=$id";
        $db->query($deleteQuery);

        for ($i = 1; $i < $_POST["answers"] + 1; $i++) {
            $answer = $_POST["answer" . $i];
            $query .= "INSERT INTO survey_answers (questionId, answer)
            VALUES ('$id', '$answer');";
        }

        $result = $db->multi_query($query);

        $db->close();

        return $result;
    }

    public function getSurveysWithRespondents()
    {
        $db = new Database();

        $query = "SELECT survey_results.questionId, 
        survey_questions.question, COUNT(*) 
        FROM survey_results JOIN survey_questions ON survey_results.questionId=survey_questions.id GROUP BY questionId";

        $result = $db->query($query);

        return $result->fetch_all();
    }

    public function homePage($surveyId)
    {
        $db = new Database();
        $query = "INSERT INTO home_page (survey) VALUES ('$surveyId')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function setHomePageLayout($eventHighlight, $newsHighlight)
    {
        $db = new Database();
        $query = "UPDATE home_page SET eventHighlight=$eventHighlight, newsHighlight=$newsHighlight WHERE id=1";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function getHomePageLayout()
    {
        $db = new Database();
        $query = "SELECT eventHighlight, newsHighlight FROM home_page WHERE id=1";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_assoc();
    }

    public function recentlyAddedContents($type)
    {
        $db = new Database();
        $query = "SELECT id, title, dateCreated, coverImage, description FROM content WHERE type='$type' ORDER BY dateCreated DESC LIMIT 3";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function newGallery()
    {
        $db = new Database();
        $query = "SELECT * FROM gallery ORDER BY dateCreated DESC LIMIT 1";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }
    public function newSurvey()
    {
        $db = new Database();
        $query = "SELECT * FROM survey ORDER BY dateCreated DESC LIMIT 1";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }
}
