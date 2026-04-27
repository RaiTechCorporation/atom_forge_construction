import './bootstrap';
import '../css/app.css';

import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider, useAuth } from './context/AuthContext';
import Sidebar from './components/Sidebar';
import Dashboard from './pages/Dashboard';
import Plans from './pages/Plans';
import Users from './pages/Users';
import Roles from './pages/Roles';
import Leads from './pages/Leads';
import Contracts from './pages/Contracts';
import Projects from './pages/Projects';
import InvestorDashboard from './pages/InvestorDashboard';
import ClientDashboard from './pages/ClientDashboard';

const PrivateRoute = ({ children }) => {
    const { user, loading } = useAuth();
    
    if (loading) return <div className="flex items-center justify-center h-screen">Loading...</div>;
    
    return user ? (
        <div className="flex bg-gray-100 min-h-screen">
            <Sidebar />
            <main className="flex-1 overflow-x-hidden overflow-y-auto">
                {children}
            </main>
        </div>
    ) : (() => { window.location.href = '/login'; return null; })();
};

const App = () => {
    return (
        <AuthProvider>
            <Router>
                <Routes>
                    {/* Admin Routes */}
                    <Route 
                        path="/admin-panel" 
                        element={
                            <PrivateRoute>
                                <Dashboard />
                            </PrivateRoute>
                        } 
                    />
                    <Route 
                        path="/admin-panel/plans" 
                        element={
                            <PrivateRoute>
                                <Plans />
                            </PrivateRoute>
                        } 
                    />
                    <Route 
                        path="/admin-panel/users" 
                        element={
                            <PrivateRoute>
                                <Users />
                            </PrivateRoute>
                        } 
                    />
                    <Route 
                        path="/admin-panel/roles" 
                        element={
                            <PrivateRoute>
                                <Roles />
                            </PrivateRoute>
                        } 
                    />
                    <Route 
                        path="/admin-panel/leads" 
                        element={
                            <PrivateRoute>
                                <Leads />
                            </PrivateRoute>
                        } 
                    />
                    <Route 
                        path="/admin-panel/contracts" 
                        element={
                            <PrivateRoute>
                                <Contracts />
                            </PrivateRoute>
                        } 
                    />
                    <Route 
                        path="/admin-panel/projects" 
                        element={
                            <PrivateRoute>
                                <Projects />
                            </PrivateRoute>
                        } 
                    />

                    {/* Shared Dashboard Redirect */}
                    <Route 
                        path="/dashboard" 
                        element={
                            <PrivateRoute>
                                <Dashboard />
                            </PrivateRoute>
                        } 
                    />

                    {/* Portals */}
                    <Route path="/investor-portal" element={<PrivateRoute><InvestorDashboard /></PrivateRoute>} />
                    <Route path="/client-portal" element={<PrivateRoute><ClientDashboard /></PrivateRoute>} />

                    <Route path="*" element={<div className="p-8">Page not found or unauthorized.</div>} />
                </Routes>
            </Router>
        </AuthProvider>
    );
};

const container = document.getElementById('app');
if (container) {
    const root = createRoot(container);
    root.render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}

export default App;
