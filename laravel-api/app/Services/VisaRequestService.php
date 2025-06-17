<?php

namespace App\Services;

use App\Enums\VisaStatusEnum;
use App\Models\VisaReject;
use App\Models\VisaRequest;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class VisaRequestService
{
    /**
     * @param array $data
     * @return VisaRequest
     */
    public function store(array $data): VisaRequest
    {
        $visa = new VisaRequest();
        $visa->service_id = $data['service_id'];
        $visa->application_number = rand(1000000, 99999999);
        $visa->nationality = $data['nationality'];
        $visa->travel_document = $data['travel_document'];
        $visa->purpose = $data['purpose'];
        $visa->arrival_date = Carbon::parse($data['arrival_date'])->format('Y-m-d H:i:s');
        $visa->surname = $data['surname'];
        $visa->given_name = $data['given_name'];
        $visa->birthday = Carbon::parse($data['birthday'])->format('Y-m-d H:i:s');
        $visa->country_of_birth = $data['country_of_birth'];
        $visa->place_of_birth = $data['place_of_birth'];
        $visa->sex = $data['sex'];
        $visa->occupation = $data['occupation'];
        $visa->phone_number = $data['phone_number'];
        $visa->address = $data['address'];
        $visa->email = $data['email'];
        $visa->passport_file = $data['uploaded_passport_file'];
        $visa->passport_issue_date = Carbon::parse($data['passport_issue_date'])->format('Y-m-d H:i:s');
        $visa->passport_expire_date = Carbon::parse($data['passport_expire_date'])->format('Y-m-d H:i:s');
        $visa->address_in_azerbaijan = $data['address_in_azerbaijan'];
        $visa->save();
        return $visa;
    }

    /**
     * @param array $data
     * @return VisaRequest
     */
    public function changeStatus(array $data): VisaRequest
    {
        $visa = VisaRequest::find($data['id']);
        $visa->status = $data['status'];
        if ($visa->status == VisaStatusEnum::COMPLETED->value) {
            $visa->completed_at = now();
            if (isset($data['message']) && !empty($data['message'])) {
                $visa->completed_message = $data['message'];
            }
        }
        $visa->save();
        return $visa;
    }


    /**
     * @param VisaRequest $visa
     * @param array $data
     * @return VisaReject
     */
    public function rejectVisa(VisaRequest $visa, array $data): VisaReject
    {
        $reject = new VisaReject();
        $reject->visa_id = $visa->id;
        if (isset($data['message']) && !empty($data['message'])) {
            $reject->message = $data['message'];
        }
        $reject->save();
        return $reject;
    }
}
