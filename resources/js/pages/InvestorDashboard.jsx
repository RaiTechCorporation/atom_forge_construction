import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { TrendingUp, Briefcase, DollarSign, Clock, ShieldCheck } from 'lucide-react';

const InvestorDashboard = () => {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchDashboardData();
    }, []);

    const fetchDashboardData = async () => {
        try {
            const response = await axios.get('/api/investor/dashboard');
            setData(response.data);
        } catch (error) {
            console.error('Error fetching investor dashboard', error);
        } finally {
            setLoading(false);
        }
    };

    if (loading) return <div className="p-8 font-black uppercase tracking-widest text-slate-400 animate-pulse">Retrieving Investment Data...</div>;

    return (
        <div className="p-8 bg-gray-50 min-h-screen">
            <div className="mb-10">
                <h1 className="text-4xl font-black text-slate-900 uppercase tracking-tight">Investor Portal</h1>
                <p className="text-slate-500 font-bold uppercase text-[10px] tracking-[0.4em] mt-2">Capital Performance & Project Oversight</p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div className="bg-white p-8 rounded-[2rem] border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <div className="flex items-center gap-4 mb-4">
                        <div className="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600">
                            <DollarSign className="w-6 h-6" />
                        </div>
                        <span className="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Capital Deployed</span>
                    </div>
                    <p className="text-3xl font-black text-slate-900">${data?.stats?.total_invested?.toLocaleString()}</p>
                </div>
                <div className="bg-white p-8 rounded-[2rem] border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <div className="flex items-center gap-4 mb-4">
                        <div className="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                            <TrendingUp className="w-6 h-6" />
                        </div>
                        <span className="text-[10px] font-black uppercase tracking-widest text-slate-400">Project Count</span>
                    </div>
                    <p className="text-3xl font-black text-slate-900">{data?.stats?.total_projects}</p>
                </div>
                <div className="bg-white p-8 rounded-[2rem] border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <div className="flex items-center gap-4 mb-4">
                        <div className="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600">
                            <ShieldCheck className="w-6 h-6" />
                        </div>
                        <span className="text-[10px] font-black uppercase tracking-widest text-slate-400">Active Allocations</span>
                    </div>
                    <p className="text-3xl font-black text-slate-900">{data?.stats?.active_investments}</p>
                </div>
            </div>

            <h2 className="text-2xl font-black text-slate-900 uppercase tracking-tight mb-8">Active Investment Holdings</h2>
            <div className="grid grid-cols-1 gap-6">
                {data?.investments?.map((investment) => (
                    <div key={investment.id} className="bg-white rounded-[2rem] border-4 border-black overflow-hidden flex flex-col md:flex-row shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                        <div className="md:w-1/3 bg-slate-900 p-8 flex flex-col justify-between text-white">
                            <div>
                                <span className="px-3 py-1 bg-blue-600 text-[10px] font-black uppercase tracking-widest rounded-lg">PRJ-{investment.project?.id}</span>
                                <h3 className="text-2xl font-black mt-4 uppercase tracking-tight">{investment.project?.name}</h3>
                                <p className="text-slate-400 text-sm mt-2 font-bold uppercase tracking-widest flex items-center gap-2">
                                    <Clock className="w-4 h-4" /> {investment.project?.status}
                                </p>
                            </div>
                            <div className="mt-8">
                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-500">Allocation Amount</p>
                                <p className="text-2xl font-black">${investment.investment_amount?.toLocaleString()}</p>
                            </div>
                        </div>
                        <div className="flex-1 p-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                            <div>
                                <p className="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Project Structural Integrity</p>
                                <div className="w-full h-4 bg-slate-100 rounded-full overflow-hidden border-2 border-slate-200">
                                    <div className="h-full bg-blue-600 rounded-full" style={{ width: '45%' }}></div>
                                </div>
                                <p className="text-right text-[10px] font-black text-blue-600 mt-2 uppercase tracking-widest">45% Complete</p>
                            </div>
                            <div className="flex justify-around text-center">
                                <div>
                                    <p className="text-[10px] font-black uppercase tracking-widest text-slate-400">Expected ROI</p>
                                    <p className="text-xl font-black text-emerald-600">+12.5%</p>
                                </div>
                                <div>
                                    <p className="text-[10px] font-black uppercase tracking-widest text-slate-400">Next Payout</p>
                                    <p className="text-xl font-black text-slate-900">Q3 2026</p>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default InvestorDashboard;
