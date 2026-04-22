import React, { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { 
    LayoutDashboard, 
    Users, 
    Briefcase, 
    Settings, 
    LogOut,
    Hammer,
    ClipboardList,
    DollarSign,
    BarChart3,
    Globe,
    ChevronDown
} from 'lucide-react';
import { useAuth } from '../context/AuthContext';

const Sidebar = () => {
    const location = useLocation();
    const { user, logout } = useAuth();
    const [cmsOpen, setCmsOpen] = useState(false);

    const menuItems = [
        { name: 'Dashboard', path: '/admin-panel', icon: LayoutDashboard, roles: ['super_admin'] },
        { name: 'Projects', path: '/admin-panel/projects', icon: Briefcase, roles: ['super_admin', 'admin_staff'] },
        { name: 'Users', path: '/admin-panel/users', icon: Users, roles: ['super_admin'] },
        { name: 'Plans', path: '/admin-panel/plans', icon: ClipboardList, roles: ['super_admin'] },
        { name: 'Materials', path: '/admin-panel/materials', icon: Hammer, roles: ['super_admin', 'admin_staff'] },
        { name: 'Finance', path: '/admin-panel/finance', icon: DollarSign, roles: ['super_admin'] },
    ];

    const managementItems = [
        { name: 'Analytics', path: '/reports', icon: BarChart3, roles: ['super_admin'], external: true },
        { name: 'Pricing Plans', path: '/construction-plans', icon: ClipboardList, roles: ['super_admin'], external: true },
    ];

    const cmsItems = [
        { name: 'All Sections', group: '' },
        { name: 'Header', group: 'header' },
        { name: 'Footer', group: 'footer' },
        { name: 'Home', group: 'home' },
        { name: 'Services', group: 'services' },
        { name: 'Projects', group: 'projects' },
        { name: 'About', group: 'about' },
        { name: 'Contact', group: 'contact' },
    ];

    const filteredItems = menuItems.filter(item => item.roles.includes(user?.role));
    const filteredManagement = managementItems.filter(item => item.roles.includes(user?.role));

    const NavLink = ({ item }) => {
        const isActive = location.pathname === item.path;
        if (item.external) {
            return (
                <a
                    href={item.path}
                    className={`group flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all ${
                        isActive ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white'
                    }`}
                >
                    <span className={`${isActive ? 'text-white' : 'text-slate-600 group-hover:text-slate-200'}`}>
                        <item.icon className="w-4 h-4" />
                    </span>
                    <span className="text-sm font-black tracking-tight">{item.name}</span>
                </a>
            );
        }
        return (
            <Link
                to={item.path}
                className={`group flex items-center gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all ${
                    isActive ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white'
                }`}
            >
                <span className={`${isActive ? 'text-white' : 'text-slate-600 group-hover:text-slate-200'}`}>
                    <item.icon className="w-4 h-4" />
                </span>
                <span className="text-[10px] font-black uppercase tracking-widest">{item.name}</span>
            </Link>
        );
    };

    return (
        <div className="flex flex-col w-[280px] h-screen bg-[#0f172a] text-slate-400 flex-shrink-0 border-r border-slate-800/40 shadow-2xl">
            <div className="h-[60px] flex items-center px-8 border-b border-slate-800/50">
                <Link to="/dashboard" className="flex items-center gap-3.5 group">
                    <div className="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-600/20 group-hover:scale-105 transition-transform duration-300">
                        <svg className="w-5 h-5 fill-white" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <span className="font-black text-lg text-white tracking-tighter uppercase italic">
                        Atom<span className="text-indigo-500">Forge</span>
                    </span>
                </Link>
            </div>
            
            <div className="flex-grow overflow-y-auto p-4 custom-scrollbar space-y-8">
                <div>
                    <span className="px-4 text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 block">Core Operations</span>
                    <ul className="space-y-1">
                        {filteredItems.map((item) => (
                            <li key={item.path}>
                                <NavLink item={item} />
                            </li>
                        ))}
                    </ul>
                </div>

                {user?.role && ['super_admin', 'admin_staff'].includes(user.role) && (
                    <div>
                        <span className="px-4 text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4 block">Asset Management</span>
                        <ul className="space-y-1">
                            {filteredManagement.map((item) => (
                                <li key={item.path}>
                                    <NavLink item={item} />
                                </li>
                            ))}
                            
                            {/* CMS Dropdown */}
                            <li>
                                <button 
                                    onClick={() => setCmsOpen(!cmsOpen)}
                                    className={`w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all ${
                                        cmsOpen ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white'
                                    }`}
                                >
                                    <div className="flex items-center gap-3">
                                        <span className={`${cmsOpen ? 'text-white' : 'text-slate-600'}`}>
                                            <Globe className="w-4 h-4" />
                                        </span>
                                        <span>CMS</span>
                                    </div>
                                    <ChevronDown className={`w-3.5 h-3.5 transition-transform duration-300 ${cmsOpen ? 'rotate-180' : ''}`} />
                                </button>
                                
                                {cmsOpen && (
                                    <ul className="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                                        {cmsItems.map((cms) => (
                                            <li key={cms.name}>
                                                <a 
                                                    href={`/website-content${cms.group ? '?group=' + cms.group : ''}`}
                                                    className="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest rounded-xl text-slate-500 hover:text-white hover:bg-white/5 transition-all"
                                                >
                                                    {cms.name}
                                                </a>
                                            </li>
                                        ))}
                                    </ul>
                                )}
                            </li>
                        </ul>
                    </div>
                )}
            </div>

            <div className="p-4 border-t border-slate-800/50 bg-[#0c1221]">
                <div className="px-4 py-3 bg-slate-900/50 border border-slate-800/50 rounded-2xl flex items-center gap-4 mb-2">
                    <div className="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-black text-xs shadow-lg shadow-indigo-600/20 uppercase">
                        {user?.name?.charAt(0).toUpperCase()}
                    </div>
                    <div className="flex flex-col min-w-0">
                        <span className="text-xs font-black text-white leading-none truncate uppercase tracking-tighter">{user?.name}</span>
                        <span className="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">{user?.role?.replace('_', ' ')}</span>
                    </div>
                </div>
                <button 
                    onClick={logout}
                    className="flex items-center w-full px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-red-500 hover:text-red-400 hover:bg-red-500/10 rounded-xl transition-all"
                >
                    <LogOut className="w-4 h-4 mr-3" />
                    Logout
                </button>
            </div>
        </div>
    );
};

export default Sidebar;
