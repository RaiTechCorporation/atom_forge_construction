import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { 
    UserPlus, 
    Mail, 
    User as UserIcon, 
    Lock, 
    Calendar, 
    MapPin, 
    Phone,
    X,
    Trash2,
    Edit as EditIcon
} from 'lucide-react';

const Users = () => {
    const [users, setUsers] = useState([]);
    const [roles, setRoles] = useState([]);
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
        role: '',
        address: '',
        city: '',
        state: '',
        country: '',
        zip: '',
        status: true,
    });

    useEffect(() => {
        fetchUsers();
        fetchRoles();
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

    const fetchRoles = async () => {
        try {
            const response = await axios.get('/api/admin/roles');
            setRoles(response.data);
        } catch (error) {
            console.error('Error fetching roles', error);
        }
    };

    const handleSave = async (e) => {
        e.preventDefault();
        try {
            if (currentUser.id) {
                await axios.put(`/api/admin/users/${currentUser.id}`, currentUser);
            } else {
                await axios.post('/api/admin/users', currentUser);
            }
            setIsEditing(false);
            resetForm();
            fetchUsers();
        } catch (error) {
            console.error('Error saving user', error);
            alert('Failed to save user. Please check your input.');
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

    if (loading) return (
        <div className="flex items-center justify-center min-h-screen bg-slate-50">
            <div className="flex flex-col items-center gap-4">
                <div className="w-12 h-12 border-4 border-indigo-600 border-t-transparent rounded-full animate-spin"></div>
                <p className="text-slate-500 font-bold uppercase text-[10px] tracking-widest">Synchronizing User Database...</p>
            </div>
        </div>
    );

    return (
        <div className="p-8 bg-slate-50 min-h-screen">
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <div>
                    <h1 className="text-2xl font-bold text-slate-900 tracking-tight">User Management</h1>
                    <p className="text-slate-500 font-medium text-sm mt-1">Manage system access and user identities.</p>
                </div>
                <button 
                    onClick={() => { setIsEditing(true); resetForm(); }}
                    className="flex items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20 active:scale-95"
                >
                    <UserPlus className="w-4 h-4 mr-2" />
                    Add New User
                </button>
            </div>

            {isEditing && (
                <div className="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
                    <div className="bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl shadow-2xl border border-slate-200 relative">
                        <div className="sticky top-0 bg-white/80 backdrop-blur-md border-b border-slate-100 p-6 flex justify-between items-center z-10">
                            <div>
                                <h2 className="text-xl font-bold text-slate-900">
                                    {currentUser.id ? 'Edit User' : 'Add New User'}
                                </h2>
                                <p className="text-slate-500 text-xs mt-1">Configure user profile and access levels.</p>
                            </div>
                            <button onClick={() => setIsEditing(false)} className="w-10 h-10 rounded-xl flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-50 transition-all">
                                <X className="w-5 h-5" />
                            </button>
                        </div>
                        
                        <form onSubmit={handleSave} className="p-8 space-y-8">
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div className="space-y-2">
                                    <label className="text-xs font-bold text-slate-700 ml-1">First Name</label>
                                    <input 
                                        type="text" required
                                        className="block w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:ring-0 text-sm font-medium"
                                        value={currentUser.first_name}
                                        onChange={(e) => setCurrentUser({...currentUser, first_name: e.target.value})}
                                        placeholder="John"
                                    />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-xs font-bold text-slate-700 ml-1">Last Name</label>
                                    <input 
                                        type="text" required
                                        className="block w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:ring-0 text-sm font-medium"
                                        value={currentUser.last_name}
                                        onChange={(e) => setCurrentUser({...currentUser, last_name: e.target.value})}
                                        placeholder="Doe"
                                    />
                                </div>
                                <div className="md:col-span-2 space-y-2">
                                    <label className="text-xs font-bold text-slate-700 ml-1">Email Address</label>
                                    <input 
                                        type="email" required
                                        className="block w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:ring-0 text-sm font-medium"
                                        value={currentUser.email}
                                        onChange={(e) => setCurrentUser({...currentUser, email: e.target.value})}
                                        placeholder="john@example.com"
                                    />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-xs font-bold text-slate-700 ml-1">Password</label>
                                    <input 
                                        type="password" required={!currentUser.id}
                                        className="block w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:ring-0 text-sm font-medium"
                                        value={currentUser.password}
                                        onChange={(e) => setCurrentUser({...currentUser, password: e.target.value})}
                                        placeholder="••••••••"
                                    />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-xs font-bold text-slate-700 ml-1">Confirm Password</label>
                                    <input 
                                        type="password" required={!currentUser.id}
                                        className="block w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:ring-0 text-sm font-medium"
                                        value={currentUser.password_confirmation}
                                        onChange={(e) => setCurrentUser({...currentUser, password_confirmation: e.target.value})}
                                        placeholder="••••••••"
                                    />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-xs font-bold text-slate-700 ml-1">Assigned Role</label>
                                    <select 
                                        className="block w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:ring-0 text-sm font-bold appearance-none"
                                        value={currentUser.role}
                                        onChange={(e) => setCurrentUser({...currentUser, role: e.target.value})}
                                    >
                                        <option value="">Select Role</option>
                                        {roles.map((role) => (
                                            <option key={role.id} value={role.slug}>
                                                {role.name}
                                            </option>
                                        ))}
                                    </select>
                                </div>
                                <div className="space-y-2">
                                    <label className="text-xs font-bold text-slate-700 ml-1">Status</label>
                                    <select 
                                        className="block w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl focus:border-indigo-600 focus:ring-0 text-sm font-bold appearance-none"
                                        value={currentUser.status}
                                        onChange={(e) => setCurrentUser({...currentUser, status: e.target.value === 'true'})}
                                    >
                                        <option value="true">Active</option>
                                        <option value="false">Suspended</option>
                                    </select>
                                </div>
                            </div>

                            <div className="flex justify-end gap-3 pt-6 border-t border-slate-100">
                                <button 
                                    type="button"
                                    onClick={() => setIsEditing(false)}
                                    className="px-6 py-2.5 bg-white text-slate-700 border border-slate-200 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit" 
                                    className="px-8 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-sm hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20"
                                >
                                    {currentUser.id ? 'Save Changes' : 'Create User'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            <div className="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div className="overflow-x-auto">
                    <table className="min-w-full divide-y divide-slate-200">
                        <thead className="bg-slate-50">
                            <tr>
                                <th className="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">User</th>
                                <th className="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                                <th className="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th className="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody className="bg-white divide-y divide-slate-200">
                            {users.map((user) => (
                                <tr key={user.id} className="hover:bg-slate-50/50 transition-colors">
                                    <td className="px-6 py-4 whitespace-nowrap">
                                        <div className="flex items-center">
                                            <div className="h-10 w-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-indigo-600/20">
                                                {user.name?.charAt(0).toUpperCase()}
                                            </div>
                                            <div className="ml-4">
                                                <div className="text-sm font-bold text-slate-900">{user.name}</div>
                                                <div className="text-xs font-medium text-slate-500">{user.email}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap">
                                        <span className="px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                            {user.role?.replace('_', ' ')}
                                        </span>
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap">
                                        <div className="flex items-center gap-2">
                                            <div className={`w-2 h-2 rounded-full ${user.status !== false ? 'bg-emerald-500' : 'bg-red-500'}`} />
                                            <span className={`text-xs font-bold ${
                                                user.status !== false ? 'text-emerald-600' : 'text-red-600'
                                            }`}>
                                                {user.status !== false ? 'Active' : 'Suspended'}
                                            </span>
                                        </div>
                                    </td>
                                    <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div className="flex justify-end gap-3">
                                            <button 
                                                onClick={() => {
                                                    const nameParts = user.name ? user.name.split(' ') : ['', ''];
                                                    const first_name = nameParts[0];
                                                    const last_name = nameParts.slice(1).join(' ');
                                                    setCurrentUser({
                                                        ...user,
                                                        first_name: first_name || '',
                                                        last_name: last_name || '',
                                                        password: '',
                                                        password_confirmation: ''
                                                    });
                                                    setIsEditing(true);
                                                }}
                                                className="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                            >
                                                <EditIcon className="w-4 h-4" />
                                            </button>
                                            <button 
                                                onClick={() => handleDelete(user.id)}
                                                className="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                            >
                                                <Trash2 className="w-4 h-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                            {users.length === 0 && (
                                <tr>
                                    <td colSpan="4" className="px-6 py-12 text-center">
                                        <p className="text-slate-400 font-medium text-sm italic">No users found.</p>
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