<?php

namespace App\Exports;

use App\Enums\VisaStatusEnum;
use App\Models\VisaRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisaExport implements FromCollection, WithHeadings
{
    public function __construct(protected array $visaRequests)
    {

    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $visaRequests = VisaRequest::select(
            'application_number',
            'given_name',
            'surname',
            'email',
            'phone_number',
            'status'
        )->whereIn('id', $this->visaRequests)->get();

        return $visaRequests->map(function ($item) {
            return [
                'application_number' => $item->application_number,
                'name' => $item->given_name,
                'surname' => $item->surname,
                'email' => $item->email,
                'phone' => $item->phone_number,
                'status' => VisaStatusEnum::getStatusName((int)$item->status),
            ];
        });
    }


    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Application Number',
            'Name',
            'Surname',
            'Email',
            'Phone',
            'Status',
        ];
    }
}
