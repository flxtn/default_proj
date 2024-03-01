@extends('layout.layout')

@section("title", "Homepage")

@section('header')
<div class="p-7 flex">
    <div class="mx-auto">
        <h1 class="text-2xl">HOMEPAGE</h1>
    </div>
    <div class="flex items-center">
        @auth('web')
            <a href="{{route('logout')}}">ВЫЙТИ</a>
        @endauth
    </div>
</div>

@section('content')
<table class="table-auto border-collapse border border-gray-800">
    <thead>
        <tr>
            <th class="px-4 py-2 bg-gray-800 text-white">Domain</th>
            <th class="px-4 py-2 bg-gray-800 text-white">Description</th>
            <th class="px-4 py-2 bg-gray-800 text-white">Requests</th>
            <th class="px-4 py-2 bg-gray-800 text-white">Hosting</th>
            <th class="px-4 py-2 bg-gray-800 text-white">Status</th>
            <th class="px-4 py-2 bg-gray-800 text-white">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td class="border px-4 py-2">{{ $item['domain'] }}</td>
            <td class="border px-4 py-2">{{ $item['description'] }}</td>
            <td class="border px-4 py-2">{{ $item['requests'] }}</td>
            <td class="border px-4 py-2">{{ $item['hosting'] }}</td>
            <td class="border px-4 py-2">{{ $item['status'] }}</td>
            <td class="border px-4 py-2">{{ $item['actions']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection