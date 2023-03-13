<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Usuarios') }}
        </h2>
    </x-slot>
    <div class="mx-auto w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{!isset($user) ? route('create_user' ): route('update_user',['id'=>$user->id]) }}">
            @csrf
            @isset($user)
                @method('patch')
            @endisset
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                @isset($user)
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus autocomplete="name" />
                @else
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                @endisset
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                @isset($user)
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autocomplete="username" />
                @else
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                @endisset
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            @empty($user)
            <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
        
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            @endempty
    
            <div class="flex items-center justify-end mt-4">
    
                <x-primary-button class="ml-4">
                    @isset($user)
                        {{ __('Actualizar') }}
                    @else
                        {{ __('Registrar') }}
                    @endisset
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
