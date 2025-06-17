<?php

namespace App\Http\Controllers;
use App\Services\CustomResponseService;

abstract class Controller
{
    use CustomResponseService;
}
