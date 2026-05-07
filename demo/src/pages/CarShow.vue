<script setup lang="ts">
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import AppLayout from '../layouts/AppLayout.vue'

const car = {
    year: 2021, make: 'Toyota', model: 'Camry SE',
    price: 22900, monthly: 389, mileage: '34,210',
    vin: '4T1B11HK1MU469173', transmission: 'Automatic',
    engine: '2.5L 4-Cylinder', drivetrain: 'FWD',
    color_ext: 'Midnight Black Metallic', color_int: 'Black Fabric',
    mpg_city: 28, mpg_hwy: 39,
    description: `This 2021 Toyota Camry SE is everything you want in a daily driver — refined, reliable, and sharp. With just 34,210 miles on the clock, it's got plenty of life left and drives like new. The SE trim adds sportier styling, a gloss-black grille, and upgraded interior touches over the base model.\n\nWe inspected this car top-to-bottom. CARFAX shows one careful owner, clean title, and zero reported accidents. Brakes, tires, and fluids are all fresh. It's ready to go.\n\nNo games. No doc fee surprises. Just a fair price and a handshake.`,
    photos: [
        'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=1400&q=85',
        'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200&q=85',
        'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=1200&q=85',
        'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=1200&q=85',
        'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=1200&q=85',
    ],
}

const specs = [
    { label: 'Year', value: '2021' }, { label: 'Make', value: 'Toyota' },
    { label: 'Model', value: 'Camry SE' }, { label: 'Mileage', value: '34,210 mi' },
    { label: 'Engine', value: '2.5L 4-Cylinder' }, { label: 'Transmission', value: 'Automatic' },
    { label: 'Drivetrain', value: 'FWD' }, { label: 'Fuel Type', value: 'Gasoline' },
    { label: 'MPG', value: '28 city / 39 hwy' }, { label: 'Ext. Color', value: 'Midnight Black Metallic' },
    { label: 'Int. Color', value: 'Black Fabric' }, { label: 'Seats', value: '5' },
    { label: 'Title', value: 'Clean' }, { label: 'VIN', value: '4T1B11HK1MU469173' },
]

const activePhoto = ref(0)
const form = ref({ name: '', phone: '', email: '', message: "Hi, I'm interested in the 2021 Toyota Camry SE listed at $22,900. Is it still available?" })
const submitted = ref(false)
</script>

<template>
    <AppLayout>
        <div class="pt-16">

            <!-- MAIN PHOTO -->
            <div class="relative bg-gray-950 overflow-hidden" style="height: 60vh; min-height: 400px;">
                <img :src="car.photos[activePhoto]" :alt="`${car.year} ${car.make} ${car.model}`" class="w-full h-full object-cover transition-all duration-500"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
                <div class="absolute bottom-0 inset-x-0 p-6 sm:p-10">
                    <div class="mx-auto max-w-7xl flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                        <div>
                            <div class="text-white/60 text-sm font-medium mb-1">{{ car.year }}</div>
                            <h1 class="text-3xl sm:text-5xl font-bold text-white tracking-tight">{{ car.make }} {{ car.model }}</h1>
                        </div>
                        <div class="text-right">
                            <div class="text-white/50 text-sm mb-0.5">Listed Price</div>
                            <div class="text-4xl sm:text-5xl font-bold text-white">${{ car.price.toLocaleString() }}</div>
                            <div class="text-white/50 text-sm mt-1">or ~${{ car.monthly }}/mo</div>
                        </div>
                    </div>
                </div>
                <div class="absolute top-4 right-4 px-3 py-1.5 rounded-full bg-black/50 backdrop-blur-sm text-white text-xs font-medium">
                    {{ activePhoto + 1 }} / {{ car.photos.length }}
                </div>
            </div>

            <!-- THUMBNAILS -->
            <div class="bg-gray-950 px-4 pb-3 pt-2">
                <div class="mx-auto max-w-7xl flex gap-2 overflow-x-auto pb-1">
                    <button v-for="(photo, i) in car.photos" :key="i" @click="activePhoto = i"
                        class="shrink-0 w-24 h-14 rounded-lg overflow-hidden border-2 transition-all"
                        :class="activePhoto === i ? 'border-orange-500' : 'border-transparent opacity-50 hover:opacity-80'">
                        <img :src="photo" :alt="`Photo ${i+1}`" class="w-full h-full object-cover"/>
                    </button>
                </div>
            </div>
        </div>

        <!-- HIGHLIGHTS BAR -->
        <div class="bg-white border-b border-gray-100 sticky top-16 z-40 shadow-sm">
            <div class="mx-auto max-w-7xl px-6">
                <div class="flex items-center gap-6 overflow-x-auto py-3 text-sm">
                    <span class="flex items-center gap-2 shrink-0 text-gray-600"><span class="text-gray-400">Mileage</span><span class="font-semibold text-gray-900">{{ car.mileage }} mi</span></span>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <span class="flex items-center gap-2 shrink-0 text-gray-600"><span class="text-gray-400">Engine</span><span class="font-semibold text-gray-900">{{ car.engine }}</span></span>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <span class="flex items-center gap-2 shrink-0 text-gray-600"><span class="text-gray-400">Trans.</span><span class="font-semibold text-gray-900">{{ car.transmission }}</span></span>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <span class="flex items-center gap-2 shrink-0 text-gray-600"><span class="text-gray-400">MPG</span><span class="font-semibold text-gray-900">{{ car.mpg_city }}/{{ car.mpg_hwy }}</span></span>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <span class="flex items-center gap-1.5 shrink-0 text-emerald-600 font-semibold">✓ CARFAX Clean</span>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <span class="flex items-center gap-1.5 shrink-0 text-emerald-600 font-semibold">✓ 1-Owner</span>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <span class="flex items-center gap-1.5 shrink-0 text-emerald-600 font-semibold">✓ 0 Accidents</span>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="mx-auto max-w-7xl px-6 py-12">
            <div class="flex flex-col lg:flex-row gap-10">

                <!-- LEFT -->
                <div class="flex-1 min-w-0 space-y-10">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">About This Vehicle</h2>
                        <div class="text-gray-600 leading-relaxed whitespace-pre-line text-[15px]">{{ car.description }}</div>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Vehicle Details</h2>
                        <div class="rounded-2xl border border-gray-100 overflow-hidden">
                            <div v-for="(spec, i) in specs" :key="spec.label"
                                class="flex items-center justify-between px-5 py-3.5 text-sm"
                                :class="i % 2 === 0 ? 'bg-white' : 'bg-gray-50/70'">
                                <span class="text-gray-500">{{ spec.label }}</span>
                                <span class="font-semibold text-gray-900">{{ spec.value }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 mb-1">CARFAX Vehicle History Report</div>
                                <div class="text-sm text-gray-600 leading-relaxed">
                                    <strong class="text-gray-900">1 owner · Clean title · 0 reported accidents.</strong> Service records on file.
                                </div>
                                <button class="mt-3 text-sm font-semibold text-emerald-700 flex items-center gap-1">
                                    View Full CARFAX Report →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT — sticky -->
                <div class="w-full lg:w-[380px] shrink-0">
                    <div class="sticky top-36 space-y-4">

                        <div class="rounded-2xl border border-gray-100 bg-white shadow-lg p-6">
                            <div class="flex items-start justify-between mb-1">
                                <div>
                                    <div class="text-3xl font-bold text-gray-900">${{ car.price.toLocaleString() }}</div>
                                    <div class="text-sm text-gray-400 mt-0.5">No hidden fees · No doc fee</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-orange-500">${{ car.monthly }}/mo</div>
                                    <div class="text-xs text-gray-400">est. financing</div>
                                </div>
                            </div>
                            <div class="mt-5 space-y-2.5">
                                <button class="w-full py-3.5 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition-colors text-sm">Apply for Financing</button>
                                <a href="tel:+18001234567" class="w-full py-3.5 rounded-xl border-2 border-gray-200 text-gray-800 font-semibold hover:border-orange-300 hover:text-orange-600 transition-all text-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    Call (800) 123-4567
                                </a>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-gray-100 bg-white shadow-lg p-6">
                            <div v-if="!submitted">
                                <h3 class="font-bold text-gray-900 mb-1">Send a Message</h3>
                                <p class="text-sm text-gray-400 mb-5">We'll get back to you within the hour.</p>
                                <div class="space-y-3">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1.5">First Name</label>
                                            <input v-model="form.name" type="text" placeholder="John" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all placeholder:text-gray-300"/>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Phone</label>
                                            <input v-model="form.phone" type="tel" placeholder="(555) 000-0000" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all placeholder:text-gray-300"/>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                                        <input v-model="form.email" type="email" placeholder="john@email.com" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all placeholder:text-gray-300"/>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Message</label>
                                        <textarea v-model="form.message" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all resize-none"></textarea>
                                    </div>
                                    <button @click="submitted=true" class="w-full py-3 rounded-xl bg-gray-900 text-white font-semibold text-sm hover:bg-gray-800 transition-colors">Send Message</button>
                                </div>
                            </div>
                            <div v-else class="py-6 text-center">
                                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div class="font-bold text-gray-900 mb-1">Message Sent!</div>
                                <p class="text-sm text-gray-500">We'll reach out within the hour.</p>
                            </div>
                        </div>

                        <div class="rounded-xl border border-gray-100 px-4 py-3 flex items-center justify-between text-sm bg-gray-50">
                            <span class="text-gray-400">VIN</span>
                            <span class="font-mono font-semibold text-gray-700 tracking-wide">{{ car.vin }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
