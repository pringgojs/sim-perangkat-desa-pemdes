<?php

namespace App\Rules;

use Closure;
use App\Models\VillageStaff;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueStaffPositionInVillage implements ValidationRule
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
        /* jika jabatan selain sekretaris dan kepala, maka bebaskan */
        // $positions = [
        //     key_option('sekretaris_desa'),
        //     key_option('kepala_desa'),
        // ];

        // if (in_array($this->staff_position_id, $positions)) {
            $query = VillageStaff::where('village_id', $this->village_id)
                                 ->where('position_type_id', $this->staff_position_id);
    
            if ($this->ignore_id) {
                $query->where('id', '!=', $this->ignore_id);
            }
    
            if ($query->exists()) {
                $fail('The selected staff position is already taken in this village.');
            }
        // }
    }
}
