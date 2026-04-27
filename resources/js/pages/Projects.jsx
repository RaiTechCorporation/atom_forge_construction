import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Plus, Edit, Trash2, MapPin, Calendar, DollarSign, Activity } from 'lucide-react';

const Projects = () => {
    const [projects, setProjects] = useState([]);
    const [loading, setLoading] = useState(true);
    const [isEditing, setIsEditing] = useState(false);
    const [currentProject, setCurrentProject] = useState({
        name: '',
        location: '',
        project_type: 'Standard',
        cost_per_sqft: '',
        total_area_sqft: '',
        total_budget: '',
        start_date: '',
        status: 'Ongoing',
        stage: 'Planning',
        description: ''
    });

    useEffect(() => {
        fetchProjects();
    }, []);

    const fetchProjects = async () => {
        try {
            const response = await axios.get('/api/admin/projects');
            setProjects(response.data);
        } catch (error) {
            console.error('Error fetching projects', error);
        } finally {
            setLoading(false);
        }
    };

    const handleSave = async (e) => {
        e.preventDefault();
        try {
            if (currentProject.id) {
                await axios.put(`/api/admin/projects/${currentProject.id}`, currentProject);
            } else {
                await axios.post('/api/admin/projects', currentProject);
            }
            setIsEditing(false);
            setCurrentProject({
                name: '',
                location: '',
                project_type: 'Standard',
                cost_per_sqft: '',
                total_area_sqft: '',
                total_budget: '',
                start_date: '',
                status: 'Ongoing',
                stage: 'Planning',
                description: ''
            });
            fetchProjects();
        } catch (error) {
            console.error('Error saving project', error);
        }
    };

    const handleDelete = async (id) => {
        if (window.confirm('Are you sure you want to delete this project?')) {
            try {
                await axios.delete(`/api/admin/projects/${id}`);
                fetchProjects();
            } catch (error) {
                console.error('Error deleting project', error);
            }
        }
    };

    if (loading) return <div className="p-8 font-black uppercase tracking-widest text-slate-400">Syncing Projects...</div>;

    return (
        <div className="p-8">
            <div className="flex justify-between items-center mb-8">
                <div>
                    <h1 className="text-3xl font-black text-slate-900 uppercase tracking-tight">Project Management</h1>
                    <p className="text-slate-500 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">Industrial Control Interface</p>
                </div>
                <button 
                    onClick={() => { setIsEditing(true); setCurrentProject({
                        name: '',
                        location: '',
                        project_type: 'Standard',
                        cost_per_sqft: '',
                        total_area_sqft: '',
                        total_budget: '',
                        start_date: '',
                        status: 'Ongoing',
                        stage: 'Planning',
                        description: ''
                    }); }}
                    className="flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all uppercase text-xs tracking-widest"
                >
                    <Plus className="w-4 h-4 mr-2" />
                    Initialize Project
                </button>
            </div>

            {isEditing && (
                <div className="bg-white p-8 rounded-[2rem] shadow-2xl mb-12 border-4 border-black">
                    <h2 className="text-xl font-black mb-6 uppercase tracking-widest">{currentProject.id ? 'Modify Project Configuration' : 'New Project Initialization'}</h2>
                    <form onSubmit={handleSave} className="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div className="space-y-2">
                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500">Project Title</label>
                            <input 
                                type="text" 
                                required
                                className="block w-full py-3 px-4 border-2 border-slate-200 rounded-xl focus:border-blue-600 focus:ring-0 font-bold"
                                value={currentProject.name}
                                onChange={(e) => setCurrentProject({...currentProject, name: e.target.value})}
                            />
                        </div>
                        <div className="space-y-2">
                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500">Geographic Deployment (Location)</label>
                            <input 
                                type="text" 
                                required
                                className="block w-full py-3 px-4 border-2 border-slate-200 rounded-xl focus:border-blue-600 focus:ring-0 font-bold"
                                value={currentProject.location}
                                onChange={(e) => setCurrentProject({...currentProject, location: e.target.value})}
                            />
                        </div>
                        <div className="space-y-2">
                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500">Structural Class (Project Type)</label>
                            <select 
                                className="block w-full py-3 px-4 border-2 border-slate-200 rounded-xl focus:border-blue-600 focus:ring-0 font-bold"
                                value={currentProject.project_type}
                                onChange={(e) => setCurrentProject({...currentProject, project_type: e.target.value})}
                            >
                                <option>Basic</option>
                                <option>Standard</option>
                                <option>Premium</option>
                                <option>Luxury</option>
                                <option>Ultra Luxury</option>
                                <option>Custom</option>
                            </select>
                        </div>
                        <div className="space-y-2">
                            <label className="text-[10px] font-black uppercase tracking-widest text-slate-500">Fiscal Budget (Total)</label>
                            <input 
                                type="number" 
                                required
                                className="block w-full py-3 px-4 border-2 border-slate-200 rounded-xl focus:border-blue-600 focus:ring-0 font-bold"
                                value={currentProject.total_budget}
                                onChange={(e) => setCurrentProject({...currentProject, total_budget: e.target.value})}
                            />
                        </div>
                        <div className="md:col-span-2 flex justify-end space-x-4 pt-4">
                            <button 
                                type="button" 
                                onClick={() => setIsEditing(false)}
                                className="px-6 py-3 border-2 border-slate-200 rounded-xl text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 transition-all"
                            >
                                Abort
                            </button>
                            <button 
                                type="submit" 
                                className="px-8 py-3 bg-black text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-xl"
                            >
                                Commit Changes
                            </button>
                        </div>
                    </form>
                </div>
            )}

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {projects.map((project) => (
                    <div key={project.id} className="bg-white rounded-[2rem] border-4 border-black shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                        <div className="p-8">
                            <div className="flex justify-between items-start mb-6">
                                <div>
                                    <div className="flex items-center gap-2 mb-2">
                                        <span className="px-2 py-0.5 bg-blue-100 text-blue-700 text-[9px] font-black uppercase tracking-widest rounded">
                                            {project.project_type}
                                        </span>
                                        <span className={`px-2 py-0.5 text-[9px] font-black uppercase tracking-widest rounded ${
                                            project.status === 'Ongoing' ? 'bg-emerald-100 text-emerald-700' : 
                                            project.status === 'Planned' ? 'bg-sky-100 text-sky-700' :
                                            'bg-amber-100 text-amber-700'
                                        }`}>
                                            {project.status}
                                        </span>
                                    </div>
                                    <h3 className="text-2xl font-black text-slate-900 uppercase tracking-tight leading-none group-hover:text-blue-600 transition-colors">{project.name}</h3>
                                </div>
                                <div className="flex gap-2">
                                    <button onClick={() => { setIsEditing(true); setCurrentProject(project); }} className="p-2 bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                        <Edit className="w-4 h-4" />
                                    </button>
                                    <button onClick={() => handleDelete(project.id)} className="p-2 bg-slate-50 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                        <Trash2 className="w-4 h-4" />
                                    </button>
                                </div>
                            </div>
                            
                            <div className="grid grid-cols-2 gap-6 mb-8">
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500">
                                        <MapPin className="w-5 h-5" />
                                    </div>
                                    <div>
                                        <p className="text-[9px] font-black uppercase tracking-widest text-slate-400">Location</p>
                                        <p className="font-bold text-slate-900 text-sm truncate">{project.location}</p>
                                    </div>
                                </div>
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500">
                                        <DollarSign className="w-5 h-5" />
                                    </div>
                                    <div>
                                        <p className="text-[9px] font-black uppercase tracking-widest text-slate-400">Budget</p>
                                        <p className="font-bold text-slate-900 text-sm">${project.total_budget?.toLocaleString()}</p>
                                    </div>
                                </div>
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500">
                                        <Activity className="w-5 h-5" />
                                    </div>
                                    <div>
                                        <p className="text-[9px] font-black uppercase tracking-widest text-slate-400">Stage</p>
                                        <p className="font-bold text-slate-900 text-sm">{project.stage}</p>
                                    </div>
                                </div>
                                <div className="flex items-center gap-3">
                                    <div className="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500">
                                        <Calendar className="w-5 h-5" />
                                    </div>
                                    <div>
                                        <p className="text-[9px] font-black uppercase tracking-widest text-slate-400">Deployed</p>
                                        <p className="font-bold text-slate-900 text-sm">{new Date(project.start_date).toLocaleDateString()}</p>
                                    </div>
                                </div>
                            </div>

                            <div className="space-y-2">
                                <div className="flex justify-between items-end">
                                    <span className="text-[10px] font-black uppercase tracking-widest text-slate-500">Structural Progress</span>
                                    <span className="text-[10px] font-black text-blue-600">65%</span>
                                </div>
                                <div className="w-full h-3 bg-slate-100 rounded-full overflow-hidden border border-slate-200 p-0.5">
                                    <div className="h-full bg-blue-600 rounded-full shadow-[0_0_8px_rgba(37,99,235,0.4)] transition-all duration-1000" style={{ width: '65%' }}></div>
                                </div>
                            </div>
                        </div>
                        <div className="px-8 py-4 bg-slate-50 border-t-2 border-slate-100 flex justify-between items-center">
                            <span className="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">System ID: PRJ-{project.id?.toString().padStart(4, '0')}</span>
                            <button className="text-xs font-black uppercase tracking-widest text-blue-600 hover:text-slate-900 transition-colors">
                                Access Core Logs
                            </button>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Projects;
