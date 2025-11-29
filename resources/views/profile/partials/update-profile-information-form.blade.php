<section>
    <header>
        <h2 class="text-xl font-bold text-black">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-[#B8948C]">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-black font-bold" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-black font-bold" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl border-[#B8948C]/30 shadow-sm focus:border-[#E73812] focus:ring-[#E73812] transition" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="bg-[#F5CB49]/10 border-l-4 border-[#F5CB49] p-4 mt-2 rounded-r-xl">
                    <p class="text-sm text-black font-medium">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-[#E73812] hover:text-black font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E73812]">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-black hover:bg-[#E73812] border-transparent text-white font-bold py-2.5 px-6 rounded-xl transition shadow-lg shadow-black/20">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold flex items-center"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>