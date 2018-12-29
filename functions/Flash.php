<?php

function flash($type, $message)
{
    $_SESSION['flash'][$type] = $message;
}

function get_flash($type)
{
    if (isset($_SESSION['flash'][$type])) {
        $success = $_SESSION['flash'][$type];

        unset($_SESSION['flash'][$type]);

        return $success;
    }

    return null;
}

function flash_sucess($message)
{
    flash('success', $message);
}

function flash_error($message)
{
    flash('error', $message);
}
