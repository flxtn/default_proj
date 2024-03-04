<?php

namespace App\Http\Controllers;

use App\Services\MockService;
use Illuminate\View\View;

class IndexController extends Controller
{

    public function __construct(protected MockService $mockService)
    {}

    public function index(): View
    {
        $data = $this->mockService->getData();
        return view('homepage', ["data" => $data]);
    }
}
