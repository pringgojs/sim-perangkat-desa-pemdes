<?php

namespace App\Exports;

use App\Models\VillagePositionType;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VillagePositionTypeExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;
    public $filter;

    public function __construct($filter = [])
    {
        $this->filter = $filter;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VillagePositionType::filter($this->filter)->with(['village.district', 'positionType', 'positionTypeStatus', 'staffHistory.villageStaff'])->orderByDefault()->get();
    }
    
    public function headings(): array
    {
        return [
            '#',
            'Kode Kecamatan',
            'Nama Kecamatan',
            'Kode Desa',
            'Nama Desa',
            'Kode Jabatan',
            'Nama Jabatan',
            'Nama Perangkat',
            'Siltap',
            'Tunjangan',
            'Status Jabatan',
            'Status Parkir'
        ];
    }

    public function map($item): array
    {
        return [
            ++$this->i,
            $item->village->district->getCode(),
            $item->village->district->name,
            $item->village->code,
            $item->village->name,
            $item->code,
            $item->position_name,
            $item->staffHistory->villageStaff->name ?? '-',
            $item->siltap,
            $item->tunjangan,
            $item->positionTypeStatus->name,
            $item->is_parkir ? 'Ya' : 'Tidak'
        ];
    }



}
