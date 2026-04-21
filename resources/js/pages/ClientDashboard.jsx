import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Home, HardHat, CreditCard, FileText, CheckCircle2 } from 'lucide-react';

const ClientDashboard = () => {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchDashboardData();
    }, []);

    const fetchDashboardData = async () => {
        try {
            const response = await axios.get('/api/client/dashboard');
            setData(response.data);
        } catch (error) {
            console.error('Error fetching client dashboard', error);
        } finally {
            setLoading(false);
        }
    };

    if (loading) return <div className="p-8 font-black uppercase tracking-widest text-slate-400">Loading Your Home Progress...</div>;

    return (
        <div className="p-8 bg-slate-50 min-h-screen">
            <div className="mb-10 flex justify-between items-end">
                <div>
                    <h1 className="text-4xl font-black text-slate-900 uppercase tracking-tight">Client Portal</h1>
                    <p className="text-slate-500 font-bold uppercase text-[10px] tracking-[0.4em] mt-2">Personal Project Oversight Interface</p>
                </div>
                <div className="bg-emerald-100 px-4 py-2 rounded-xl border-2 border-emerald-500">
                    <p className="text-[9px] font-black uppercase tracking-widest text-emerald-700">Account Status</p>
                    <p className="text-xs font-black text-emerald-800 uppercase">Authenticated & Secure</p>
                </div>
            </div>

            {data?.projects?.length === 0 ? (
                <div className="bg-white p-20 rounded-[3rem] border-4 border-dashed border-slate-200 text-center">
                    <Home className="w-16 h-16 text-slate-200 mx-auto mb-6" />
                    <h2 className="text-2xl font-black text-slate-400 uppercase tracking-widest">No Active Construction Found</h2>
                    <p className="text-slate-400 font-bold mt-2">Please contact our administrative office to link your project.</p>
                </div>
            ) : (
                <div className="space-y-12">
                    {data?.projects?.map((project) => (
                        <div key={project.id} className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            {/* Main Progress Card */}
                            <div className="lg:col-span-2 bg-white rounded-[2.5rem] border-4 border-black shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                                <div className="p-10">
                                    <div className="flex justify-between items-start mb-8">
                                        <div>
                                            <span className="px-3 py-1 bg-black text-white text-[10px] font-black uppercase tracking-widest rounded-lg">Property ID: {project.id}</span>
                                            <h2 className="text-3xl font-black text-slate-900 mt-4 uppercase tracking-tight">{project.name}</h2>
                                            <p className="text-slate-500 font-bold text-sm uppercase tracking-widest mt-1 flex items-center gap-2">
                                                <CheckCircle2 className="w-4 h-4 text-blue-600" /> {project.stage} Stage
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <p className="text-[10px] font-black uppercase tracking-widest text-slate-400">Current Phase</p>
                                            <p className="text-lg font-black text-blue-600 uppercase">{project.stage}</p>
                                        </div>
                                    </div>

                                    <div className="mb-12">
                                        <div className="flex justify-between items-end mb-3">
                                            <span className="text-[10px] font-black uppercase tracking-widest text-slate-500">Total Construction Progress</span>
                                            <span className="text-2xl font-black text-slate-900">72%</span>
                                        </div>
                                        <div className="w-full h-6 bg-slate-100 rounded-2xl border-2 border-black p-1">
                                            <div className="h-full bg-blue-600 rounded-xl" style={{ width: '72%' }}></div>
                                        </div>
                                    </div>

                                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div className="bg-slate-50 p-6 rounded-2xl border-2 border-slate-100">
                                            <HardHat className="w-6 h-6 text-slate-400 mb-4" />
                                            <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Project Manager</p>
                                            <p className="font-black text-slate-900">Alan Turing</p>
                                        </div>
                                        <div className="bg-slate-50 p-6 rounded-2xl border-2 border-slate-100">
                                            <CreditCard className="w-6 h-6 text-slate-400 mb-4" />
                                            <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Next Payment</p>
                                            <p className="font-black text-slate-900">Oct 12, 2026</p>
                                        </div>
                                        <div className="bg-slate-50 p-6 rounded-2xl border-2 border-slate-100">
                                            <FileText className="w-6 h-6 text-slate-400 mb-4" />
                                            <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Agreements</p>
                                            <p className="font-black text-blue-600">Download PDF</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Updates Timeline */}
                            <div className="bg-black text-white rounded-[2.5rem] p-10 shadow-[12px_12px_0px_0px_rgba(59,130,246,0.3)]">
                                <h3 className="text-xl font-black uppercase tracking-widest mb-8 border-b border-white/10 pb-4 italic">Recent Logs</h3>
                                <div className="space-y-8">
                                    {project.project_updates?.length === 0 ? (
                                        <p className="text-slate-500 text-xs font-black uppercase italic">No logs available for this cycle.</p>
                                    ) : (
                                        project.project_updates?.map((update, idx) => (
                                            <div key={idx} className="relative pl-6 border-l-2 border-blue-600">
                                                <div className="absolute -left-[9px] top-0 w-4 h-4 bg-blue-600 rounded-full border-4 border-black"></div>
                                                <p className="text-[10px] font-black text-slate-500 uppercase mb-1">{new Date(update.created_at).toLocaleDateString()}</p>
                                                <p className="text-sm font-bold leading-relaxed">{update.description}</p>
                                            </div>
                                        ))
                                    )}
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

export default ClientDashboard;
