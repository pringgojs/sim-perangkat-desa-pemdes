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
        return VillageStaff::filter($this->filter)->pensiun($this->filter, $this->isWillRetire)->with(['village.district', 'positionType', 'dataStatus', 'educationLevel', 'histories.positionTypeStatus'])->orderByDefault()->get();
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
            'Kode Jabatan 1',
            'Nama Jabatan 1',
            'Status Jabatan 1',
            'Siltap Jabatan 1',
            'Tunjangan Jabatan 1',
            'THP Jabatan 1',
            /* jabatan plt */
            'Kode Jabatan 2',
            'Nama Jabatan 2',
            'Status Jabatan 2',
            'Siltap Jabatan 2',
            'Tunjangan Jabatan 2',
            'THP Jabatan Jabatan 2',
            'Total THP',
        ];
    }

    public function map($item): array
    {
        $data = [
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
        ];

        $histories = $item->histories;
        $total = 0;
        foreach ($histories as $history) {
            
            $data[] = $history->position_code;
            $data[] = $history->position_name;
            $data[] = $history->positionTypeStatus->name;
            $data[] = $history->siltap;
            $data[] = $history->tunjangan;
            $data[] = $history->thp;

            $total += $history->thp;
        } 

        $data[] = $total;
        return $data;
    }
}
