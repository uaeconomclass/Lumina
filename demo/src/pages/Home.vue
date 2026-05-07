<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import AppLayout from '../layouts/AppLayout.vue'

const router = useRouter()

const stats = [
    { value: '500+', label: 'Vehicles Sold' },
    { value: '50',   label: 'Cars In Stock' },
    { value: '4.9★', label: 'Google Rating' },
    { value: '$0',   label: 'Hidden Fees' },
]

const featuredCars = [
    { id: 1, year: 2021, make: 'Toyota', model: 'Camry SE',   mileage: '34,210', price: '22,900', badge: 'Best Value',   from: '#0c1a3d', to: '#1e3a6e', img: 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800&q=80' },
    { id: 2, year: 2020, make: 'Honda',  model: 'CR-V EX',    mileage: '41,880', price: '26,500', badge: 'Just Arrived', from: '#1a1a2e', to: '#0f3460', img: 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80' },
    { id: 3, year: 2022, make: 'Ford',   model: 'F-150 XLT',  mileage: '28,440', price: '38,900', badge: 'Low Miles',    from: '#1c0a00', to: '#3d1c02', img: 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800&q=80' },
]

const features = [
    { icon: 'shield', title: 'CARFAX Reports',      desc: 'Every vehicle includes a free CARFAX report. Full history, zero surprises.' },
    { icon: 'tag',    title: 'No-Haggle Pricing',   desc: 'Our prices are set fair and final. No back-and-forth, no stress.' },
    { icon: 'credit', title: 'Financing Available', desc: 'We work with multiple lenders to get you the best rate possible.' },
    { icon: 'check',  title: '150-Point Inspection', desc: 'Every car is inspected by our certified technicians before hitting the lot.' },
]

const steps = [
    { n: '01', title: 'Browse Online',        desc: 'Explore our full inventory with detailed photos, specs, and pricing — all online.' },
    { n: '02', title: 'Schedule a Test Drive', desc: "Reserve your spot online or give us a call. We'll have the car ready and waiting." },
    { n: '03', title: 'Drive It Home',         desc: 'Simple paperwork, transparent deal. Most customers are on the road in under 2 hours.' },
]

const testimonials = [
    { name: 'Marcus T.',   location: 'Dallas, TX',  text: "Easiest car purchase I've ever made. No pressure, fair price, and I was driving home same day. AutoHaven is the real deal." },
    { name: 'Jennifer L.', location: 'Phoenix, AZ', text: "They were upfront about everything — even pointed out a tiny scratch I didn't notice. That kind of honesty is rare." },
    { name: 'David K.',    location: 'Austin, TX',  text: 'Already sent my brother here. These guys make buying a used car feel like it should — simple and fair.' },
]

const searchMake  = ref('')
const searchPrice = ref('')

function doSearch() {
    const query: Record<string, string> = {}
    if (searchMake.value)  query.make  = searchMake.value
    if (searchPrice.value) query.price = searchPrice.value
    router.push({ path: '/cars', query })
}
</script>

<template>
    <AppLayout>
        <div class="min-h-screen bg-[#0a0a0a] text-white">

            <!-- HERO -->
            <section class="relative min-h-screen flex items-center pt-16 overflow-hidden bg-[#0a0e1a]">
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1920&q=80" alt=""
                    class="absolute inset-0 w-full h-full object-cover object-center opacity-50"/>
                <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(10,14,26,0.75) 0%, rgba(15,23,42,0.60) 50%, rgba(26,14,6,0.70) 100%);"></div>
                <div class="absolute inset-0 opacity-[0.025]" style="background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,1) 1px, transparent 1px); background-size: 80px 80px;"></div>
                <div class="absolute top-1/3 left-1/4 w-[500px] h-[500px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(249,115,22,0.1) 0%, transparent 65%);"></div>

                <div class="relative mx-auto max-w-7xl px-6 py-28 w-full">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 mb-7 px-3.5 py-1.5 rounded-full border border-white/10 bg-white/5 text-sm text-white/55">
                            <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse shrink-0"></span>
                            Up to 50 Pre-Owned Vehicles Available
                        </div>
                        <h1 class="text-5xl sm:text-6xl lg:text-[5.5rem] font-bold text-white leading-[1.04] tracking-tight mb-6">
                            Find Your<br><span class="text-orange-400">Perfect Ride.</span>
                        </h1>
                        <p class="text-lg sm:text-xl text-white/45 max-w-md mb-10 leading-relaxed">
                            Quality pre-owned vehicles. No-haggle pricing. CARFAX on every car.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-2 p-2 rounded-2xl bg-white/8 backdrop-blur border border-white/10 max-w-2xl mb-10">
                            <select v-model="searchMake" class="flex-1 px-4 py-3 rounded-xl bg-white/10 text-white border-0 text-sm focus:outline-none cursor-pointer [&>option]:bg-slate-900">
                                <option value="">Any Make</option>
                                <option>BMW</option><option>Chevrolet</option><option>Ford</option>
                                <option>Honda</option><option>Hyundai</option><option>Jeep</option>
                                <option>Mazda</option><option>Nissan</option><option>Toyota</option>
                            </select>
                            <select v-model="searchPrice" class="flex-1 px-4 py-3 rounded-xl bg-white/10 text-white border-0 text-sm focus:outline-none cursor-pointer [&>option]:bg-slate-900">
                                <option value="">Any Price</option>
                                <option value="1">Under $20k</option>
                                <option value="2">$20k – $30k</option>
                                <option value="3">$30k – $40k</option>
                                <option value="4">$40k+</option>
                            </select>
                            <button @click="doSearch" class="px-8 py-3 rounded-xl bg-orange-500 text-white font-semibold text-sm hover:bg-orange-600 transition-colors whitespace-nowrap">
                                Search Cars
                            </button>
                        </div>

                        <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-white/35">
                            <span v-for="t in ['Free CARFAX Reports','No-Haggle Pricing','150-Point Inspection','Financing Available']" :key="t" class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-orange-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                {{ t }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/20">
                    <span class="text-[10px] tracking-widest uppercase">Scroll</span>
                    <div class="w-px h-10 bg-gradient-to-b from-white/20 to-transparent"></div>
                </div>
            </section>

            <!-- STATS -->
            <section class="bg-white border-b border-gray-100">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-gray-100">
                        <div v-for="stat in stats" :key="stat.label" class="py-8 px-6 text-center">
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ stat.value }}</div>
                            <div class="text-sm text-gray-400">{{ stat.label }}</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FEATURED INVENTORY -->
            <section id="inventory" class="py-24 bg-gray-50">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="flex items-end justify-between mb-12">
                        <div>
                            <div class="text-xs font-semibold text-orange-500 tracking-widest uppercase mb-2">Inventory</div>
                            <h2 class="text-4xl font-bold text-gray-900 tracking-tight">Featured Vehicles</h2>
                        </div>
                        <RouterLink to="/cars" class="hidden sm:flex items-center gap-1.5 text-sm font-semibold text-orange-500 hover:text-orange-600 transition-colors">
                            View All 50 Cars
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </RouterLink>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <RouterLink v-for="car in featuredCars" :key="car.id" :to="`/cars/${car.id}`"
                            class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 block">
                            <div class="relative h-56 overflow-hidden" :style="`background: linear-gradient(135deg, ${car.from}, ${car.to})`">
                                <img :src="car.img" :alt="`${car.year} ${car.make} ${car.model}`"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy"/>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-black/20"></div>
                                <div class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-orange-500 text-white text-xs font-semibold z-10">{{ car.badge }}</div>
                                <div class="absolute top-3 right-3 px-3 py-1.5 rounded-lg bg-black/50 backdrop-blur-sm text-white text-sm font-bold z-10">${{ car.price }}</div>
                            </div>
                            <div class="p-5">
                                <div class="text-xs text-gray-400 font-medium mb-1">{{ car.year }}</div>
                                <h3 class="text-lg font-bold text-gray-900 mb-3">{{ car.make }} {{ car.model }}</h3>
                                <div class="flex items-center gap-4 text-sm text-gray-400 mb-5">
                                    <span>{{ car.mileage }} mi</span>
                                    <span class="text-emerald-600 font-medium flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        CARFAX Clean
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-gray-900">${{ car.price }}</span>
                                    <span class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-orange-500 text-white text-sm font-semibold group-hover:bg-orange-600 transition-colors">
                                        View Details
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </span>
                                </div>
                            </div>
                        </RouterLink>
                    </div>

                    <div class="mt-8 text-center sm:hidden">
                        <RouterLink to="/cars" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-gray-200 text-sm font-semibold text-gray-700">View All 50 Cars →</RouterLink>
                    </div>
                </div>
            </section>

            <!-- WHY -->
            <section id="why" class="py-24 bg-white">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="text-center mb-16">
                        <div class="text-xs font-semibold text-orange-500 tracking-widest uppercase mb-3">Why AutoHaven</div>
                        <h2 class="text-4xl font-bold text-gray-900 tracking-tight">The difference is in<br class="hidden sm:block"> the details.</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                        <div v-for="f in features" :key="f.title" class="text-center">
                            <div class="w-12 h-12 mx-auto mb-5 rounded-xl bg-orange-50 flex items-center justify-center">
                                <svg v-if="f.icon==='shield'" class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <svg v-else-if="f.icon==='tag'" class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <svg v-else-if="f.icon==='credit'" class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <svg v-else class="w-5 h-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-2">{{ f.title }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ f.desc }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- HOW IT WORKS -->
            <section class="py-24 bg-gray-50">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="text-center mb-16">
                        <div class="text-xs font-semibold text-orange-500 tracking-widest uppercase mb-3">The Process</div>
                        <h2 class="text-4xl font-bold text-gray-900 tracking-tight">How It Works</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div v-for="(step, i) in steps" :key="step.n" class="relative text-center">
                            <div v-if="i < steps.length - 1" class="hidden md:block absolute top-8 left-[calc(50%+2rem)] right-[calc(-50%+2rem)] h-px bg-orange-100"></div>
                            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-white border-2 border-orange-200 flex items-center justify-center shadow-sm relative z-10">
                                <span class="text-base font-bold text-orange-500 font-mono">{{ step.n }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-3">{{ step.title }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">{{ step.desc }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- TESTIMONIALS -->
            <section class="py-24 bg-white">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="text-center mb-16">
                        <div class="text-xs font-semibold text-orange-500 tracking-widest uppercase mb-3">Reviews</div>
                        <h2 class="text-4xl font-bold text-gray-900 tracking-tight">What Our Customers Say</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div v-for="t in testimonials" :key="t.name" class="p-7 rounded-2xl border border-gray-100 bg-gray-50/80">
                            <div class="flex gap-0.5 mb-5">
                                <svg v-for="i in 5" :key="i" class="w-4 h-4 text-orange-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed mb-6">"{{ t.text }}"</p>
                            <div>
                                <div class="font-semibold text-gray-900 text-sm">{{ t.name }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">{{ t.location }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section id="contact" class="py-24 overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1a0e06 100%);">
                <div class="mx-auto max-w-3xl px-6 text-center">
                    <div class="text-xs font-semibold text-orange-400 tracking-widest uppercase mb-4">Get Started</div>
                    <h2 class="text-4xl sm:text-5xl font-bold text-white tracking-tight mb-5">Ready to Find<br>Your Next Car?</h2>
                    <p class="text-white/40 text-lg mb-10">Browse 50 hand-picked vehicles or give us a call.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                        <RouterLink to="/cars" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition-colors text-center">Browse Inventory</RouterLink>
                        <a href="tel:+18001234567" class="w-full sm:w-auto px-8 py-4 rounded-xl border border-white/15 text-white/70 font-medium hover:border-white/30 hover:text-white transition-all text-center">Call (800) 123-4567</a>
                    </div>
                    <div class="mt-12 pt-10 border-t border-white/10 flex flex-wrap items-center justify-center gap-6 text-sm text-white/25">
                        <span>📍 123 Auto Drive, Dallas, TX 75201</span>
                        <span>🕐 Mon–Sat 9am–7pm · Sun 11am–5pm</span>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
