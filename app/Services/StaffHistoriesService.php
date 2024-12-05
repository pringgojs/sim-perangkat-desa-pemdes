<?php

namespace App\Services;

use App\Models\VillageStaff;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class StaffHistoriesService
{
    use LivewireAlert;

    private $villagePositionType;

    private $staff;

    public function __construct()
    {
        // $this->villagePositionType = $villagePositionType;
        // $this->staff = $staff;
    }

    public function setNonActive($history)
    {
        $staff = $history->villageStaff;

        if (option_is_match('definitif', $history->position_type_status_id)) {
            /* jika definitif */
            $staff->position_id = null;
            $staff->position_name = null;
            $staff->position_code = null;
            $staff->position_is_active = false;
            $staff->save();
        } else {
            $staff->position_plt_id = null;
            $staff->position_plt_name = null;
            $staff->position_plt_code = null;
            $staff->position_plt_is_active = false;
            $staff->save();
        }

        $history->is_active = false;
        $history->non_active_at = date('Y-m-d H:i:s');
        $history->save();

        /* update village position type */
        $villagePositionType = VillagePositionType::find($history->village_position_type_id);
        $villagePositionType->position_type_status_id = null;
        $villagePositionType->is_parkir = 0;
        $villagePositionType->siltap = 0;
        $villagePositionType->tunjangan = 0;
        $villagePositionType->save();

    }

    public function setActive($history)
    {
        $staff = $history->villageStaff;
        if (option_is_match('definitif', $history->position_type_status_id)) {
            $staff->position_id = $history->villagePositionType->position_type_id;
            $staff->position_name = $history->villagePositionType->position_name;
            $staff->position_code = $history->villagePositionType->code;
            $staff->position_is_active = true;
            $staff->save();
        } else {

            /* ubah status staff jika jabatan plt */
            $staff->position_plt_id = $history->villagePositionType->position_type_id;
            $staff->position_plt_name = $history->villagePositionType->position_name;
            $staff->position_plt_code = $history->villagePositionType->code;
            $staff->position_plt_is_active = true;
            $staff->save();
        }

        $history->is_active = true;
        $history->non_active_at = null;
        $history->save();

        $villagePositionType = $history->villagePositionType;
        /* update village position type */
        $villagePositionType->tunjangan = $history->tunjangan ?? 0;
        $villagePositionType->siltap = $history->siltap ?? 0;
        $villagePositionType->is_parkir = $history->is_parkir;
        $villagePositionType->position_type_status_id = $history->position_type_status_id;
        $villagePositionType->save();

    }

    public function initStore($villagePositionTypeId, $staffId, $positionTypeStatusId)
    {
        $villagePositionType = VillagePositionType::findOrFail($villagePositionTypeId);
        $staff = VillageStaff::findOrFail($staffId);

        $payload = [
            'village_staff_id' => $staff->id,
            'village_position_type_id' => $villagePositionType->id,
            'village_id' => $villagePositionType->village_id,
            'position_code' => $villagePositionType->code,
            'position_type_id' => $villagePositionType->position_type_id,
            'position_name' => $villagePositionType->position_name,
            'non_active_at' => null,
            'is_active' => true,
            'created_by' => auth()->user()->id,
            'position_type_status_id' => $positionTypeStatusId,
            // ---
            'no_sk' => null,
            'date_of_sk' => null,
            'date_of_appointment' => null,
            'enddate_of_office' => null,
            'is_active' => true,
            'siltap' => 0,
            'tunjangan' => 0,
            'thp' => 0,
            'is_parkir' => 0,
            'authorized_signature' => null,
        ];

        /* proses simpan */
        $model = VillageStaffHistory::create($payload);

        self::setActive($model);

        return $model;
    }
}
