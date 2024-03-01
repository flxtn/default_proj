<?php

namespace App\Http\Controllers;

use App\Services\MockService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected MockService $mockService;

    public function __construct(MockService $mockService)
    {
        $this->mockService = $mockService;
    }

    public function index()
    {
        $data = $this->mockService->getData();
        return view('homepage', ["data" => $data]);
    }
}
