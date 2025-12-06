@extends('layouts.admin')

@section('header', 'Tổng quan hệ thống')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-amber-500">
            <h3 class="text-gray-500 font-bold">Tổng số sách</h3>
            <p class="text-3xl font-bold text-amber-600 mt-2">10</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
            <h3 class="text-gray-500 font-bold">Độc giả</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">5</p>
        </div>
    </div>
@endsection