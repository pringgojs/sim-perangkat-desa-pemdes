<?php

namespace App\Services;

use Exception;
use App\Models\VillageStaff;
use Illuminate\Support\Facades\DB;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;


class StaffHistoriesService
{
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
            $staff->position_code = null;
            $staff->position_plt_is_active = false;
            $staff->save();
        }

        $history->is_active = false;
        $history->non_active_at = date('Y-m-d H:i:s');
        $history->save();
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
            $staff->position_code = $history->villagePositionType->code;
            $staff->position_plt_is_active = true;
            $staff->save();
        }

        $history->is_active = true;
        $history->non_active_at = null;
        $history->save();
    }
}