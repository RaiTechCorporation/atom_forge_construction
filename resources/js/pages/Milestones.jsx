import React from 'react';

const Milestones = () => {
    return (
        <div className="p-8">
            <h1 className="text-3xl font-black text-slate-900 uppercase tracking-tight">Milestones Management</h1>
            <p className="text-slate-500 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">Project Phase Control</p>
            
            <div className="mt-8 bg-white p-12 rounded-3xl border-4 border-black shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] text-center">
                <div className="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center text-indigo-600 mx-auto mb-6">
                    <svg className="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <h2 className="text-2xl font-black text-slate-900 tracking-tight mb-2 italic">Phase Tracking System</h2>
                <p className="text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed">
                    This module is currently being initialized. Soon you will be able to track and manage all project milestones and phase transitions from this interface.
                </p>
            </div>
        </div>
    );
};

export default Milestones;
