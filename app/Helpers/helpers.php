<?php

use App\Models\Option;

/** initials */
function initials($name) {
    $nameParts = explode(' ', trim($name));
    $firstName = array_shift($nameParts);
    $lastName = array_pop($nameParts);
    return (
        mb_substr($firstName,0,1) .
        mb_substr($lastName,0,1)
    );
}

function key_option($key) {
    $option = Option::where('key', $key)->first();
    return $option ? $option->id : null;
}

/* cek  */
function option_is_match($key, $id) {
    return key_option($key) === $id;
}

/* user */
function is_administrator() {
    $user = auth()->user();
    return $user->hasRole('administrator');
}

function is_sekdes() {
    $user = auth()->user();
    if ($user->hasRole('operator')) {
        if ($user->staff()->position_type_id == key_option('sekretaris_desa')) {
            return true;
        }

    }
    return false;
}