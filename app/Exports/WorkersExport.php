<?php

namespace App\Exports;

use App\Models\Worker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WorkersExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $workers = Worker::orderBy('id')->all();
        return $workers;
    }
    public function headings(): array
    {
        return [
            'id',
            'Name',
            'Position',
            'VP',
            'Area',
            'Type',
            'Company',
            'Country',
            'Location',
            'State',
            'Manager',
        ];
    }
    public function map($vios): array
    {
        return [
            $vios->id,
            $vios->vp->vp_name,
            $vios->area->area_name,
            $vios->date,
            $vios->time,
            $vios->category,
            $vios->involved_ids,
            $vios->involved_names,
            $vios->description,
            $vios->action,
            $vios->vioType->classification,
            "http://127.0.0.1:8000/violations/show/$vios->id"
        ];
    }
}