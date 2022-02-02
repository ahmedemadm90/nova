<?php

namespace App\Exports;

use App\Models\Violation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ViolationsExport implements FromCollection, WithMapping, WithHeadings
{
    public function __construct(String $date_from = null, String $date_to = null)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (!isset($this->date_from) && !isset($this->date_to)) {
            $vios = Violation::get();
            return $vios;
        } else {
            $date_from = $this->date_from;
            $date_to = $this->date_to;
            $vios = Violation::whereBetween('date', [$date_from, $date_to])->get();
            return $vios;
        }
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
            $vios->vioType->classification,
            $vios->involved_ids,
            $vios->involved_names,
            $vios->description,
            $vios->action,
            $vios->vioType->classification,
            $vios->operator->name,
            "http://127.0.0.1:8000/egy/violations/show/$vios->id"
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'VP',
            'Area',
            'Date',
            'Time',
            'category',
            'Classification',
            'Involved IDs',
            'Involved Names',
            'Desc',
            'Actions',
            'Classification',
            'Register By',
            'Images & Video',
        ];
    }
}
