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
        WHERE alumni_school_history.track='$track' AND alumni.status='active'");
        $count = $result->num_rows;

        return $count;
    }

    public function tracks()
    {
        return array(
            "TVL" => $this->queryTrackFinished('Technical-Vocational and Livelihood'),
            "Academic" => $this->queryTrackFinished('Academic')
        );
    }
}
