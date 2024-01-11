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

        $query = "INSERT INTO content 
        (type, 
        title, 
        body, 
        author, 
        eventStart, 
        eventEnd, 
        coverImage) 
        VALUES (
        'event',
        '$title',
        '$body',
        $userId,
        '$eventStart',
        '$eventEnd',
        '$coverImage')";

        $result = $db->query($query);
        $db->close();

        return $result;
    }

    public function getContents($type)
    {
        $db = new Database();
        $query = "SELECT title, body, author, eventStart, eventEnd, coverImage, id FROM content WHERE type='$type' ORDER BY eventStart DESC";
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

    public function deleteContent($id)
    {
        $db = new Database();
        $query = "DELETE FROM content WHERE id=$id";

        $result = $db->query($query);
        $db->close();

        return $result;
    }
}
