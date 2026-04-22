<div class="space-y-16">
    @php
        $sections = [
            [
                'id' => '01',
                'title' => 'Personal Information',
                'desc' => 'Basic details for the investor profile.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
                'fields' => [
                    ['name' => 'name', 'label' => 'Full Name', 'type' => 'text', 'placeholder' => 'e.g. John Doe', 'required' => true, 'span' => 2],
                    ['name' => 'email', 'label' => 'Email Address', 'type' => 'email', 'placeholder' => 'e.g. john@example.com', 'required' => true, 'span' => 1],
                    ['name' => 'phone', 'label' => 'Phone Number', 'type' => 'text', 'placeholder' => 'e.g. +91 9876543210', 'required' => true, 'span' => 1],
                    ['name' => 'address', 'label' => 'Physical Address', 'type' => 'textarea', 'placeholder' => 'Complete address...', 'span' => 2],
                ]
            ],
            [
                'id' => '02',
                'title' => 'Account Credentials',
                'desc' => 'Security details for the investor portal access.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>',
                'fields' => [
                    ['name' => 'password', 'label' => 'Portal Password', 'type' => 'password', 'placeholder' => 'Minimum 8 characters', 'required' => !isset($investor), 'span' => 1],
                    ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'type' => 'password', 'placeholder' => 'Repeat password', 'required' => !isset($investor), 'span' => 1],
                ]
            ],
            [
                'id' => '03',
                'title' => 'Status & Settings',
                'desc' => 'Configure investor account status.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>',
                'fields' => [
                    ['name' => 'status', 'label' => 'Account Status', 'type' => 'select', 'options' => ['active', 'inactive'], 'required' => true, 'span' => 2],
                ]
            ]
        ];
    @endphp

    @foreach($sections as $section)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="col-span-1">
                <div class="sticky top-24">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-indigo-600/20 mb-6">
                        {!! $section['icon'] !!}
                    </div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase">{{ $section['id'] }}. {{ __($section['title']) }}</h3>
                    <p class="mt-3 text-sm text-slate-500 font-bold leading-relaxed">
                        {{ __($section['desc']) }}
                    </p>
                </div>
            </div>

            <div class="col-span-1 lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($section['fields'] as $field)
                        <div class="{{ $field['span'] == 2 ? 'md:col-span-2' : '' }}">
                            <label for="{{ $field['name'] }}" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">
                                {{ __($field['label']) }}
                                @if($field['required'] ?? false) <span class="text-rose-500">*</span> @endif
                            </label>
                            
                            @if($field['type'] === 'select')
                                <div class="relative">
                                    <select id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-slate-900 font-bold focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 transition-all appearance-none" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                        @foreach($field['options'] as $option)
                                            <option value="{{ $option }}" {{ old($field['name'], $investor->{$field['name']} ?? '') == $option ? 'selected' : '' }}>{{ ucfirst($option) }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            @elseif($field['type'] === 'textarea')
                                <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" rows="4" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-slate-900 font-bold focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 transition-all" placeholder="{{ $field['placeholder'] }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>{{ old($field['name'], $investor->{$field['name']} ?? '') }}</textarea>
                            @else
                                <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" value="{{ $field['type'] !== 'password' ? old($field['name'], $investor->{$field['name']} ?? '') : '' }}" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 text-slate-900 font-bold focus:bg-white focus:border-indigo-600 focus:ring-4 focus:ring-indigo-600/5 transition-all" placeholder="{{ $field['placeholder'] }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                            @endif
                            
                            @error($field['name'])
                                <p class="mt-2 text-xs font-bold text-rose-500 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-100">
        <a href="{{ route('investors.index') }}" class="px-8 py-4 text-slate-400 hover:text-slate-600 text-xs font-black uppercase tracking-widest transition-all">
            {{ __('Cancel') }}
        </a>
        <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-indigo-600/20 flex items-center gap-3">
            {{ $submitText }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>
</div>
