import React, { useState } from 'react';
import { Shield, Check, X, Save } from 'lucide-react';

const Roles = () => {
    const [roleName, setRoleName] = useState('');
    const [dataAccess, setDataAccess] = useState('allocated'); // Default to Allocated Data Access as requested

    const modules = [
        'Leads',
        'Contracts',
        'Projects',
        'Tasks',
        'Expenses',
        'Milestones',
        'Finance',
        'Users',
        'CMS'
    ];

    const actions = ['Manage', 'Create', 'Edit', 'Delete'];

    const [permissions, setPermissions] = useState(
        modules.reduce((acc, module) => {
            acc[module] = actions.reduce((actAcc, action) => {
                actAcc[action] = false;
                return actAcc;
            }, {});
            return acc;
        }, {})
    );

    const togglePermission = (module, action) => {
        setPermissions(prev => ({
            ...prev,
            [module]: {
                ...prev[module],
                [action]: !prev[module][action]
            }
        }));
    };

    const selectAllColumnPermissions = (action, value) => {
        setPermissions(prev => {
            const newPermissions = { ...prev };
            modules.forEach(module => {
                newPermissions[module] = {
                    ...newPermissions[module],
                    [action]: value
                };
            });
            return newPermissions;
        });
    };

    const handleSave = () => {
        console.log('Saving Role:', { roleName, dataAccess, permissions });
        // Here you would integrate with Laravel backend
        alert(`Role "${roleName}" saved with permissions!`);
    };

    return (
        <div className="p-8 bg-slate-50 min-h-screen">
            <div className="max-w-6xl mx-auto">
                <div className="flex justify-between items-center mb-8">
                    <div>
                        <h1 className="text-2xl font-black text-slate-900 flex items-center gap-3 uppercase tracking-tight">
                            <Shield className="w-8 h-8 text-indigo-600" />
                            Role Management
                        </h1>
                        <p className="text-slate-500 mt-1 font-medium">Configure construction-specific access control</p>
                    </div>
                    <button 
                        onClick={handleSave}
                        className="bg-indigo-600 text-white px-6 py-2.5 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center gap-2 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20"
                    >
                        <Save className="w-4 h-4" />
                        Save Role
                    </button>
                </div>

                <div className="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    <div className="p-8 border-b border-slate-100 bg-slate-50/50">
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label className="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Role Name</label>
                                <input 
                                    type="text" 
                                    value={roleName}
                                    onChange={(e) => setRoleName(e.target.value)}
                                    placeholder="e.g., Site Supervisor"
                                    className="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none"
                                />
                            </div>
                            <div>
                                <label className="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Data Access Level</label>
                                <select 
                                    value={dataAccess}
                                    onChange={(e) => setDataAccess(e.target.value)}
                                    className="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none"
                                >
                                    <option value="all">All Data Access</option>
                                    <option value="allocated">Allocated Data Access</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div className="overflow-x-auto">
                        <table className="w-full text-left border-collapse">
                            <thead>
                                <tr className="bg-slate-50/50">
                                    <th className="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest border-b border-slate-100">Module</th>
                                    {actions.map(action => (
                                        <th key={action} className="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest border-b border-slate-100">
                                            <div className="flex flex-col gap-2 items-center">
                                                <span>{action}</span>
                                                <input 
                                                    type="checkbox" 
                                                    onChange={(e) => selectAllColumnPermissions(action, e.target.checked)}
                                                    className="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20"
                                                />
                                            </div>
                                        </th>
                                    ))}
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-slate-50">
                                {modules.map(module => (
                                    <tr key={module} className="hover:bg-slate-50/30 transition-colors">
                                        <td className="px-8 py-5 font-bold text-slate-700 text-sm">{module}</td>
                                        {actions.map(action => (
                                            <td key={action} className="px-8 py-5">
                                                <div className="flex justify-center">
                                                    <button 
                                                        onClick={() => togglePermission(module, action)}
                                                        className={`w-10 h-10 rounded-xl flex items-center justify-center transition-all ${
                                                            permissions[module][action] 
                                                            ? 'bg-indigo-100 text-indigo-600 shadow-inner' 
                                                            : 'bg-slate-100 text-slate-300 hover:bg-slate-200'
                                                        }`}
                                                    >
                                                        {permissions[module][action] ? <Check className="w-5 h-5" /> : <X className="w-4 h-4" />}
                                                    </button>
                                                </div>
                                            </td>
                                        ))}
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div className="mt-8 bg-indigo-50 rounded-2xl p-6 border border-indigo-100">
                    <h3 className="text-indigo-900 font-black uppercase text-[10px] tracking-widest mb-4">Role Configuration Tips</h3>
                    <ul className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <li className="flex gap-3 text-sm text-indigo-700 font-medium">
                            <div className="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></div>
                            Site Supervisors should use "Allocated Data Access" for site security.
                        </li>
                        <li className="flex gap-3 text-sm text-indigo-700 font-medium">
                            <div className="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></div>
                            Tender Executives need full access to Leads and Contracts.
                        </li>
                        <li className="flex gap-3 text-sm text-indigo-700 font-medium">
                            <div className="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></div>
                            Accountants manage Finance and Expenses but usually not Site Tasks.
                        </li>
                        <li className="flex gap-3 text-sm text-indigo-700 font-medium">
                            <div className="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-1.5"></div>
                            Link Leads to Contracts to streamline tender preparation for govt projects.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    );
};

export default Roles;
