@extends('layouts.public')

@section('content')
    <!-- Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-white border-b-4 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-lg bg-yellow-400 border-2 border-black text-black text-xs font-black uppercase tracking-widest mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                Transmission Hub
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-black tracking-tighter mb-6 uppercase">
                {{ $content['contact_hero_title'] ?? "Let's Build Together" }}
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto font-bold uppercase tracking-tight opacity-80">
                {{ $content['contact_hero_subtitle'] ?? 'Establish project communication protocols and initiate strategic collaboration.' }}
            </p>
        </div>
    </section>

    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-32 items-start">
                <!-- Contact Info Cards -->
                <div class="space-y-10">
                    <div class="group bg-white p-10 rounded-3xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all">
                        <div class="w-16 h-16 bg-indigo-600 text-white border-2 border-black rounded-2xl flex items-center justify-center mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-3xl font-black text-black mb-4 uppercase tracking-tight">HQ Coordinates</h3>
                        <p class="text-lg text-slate-800 font-bold leading-relaxed">{{ $content['contact_address'] ?? '3584 Hickory Heights Drive, USA' }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="bg-emerald-400 p-10 rounded-3xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                            <div class="w-14 h-14 bg-white border-2 border-black rounded-2xl flex items-center justify-center mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                <svg class="w-7 h-7 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <h4 class="text-xl font-black text-black mb-2 uppercase">Audio Feed</h4>
                            <p class="text-black font-black text-lg tracking-tight">{{ $content['contact_phone'] ?? '+1 (555) 000-0000' }}</p>
                        </div>
                        <div class="bg-indigo-400 p-10 rounded-3xl border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                            <div class="w-14 h-14 bg-white border-2 border-black rounded-2xl flex items-center justify-center mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                                <svg class="w-7 h-7 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="text-xl font-black text-black mb-2 uppercase">Digital Memo</h4>
                            <p class="text-black font-black text-lg tracking-tight">{{ $content['contact_email'] ?? 'info@atomforge.com' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white p-10 md:p-12 rounded-[2.5rem] border-4 border-black shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="text-3xl font-black text-black mb-10 uppercase tracking-tight">Dispatch Inquiry</h3>
                    <form action="#" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-black text-black uppercase tracking-widest mb-3">Operator Name</label>
                                <input type="text" placeholder="e.g. JOHN DOE" class="w-full py-4 px-6 rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 placeholder-slate-400 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-black text-black uppercase tracking-widest mb-3">Return Signal (Email)</label>
                                <input type="email" placeholder="OPERATOR@EXAMPLE.SYS" class="w-full py-4 px-6 rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 placeholder-slate-400 transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-black text-black uppercase tracking-widest mb-3">Mission Subject</label>
                            <select class="w-full py-4 px-6 rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 transition-all appearance-none cursor-pointer">
                                <option>RESIDENTIAL PROJECT</option>
                                <option>COMMERCIAL PROJECT</option>
                                <option>INTERIOR DESIGN</option>
                                <option>GENERAL INTELLIGENCE</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-black text-black uppercase tracking-widest mb-3">Transmission Message</label>
                            <textarea rows="4" placeholder="ESTABLISH CONTEXT..." class="w-full py-4 px-6 rounded-xl border-4 border-black bg-white text-black font-black focus:border-indigo-700 focus:ring-4 focus:ring-indigo-700/10 placeholder-slate-400 transition-all"></textarea>
                        </div>
                        <button type="submit" class="w-full py-5 bg-yellow-400 border-4 border-black rounded-2xl font-black text-base text-black hover:bg-yellow-500 transition-all shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] uppercase tracking-widest active:translate-x-1 active:translate-y-1 active:shadow-none">
                            Broadcast Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="h-[500px] w-full bg-slate-100 border-t-4 border-black grayscale hover:grayscale-0 transition-all duration-700">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.142293761308!2d-73.98731968459391!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1634567890123!5m2!1sen!2sus" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </section>
@endsection
