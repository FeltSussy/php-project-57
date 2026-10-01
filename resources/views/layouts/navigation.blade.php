<nav class="border-b border-gray-200 bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-16 flex-wrap items-center justify-between gap-4 py-3">
            <a href="{{ url('/') }}" class="shrink-0 text-xl font-semibold text-black">
                {{ __('navigation.task_manager') }}
            </a>

            <div class="flex flex-wrap items-center gap-4 md:gap-8">
                <a
                    href="{{ url('/tasks') }}"
                    class="text-base text-gray-600 transition hover:text-gray-900"
                >
                    {{ __('navigation.tasks') }}
                </a>

                <a
                    href="{{ url('/task_statuses') }}"
                    class="text-base text-gray-600 transition hover:text-gray-900"
                >
                    {{ __('navigation.statuses') }}
                </a>

                <a
                    href="{{ url('/labels') }}"
                    class="text-base text-gray-600 transition hover:text-gray-900"
                >
                    {{ __('navigation.labels') }}
                </a>
            </div>

            <div class="flex items-center gap-2">
                @auth
                    <a
                        href="{{ route('profile.edit') }}"
                        class="rounded px-3 py-2 text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                    >
                        {{ Auth::user()->name }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="rounded px-3 py-2 text-gray-600 transition hover:bg-gray-50 hover:text-gray-900"
                        >
                            {{ __('navigation.logout') }}
                        </a>
                    </form>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded bg-blue-500 px-4 py-2 text-base font-semibold text-white transition hover:bg-blue-600"
                    >
                        {{ __('navigation.login') }}
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded bg-blue-500 px-4 py-2 text-base font-semibold text-white transition hover:bg-blue-600"
                    >
                        {{ __('navigation.register') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
