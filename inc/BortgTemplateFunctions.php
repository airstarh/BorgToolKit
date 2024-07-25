<?php
if (!function_exists('borgTemplate')) {
    function borgTemplate($path, $data)
    {
        return BorgTemplate::render($path, $data);
    }
}
