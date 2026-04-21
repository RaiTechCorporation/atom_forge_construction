import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Plus, Edit, Trash2, Check, X, Shield, Star, Crown, Zap, Home } from 'lucide-react';

const Plans = () => {
    const [plans, setPlans] = useState([]);
    const [loading, setLoading] = useState(true);
    const [isEditing, setIsEditing] = useState(false);
    const [currentPlan, setCurrentPlan] = useState({ name: '', price_per_sqft: '', features: [], is_active: true });
    const [newFeature, setNewFeature] = useState('');

    useEffect(() => {
        fetchPlans();
    }, []);

    const fetchPlans = async () => {
        try {
            const response = await axios.get('/api/admin/plans');
            setPlans(response.data);
        } catch (error) {
            console.error('Error fetching plans', error);
        } finally {
            setLoading(false);
        }
    };

    const handleSave = async (e) => {
        e.preventDefault();
        try {
            if (currentPlan.id) {
                await axios.put(`/api/admin/plans/${currentPlan.id}`, currentPlan);
            } else {
                await axios.post('/api/admin/plans', currentPlan);
            }
            setIsEditing(false);
            setCurrentPlan({ name: '', price_per_sqft: '', features: [], is_active: true });
            fetchPlans();
        } catch (error) {
            console.error('Error saving plan', error);
        }
    };

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure you want to delete this plan?')) {
            try {
                await axios.delete(`/api/admin/plans/${id}`);
                fetchPlans();
            } catch (error) {
                console.error('Error deleting plan', error);
            }
        }
    };

    const addFeature = () => {
        if (newFeature.trim()) {
            setCurrentPlan({
                ...currentPlan,
                features: [...(currentPlan.features || []), newFeature.trim()]
            });
            setNewFeature('');
        }
    };

    const removeFeature = (index) => {
        const updatedFeatures = [...currentPlan.features];
        updatedFeatures.splice(index, 1);
        setCurrentPlan({ ...currentPlan, features: updatedFeatures });
    };

    if (loading) return <div className="p-8 font-black uppercase tracking-widest text-slate-400">Loading Pricing Infrastructure...</div>;

    const getPlanIcon = (name) => {
        const n = name.toLowerCase();
        if (n.includes('ultra')) return <Crown className="w-6 h-6" />;
        if (n.includes('luxury')) return <Star className="w-6 h-6" />;
        if (n.includes('premium')) return <Zap className="w-6 h-6" />;
        if (n.includes('investor')) return <Shield className="w-6 h-6" />;
        return <Home className="w-6 h-6" />;
    };

    return (
        <div className="p-8 bg-slate-50 min-h-screen">
            <div className="flex justify-between items-center mb-10">
                <div>
                    <h1 className="text-4xl font-black text-slate-900 uppercase tracking-tight italic">Pricing Architecture</h1>
                    <p className="text-slate-500 font-bold uppercase text-[10px] tracking-[0.4em] mt-2">Manage Construction Plans & Fiscal Parameters</p>
                </div>
                <button 
                    onClick={() => { setIsEditing(true); setCurrentPlan({ name: '', price_per_sqft: '', features: [], is_active: true }); }}
                    className="flex items-center px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-500/20"
                >
                    <Plus className="w-4 h-4 mr-2" />
                    Initialize New Plan
                </button>
            </div>

            {isEditing && (
                <div className="bg-white p-10 rounded-[2.5rem] shadow-2xl mb-12 border-4 border-black relative overflow-hidden">
                    <div className="absolute top-0 right-0 p-8">
                        <button onClick={() => setIsEditing(false)} className="text-slate-300 hover:text-black transition-colors">
                            <X className="w-8 h-8" />
                        </button>
                    </div>
                    
                    <h2 className="text-2xl font-black mb-8 uppercase tracking-widest italic">{currentPlan.id ? 'Modify Plan Protocol' : 'Deploy New Plan Protocol'}</h2>
                    
                    <form onSubmit={handleSave} className="space-y-8">
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div className="space-y-3">
                                <label className="text-[10px] font-black uppercase tracking-widest text-slate-500">Plan Designation</label>
                                <input 
                                    type="text" 
                                    required
                                    className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-lg"
                                    value={currentPlan.name}
                                    onChange={(e) => setCurrentPlan({...currentPlan, name: e.target.value})}
                                    placeholder="e.g. ULTRA LUXURY"
                                />
                            </div>
                            <div className="space-y-3">
                                <label className="text-[10px] font-black uppercase tracking-widest text-slate-500">Price Rate (Per Sq Ft)</label>
                                <div className="relative">
                                    <span className="absolute left-6 top-1/2 -translate-y-1/2 font-black text-slate-400">$</span>
                                    <input 
                                        type="number" 
                                        required
                                        className="block w-full py-4 pl-10 pr-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-lg"
                                        value={currentPlan.price_per_sqft}
                                        onChange={(e) => setCurrentPlan({...currentPlan, price_per_sqft: e.target.value})}
                                    />
                                </div>
                            </div>
                        </div>

                        <div className="space-y-3">
                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500">Structural Features & Specifications</label>
                            <div className="flex gap-4">
                                <input 
                                    type="text"
                                    className="flex-1 py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold"
                                    value={newFeature}
                                    onChange={(e) => setNewFeature(e.target.value)}
                                    placeholder="Add specific feature..."
                                    onKeyPress={(e) => e.key === 'Enter' && (e.preventDefault(), addFeature())}
                                />
                                <button 
                                    type="button"
                                    onClick={addFeature}
                                    className="px-8 bg-black text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-slate-800 transition-all"
                                >
                                    Add Feature
                                </button>
                            </div>
                            
                            <div className="flex flex-wrap gap-3 mt-6">
                                {currentPlan.features?.map((feature, idx) => (
                                    <div key={idx} className="flex items-center gap-2 bg-slate-50 border-2 border-slate-200 px-4 py-2 rounded-xl font-bold text-sm text-slate-700">
                                        {feature}
                                        <button type="button" onClick={() => removeFeature(idx)} className="text-slate-400 hover:text-red-600">
                                            <X className="w-4 h-4" />
                                        </button>
                                    </div>
                                ))}
                            </div>
                        </div>

                        <div className="flex justify-end pt-6">
                            <button 
                                type="submit" 
                                className="px-12 py-5 bg-blue-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-blue-700 transition-all shadow-2xl shadow-blue-600/30"
                            >
                                {currentPlan.id ? 'Commit Protocol Changes' : 'Initialize Plan Deployment'}
                            </button>
                        </div>
                    </form>
                </div>
            )}

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {plans.map((plan) => (
                    <div key={plan.id} className="bg-white rounded-[2.5rem] border-4 border-black p-10 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex flex-col hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all duration-300">
                        <div className="flex justify-between items-start mb-8">
                            <div className="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(59,130,246,1)]">
                                {getPlanIcon(plan.name)}
                            </div>
                            <div className="flex gap-2">
                                <button onClick={() => { setIsEditing(true); setCurrentPlan(plan); }} className="p-2 text-slate-400 hover:text-blue-600 transition-colors">
                                    <Edit className="w-5 h-5" />
                                </button>
                                <button onClick={() => handleDelete(plan.id)} className="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                    <Trash2 className="w-5 h-5" />
                                </button>
                            </div>
                        </div>

                        <h3 className="text-2xl font-black text-slate-900 uppercase tracking-tight mb-2">{plan.name}</h3>
                        <div className="mb-8">
                            <span className="text-4xl font-black text-blue-600">${plan.price_per_sqft}</span>
                            <span className="text-slate-400 font-bold uppercase text-[10px] tracking-widest ml-2">/ SQ FT</span>
                        </div>

                        <div className="flex-grow space-y-4 mb-10">
                            {plan.features?.map((feature, idx) => (
                                <div key={idx} className="flex items-center gap-3 text-sm font-bold text-slate-600">
                                    <div className="w-5 h-5 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600">
                                        <Check className="w-3.5 h-3.5" />
                                    </div>
                                    {feature}
                                </div>
                            ))}
                        </div>

                        <div className="pt-6 border-t-2 border-slate-50 flex justify-between items-center">
                            <span className={`text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-lg ${
                                plan.is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700'
                            }`}>
                                {plan.is_active ? 'Protocol Active' : 'Protocol Halted'}
                            </span>
                            <span className="text-[9px] font-black text-slate-300 uppercase tracking-widest">ID: {plan.id?.toString().padStart(4, '0')}</span>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Plans;
