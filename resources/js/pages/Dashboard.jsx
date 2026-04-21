import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { 
    TrendingUp, 
    Users, 
    Briefcase, 
    DollarSign,
    CheckCircle,
    Clock
} from 'lucide-react';
import { 
    BarChart, 
    Bar, 
    XAxis, 
    YAxis, 
    CartesianGrid, 
    Tooltip, 
    Legend, 
    ResponsiveContainer 
} from 'recharts';

const Dashboard = () => {
    const [stats, setStats] = useState(null);
    const [performance, setPerformance] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchStats();
    }, []);

    const fetchStats = async () => {
        try {
            const response = await axios.get('/api/admin/dashboard-stats');
            setStats(response.data.stats);
            setPerformance(response.data.projects_performance);
        } catch (error) {
            console.error('Error fetching stats', error);
        } finally {
            setLoading(false);
        }
    };

    if (loading) return <div className="p-8">Loading dashboard...</div>;

    const cards = [
        { name: 'Total Projects', value: stats?.total_projects, icon: Briefcase, color: 'bg-blue-500' },
        { name: 'Active Projects', value: stats?.active_projects, icon: Clock, color: 'bg-yellow-500' },
        { name: 'Completed', value: stats?.completed_projects, icon: CheckCircle, color: 'bg-green-500' },
        { name: 'Total Revenue', value: `$${stats?.total_revenue?.toLocaleString()}`, icon: DollarSign, color: 'bg-purple-500' },
        { name: 'Investor Funds', value: `$${stats?.investor_funds?.toLocaleString()}`, icon: TrendingUp, color: 'bg-indigo-500' },
        { name: 'Labor Costs', value: `$${stats?.labor_costs?.toLocaleString()}`, icon: Users, color: 'bg-red-500' },
    ];

    return (
        <div className="p-6">
            <h1 className="text-2xl font-bold mb-6">Admin Dashboard</h1>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
                {cards.map((card) => (
                    <div key={card.name} className="bg-white rounded-lg shadow p-4 flex items-center">
                        <div className={`p-3 rounded-full ${card.color} text-white mr-4`}>
                            <card.icon className="w-6 h-6" />
                        </div>
                        <div>
                            <p className="text-gray-500 text-sm">{card.name}</p>
                            <p className="text-xl font-bold">{card.value}</p>
                        </div>
                    </div>
                ))}
            </div>

            <div className="bg-white p-6 rounded-lg shadow mb-8">
                <h2 className="text-lg font-bold mb-4">Project Profitability Analysis</h2>
                <div className="h-80">
                    <ResponsiveContainer width="100%" height="100%">
                        <BarChart data={performance}>
                            <CartesianGrid strokeDasharray="3 3" />
                            <XAxis dataKey="name" />
                            <YAxis />
                            <Tooltip />
                            <Legend />
                            <Bar dataKey="budget" fill="#3b82f6" name="Total Budget" />
                            <Bar dataKey="expenses" fill="#ef4444" name="Total Expenses" />
                            <Bar dataKey="profit" fill="#10b981" name="Profit/Loss" />
                        </BarChart>
                    </ResponsiveContainer>
                </div>
            </div>
        </div>
    );
};

export default Dashboard;
