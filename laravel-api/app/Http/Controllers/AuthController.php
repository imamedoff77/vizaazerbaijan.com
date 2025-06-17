<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @param AdminLoginRequest $request
     * @return JsonResponse
     */
    public function login(AdminLoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            if (Auth::attempt($validated)) {
                $token = $request->user()->createToken('token');
                $this->success('Uğurla daxil oldunuz');
                $this->setData([
                    'token' => $token->plainTextToken,
                    'user' => $request->user()
                ]);
            } else {
                $this->error('E-mail və ya şifrə yanlışdır');
            }
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
            $this->success(true);
        } catch (\Exception $e) {
            $this->errorWithLog($e->getMessage());
        }

        return $this->response();
    }
}
