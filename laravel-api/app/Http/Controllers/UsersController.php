<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\DeleteRequest;
use App\Http\Requests\Users\SaveRequest;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(protected UsersService $service)
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
            $user = $this->service->save($request->validated());
            $this->success('İstifadəçi yadda saxlandı');
            $this->res->user = $user;
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param DeleteRequest $request
     * @return JsonResponse
     */
    public function delete(DeleteRequest $request): JsonResponse
    {
        try {
            $user = User::find($request->id);
            $user->delete();
            $this->success('İstifadəçi silindi');
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }
}
