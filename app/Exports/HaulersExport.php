<?php

namespace App\Exports;

use App\Models\Hauler;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HaulersExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $haulers = Hauler::where('active', 1)->get();
        return $haulers;
    }
    public function map($haulers): array
    {
        return [
            $haulers->id,
            $haulers->name,
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'Hauler Name',
        ];
    }
}