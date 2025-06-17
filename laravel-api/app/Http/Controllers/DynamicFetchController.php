<?php

namespace App\Http\Controllers;

use App\Http\Requests\DynamicFetch\GetRequest;
use App\Services\DynamicFetchService;
use Illuminate\Http\JsonResponse;

class DynamicFetchController extends Controller
{

    public function __construct(protected DynamicFetchService $service)
    {
        parent::__construct();
    }


    /**
     * @param GetRequest $request
     * @return JsonResponse
     */
    public function fetch(GetRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $this->res->data = $this->service->fetch($validated['models']);
            $this->success(true);
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }
        return $this->response();
    }
}
