<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route($route) }}">
        @csrf
        @include('auth.partials.form-login')
    </form>
</x-guest-layout>
