<?php

namespace App\Rules;

use Closure;
use App\Models\Village;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueVillageCode implements ValidationRule
{
    protected $village;

    protected $code;

    public function __construct($code, $village = null)
    {
        $this->code = $code;
        $this->village = $village;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Village::where('code', $this->code);

        if ($this->village) {
            $query->where('id', '!=', $this->village->id);
        }

        if ($query->exists()) {
            $fail('kode ini sudah ada. Silahkan pilih yang lain.');
        }
    }
}
