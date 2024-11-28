<?php

namespace App\Rules;

use Closure;
use App\Models\User;
use App\Models\VillageStaffHistory;
use Illuminate\Contracts\Validation\ValidationRule;

class UniquePositionStatusHistory implements ValidationRule
{
    protected $staffId;
    protected $positionStatusId;
    protected $ignoreId;

    public function __construct($positionStatusId, $staffId, $ignoreId = null)
    {
        $this->positionStatusId = $positionStatusId;
        $this->staffId = $staffId;
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->positionStatusId) return;

        $definitif = key_option('definitif');
        $positionStatus = $this->positionStatusId;

        $query = VillageStaffHistory::active()
            ->where('village_staff_id', $this->staffId)
            ->where(function ($q) use ($positionStatus, $definitif) {
                if (option_is_match('definitif', $positionStatus)) {
                    $q->where('position_type_status_id', $definitif);
                } else {
                    $q->where('position_type_status_id', '!=', $definitif);
                }
            });
            
        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('Pegawai ini sudah menjabat sesuai dengan status
            jabatan yang dipilih. Setiap pegawai tidak boleh mempunyai jabatan yang
            dua-duanya definitif atau dua-duanya plt/plh/pj.');
        }
    }
}
