<?php

namespace App\Rules;

use Closure;
use App\Models\VillageSiltap;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueVillageSiltap implements ValidationRule
{
    protected $village_id;
    protected $staff_position_id;
    protected $ignore_id;

    public function __construct($village_id, $staff_position_id, $ignore_id = null)
    {
        $this->village_id = $village_id;
        $this->staff_position_id = $staff_position_id;
        $this->ignore_id = $ignore_id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /* jika jabatan sekdes, kepala. pastikan hanya ada 1 */
        $query = VillageSiltap::where('village_id', $this->village_id)
            ->where('position_type_id', $this->staff_position_id);

        if ($this->ignore_id) {
            $query->where('id', '!=', $this->ignore_id);
        }

        if ($query->exists()) {
            $fail('Untuk siltap dan tunjangan untuk jabatan dan desa ini sudah terisi.');
        }
    }
}
