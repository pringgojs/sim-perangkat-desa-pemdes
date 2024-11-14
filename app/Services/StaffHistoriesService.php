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

    public function __construct(VillagePositionType $villagePositionType, VillageStaff $staff)
    {
        $this->villagePositionType = $villagePositionType;
        $this->staff = $staff;
    }

    /**
     * Fungsi untuk ketika ada perubahan jabatan, baik itu update atau delete, maka history harus diubah
      */
    public function store($params = [], $id = null)
    {

        DB::beginTransaction();
        
        if (!$this->villagePositionType) return;

        if (!$this->staff) return;
        
        self::updateStatusCurrentStaff();

        self::updateThisStaff();

        $payload = [
            'village_staff_id' => $this->staff->id,
            'village_position_type_id' => $this->villagePositionType->id,
            'village_id' => $this->villagePositionType->village_id,
            'position_code' => $this->villagePositionType->code,
            'position_type_id' => $this->villagePositionType->position_type_id,
            'position_name' => $this->villagePositionType->position_name,
            'position_type_status_id' => $this->villagePositionType->position_type_status_id,
            'siltap' => $this->villagePositionType->siltap,
            'tunjangan' => $this->villagePositionType->tunjangan,
            'thp' => $this->villagePositionType->siltap + $this->villagePositionType->tunjangan,
            'non_active_at' => null,
            'created_by' => auth()->user()->id
        ];

        if ($params) {
            $payload['no_sk'] = isset($params['no_sk']) ? $params['no_sk'] : null;
            $payload['date_of_sk'] = isset($params['date_of_sk']) ? $params['date_of_sk'] : null;
            $payload['date_of_appointment'] = isset($params['date_of_appointment']) ? $params['date_of_appointment'] : null;
            $payload['enddate_of_office'] = isset($params['enddate_of_office']) ? $params['enddate_of_office'] : null;
            $payload['is_active'] = true;
        }
        
        /* proses simpan */
        $model = VillageStaffHistory::updateOrCreate([
            'id' => $id
        ], $payload);

        DB::commit();

        return $model;
    }

    public function updateDefinitif()
    {
        /* ubah status perangkat definitif menjadi not-active*/
        $update = VillageStaffHistory::active()
        ->where('village_staff_id', $this->staff->id)
        ->where('position_type_status_id', key_option('definitif'))
        ->update(['is_active' => 0, 'non_active_at' => date('Y-m-d H:i:s')]);

        $update = VillageStaff::where('position_code', $this->villagePositionType->code)
        ->where('id', '!=', $this->staff->id)
        ->update(['position_is_active' => 0]);
    }

    public function updateNotDefinitif()
    {
        $update = VillageStaffHistory::active()
            ->where('village_staff_id', $this->staff->id)
            ->where('position_type_status_id', '!=', key_option('definitif'))
            ->update(['is_active' => false, 'non_active_at' => date('Y-m-d H:i:s')]);

        $update = VillageStaff::where('position_plt_code', $this->villagePositionType->code)
            ->where('id', '!=', $this->staff->id)
            ->update(['position_plt_is_active' => 0]);
    }

    public function updateThisStaff()
    {
        /* ubah status staff jika jabatan definitif */
        if (option_is_match('definitif', $this->villagePositionType->position_type_status_id)) {
            $this->staff->position_id = $this->villagePositionType->position_type_id;
            $this->staff->position_name = $this->villagePositionType->position_name;
            $this->staff->position_code = $this->villagePositionType->code;
            $this->staff->position_is_active = true;
            $this->staff->save();

            self::updateDefinitif();

            return;
        }

        /* ubah status staff jika jabatan plt */
        $this->staff->position_plt_id = $this->villagePositionType->position_type_id;
        $this->staff->position_plt_name = $this->villagePositionType->position_name;
        $this->staff->position_code = $this->villagePositionType->code;
        $this->staff->position_plt_is_active = true;
        $this->staff->save();

        self::updateNotDefinitif();
    }

    public function updateStatusCurrentStaff()
    {
        $positionNow = VillageStaffHistory::active()->where('village_position_type_id', $this->villagePositionType->id)->first();

        if (!$positionNow) return;

        $positionNow->is_active = false;
        $positionNow->non_active_at = date('Y-m-d H:i:s');
        $positionNow->save();
    }
}