<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-sky-600 to-indigo-700 rounded-2xl p-12 text-white mb-12 shadow-glow" data-aos="fade-up">
                <h1 class="text-5xl font-bold mb-4">Afghanistan Engineers Association</h1>
                <p class="text-xl text-blue-100">Empowering the next generation of engineers through quality education and hands-on training</p>
            </div>

            <!-- Mission Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]" data-aos="fade-up">
                    <div class="w-16 h-16 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Our Mission</h3>
                    <p class="text-slate-400 leading-relaxed">
                        To provide accessible, high-quality engineering education that equips students with practical skills 
                        and theoretical knowledge needed to excel in their careers and contribute to technological advancement.
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-[0_0_30px_rgba(0,0,0,0.3)]" data-aos="fade-up" data-aos-delay="80">
                    <div class="w-16 h-16 bg-purple-500/20 border border-purple-500/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Our Vision</h3>
                    <p class="text-slate-400 leading-relaxed">
                        To become a leading engineering education institution recognized for excellence in teaching, 
                        innovation in curriculum design, and success in producing industry-ready professionals.
                    </p>
                </div>
            </div>

            <!-- What We Offer -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl shadow-[0_0_30px_rgba(0,0,0,0.3)] p-12 mb-12" data-aos="fade-up">
                <h3 class="text-3xl font-bold text-white mb-8 text-center">What We Offer</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-2">Expert-Led Courses</h4>
                        <p class="text-slate-400">Learn from experienced engineers and industry professionals with real-world expertise</p>
                    </div>

                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-2">Certified Programs</h4>
                        <p class="text-slate-400">Earn recognized certificates upon completion to boost your career prospects</p>
                    </div>

                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-2">Career Support</h4>
                        <p class="text-slate-400">Get guidance and support to transition into engineering roles successfully</p>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 text-center hover:border-white/20 transition-all" data-aos="zoom-in" data-aos-delay="0">
                    <div class="text-4xl font-bold text-blue-400 mb-2">500+</div>
                    <div class="text-slate-400">Students Enrolled</div>
                </div>
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 text-center hover:border-white/20 transition-all" data-aos="zoom-in" data-aos-delay="60">
                    <div class="text-4xl font-bold text-purple-400 mb-2">20+</div>
                    <div class="text-slate-400">Expert Courses</div>
                </div>
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 text-center hover:border-white/20 transition-all" data-aos="zoom-in" data-aos-delay="120">
                    <div class="text-4xl font-bold text-emerald-400 mb-2">15+</div>
                    <div class="text-slate-400">Professional Instructors</div>
                </div>
                <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 text-center hover:border-white/20 transition-all" data-aos="zoom-in" data-aos-delay="180">
                    <div class="text-4xl font-bold text-orange-400 mb-2">95%</div>
                    <div class="text-slate-400">Success Rate</div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-gradient-to-r from-sky-600 to-indigo-700 rounded-2xl p-12 text-center text-white shadow-glow" data-aos="fade-up">
                <h3 class="text-3xl font-bold mb-4">Ready to Start Your Journey?</h3>
                <p class="text-xl text-blue-100 mb-8">Join hundreds of successful students and transform your career</p>
                <a href="{{ route('courses.public.index') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                    Browse Our Courses
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
