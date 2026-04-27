import React from 'react';
import { ClipboardList, Search, FilePlus } from 'lucide-react';

const Contracts = () => {
    return (
        <div className="p-8">
            <div className="flex justify-between items-center mb-8">
                <div>
                    <h1 className="text-2xl font-black text-slate-900 flex items-center gap-3 uppercase tracking-tight">
                        <ClipboardList className="w-8 h-8 text-indigo-600" />
                        Contracts
                    </h1>
                    <p className="text-slate-500 mt-1 font-medium">Manage project agreements and vendor contracts</p>
                </div>
                <button className="bg-indigo-600 text-white px-6 py-2.5 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center gap-2 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">
                    <FilePlus className="w-4 h-4" />
                    Create Contract
                </button>
            </div>
            
            <div className="bg-white rounded-[2rem] p-12 border border-slate-100 text-center">
                <div className="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <Search className="w-10 h-10 text-slate-300" />
                </div>
                <h2 className="text-xl font-bold text-slate-900 mb-2">No Contracts Active</h2>
                <p className="text-slate-500 max-w-sm mx-auto">Link your tender leads to contracts once awarded to begin project tracking and milestone management.</p>
            </div>
        </div>
    );
};

export default Contracts;
