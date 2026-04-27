import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { 
    UserPlus, 
    Shield, 
    Mail, 
    User as UserIcon, 
    Lock, 
    Calendar, 
    MapPin, 
    Settings as SettingsIcon,
    Phone,
    Globe,
    Check,
    X,
    Trash2,
    Edit as EditIcon
} from 'lucide-react';

const Users = () => {
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [isEditing, setIsEditing] = useState(false);
    const [currentUser, setCurrentUser] = useState({
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: '',
        dob: '',
        joining_date: '',
        role: 'client',
        address: '',
        city: '',
        state: '',
        country: '',
        zip: '',
        status: true,
        email_verified: false
    });

    useEffect(() => {
        fetchUsers();
    }, []);

    const fetchUsers = async () => {
        try {
            const response = await axios.get('/api/admin/users');
            setUsers(response.data);
        } catch (error) {
            console.error('Error fetching users', error);
        } finally {
            setLoading(false);
        }
    };

    const handleSave = async (e) => {
        e.preventDefault();
        try {
            const userData = {
                ...currentUser,
                name: `${currentUser.first_name} ${currentUser.last_name}`.trim()
            };

            if (currentUser.id) {
                await axios.put(`/api/admin/users/${currentUser.id}`, userData);
            } else {
                await axios.post('/api/admin/users', userData);
            }
            setIsEditing(false);
            resetForm();
            fetchUsers();
        } catch (error) {
            console.error('Error saving user', error);
        }
    };

    const resetForm = () => {
        setCurrentUser({
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            password: '',
            password_confirmation: '',
            dob: '',
            joining_date: '',
            role: 'client',
            address: '',
            city: '',
            state: '',
            country: '',
            zip: '',
            status: true,
            email_verified: false
        });
    };

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure you want to delete this user?')) {
            try {
                await axios.delete(`/api/admin/users/${id}`);
                fetchUsers();
            } catch (error) {
                console.error('Error deleting user', error);
            }
        }
    };

    if (loading) return <div className="p-8 font-black uppercase tracking-widest text-slate-400 text-center mt-20">Synchronizing User Database...</div>;

    return (
        <div className="p-8 bg-slate-50 min-h-screen">
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div>
                    <h1 className="text-4xl font-black text-slate-900 uppercase tracking-tight italic">Personnel Registry</h1>
                    <p className="text-slate-500 font-bold uppercase text-[10px] tracking-[0.4em] mt-2">Manage System Access & User Identities</p>
                </div>
                <button 
                    onClick={() => { setIsEditing(true); resetForm(); }}
                    className="flex items-center px-8 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-500/20 active:scale-95"
                >
                    <UserPlus className="w-4 h-4 mr-2" />
                    Add New User
                </button>
            </div>

            {isEditing && (
                <div className="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                    <div className="bg-white w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-[2.5rem] shadow-2xl border-4 border-black relative custom-scrollbar">
                        <div className="sticky top-0 bg-white border-b-4 border-black p-8 flex justify-between items-center z-10">
                            <div>
                                <h2 className="text-2xl font-black uppercase tracking-widest italic text-slate-900">
                                    {currentUser.id ? 'Modify User Profile' : 'User Creation Protocol'}
                                </h2>
                                <p className="text-slate-400 font-bold uppercase text-[9px] tracking-widest mt-1">Configure user access and personal parameters</p>
                            </div>
                            <button onClick={() => setIsEditing(false)} className="w-12 h-12 rounded-xl flex items-center justify-center text-slate-300 hover:text-black hover:bg-slate-50 transition-all border-2 border-transparent hover:border-slate-100">
                                <X className="w-8 h-8" />
                            </button>
                        </div>
                        
                        <form onSubmit={handleSave} className="p-10 space-y-16">
                            {/* Personal Info */}
                            <section className="relative">
                                <div className="flex items-center gap-4 mb-8">
                                    <div className="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-600/20">
                                        <UserIcon className="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-black uppercase tracking-tight text-slate-900">👤 Personal Info</h3>
                                        <p className="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Primary Identification Data</p>
                                    </div>
                                </div>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">First Name</label>
                                        <input 
                                            type="text" required
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 placeholder:text-slate-300"
                                            value={currentUser.first_name}
                                            onChange={(e) => setCurrentUser({...currentUser, first_name: e.target.value})}
                                            placeholder="John"
                                        />
                                    </div>
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Last Name</label>
                                        <input 
                                            type="text" required
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 placeholder:text-slate-300"
                                            value={currentUser.last_name}
                                            onChange={(e) => setCurrentUser({...currentUser, last_name: e.target.value})}
                                            placeholder="Doe"
                                        />
                                    </div>
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Email Address</label>
                                        <div className="relative">
                                            <Mail className="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300" />
                                            <input 
                                                type="email" required
                                                className="block w-full py-4 pl-14 pr-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 placeholder:text-slate-300"
                                                value={currentUser.email}
                                                onChange={(e) => setCurrentUser({...currentUser, email: e.target.value})}
                                                placeholder="john.doe@atomforge.com"
                                            />
                                        </div>
                                    </div>
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Phone Number</label>
                                        <div className="relative">
                                            <Phone className="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300" />
                                            <input 
                                                type="tel"
                                                className="block w-full py-4 pl-14 pr-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 placeholder:text-slate-300"
                                                value={currentUser.phone}
                                                onChange={(e) => setCurrentUser({...currentUser, phone: e.target.value})}
                                                placeholder="+1 (555) 000-0000"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {/* Security */}
                            <section>
                                <div className="flex items-center gap-4 mb-8">
                                    <div className="w-12 h-12 bg-red-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-red-600/20">
                                        <Lock className="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-black uppercase tracking-tight text-slate-900">🔐 Security</h3>
                                        <p className="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Authentication Protocols</p>
                                    </div>
                                </div>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Secure Password</label>
                                        <input 
                                            type="password" required={!currentUser.id}
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 placeholder:text-slate-300"
                                            value={currentUser.password}
                                            onChange={(e) => setCurrentUser({...currentUser, password: e.target.value})}
                                            placeholder="••••••••"
                                        />
                                    </div>
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Confirm Password</label>
                                        <input 
                                            type="password" required={!currentUser.id}
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 placeholder:text-slate-300"
                                            value={currentUser.password_confirmation}
                                            onChange={(e) => setCurrentUser({...currentUser, password_confirmation: e.target.value})}
                                            placeholder="••••••••"
                                        />
                                    </div>
                                </div>
                            </section>

                            {/* Details */}
                            <section>
                                <div className="flex items-center gap-4 mb-8">
                                    <div className="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-600/20">
                                        <Calendar className="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-black uppercase tracking-tight text-slate-900">📅 Details</h3>
                                        <p className="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Temporal & Organizational Data</p>
                                    </div>
                                </div>
                                <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Date of Birth</label>
                                        <input 
                                            type="date"
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900"
                                            value={currentUser.dob}
                                            onChange={(e) => setCurrentUser({...currentUser, dob: e.target.value})}
                                        />
                                    </div>
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Joining Date</label>
                                        <input 
                                            type="date"
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900"
                                            value={currentUser.joining_date}
                                            onChange={(e) => setCurrentUser({...currentUser, joining_date: e.target.value})}
                                        />
                                    </div>
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Assigned Role</label>
                                        <select 
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%22%20stroke%3D%22%2394a3b8%22%20stroke-width%3D%222.5%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20d%3D%22M19%209l-7%207-7-7%22%20%2F%3E%3C%2Fsvg%3E')] bg-[length:1.25rem] bg-[right_1.5rem_center] bg-no-repeat"
                                            value={currentUser.role}
                                            onChange={(e) => setCurrentUser({...currentUser, role: e.target.value})}
                                        >
                                            <option value="super_admin">Super Admin</option>
                                            <option value="project_manager">Project Manager</option>
                                            <option value="tender_executive">Tender Executive</option>
                                            <option value="site_supervisor">Site Supervisor</option>
                                            <option value="accountant">Accountant</option>
                                            <option value="client">Client</option>
                                            <option value="investor">Investor</option>
                                        </select>
                                    </div>
                                </div>
                            </section>

                            {/* Address Info */}
                            <section>
                                <div className="flex items-center gap-4 mb-8">
                                    <div className="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-600/20">
                                        <MapPin className="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-black uppercase tracking-tight text-slate-900">📍 Address Info</h3>
                                        <p className="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Geographic Location Parameters</p>
                                    </div>
                                </div>
                                <div className="space-y-8">
                                    <div className="space-y-3">
                                        <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Street Address</label>
                                        <input 
                                            type="text"
                                            className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900 placeholder:text-slate-300"
                                            value={currentUser.address}
                                            onChange={(e) => setCurrentUser({...currentUser, address: e.target.value})}
                                            placeholder="123 Industrial Way, Tech Park"
                                        />
                                    </div>
                                    <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                                        <div className="space-y-3">
                                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">City</label>
                                            <input 
                                                type="text"
                                                className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900"
                                                value={currentUser.city}
                                                onChange={(e) => setCurrentUser({...currentUser, city: e.target.value})}
                                                placeholder="Metropolis"
                                            />
                                        </div>
                                        <div className="space-y-3">
                                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">State</label>
                                            <input 
                                                type="text"
                                                className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900"
                                                value={currentUser.state}
                                                onChange={(e) => setCurrentUser({...currentUser, state: e.target.value})}
                                                placeholder="NY"
                                            />
                                        </div>
                                        <div className="space-y-3">
                                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Country</label>
                                            <input 
                                                type="text"
                                                className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900"
                                                value={currentUser.country}
                                                onChange={(e) => setCurrentUser({...currentUser, country: e.target.value})}
                                                placeholder="USA"
                                            />
                                        </div>
                                        <div className="space-y-3">
                                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500 ml-2">Zip Code</label>
                                            <input 
                                                type="text"
                                                className="block w-full py-4 px-6 border-4 border-slate-100 rounded-2xl focus:border-blue-600 focus:ring-0 font-bold text-slate-900"
                                                value={currentUser.zip}
                                                onChange={(e) => setCurrentUser({...currentUser, zip: e.target.value})}
                                                placeholder="10001"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </section>

                            {/* Settings */}
                            <section>
                                <div className="flex items-center gap-4 mb-8">
                                    <div className="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-amber-500/20">
                                        <SettingsIcon className="w-6 h-6" />
                                    </div>
                                    <div>
                                        <h3 className="text-xl font-black uppercase tracking-tight text-slate-900">⚙️ Settings</h3>
                                        <p className="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Operational Configurations</p>
                                    </div>
                                </div>
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div className="flex items-center justify-between p-8 bg-slate-50 rounded-[2rem] border-4 border-slate-100 hover:border-blue-100 transition-colors">
                                        <div>
                                            <p className="font-black uppercase tracking-widest text-xs text-slate-900">Account Status</p>
                                            <p className="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">Enable/Disable User Access</p>
                                        </div>
                                        <button 
                                            type="button"
                                            onClick={() => setCurrentUser({...currentUser, status: !currentUser.status})}
                                            className={`w-16 h-9 rounded-full transition-all relative border-2 ${currentUser.status ? 'bg-blue-600 border-blue-700' : 'bg-slate-200 border-slate-300'}`}
                                        >
                                            <div className={`absolute top-1 w-5 h-5 bg-white rounded-full transition-all shadow-md ${currentUser.status ? 'left-8' : 'left-1'}`} />
                                        </button>
                                    </div>
                                    <div className="flex items-center justify-between p-8 bg-slate-50 rounded-[2rem] border-4 border-slate-100 hover:border-emerald-100 transition-colors">
                                        <div>
                                            <p className="font-black uppercase tracking-widest text-xs text-slate-900">Email Verification</p>
                                            <p className="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">Manual Verification Bypass</p>
                                        </div>
                                        <button 
                                            type="button"
                                            onClick={() => setCurrentUser({...currentUser, email_verified: !currentUser.email_verified})}
                                            className={`w-16 h-9 rounded-full transition-all relative border-2 ${currentUser.email_verified ? 'bg-emerald-500 border-emerald-600' : 'bg-slate-200 border-slate-300'}`}
                                        >
                                            <div className={`absolute top-1 w-5 h-5 bg-white rounded-full transition-all shadow-md ${currentUser.email_verified ? 'left-8' : 'left-1'}`} />
                                        </button>
                                    </div>
                                </div>
                            </section>

                            <div className="flex flex-col md:flex-row justify-end gap-4 pt-12 border-t-4 border-black">
                                <button 
                                    type="button"
                                    onClick={() => setIsEditing(false)}
                                    className="px-10 py-5 bg-white text-black border-4 border-black rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all active:scale-95"
                                >
                                    Abort Operation
                                </button>
                                <button 
                                    type="submit" 
                                    className="px-14 py-5 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-2xl shadow-blue-600/30 active:scale-95"
                                >
                                    {currentUser.id ? 'Commit Protocol Changes' : 'Initialize User Deployment'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            <div className="bg-white rounded-[2.5rem] border-4 border-black shadow-[16px_16px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div className="overflow-x-auto">
                    <table className="min-w-full divide-y-4 divide-black">
                        <thead className="bg-slate-900 text-white">
                            <tr>
                                <th className="px-10 py-8 text-left text-[10px] font-black uppercase tracking-[0.3em]">Operational Identity</th>
                                <th className="px-10 py-8 text-left text-[10px] font-black uppercase tracking-[0.3em]">System Designation</th>
                                <th className="px-10 py-8 text-left text-[10px] font-black uppercase tracking-[0.3em]">Access Status</th>
                                <th className="px-10 py-8 text-right text-[10px] font-black uppercase tracking-[0.3em]">Protocol Actions</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y-4 divide-slate-100">
                            {users.map((user) => (
                                <tr key={user.id} className="group hover:bg-blue-50/30 transition-colors">
                                    <td className="px-10 py-8">
                                        <div className="flex items-center">
                                            <div className="flex-shrink-0 h-14 w-14 bg-slate-900 text-white rounded-[1.25rem] flex items-center justify-center font-black text-xl shadow-[4px_4px_0px_0px_rgba(59,130,246,1)] group-hover:scale-105 transition-transform">
                                                {user.name?.charAt(0).toUpperCase()}
                                            </div>
                                            <div className="ml-6">
                                                <div className="text-lg font-black text-slate-900 uppercase tracking-tight">{user.name}</div>
                                                <div className="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">{user.email}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td className="px-10 py-8">
                                        <span className="px-5 py-2 bg-white text-slate-900 rounded-xl text-[10px] font-black uppercase tracking-widest border-2 border-slate-200 shadow-sm">
                                            {user.role?.replace('_', ' ')}
                                        </span>
                                    </td>
                                    <td className="px-10 py-8">
                                        <div className="flex items-center gap-3">
                                            <div className={`w-2.5 h-2.5 rounded-full ${user.status !== false ? 'bg-emerald-500 animate-pulse' : 'bg-red-500'}`} />
                                            <span className={`text-[10px] font-black uppercase tracking-widest ${
                                                user.status !== false ? 'text-emerald-600' : 'text-red-600'
                                            }`}>
                                                {user.status !== false ? 'Protocol Active' : 'Access Halted'}
                                            </span>
                                        </div>
                                    </td>
                                    <td className="px-10 py-8 text-right">
                                        <div className="flex justify-end gap-4">
                                            <button 
                                                onClick={() => {
                                                    const [first_name, ...last_name] = user.name.split(' ');
                                                    setCurrentUser({
                                                        ...user,
                                                        first_name: first_name || '',
                                                        last_name: last_name.join(' ') || '',
                                                        password: '',
                                                        password_confirmation: ''
                                                    });
                                                    setIsEditing(true);
                                                }}
                                                className="w-11 h-11 flex items-center justify-center bg-slate-100 text-slate-400 hover:bg-blue-600 hover:text-white rounded-xl transition-all border-2 border-slate-200 hover:border-blue-700 shadow-sm"
                                            >
                                                <EditIcon className="w-5 h-5" />
                                            </button>
                                            <button 
                                                onClick={() => handleDelete(user.id)}
                                                className="w-11 h-11 flex items-center justify-center bg-slate-100 text-slate-400 hover:bg-red-600 hover:text-white rounded-xl transition-all border-2 border-slate-200 hover:border-red-700 shadow-sm"
                                            >
                                                <Trash2 className="w-5 h-5" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                            {users.length === 0 && (
                                <tr>
                                    <td colSpan="4" className="px-10 py-20 text-center">
                                        <p className="text-slate-300 font-black uppercase tracking-[0.5em] text-sm italic">No Personnel Records Detected</p>
                                    </td>
                                </tr>
                            )}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    );
};

export default Users;