import React from 'react';

const Finance = () => {
    return (
        <div className="p-8">
            <h1 className="text-3xl font-black text-slate-900 uppercase tracking-tight">Finance Operations</h1>
            <p className="text-slate-500 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">Fiscal Oversight & Audit</p>
            
            <div className="mt-8 bg-white p-12 rounded-3xl border-4 border-black shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] text-center">
                <div className="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-600 mx-auto mb-6">
                    <svg className="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 className="text-2xl font-black text-slate-900 tracking-tight mb-2 italic">Monetary Intelligence</h2>
                <p className="text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed">
                    The financial management module is under construction. Advanced ROI analytics, payout tracking, and budget reconciliation features will be available here.
                </p>
            </div>
        </div>
    );
};

export default Finance;
