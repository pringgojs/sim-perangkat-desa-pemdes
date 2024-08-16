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