<?php

namespace App\Exports;

use App\Models\VillageStaff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VillageStaffExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $filter;

    public $isWillRetire;

    public function __construct($filter = [], $isWillRetire = false)
    {
        $this->filter = $filter;
        $this->isWillRetire = $isWillRetire;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VillageStaff::filter($this->filter)->pensiun($this->filter, $this->isWillRetire)->with(['village.district', 'positionType', 'dataStatus', 'educationLevel'])->orderByDefault()->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode Kecamatan',
            'Nama Kecamatan',
            'Kode Desa',
            'Nama Desa',
            'Nama 1',
            'Nama 2',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'No. HP',
            'Alamat',
            'Pendidikan',
            'Status Data',
            /* jabatan definitif */
            'Kode Jabatan Definitif',
            'Nama Jabatan Definitif',
            'Status Jabatan Definitif',
            /* jabatan plt */
            'Kode Jabatan Plt/Plh/Pj',
            'Nama Jabatan Plt/Plh/Pj',
            'Status Jabatan Plt/Plh/Pj',

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
            $item->name,
            $item->another_name,
            $item->gender,
            $item->place_of_birth,
            $item->date_of_birth,
            $item->phone_number,
            $item->address,
            $item->educationLevel->name ?? '-',
            $item->dataStatus->name,
            /* jabatan definitif */
            $item->position_code,
            $item->position_name,
            $item->position_is_active ? 'Aktif' : 'Tidak Aktif',
            /* jabatan plt */
            /* jabatan definitif */
            $item->position_plt_code,
            $item->position_plt_name,
            $item->position_plt_is_active ? 'Aktif' : 'Tidak Aktif',
        ];
    }
}
