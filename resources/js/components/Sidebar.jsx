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
    ChevronDown,
    Shield
} from 'lucide-react';
import { useAuth } from '../context/AuthContext';

const Sidebar = () => {
    const location = useLocation();
    const { user, logout } = useAuth();
    const [cmsOpen, setCmsOpen] = useState(false);
    const [adminOpen, setAdminOpen] = useState(false);

    const menuItems = [
        { name: 'Dashboard', path: '/admin/dashboard', icon: LayoutDashboard, roles: ['super_admin', 'project_manager', 'tender_executive', 'site_supervisor', 'accountant'] },
        { name: 'Leads', path: '/leads', icon: Users, roles: ['super_admin', 'project_manager', 'tender_executive'] },
        { name: 'Contracts', path: '/contracts', icon: ClipboardList, roles: ['super_admin', 'project_manager', 'tender_executive'] },
        { name: 'Projects', path: '/projects', icon: Briefcase, roles: ['super_admin', 'project_manager', 'site_supervisor'] },
        { name: 'Milestones', path: '/milestones', icon: ClipboardList, roles: ['super_admin', 'project_manager', 'site_supervisor'] },
        { name: 'Materials', path: '/materials', icon: Hammer, roles: ['super_admin', 'project_manager', 'site_supervisor'], external: true },
        { name: 'Finance', path: '/finance', icon: DollarSign, roles: ['super_admin', 'project_manager', 'accountant'] },
    ];

    const administrationItems = [
        { name: 'Email Settings', path: '/email-config', icon: Settings, roles: ['super_admin'], external: true },
        { name: 'Broadcast', path: '/group-email', icon: Globe, roles: ['super_admin'], external: true },
        { name: 'User Management', path: '/users', icon: Users, roles: ['super_admin', 'project_manager', 'admin_staff'] },
        { name: 'Role Permissions', path: '/roles', icon: Shield, roles: ['super_admin'], external: true },
    ];

    const managementItems = [
        { name: 'Analytics', path: '/reports', icon: BarChart3, roles: ['super_admin', 'project_manager'], external: true },
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
    const filteredAdmin = administrationItems.filter(item => item.roles.includes(user?.role));

    const NavLink = ({ item, isSub = false }) => {
        const isActive = location.pathname === item.path;
        const baseClasses = `group flex items-center gap-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all ${
            isActive ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white'
        }`;
        const paddingClasses = isSub ? 'px-4 py-2.5 rounded-xl' : 'px-4 py-3';

        if (item.external) {
            return (
                <a href={item.path} className={`${baseClasses} ${paddingClasses}`}>
                    <span className={`${isActive ? 'text-white' : 'text-slate-600 group-hover:text-slate-200'}`}>
                        <item.icon className="w-4 h-4" />
                    </span>
                    <span className={isSub ? 'text-[10px]' : 'text-[10px]'}>{item.name}</span>
                </a>
            );
        }
        return (
            <Link to={item.path} className={`${baseClasses} ${paddingClasses}`}>
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
                <a href="/dashboard" className="flex items-center gap-3.5 group">
                    <div className="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-600/20 group-hover:scale-105 transition-transform duration-300">
                        <img src="/images/cropped-Atom-Forge-Logo.png-For-White-Background.png" alt="Logo" className="w-full h-full object-contain" />
                    </div>
                    <span className="font-black text-lg text-white tracking-tighter uppercase italic">
                        Atom<span className="text-indigo-500">Forge</span>
                    </span>
                </a>
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
                    <div className="space-y-6">
                        {/* Administration Dropdown */}
                        <div>
                            <button 
                                onClick={() => setAdminOpen(!adminOpen)}
                                className={`w-full flex items-center justify-between gap-3 px-4 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all ${
                                    adminOpen ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white'
                                }`}
                            >
                                <div className="flex items-center gap-3">
                                    <span className={`${adminOpen ? 'text-white' : 'text-slate-600'}`}>
                                        <Settings className="w-4 h-4" />
                                    </span>
                                    <span>Administration</span>
                                </div>
                                <ChevronDown className={`w-3.5 h-3.5 transition-transform duration-300 ${adminOpen ? 'rotate-180' : ''}`} />
                            </button>
                            
                            {adminOpen && (
                                <ul className="mt-2 ml-4 space-y-1 border-l border-slate-800/50 pl-4">
                                    {filteredAdmin.map((item) => (
                                        <li key={item.path}>
                                            <NavLink item={item} isSub={true} />
                                        </li>
                                    ))}
                                </ul>
                            )}
                        </div>

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
