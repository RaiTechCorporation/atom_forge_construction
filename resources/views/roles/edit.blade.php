<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Edit Role') }}: {{ $role->name }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Update access level and adjust module permissions.') }}
                </p>
            </div>
            <div>
                <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 transition-all text-sm">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-8">
            <!-- Basic Information -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900">{{ __('Role Information') }}</h3>
                </div>
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <x-input-label for="name" :value="__('Role Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $role->name)" required placeholder="e.g. Site Supervisor" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $role->description)" placeholder="Briefly describe what this role can do" />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $role->is_active ? 'checked' : '' }} class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <x-input-label for="is_active" :value="__('Active Status')" class="!mb-0" />
                    </div>
                </div>
            </div>

            <!-- Permission Matrix -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">{{ __('Permission Matrix') }}</h3>
                        <p class="text-sm font-medium text-slate-500 mt-1">{{ __('Select permissions for each module.') }}</p>
                    </div>
                    <button type="button" id="select-all" class="text-xs font-bold text-indigo-600 uppercase tracking-widest hover:text-indigo-700">
                        {{ __('Select All Permissions') }}
                    </button>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @forelse($permissions as $module => $modulePermissions)
                        <div class="p-6 bg-slate-50/50 border border-slate-100 rounded-2xl space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                                <h4 class="font-bold text-slate-800 flex items-center gap-2">
                                    <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                                    {{ $module }}
                                </h4>
                                <button type="button" class="select-module text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600" data-module="{{ Str::slug($module) }}">
                                    {{ __('Toggle All') }}
                                </button>
                            </div>
                            <div class="space-y-3">
                                @foreach($modulePermissions as $permission)
                                <label class="flex items-center gap-3 group cursor-pointer">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} class="permission-checkbox module-{{ Str::slug($module) }} rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900 transition-colors">{{ $permission->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full p-12 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-300">
                            <p class="text-slate-500 font-medium">No permissions found in the database. Please run the seeder.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="p-8 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-4">
                    <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/20">
                        {{ __('Update Role & Permissions') }}
                    </button>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
        });

        document.querySelectorAll('.select-module').forEach(button => {
            button.addEventListener('click', function() {
                const module = this.dataset.module;
                const checkboxes = document.querySelectorAll('.module-' + module);
                const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                checkboxes.forEach(cb => cb.checked = !allChecked);
            });
        });
    </script>
    @endpush
</x-app-layout>
