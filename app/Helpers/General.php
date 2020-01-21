<?php
if (!function_exists('set_active')) {
    function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }
}
if (!function_exists('set_selected_month')) {
    function set_selected_month($value)
    {
        if (!empty($_GET['bulan'])) {
            if ($_GET['bulan'] == $value) {
                $status = 'selected';
            } else {
                $status = '';
            }
        } else {
            $status = '';
        }
        return $status;
    }
}

if (!function_exists('set_selected_year')) {
    function set_selected_year($value)
    {
        if (!empty($_GET['tahun'])) {
            if ($_GET['tahun'] == $value) {
                $status = 'selected';
            } else {
                $status = '';
            }
        } else {
            $status = '';
        }
        return $status;
    }
}
