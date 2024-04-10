<?php

class Dashboard
{
    public function registeredAlumni()
    {
        $db = new Database();

        $query = "SELECT * FROM alumni WHERE status='active'";

        $result = $db->query($query);

        $db->close();

        return $result->num_rows;
    }

    public function queryTrackFinished($track)
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM alumni WHERE trackFinished='$track' AND status='active'");
        $count = $result->num_rows;

        return $count;
    }

    public function tracks()
    {
        return array(
            "TVL" => $this->queryTrackFinished('TVL'),
            "Academic" => $this->queryTrackFinished('Academic'),
            "Sports and Recreation" => $this->queryTrackFinished('Sports and Recreation')
        );
    }
}
