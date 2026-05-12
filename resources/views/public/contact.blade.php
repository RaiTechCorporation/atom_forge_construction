@extends('layouts.public')

@section('content')
    <!-- Refined Page Header -->
    <section class="relative pt-24 pb-20 overflow-hidden bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100/50 border border-orange-100 text-orange-700 text-xs font-bold uppercase tracking-wider mb-6">
                Get In Touch
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                {{ $content['contact_hero_title'] ?? "Let's Build Together" }}
            </h1>
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto font-medium">
                {{ $content['contact_hero_subtitle'] ?? 'Have a project in mind? Reach out to us and let\'s start a conversation about your next big idea.' }}
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none -z-10">
            <div class="absolute top-[-20%] left-[-10%] w-[30%] h-[60%] bg-orange-50 rounded-full blur-[100px] opacity-50"></div>
        </div>
    </section>

    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
                <!-- Contact Info -->
                <div class="space-y-12">
                    <div>
                        <span class="text-orange-primary font-bold uppercase tracking-widest text-xs mb-4 block">Contact Details</span>
                        <h2 class="text-4xl font-extrabold text-slate-900 mb-8 tracking-tight">Our Information</h2>
                        <p class="text-slate-500 font-medium text-lg leading-relaxed mb-10">We are always ready to discuss your projects, answer questions about our services, or provide a detailed quote for your construction needs.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <!-- Address -->
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 shrink-0 bg-orange-50 text-orange-primary rounded-2xl flex items-center justify-center shadow-sm group-hover:bg-orange-primary group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2">Office Headquarters</h4>
                                <a href="https://www.google.com/maps/place/Atom+Forge+Construction/@26.732891,83.3862048,164m/data=!3m1!1e3!4m22!1m15!4m14!1m6!1m2!1s0x399143be04f92235:0x5bd0ddd9ec36db2a!2sAtom+Forge+Construction,+HIG+II,+Gautam+Vihar+Vistar,+Taramandal,+Gorakhpur,+Uttar+Pradesh+273014!2m2!1d83.3862029!2d26.7327535!1m6!1m2!1s0x399143be04f92235:0x5bd0ddd9ec36db2a!2sAtom+Forge+Construction,+HIG+II,+Gautam+Vihar+Vistar,+Taramandal,+Gorakhpur,+Uttar+Pradesh+273014!2m2!1d83.3862029!2d26.7327535!3m5!1s0x399143be04f92235:0x5bd0ddd9ec36db2a!8m2!3d26.7327535!4d83.3862029!16s%2Fg%2F11yrsbgfwj" target="_blank" class="text-slate-500 font-medium leading-relaxed hover:text-orange-primary transition-colors">
                                    {{ $content['contact_address'] ?? 'HIG II, Gautam Vihar Vistar, Taramandal, Gorakhpur, Uttar Pradesh 273014' }}
                                </a>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 shrink-0 bg-orange-50 text-orange-primary rounded-2xl flex items-center justify-center shadow-sm group-hover:bg-orange-primary group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2">Phone Number</h4>
                                <p class="text-slate-500 font-medium leading-relaxed">{{ $content['contact_phone'] ?? '+91 8318754257' }}</p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="flex gap-6 group">
                            <div class="w-14 h-14 shrink-0 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center shadow-sm group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 mb-2">WhatsApp Us</h4>
                                <a href="https://wa.me/918318754257" target="_blank" class="text-slate-500 font-medium leading-relaxed hover:text-green-600 transition-colors">+91 8318754257</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-slate-50 p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-primary/5 rounded-full translate-x-1/2 -translate-y-1/2 blur-2xl"></div>
                    
                    <h3 class="text-2xl font-bold text-slate-900 mb-8 tracking-tight relative z-10">Send us a Message</h3>
                    <form id="whatsappForm" class="space-y-6 relative z-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Your Name</label>
                                <input type="text" id="name" placeholder="John Doe" required class="w-full py-4 px-6 rounded-xl border border-slate-200 bg-white text-slate-900 font-medium focus:border-orange-primary focus:ring-4 focus:ring-orange-primary/10 placeholder-slate-400 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                                <input type="email" id="email" placeholder="john@example.com" required class="w-full py-4 px-6 rounded-xl border border-slate-200 bg-white text-slate-900 font-medium focus:border-orange-primary focus:ring-4 focus:ring-orange-primary/10 placeholder-slate-400 transition-all outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Project Type</label>
                            <div class="relative">
                                <select id="project_type" class="w-full py-4 px-6 rounded-xl border border-slate-200 bg-white text-slate-900 font-medium focus:border-orange-primary focus:ring-4 focus:ring-orange-primary/10 transition-all appearance-none cursor-pointer outline-none">
                                    <option>Residential Project</option>
                                    <option>Commercial Project</option>
                                    <option>Interior Design</option>
                                    <option>General Inquiry</option>
                                </select>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Your Message</label>
                            <textarea id="message" rows="4" placeholder="How can we help you?" required class="w-full py-4 px-6 rounded-xl border border-slate-200 bg-white text-slate-900 font-medium focus:border-orange-primary focus:ring-4 focus:ring-orange-primary/10 placeholder-slate-400 transition-all outline-none resize-none"></textarea>
                        </div>
                        <button type="submit" class="w-full py-5 bg-green-600 text-white font-bold rounded-2xl hover:bg-green-700 transition-all shadow-lg shadow-green-500/20 uppercase tracking-widest text-sm flex items-center justify-center gap-3">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            Send via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="h-[500px] w-full bg-slate-100 border-t border-slate-100">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1781.92811524823!2d83.3862029!3d26.7327535!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399143be04f92235%3A0x5bd0ddd9ec36db2a!2sAtom%20Forge%20Construction!5e0!3m2!1sen!2sin!4v1715326800000!5m2!1sen!2sin" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            class="grayscale hover:grayscale-0 transition-all duration-700">
        </iframe>
    </section>
    <script>
        document.getElementById('whatsappForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const projectType = document.getElementById('project_type').value;
            const message = document.getElementById('message').value;
            
            const whatsappNumber = '918318754257';
            const text = `*New Message from Contact Form*%0A%0A` +
                         `*Name:* ${name}%0A` +
                         `*Email:* ${email}%0A` +
                         `*Project Type:* ${projectType}%0A` +
                         `*Message:* ${message}`;
            
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${text}`;
            
            window.open(whatsappUrl, '_blank');
        });
    </script>
@endsection
