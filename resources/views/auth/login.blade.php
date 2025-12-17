<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mật khẩu" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Quên mật khẩu?
                </a>
            @endif

            <x-primary-button class="ms-3 bg-amber-600 hover:bg-amber-700">
                {{ __('Đăng nhập') }}
            </x-primary-button>
        </div>

        <div class="mt-6 text-center border-t border-gray-200 pt-4">
            <span class="text-sm text-gray-600">Bạn chưa có tài khoản?</span>
            <a href="{{ route('register') }}" class="text-sm font-bold text-amber-700 hover:underline ml-1">
                Đăng ký ngay
            </a>
        </div>
    </form>
</x-guest-layout>