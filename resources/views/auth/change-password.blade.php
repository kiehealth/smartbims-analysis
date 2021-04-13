<x-riscc-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{ url('/') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
		
		@if (session('error'))
			<div class="font-medium text-red-600">
            	{{ __('lang.Whoops! Something went wrong.') }}
        	</div>

		<!-- Current Password do not match the password given -->
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li>{{ session('error') }}</li>
        </ul>
        @endif
        
        @if(session()->has('password_updated'))
        <div class="alert alert-success text-justify">
          {!! session('password_updated') !!}  
        </div>
        @else
        <form method="POST" action="{{ route('password.change') }}">
            @csrf


            <!-- Old Password -->
            <div class="mt-4">
                <x-label for="current_password" :value="__('lang.Current Password')" />

                <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" required autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('lang.New Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('lang.Confirm New Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('lang.change-password') }}
                </x-button>
            </div>
        </form>
        @endif
    </x-auth-card>
</x-riscc-layout>
