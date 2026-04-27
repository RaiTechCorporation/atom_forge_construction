<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
                    {{ __('Role Management') }}
                </h2>
                <p class="mt-1 text-sm font-medium text-slate-500">
                    {{ __('Manage system access levels and user permissions.') }}
                </p>
            </div>
            <div>
                <a href="{{ route('roles.create') }}" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all text-sm shadow-lg shadow-indigo-600/20">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Create New Role') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('Role Name') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('Slug') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('Description') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('Users') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">{{ __('Status') }}</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-slate-500 text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($roles as $role)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-900">{{ $role->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $role->slug }}</td>
                        <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">{{ $role->description ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600">
                                {{ $role->users_count }} users
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('roles.toggle-status', $role) }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-1.5">
                                    @if($role->is_active)
                                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Active</span>
                                    @else
                                        <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                        <span class="text-xs font-bold text-red-600 uppercase tracking-wider">Inactive</span>
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('roles.edit', $role) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                @if($role->users_count == 0 && !in_array($role->slug, ['super-admin', 'admin']))
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-slate-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                <p class="text-slate-500 font-medium">{{ __('No roles found') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($roles->hasPages())
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
            {{ $roles->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
