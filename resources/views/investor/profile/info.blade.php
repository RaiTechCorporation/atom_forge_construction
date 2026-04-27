<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight">
            {{ __('Personal Information') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        @if (session('status') === 'profile-info-updated')
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold">
                {{ __('Profile information updated successfully.') }}
            </div>
        @endif

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8">
            <div class="flex items-center gap-8 mb-10 pb-10 border-b border-slate-50">
                <div class="w-24 h-24 bg-indigo-600 rounded-3xl flex items-center justify-center text-white text-3xl font-black shadow-xl shadow-indigo-600/20">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight">{{ $user->name }}</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Investor Profile Verified</p>
                </div>
            </div>

            <form method="POST" action="{{ route('investor.profile.info.update') }}" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Full Name</label>
                        <input type="text" value="{{ $user->name }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all opacity-60 cursor-not-allowed" disabled>
                        <p class="text-[9px] font-bold text-slate-400 mt-2 uppercase italic">Managed by Administration</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email Address</label>
                        <input type="email" value="{{ $user->email }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all opacity-60 cursor-not-allowed" disabled>
                        <p class="text-[9px] font-bold text-slate-400 mt-2 uppercase italic">Primary Authentication Email</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $investor->phone) }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" placeholder="Enter phone number">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Address</label>
                        <input type="text" name="address" value="{{ old('address', $investor->address) }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all" placeholder="Enter physical address">
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="px-8 py-4 bg-indigo-600 text-white text-[10px] font-black rounded-2xl uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
