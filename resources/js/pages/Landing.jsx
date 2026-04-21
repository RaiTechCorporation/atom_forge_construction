import React from 'react';
import { Link } from 'react-router-dom';
import { HardHat, Shield, BarChart, Users } from 'lucide-react';

const Landing = () => {
    return (
        <div className="bg-white">
            {/* Navigation */}
            <nav className="flex items-center justify-between p-6 lg:px-8 shadow-sm">
                <div className="flex lg:flex-1">
                    <span className="text-2xl font-bold text-blue-600">Atom Forge</span>
                </div>
                <div className="flex gap-x-12">
                    <Link to="/login" className="text-sm font-semibold leading-6 text-gray-900">
                        Log in <span aria-hidden="true">&rarr;</span>
                    </Link>
                </div>
            </nav>

            {/* Hero section */}
            <div className="relative isolate px-6 pt-14 lg:px-8">
                <div className="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56 text-center">
                    <h1 className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                        Modern Construction Management System
                    </h1>
                    <p className="mt-6 text-lg leading-8 text-gray-600">
                        Everything you need to manage your construction projects, investors, and clients in one place. Powerful admin control, real-time tracking, and professional reporting.
                    </p>
                    <div className="mt-10 flex items-center justify-center gap-x-6">
                        <Link
                            to="/login"
                            className="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                        >
                            Get Started
                        </Link>
                    </div>
                </div>
            </div>

            {/* Features section */}
            <div className="py-24 sm:py-32 bg-gray-50">
                <div className="mx-auto max-w-7xl px-6 lg:px-8">
                    <div className="grid grid-cols-1 gap-y-16 lg:grid-cols-3 lg:gap-x-8">
                        <div className="text-center">
                            <div className="flex justify-center mb-4">
                                <Shield className="h-12 w-12 text-blue-600" />
                            </div>
                            <h3 className="text-xl font-bold">Admin Controlled</h3>
                            <p className="mt-2 text-gray-600">Full control over users, roles, and project configurations.</p>
                        </div>
                        <div className="text-center">
                            <div className="flex justify-center mb-4">
                                <BarChart className="h-12 w-12 text-blue-600" />
                            </div>
                            <h3 className="text-xl font-bold">Real-time Analytics</h3>
                            <p className="mt-2 text-gray-600">Track costs, material usage, and ROI with live dashboards.</p>
                        </div>
                        <div className="text-center">
                            <div className="flex justify-center mb-4">
                                <Users className="h-12 w-12 text-blue-600" />
                            </div>
                            <h3 className="text-xl font-bold">Collaborative</h3>
                            <p className="mt-2 text-gray-600">Dedicated portals for investors, clients, and staff.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Landing;
