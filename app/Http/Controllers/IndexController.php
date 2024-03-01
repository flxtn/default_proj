<?php

namespace App\Http\Controllers;

use App\Services\MockService;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct(protected MockService $mockService)
    {}

    public function index()
    {
        $data = $this->mockService->getData();
        return view('homepage', ["data" => $data]);
    }
}
