<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-400">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-slate-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 hover:shadow-[0_0_30px_rgba(239,68,68,0.5)] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02]">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-white">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-slate-300">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 px-4 py-2 bg-slate-900/50 border border-white/20 rounded-lg text-white placeholder-slate-400 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none"
                    placeholder="{{ __('Password') }}"
                />
                @if($errors->userDeletion->get('password'))
                    <p class="mt-2 text-sm text-red-400">{{ $errors->userDeletion->get('password')[0] }}</p>
                @endif
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close-modal', 'confirm-user-deletion')" class="px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-lg transition-colors">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-red-600 to-rose-600 hover:shadow-[0_0_20px_rgba(239,68,68,0.5)] text-white font-semibold rounded-lg transition-all">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
