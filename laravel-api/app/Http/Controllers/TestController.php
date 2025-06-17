<?php

namespace App\Http\Controllers;


use App\Enums\VisaStatusEnum;
use App\Models\Page;
use App\Models\Service;
use App\Models\VisaRequest;
use App\Services\CommonService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index()
    {
        echo 'test';
    }
}
