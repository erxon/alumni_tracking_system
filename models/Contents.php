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

        $query = "INSERT INTO content 
        (type, 
        title, 
        body, 
        author, 
        coverImage) 
        VALUES (
        'news',
        '$title',
        '$body',
        $userId,
        '$coverImage')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function getContents($type)
    {
        $db = new Database();
        $query = "SELECT title, body, author, eventStart, eventEnd, coverImage, id, description FROM content WHERE type='$type' ORDER BY eventStart DESC";
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
        $query = "SELECT title, body, author, coverImage, id, dateCreated FROM content WHERE type='news' ORDER BY dateCreated DESC";
        $events = $db->query($query);

        if (!empty($events)) {
            return $events->fetch_all();
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

    public function addSurveyQuestion($values, $author)
    {
        $db = new Database();

        $question = $values["question"];
        $body = $values["body"];
        $coverImage = $values["coverImage"];

        $query = "INSERT INTO survey_questions 
        (question, body, coverImage, author) VALUES
        ('$question', '$body', '$coverImage', '$author')";

        $result = $db->query($query);

        if ($result) {
            return $db->getId();
        }

        $db->close();
        return $result;
    }

    public function addSurveyAnswers($questionId)
    {
        $db = new Database();
        $query = "";

        for ($i = 1; $i < $_POST["answers"] + 1; $i++) {
            $answer = $_POST["answer" . $i];
            $query .= "INSERT INTO survey_answers (questionId, answer)
            VALUES ('$questionId', '$answer');";
        }

        $result = $db->multi_query($query);
        $db->close();

        return $result;
    }

    public function getSurveys()
    {
        $db = new Database();
        $query = "SELECT * FROM survey_questions";

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

    public function getSurveyAnswers($questionId)
    {
        $db = new Database();
        $query = "SELECT * FROM survey_answers WHERE questionId=$questionId";

        $result = $db->query($query);
        $db->close();

        return $result->fetch_all();
    }

    public function deleteSurvey($id)
    {
        $db = new Database();
        $query = "DELETE FROM survey_answers WHERE questionId=$id;";
        $query .= "DELETE FROM survey_questions WHERE id=$id";

        $result = $db->multi_query($query);
        $db->close();

        return $result;
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

    public function surveyVote($userId, $questionId, $answerId)
    {
        $db = new Database();

        $query = "INSERT INTO survey_results (userId, questionId, answerId)
        VALUES ('$userId', '$questionId', '$answerId')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function getSurveyVotes($questionId, $answerId)
    {
        $db = new Database();
        $query = "SELECT * FROM survey_results WHERE answerId='$answerId' AND questionId='$questionId'";

        $result = $db->query($query);

        $count = $result->num_rows;

        return $count;
    }

    public function homePage($surveyId)
    {
        $db = new Database();
        $query = "INSERT INTO home_page (survey) VALUES ('$surveyId')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }
}
