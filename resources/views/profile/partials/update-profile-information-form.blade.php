<section>
    <header>
        <h2 class="text-xl font-bold text-white">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-slate-400">
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
            <label for="name" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                class="mt-1 block w-full bg-slate-900/50 border border-white/10 rounded-xl text-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
            @if($errors->get('name'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->get('name')[0] }}</p>
            @endif
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                class="mt-1 block w-full bg-slate-900/50 border border-white/10 rounded-xl text-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
            @if($errors->get('email'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->get('email')[0] }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-slate-400">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-blue-400 hover:text-blue-300 transition-colors">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02]">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
