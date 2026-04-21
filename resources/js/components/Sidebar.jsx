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
                    className={`flex flex-row items-center h-11 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-400 hover:text-white px-4 ${
                        isActive ? 'text-white bg-gray-800' : ''
                    }`}
                >
                    <span className="inline-flex items-center justify-center h-12 w-12 text-lg">
                        <item.icon className="w-5 h-5" />
                    </span>
                    <span className="text-sm font-medium">{item.name}</span>
                </a>
            );
        }
        return (
            <Link
                to={item.path}
                className={`flex flex-row items-center h-11 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-400 hover:text-white px-4 ${
                    isActive ? 'text-white bg-gray-800' : ''
                }`}
            >
                <span className="inline-flex items-center justify-center h-12 w-12 text-lg">
                    <item.icon className="w-5 h-5" />
                </span>
                <span className="text-sm font-medium">{item.name}</span>
            </Link>
        );
    };

    return (
        <div className="flex flex-col w-64 h-screen bg-gray-900 text-white flex-shrink-0">
            <div className="flex items-center px-6 h-20 border-b border-gray-800">
                <h1 className="text-xl font-bold tracking-tight text-white">Atom<span className="text-blue-500">Forge</span></h1>
            </div>
            
            <div className="flex-grow overflow-y-auto py-4 custom-scrollbar">
                <ul className="flex flex-col space-y-1">
                    {filteredItems.map((item) => (
                        <li key={item.path}>
                            <NavLink item={item} />
                        </li>
                    ))}

                    {user?.role === 'super_admin' && (
                        <>
                            <li className="px-5 pt-6 pb-2">
                                <span className="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Management</span>
                            </li>
                            {filteredManagement.map((item) => (
                                <li key={item.path}>
                                    <NavLink item={item} />
                                </li>
                            ))}
                            
                            {/* CMS Dropdown */}
                            <li>
                                <button 
                                    onClick={() => setCmsOpen(!cmsOpen)}
                                    className="flex flex-row items-center justify-between w-full h-11 text-gray-400 hover:text-white px-4 hover:bg-gray-800 transition-colors"
                                >
                                    <div className="flex items-center">
                                        <span className="inline-flex items-center justify-center h-12 w-12 text-lg">
                                            <Globe className="w-5 h-5" />
                                        </span>
                                        <span className="text-sm font-medium">CMS</span>
                                    </div>
                                    <ChevronDown className={`w-4 h-4 transition-transform duration-200 ${cmsOpen ? 'rotate-180' : ''}`} />
                                </button>
                                
                                {cmsOpen && (
                                    <ul className="bg-gray-800/50 mt-1 mx-2 rounded-lg py-1">
                                        {cmsItems.map((cms) => (
                                            <li key={cms.name}>
                                                <a 
                                                    href={`/website-content${cms.group ? '?group=' + cms.group : ''}`}
                                                    className="block px-12 py-2 text-xs font-medium text-gray-400 hover:text-white transition-colors"
                                                >
                                                    {cms.name}
                                                </a>
                                            </li>
                                        ))}
                                    </ul>
                                )}
                            </li>
                        </>
                    )}
                </ul>
            </div>

            <div className="p-4 border-t border-gray-800 bg-gray-900/50">
                <div className="flex items-center gap-3 px-4 py-3 mb-2 rounded-lg bg-gray-800/30">
                    <div className="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold">
                        {user?.name?.charAt(0).toUpperCase()}
                    </div>
                    <div className="flex flex-col min-w-0">
                        <span className="text-xs font-bold truncate">{user?.name}</span>
                        <span className="text-[10px] text-gray-500 truncate uppercase">{user?.role?.replace('_', ' ')}</span>
                    </div>
                </div>
                <button 
                    onClick={logout}
                    className="flex items-center w-full px-4 py-2 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-red-900/20 rounded-lg transition-colors"
                >
                    <LogOut className="w-5 h-5 mr-3" />
                    Logout
                </button>
            </div>
        </div>
    );
};

export default Sidebar;
