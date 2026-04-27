import React from 'react';
import { Users, Filter, Plus } from 'lucide-react';

const Leads = () => {
    return (
        <div className="p-8">
            <div className="flex justify-between items-center mb-8">
                <div>
                    <h1 className="text-2xl font-black text-slate-900 flex items-center gap-3 uppercase tracking-tight">
                        <Users className="w-8 h-8 text-indigo-600" />
                        Tender Leads
                    </h1>
                    <p className="text-slate-500 mt-1 font-medium">Manage UP/Haryana government project tenders</p>
                </div>
                <button className="bg-indigo-600 text-white px-6 py-2.5 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center gap-2 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">
                    <Plus className="w-4 h-4" />
                    New Lead
                </button>
            </div>
            
            <div className="bg-white rounded-[2rem] p-12 border border-slate-100 text-center">
                <div className="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <Filter className="w-10 h-10 text-slate-300" />
                </div>
                <h2 className="text-xl font-bold text-slate-900 mb-2">No Leads Found</h2>
                <p className="text-slate-500 max-w-sm mx-auto">Start by adding your first government project tender lead to track your construction bidding pipeline.</p>
            </div>
        </div>
    );
};

export default Leads;
