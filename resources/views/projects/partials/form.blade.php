<div class="space-y-16">
    @php
        $sections = [
            [
                'id' => '01',
                'title' => 'Identity',
                'desc' => 'Essential identification details for your construction project.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>',
                'fields' => [
                    ['name' => 'need_funding', 'label' => 'Need Funding', 'type' => 'checkbox', 'span' => 2, 'default' => false],
                    ['name' => 'name', 'label' => 'Project Name', 'type' => 'text', 'placeholder' => 'e.g. Skyline Residency Phase I', 'required' => true, 'span' => 2],
                    ['name' => 'project_code', 'label' => 'Project Code / ID', 'type' => 'text', 'placeholder' => 'e.g. PRJ-2026-001', 'span' => 1],
                    ['name' => 'project_type', 'label' => 'Quality Standard', 'type' => 'select', 'options' => ['Basic', 'Standard', 'Premium', 'Luxury', 'Ultra Luxury', 'Custom'], 'required' => true, 'span' => 1],
                    ['name' => 'building_type', 'label' => 'Structure Category', 'type' => 'select', 'options' => ['Residential', 'Commercial', 'Industrial', 'Infrastructure'], 'required' => true, 'span' => 1],
                    ['name' => 'priority', 'label' => 'Execution Priority', 'type' => 'select', 'options' => ['Low', 'Medium', 'High', 'Urgent'], 'required' => true, 'span' => 1],
                    ['name' => 'description', 'label' => 'Project Abstract', 'type' => 'textarea', 'placeholder' => 'Detailed overview of project scope...', 'span' => 2],
                ]
            ],
            [
                'id' => '02',
                'title' => 'Location',
                'desc' => 'Specific geographical information and site address.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
                'fields' => [
                    ['name' => 'location', 'label' => 'Site Landmark', 'type' => 'text', 'placeholder' => 'e.g. BKC, Mumbai', 'required' => true, 'span' => 2],
                    ['name' => 'site_address', 'label' => 'Full Site Address', 'type' => 'textarea', 'placeholder' => 'Complete mailing address...', 'required' => true, 'span' => 2],
                    ['name' => 'city', 'label' => 'Urban Hub', 'type' => 'text', 'placeholder' => 'City', 'required' => true, 'span' => 1],
                    ['name' => 'state', 'label' => 'State / Region', 'type' => 'text', 'placeholder' => 'State', 'required' => true, 'span' => 1],
                    ['name' => 'country', 'label' => 'Country', 'type' => 'text', 'placeholder' => 'Country', 'required' => true, 'span' => 1],
                    ['name' => 'zip_code', 'label' => 'Postal Code', 'type' => 'text', 'placeholder' => 'Zip Code', 'required' => true, 'span' => 1],
                    ['name' => 'gps_coordinates', 'label' => 'GPS Coordinates', 'type' => 'text', 'placeholder' => '19.0760° N, 72.8777° E', 'span' => 2],
                ]
            ],
            [
                'id' => '03',
                'title' => 'Stakeholders',
                'desc' => 'Primary contacts and responsible parties.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
                'fields' => [
                    ['name' => 'client_name', 'label' => 'Client / Owner', 'type' => 'text', 'placeholder' => 'Proprietor Name', 'required' => true, 'span' => 2],
                    ['name' => 'client_phone', 'label' => 'Client Phone', 'type' => 'text', 'placeholder' => '+91 ...', 'span' => 1],
                    ['name' => 'client_email', 'label' => 'Client Email', 'type' => 'email', 'placeholder' => 'owner@example.com', 'span' => 1],
                    ['name' => 'contractor_name', 'label' => 'Lead Contractor', 'type' => 'text', 'placeholder' => 'Firm Name', 'span' => 1],
                    ['name' => 'project_manager', 'label' => 'Project Director', 'type' => 'text', 'placeholder' => 'PM Name', 'span' => 1],
                    ['name' => 'architect', 'label' => 'Principal Architect', 'type' => 'text', 'placeholder' => 'Architect Name', 'span' => 1],
                    ['name' => 'consultant', 'label' => 'Primary Consultant', 'type' => 'text', 'placeholder' => 'Consultant Name', 'span' => 1],
                    ['name' => 'vendor_list', 'label' => 'Supplier Directory', 'type' => 'textarea', 'placeholder' => 'Key material vendors...', 'span' => 2],
                ]
            ],
            [
                'id' => '04',
                'title' => 'Timeline',
                'desc' => 'Temporal roadmap and milestone schedule.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
                'fields' => [
                    ['name' => 'start_date', 'label' => 'Commencement Date', 'type' => 'date', 'required' => true, 'span' => 1],
                    ['name' => 'end_date', 'label' => 'Target Completion', 'type' => 'date', 'span' => 1],
                    ['name' => 'estimated_duration', 'label' => 'Estimated Duration', 'type' => 'text', 'placeholder' => 'e.g. 18 Months', 'span' => 2],
                    ['name' => 'milestone_planning_approval', 'label' => 'Planning Approval', 'type' => 'date', 'span' => 1],
                    ['name' => 'milestone_foundation_start', 'label' => 'Foundation Start', 'type' => 'date', 'span' => 1],
                    ['name' => 'milestone_structure_completion', 'label' => 'Structure Done', 'type' => 'date', 'span' => 1],
                    ['name' => 'milestone_finishing_phase', 'label' => 'Finishing Phase', 'type' => 'date', 'span' => 1],
                    ['name' => 'milestone_handover', 'label' => 'Final Handover', 'type' => 'date', 'span' => 2],
                ]
            ],
            [
                'id' => '05',
                'title' => 'Financials',
                'desc' => 'Budget allocation and payment provisions.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                'fields' => [
                    ['name' => 'total_budget', 'label' => 'Contract Budget', 'type' => 'number', 'placeholder' => 'Enter the Budget', 'required' => true, 'span' => 2, 'has_units' => true],
                    ['name' => 'est_cost_materials', 'label' => 'Materials Cost', 'type' => 'number', 'placeholder' => '0.00', 'span' => 1],
                    ['name' => 'est_cost_labor', 'label' => 'Labour Cost', 'type' => 'number', 'placeholder' => '0.00', 'span' => 1],
                    ['name' => 'est_cost_equipment', 'label' => 'Equipment Cost', 'type' => 'number', 'placeholder' => '0.00', 'span' => 1],
                    ['name' => 'est_cost_miscellaneous', 'label' => 'Misc Costs', 'type' => 'number', 'placeholder' => '0.00', 'span' => 1],
                    ['name' => 'advance_payment', 'label' => 'Advance Retainer', 'type' => 'number', 'placeholder' => '0.00', 'span' => 1],
                    ['name' => 'billing_cycle', 'label' => 'Billing Cycle', 'type' => 'select', 'options' => ['Milestone-based', 'Monthly'], 'span' => 1],
                    ['name' => 'payment_terms', 'label' => 'Payment Provisions', 'type' => 'textarea', 'placeholder' => 'Terms and conditions...', 'span' => 2],
                ]
            ],
            [
                'id' => '06',
                'title' => 'Specifications',
                'desc' => 'Technical dimensions and material standards.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
                'fields' => [
                    ['name' => 'total_area_sqft', 'label' => 'Total Area (Sq.Ft)', 'type' => 'number', 'placeholder' => '0', 'span' => 1],
                    ['name' => 'number_of_floors', 'label' => 'Floor Count', 'type' => 'number', 'placeholder' => '0', 'span' => 1],
                    ['name' => 'units_count', 'label' => 'Unit Density', 'type' => 'number', 'placeholder' => '0', 'span' => 1],
                    ['name' => 'construction_type', 'label' => 'Build Methodology', 'type' => 'select', 'options' => ['RCC', 'Steel', 'Prefab', 'Other'], 'span' => 1],
                    ['name' => 'material_specifications', 'label' => 'Material Standards', 'type' => 'textarea', 'placeholder' => 'Brand/Quality requirements...', 'span' => 2],
                ]
            ],
            [
                'id' => '07',
                'title' => 'Media & Docs',
                'desc' => 'Visual records and statutory documentation.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
                'fields' => [
                    ['name' => 'design_documents', 'label' => 'Design Schemes', 'type' => 'file', 'multiple' => true, 'span' => 1],
                    ['name' => 'contracts_agreements', 'label' => 'Legal Accords', 'type' => 'file', 'multiple' => true, 'span' => 1],
                    ['name' => 'permits_licenses', 'label' => 'Statutory Permits', 'type' => 'file', 'multiple' => true, 'span' => 1],
                    ['name' => 'safety_documents', 'label' => 'OHS Records', 'type' => 'file', 'multiple' => true, 'span' => 1],
                    ['name' => 'blueprints_layouts', 'label' => 'Site Blueprints', 'type' => 'file', 'multiple' => true, 'span' => 1],
                    ['name' => 'site_media', 'label' => 'Site Media', 'type' => 'file', 'multiple' => true, 'span' => 1],
                ]
            ],
            [
                'id' => '08',
                'title' => 'Settings',
                'desc' => 'Lifecycle status and notification preferences.',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>',
                'fields' => [
                    ['name' => 'status', 'label' => 'Portfolio Status', 'type' => 'select', 'options' => ['Planned', 'Ongoing', 'Completed', 'On Hold'], 'required' => true, 'span' => 2],
                    ['name' => 'deadline_alerts', 'label' => 'Deadline Alerts', 'type' => 'checkbox', 'span' => 1],
                    ['name' => 'budget_alerts', 'label' => 'Budget Alerts', 'type' => 'checkbox', 'span' => 1],
                    ['name' => 'task_reminders', 'label' => 'Task Reminders', 'type' => 'checkbox', 'span' => 1],
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

            <div class="col-span-1 lg:col-span-2 premium-card p-8 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($section['fields'] as $field)
                        <div class="{{ $field['span'] == 2 ? 'md:col-span-2' : '' }}">
                            @if($field['type'] === 'checkbox')
                                <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 transition-all hover:border-indigo-200 group h-full mt-2">
                                    <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="hidden" value="0">
                                    <input id="{{ $field['name'] }}_checkbox" name="{{ $field['name'] }}" type="checkbox" value="1" {{ old($field['name'], $project->{$field['name']} ?? ($field['default'] ?? true)) ? 'checked' : '' }}
                                        class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-600 transition-colors cursor-pointer">
                                    <label for="{{ $field['name'] }}_checkbox" class="text-xs font-black uppercase tracking-widest text-slate-600 cursor-pointer group-hover:text-indigo-700 transition-colors">
                                        {{ __($field['label']) }}
                                    </label>
                                </div>
                            @else
                                <x-input-label for="{{ $field['name'] }}" :value="__($field['label'])" class="stat-label mb-2.5 ml-1" />
                                
                                @if($field['type'] === 'select')
                                    <div class="relative">
                                        <select id="{{ $field['name'] }}" name="{{ $field['name'] }}" class="input-premium appearance-none cursor-pointer pr-12" {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                            @if(!($field['required'] ?? false)) <option value="">{{ __('Select') }}</option> @endif
                                            @foreach($field['options'] as $option)
                                                <option value="{{ $option }}" {{ old($field['name'], $project->{$field['name']} ?? '') == $option ? 'selected' : '' }}>{{ $option }}</option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                @elseif($field['type'] === 'textarea')
                                    <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}" rows="3" class="input-premium" placeholder="{{ $field['placeholder'] }}" {{ ($field['required'] ?? false) ? 'required' : '' }}>{{ old($field['name'], $project->{$field['name']} ?? '') }}</textarea>
                                @elseif($field['type'] === 'file')
                                    <input id="{{ $field['name'] }}" name="{{ $field['name'] }}{{ ($field['multiple'] ?? false) ? '[]' : '' }}" type="file" {{ ($field['multiple'] ?? false) ? 'multiple' : '' }}
                                        class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                                    @if(isset($project) && $project->{$field['name']})
                                        <div class="mt-3 flex flex-wrap gap-1.5">
                                            @foreach((array)$project->{$field['name']} as $file)
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-600 border border-slate-200">{{ basename($file) }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                @elseif($field['type'] === 'number' && ($field['has_units'] ?? false))
                                    <div class="flex gap-4 items-center">
                                        <div class="flex-1 relative">
                                            <input type="number" id="{{ $field['name'] }}_display" step="any" class="input-premium" placeholder="{{ $field['placeholder'] ?? '' }}" oninput="updateBudgetActual('{{ $field['name'] }}')">
                                        </div>
                                        <div class="w-40 relative">
                                            <select id="{{ $field['name'] }}_unit" class="input-premium appearance-none cursor-pointer pr-10" onchange="updateBudgetActual('{{ $field['name'] }}')">
                                                <option value="1">Rupees</option>
                                                <option value="100000">Lakhs</option>
                                                <option value="10000000">Crores</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                        <input type="hidden" name="{{ $field['name'] }}" id="{{ $field['name'] }}" value="{{ old($field['name'], $project->{$field['name']} ?? '') }}">
                                    </div>
                                @else
                                    <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $field['type'] }}" class="input-premium" value="{{ old($field['name'], $project->{$field['name']} instanceof \Carbon\Carbon ? $project->{$field['name']}->format('Y-m-d') : ($project->{$field['name']} ?? '')) }}" placeholder="{{ $field['placeholder'] ?? '' }}" {{ ($field['required'] ?? false) ? 'required' : '' }} />
                                @endif

                                <x-input-error class="mt-2 font-black text-rose-600 text-[10px] uppercase tracking-widest" :messages="$errors->get($field['name'])" />
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <!-- Phase-wise Payments Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-16 pt-16 border-t border-slate-200" x-data="{ 
        phases: {{ json_encode(old('payment_phases', $project->paymentPhases->toArray() ?? [])) }},
        addPhase() {
            this.phases.push({ phase_name: '', amount: '', due_date: '', status: 'Pending' });
        },
        removePhase(index) {
            this.phases.splice(index, 1);
        }
    }">
        <div class="col-span-1">
            <div class="sticky top-24">
                <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-emerald-600/20 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 tracking-tight uppercase">09. Phase Payments</h3>
                <p class="mt-3 text-sm text-slate-500 font-bold leading-relaxed">
                    Define structural payment milestones and release schedules.
                </p>
                <button type="button" @click="addPhase()" class="mt-8 inline-flex items-center px-6 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-100 transition-all border border-emerald-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                    Add Payment Phase
                </button>
            </div>
        </div>

        <div class="col-span-1 lg:col-span-2 space-y-6">
            <template x-for="(phase, index) in phases" :key="index">
                <div class="premium-card p-8 relative group">
                    <button type="button" @click="removePhase(index)" class="absolute top-6 right-6 text-slate-400 hover:text-rose-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="md:col-span-2">
                            <label class="stat-label mb-2.5 ml-1 block">Phase Description</label>
                            <input type="text" :name="`payment_phases[${index}][phase_name]`" x-model="phase.phase_name" class="input-premium" placeholder="e.g. Foundation Completion, 1st Floor Slab" required>
                        </div>
                        <div>
                            <label class="stat-label mb-2.5 ml-1 block">Release Amount</label>
                            <input type="number" :name="`payment_phases[${index}][amount]`" x-model="phase.amount" step="any" class="input-premium" placeholder="0.00" required>
                        </div>
                        <div>
                            <label class="stat-label mb-2.5 ml-1 block">Expected Date</label>
                            <input type="date" :name="`payment_phases[${index}][due_date]`" x-model="phase.due_date" class="input-premium">
                        </div>
                        <div>
                            <label class="stat-label mb-2.5 ml-1 block">Status</label>
                            <div class="relative">
                                <select :name="`payment_phases[${index}][status]`" x-model="phase.status" class="input-premium appearance-none cursor-pointer pr-12" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Partially Paid">Partially Paid</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Overdue">Overdue</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <div x-show="phases.length === 0" class="premium-card p-12 text-center border-dashed">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-1">No Phases Defined</h4>
                <p class="text-xs text-slate-500 font-bold uppercase tracking-tight">Click the button to add payment milestones</p>
            </div>
        </div>
    </div>

    <div class="mt-16 pt-12 border-t border-slate-200 flex flex-col-reverse sm:flex-row justify-end items-center gap-6">
        <a href="{{ route('projects.index') }}" class="w-full sm:w-auto px-8 py-3.5 bg-white border border-slate-200 rounded-2xl font-black text-[10px] text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition-all text-center uppercase tracking-[0.2em]">
            Discard Changes
        </a>
        <button type="submit" class="w-full sm:w-auto px-12 py-3.5 bg-indigo-600 text-white rounded-2xl font-black text-[10px] hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-600/20 uppercase tracking-[0.2em]">
            {{ $submitText }}
        </button>
    </div>
</div>

<script>
    function updateBudgetActual(fieldName) {
        const display = document.getElementById(fieldName + '_display');
        const unit = document.getElementById(fieldName + '_unit');
        const hidden = document.getElementById(fieldName);
        if (display && unit && hidden) {
            if (display.value === "") {
                hidden.value = "";
            } else {
                const val = parseFloat(display.value) || 0;
                const multiplier = parseFloat(unit.value);
                hidden.value = (val * multiplier).toFixed(2);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const displays = document.querySelectorAll('[id$="_display"]');
        displays.forEach(display => {
            const fieldName = display.id.replace('_display', '');
            const hidden = document.getElementById(fieldName);
            const unitSelect = document.getElementById(fieldName + '_unit');
            
            if (hidden && hidden.value && unitSelect) {
                let val = parseFloat(hidden.value);
                if (val >= 10000000) {
                    display.value = (val / 10000000).toFixed(2).replace(/\.00$/, '');
                    unitSelect.value = "10000000";
                } else if (val >= 100000) {
                    display.value = (val / 100000).toFixed(2).replace(/\.00$/, '');
                    unitSelect.value = "100000";
                } else {
                    display.value = val;
                    unitSelect.value = "1";
                }
            }
        });
    });
</script>
