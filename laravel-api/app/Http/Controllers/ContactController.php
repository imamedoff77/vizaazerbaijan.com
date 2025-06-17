<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\BulkDeleteRequest;
use App\Http\Requests\Contact\GetRequest;
use App\Http\Requests\Contact\SaveRequest;
use App\Jobs\ToAdmin\NewContactMessageJob;
use App\Models\ContactMessage;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function __construct(protected ContactService $service)
    {
        parent::__construct();
    }

    /**
     * @param SaveRequest $request
     * @return JsonResponse
     */
    public function save(SaveRequest $request): JsonResponse
    {
        try {
            $message = $this->service->save($request->validated());
            NewContactMessageJob::dispatch($message);
            $this->success('Message sent successfully');
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function read(GetRequest $request): JsonResponse
    {
        try {
            $message = $this->service->read($request->id);
            $this->success(true);
            $this->res->contact_message = $message;
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
            $message = ContactMessage::find($request->id);
            $message->delete();
            $this->success('Mesaj silindi');
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param BulkDeleteRequest $request
     * @return JsonResponse
     */
    public function bulkDelete(BulkDeleteRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $this->service->bulkDelete($request->messageList);
            });
            $this->success('Seçilən mesajlar silindi');
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }
}
