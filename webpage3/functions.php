<?php 
    function getFormatedSize($size_in_bytes)
    {
        if ($size_in_bytes >= 1073741824)
        {
            $size_in_bytes = number_format($size_in_bytes / 1073741824, 2) . ' GB';
        }
        elseif ($size_in_bytes >= 1048576)
        {
            $size_in_bytes = number_format($size_in_bytes / 1048576, 2) . ' MB';
        }
        elseif ($size_in_bytes >= 1024)
        {
            $size_in_bytes = number_format($size_in_bytes / 1024, 2) . ' KB';
        }
        elseif ($size_in_bytes >= 1)
        {
            $size_in_bytes = $size_in_bytes . ' b';
        }
        else
        {
            $size_in_bytes = '0 b';
        }

        return $size_in_bytes;
    }   

    function shuffle_files($array) {
        $keys = array_keys($array);
        $new = array();

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        return $new;
    }
?>