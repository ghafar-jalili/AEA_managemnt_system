<section>
    <header>
        <h2 class="text-xl font-bold text-white">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="mt-1 block w-full bg-slate-900/50 border border-white/10 rounded-xl text-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
            @if($errors->updatePassword->get('current_password'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->updatePassword->get('current_password')[0] }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-slate-300 mb-2">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="mt-1 block w-full bg-slate-900/50 border border-white/10 rounded-xl text-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
            @if($errors->updatePassword->get('password'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->updatePassword->get('password')[0] }}</p>
            @endif
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="mt-1 block w-full bg-slate-900/50 border border-white/10 rounded-xl text-white px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all" />
            @if($errors->updatePassword->get('password_confirmation'))
                <p class="mt-2 text-sm text-red-400">{{ $errors->updatePassword->get('password_confirmation')[0] }}</p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-[0_0_30px_rgba(59,130,246,0.5)] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02]">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
