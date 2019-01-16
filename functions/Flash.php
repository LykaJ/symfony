<?php

/*
    Set un message flash avec un type donné
    @param $type: le type du flash
    @param $message: le message
*/
function flash($type, $message)
{
    $_SESSION['flash'][$type] = $message;
}

/*
    Function à appeler dans la vue
    Récupère le flash du type donné
    @param $type: le type du flash
    @return le flash du type donné, ou null si non défini
*/
function get_flash($type)
{
    if (isset($_SESSION['flash'][$type])) {
        $message = $_SESSION['flash'][$type];

        unset($_SESSION['flash'][$type]);

        return $message;
    }

    return null;
}

function flash_success($message)
{
    flash('success', $message);
}

function flash_error($message)
{
    flash('error', $message);
}

function flash_warning($message)
{
    flash('warning', $message);
}
