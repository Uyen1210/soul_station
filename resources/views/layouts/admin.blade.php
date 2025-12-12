<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Soul Station</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#f5f5dc]">
    <div class="min-h-screen flex">

        <aside class="w-64 bg-white border-r border-amber-100 shadow-lg fixed h-full z-10">
            <div class="h-16 flex items-center justify-center border-b border-amber-100">
                <span class="text-2xl font-bold text-amber-800">Soul Station</span>
            </div>

            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-amber-50 hover:text-amber-900 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-amber-100 font-bold text-amber-900' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.books.index') }}"
                    class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-amber-50 hover:text-amber-900 transition-colors {{ request()->routeIs('admin.books.*') ? 'bg-amber-100 font-bold text-amber-900' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <span>Quản lý Sách</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-amber-50 hover:text-amber-900 transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-amber-100 font-bold text-amber-900' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    <span>Quản lý Danh mục</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-amber-50 hover:text-amber-900 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-amber-100 font-bold text-amber-900' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <span>Quản lý Độc giả</span>
                </a>

                <a href="{{ route('admin.borrows.index') }}"
                    class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-amber-50 hover:text-amber-900 transition-colors {{ request()->routeIs('admin.borrows.*') ? 'bg-amber-100 font-bold text-amber-900' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    <span>Quản lý Mượn/Trả</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 ml-64 flex flex-col min-h-screen">

            <header class="bg-white shadow-sm h-16 flex justify-between items-center px-8 border-b border-amber-100">
                <h2 class="font-semibold text-xl text-amber-800 leading-tight">
                    @yield('header', 'Admin Dashboard')
                </h2>

                <div class="flex items-center">
                    <span class="mr-4 text-gray-600">Xin chào, {{ Auth::user()->name ?? 'Admin' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-8">
                @yield('content')
            </main>

            <footer class="bg-white border-t border-amber-100 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Soul Station Library. All rights reserved.
            </footer>
        </div>
    </div>
</body>

</html>