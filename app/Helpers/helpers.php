<?php

use App\Models\Option;
use Carbon\Carbon;

/** initials */
function initials($name)
{
    $nameParts = explode(' ', trim($name));
    $firstName = array_shift($nameParts);
    $lastName = array_pop($nameParts);

    return
        mb_substr($firstName, 0, 1).
        mb_substr($lastName, 0, 1);
}

function key_option($key)
{
    $option = Option::where('key', $key)->first();

    return $option ? $option->id : null;
}

/* cek  */
function option_is_match($key, $id)
{
    return key_option($key) === $id;
}

/* user */
function is_administrator()
{
    $user = auth()->user();

    return $user->hasRole('administrator');
}

function is_sekdes()
{
    $user = auth()->user();
    if ($user->hasRole('operator')) {
        /* cek status aktif */
        if ($user->staff()->position_id == key_option('sekretaris_desa') && ($user->staff()->position_is_active)) {
            return true;
        }
        if ($user->staff()->position_plt_id == key_option('sekretaris_desa') && ($user->staff()->position_plt_is_active)) {
            return true;
        }
    }

    return false;
}

function format_rupiah($number)
{
    return 'Rp. '.number_format($number, 0, ',', '.');
}

function format_price($string = null)
{
    return str_replace(',', '', $string);
}

function date_format_view($date)
{
    if (! $date) {
        return '-';
    }
    Carbon::setLocale('id');
    // Buat instance Carbon dari created_at yang diberikan
    $carbonDate = Carbon::parse($date);

    // Format datetime menjadi 'd F Y H:i' (contoh: 24 Januari 2024 25:56)
    return $carbonDate->translatedFormat('d F Y');
}

function months()
{
    return [
        ['name' => 'januari', 'value' => 1],
        ['name' => 'februari', 'value' => 2],
        ['name' => 'maret', 'value' => 3],
        ['name' => 'april', 'value' => 4],
        ['name' => 'mei', 'value' => 5],
        ['name' => 'juni', 'value' => 6],
        ['name' => 'juli', 'value' => 7],
        ['name' => 'agustus', 'value' => 8],
        ['name' => 'september', 'value' => 9],
        ['name' => 'oktober', 'value' => 10],
        ['name' => 'november', 'value' => 11],
        ['name' => 'desember', 'value' => 12],
    ];

}
