@extends('layouts.admin')

@section('header', 'Thống kê tổng quan')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-amber-500">
            <h3 class="text-gray-500 text-sm font-medium">Tổng số sách</h3>
            <p class="text-3xl font-bold text-amber-800 mt-2">120</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
            <h3 class="text-gray-500 text-sm font-medium">Độc giả</h3>
            <p class="text-3xl font-bold text-blue-800 mt-2">45</p>
        </div>
    </div>
@endsection