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
        $result = $db->query("SELECT * FROM alumni 
        JOIN alumni_school_history ON alumni.id = alumni_school_history.alumniID 
        WHERE track='$track' AND status='active'");
        $count = $result->num_rows;

        return $count;
    }

    public function tracks()
    {
        return array(
            "TVL" => $this->queryTrackFinished('TVL'),
            "Academic" => $this->queryTrackFinished('Academic')
        );
    }
}
