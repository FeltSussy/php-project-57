<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Спасибо за регистрацию! Подтвердите адрес электронной почты, перейдя по ссылке из отправленного письма. Если письмо не пришло, мы можем отправить его ещё раз.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600">
            Новая ссылка для подтверждения отправлена на указанный вами email.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Отправить письмо повторно
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Выйти
            </button>
        </form>
    </div>
</x-guest-layout>
