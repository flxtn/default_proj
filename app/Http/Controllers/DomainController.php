<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Services\DomainService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class DomainController extends Controller
{

    public function __construct(protected DomainService $domainService)
    {}

    public function index(): View
    {
        $domains = auth()->user()->domains;
        return view('domainpage.domainpage', ['data' => $domains]);
    }

    public function update(Request $request):RedirectResponse
    {
        $data = $request->data;
        $this->domainService->update($data);

        return redirect()->route('domains');

    }

    public function create():RedirectResponse
    {
        $this->domainService->create();
        return redirect()->route('domains');
    }
}

