<nav x-data="{ open: false }" class="border-b border-gray-200 bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ url('/') }}" class="shrink-0 text-xl font-semibold text-black">
                {{ __('navigation.task_manager') }}
            </a>

            <div class="hidden items-center gap-8 md:flex">
                <a href="{{ url('/tasks') }}" class="text-base text-gray-600 transition hover:text-gray-900">{{ __('navigation.tasks') }}</a>
                <a href="{{ url('/task_statuses') }}" class="text-base text-gray-600 transition hover:text-gray-900">{{ __('navigation.statuses') }}</a>
                <a href="{{ url('/labels') }}" class="text-base text-gray-600 transition hover:text-gray-900">{{ __('navigation.labels') }}</a>
            </div>

            <div class="hidden items-center gap-2 md:flex">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-1 rounded-md px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('navigation.profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('navigation.logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="rounded bg-blue-500 px-4 py-2 text-base font-semibold text-white transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('navigation.login') }}
                    </a>
                    <a href="{{ route('register') }}" class="rounded bg-blue-500 px-4 py-2 text-base font-semibold text-white transition hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        {{ __('navigation.register') }}
                    </a>
                @endauth
            </div>

            <button type="button" @click="open = !open" class="inline-flex h-10 w-10 items-center justify-center rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 md:hidden" :aria-expanded="open" aria-label="{{ __('navigation.open_menu') }}">
                <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-gray-200 px-4 py-4 md:hidden">
        <div class="space-y-1">
            <a href="{{ url('/tasks') }}" class="block rounded px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900">{{ __('navigation.tasks') }}</a>
            <a href="{{ url('/task_statuses') }}" class="block rounded px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900">{{ __('navigation.statuses') }}</a>
            <a href="{{ url('/labels') }}" class="block rounded px-3 py-2 text-gray-600 hover:bg-gray-50 hover:text-gray-900">{{ __('navigation.labels') }}</a>
        </div>

        <div class="mt-3 border-t border-gray-200 pt-3">
            @auth
                <div class="px-3 pb-2 text-sm text-gray-500">{{ Auth::user()->name }}</div>
                <a href="{{ route('profile.edit') }}" class="block rounded px-3 py-2 text-gray-600 hover:bg-gray-50">{{ __('navigation.profile') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded px-3 py-2 text-left text-gray-600 hover:bg-gray-50">{{ __('navigation.logout') }}</button>
                </form>
            @else
                <div class="flex gap-2">
                    <a href="{{ route('login') }}" class="rounded bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600">{{ __('navigation.login') }}</a>
                    <a href="{{ route('register') }}" class="rounded bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-600">{{ __('navigation.register') }}</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

