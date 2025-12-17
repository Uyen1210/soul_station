<x-app-layout>
    {{-- PHẦN HEADER: Tiêu đề trang hiển thị trên thanh xám --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thông Tin Cá Nhân') }}
        </h2>
    </x-slot>

    {{-- PHẦN NỘI DUNG CHÍNH --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Hiển thị thông báo thành công --}}
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Form cập nhật thông tin --}}
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        {{-- Nhập Tên --}}
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Tên:</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email (Readonly) --}}
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email (không thể chỉnh
                                sửa):</label>
                            <input type="email" id="email" value="{{ $user->email }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" disabled>
                        </div>

                        {{-- Số điện thoại --}}
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Số điện thoại:</label>
                            <input type="text" name="phone" id="phone" value="{{ $user->phone ?? '' }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Địa chỉ --}}
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">Địa chỉ:</label>
                            <input type="text" name="address" id="address" value="{{ $user->address ?? '' }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nút Submit --}}
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cập Nhật Thông Tin
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>