<?php

namespace App\Http\Controllers;

use App\Enums\VisaStatusEnum;
use App\Exports\VisaExport;
use App\Http\Requests\Visa\ExportExcelRequest;
use App\Http\Requests\VisaRequests\ChangeStatusRequest;
use App\Http\Requests\VisaRequests\CheckStatusRequest;
use App\Http\Requests\VisaRequests\GetRequest;
use App\Http\Requests\VisaRequests\StoreRequest;
use App\Jobs\ToAdmin\NewVisaRequestJob;
use App\Jobs\ToUser\CompletedVisaJob;
use App\Jobs\ToUser\ReceivedVisaJob;
use App\Jobs\ToUser\RejectedVisaJob;
use App\Models\VisaRequest;
use App\Services\UploadService;
use App\Services\VisaRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Maatwebsite\Excel\Facades\Excel;


class VisaRequestController extends Controller
{

    /**
     * @param VisaRequestService $service
     */
    public function __construct(protected VisaRequestService $service)
    {
        parent::__construct();
    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['uploaded_passport_file'] = UploadService::save(
                $request->file('passport_file'),
                'visa/passports'
            );
            $visa = $this->service->store($data);
            $this->success(true);
            ReceivedVisaJob::dispatch($visa);
            NewVisaRequestJob::dispatch($visa); // Yerİni dəyiş. Ödənişdən sonra dispatch olmalıdır
            $this->res->visa = $visa;
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }


    /**
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function delete(GetRequest $request): JsonResponse
    {
        try {
            $visa = VisaRequest::find($request->id);
            $visa->delete();
            $this->success('Visa request silindi');
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param ChangeStatusRequest $request
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            DB::transaction(function () use ($data) {
                $visa = $this->service->changeStatus($data);
                if ($visa->status == VisaStatusEnum::CANCELLED->value) {
                    $visa->rejected = $this->service->rejectVisa($visa, $data);
                    RejectedVisaJob::dispatch($visa->id);
                }

                if ($visa->status == VisaStatusEnum::COMPLETED->value) {
                    CompletedVisaJob::dispatch($visa->id);
                }
                $this->success('Visa statusu dəyişdirildi');
                $this->res->visa = $visa;
            });
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param CheckStatusRequest $request
     * @return JsonResponse
     */
    public function checkStatus(CheckStatusRequest $request): JsonResponse
    {
        $visa = VisaRequest::where([
            'application_number' => $request->application_number,
            'email' => $request->email
        ])
            ->with('service')
            ->first();

        if (empty($visa)) {
            $this->error('Visa request not found');
        } else {
            $this->success(true);
            $this->res->visa = $visa;
        }

        return $this->response();
    }

    /**
     * @param GetRequest $request
     * @return BinaryFileResponse
     */
    public function downloadPassportFile(GetRequest $request): BinaryFileResponse
    {
        $visa = VisaRequest::find($request->id);
        return Response::download($visa->passport_file);
    }

    /**
     * @param ExportExcelRequest $request
     * @return BinaryFileResponse
     */
    public function exportExcel(ExportExcelRequest $request): BinaryFileResponse
    {
        return Excel::download(new VisaExport($request->requests), 'visa_requests.xlsx');
    }
}
