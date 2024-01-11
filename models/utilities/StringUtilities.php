<?php

class StringUltilities
{   
    public function truncate($string, $length = 100, $append = "&hellip;")
    {
        $string = trim($string);

        if (strlen($string) > $length) {
            $string = wordwrap($string, $length);
            $string = explode("\n", $string, 2);
            $string = $string[0] . $append;
        }

        return $string;
    }

    public function dateAndTime($dateString)
    {
        $date = strtotime($dateString);
        return date('M d Y', $date) . " at " . date('H:i A', $date);
    }
}
