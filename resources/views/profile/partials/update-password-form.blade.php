<section>
    <header>
        <h2 class="text-xl font-bold text-black">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-[#B8948C]">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" value="{{ __('Current Password') }}" class="text-black font-bold" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="{{ __('New Password') }}" class="text-black font-bold" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-black font-bold" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-black hover:bg-[#E73812] border-transparent text-white font-bold py-2.5 px-6 rounded-xl transition shadow-lg shadow-black/20">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>