<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const car = {
    id: 1,
    year: 2021,
    make: 'Toyota',
    model: 'Camry SE',
    price: 22900,
    monthly: 389,
    mileage: '34,210',
    vin: '4T1B11HK1MU469173',
    transmission: 'Automatic',
    fuel: 'Gasoline',
    engine: '2.5L 4-Cylinder',
    drivetrain: 'FWD',
    color_ext: 'Midnight Black Metallic',
    color_int: 'Black Fabric',
    mpg_city: 28,
    mpg_hwy: 39,
    seats: 5,
    carfax: true,
    one_owner: true,
    accidents: 0,
    description: `This 2021 Toyota Camry SE is everything you want in a daily driver — refined, reliable, and sharp. With just 34,210 miles on the clock, it's got plenty of life left and drives like new. The SE trim adds sportier styling, a gloss-black grille, and upgraded interior touches over the base model.

We inspected this car top-to-bottom. CARFAX shows one careful owner, clean title, and zero reported accidents. Brakes, tires, and fluids are all fresh. It's ready to go.

No games. No doc fee surprises. Just a fair price and a handshake.`,
    photos: [
        'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=1400&q=85',
        'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=1200&q=85',
        'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=1200&q=85',
        'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=1200&q=85',
        'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=1200&q=85',
    ],
}

const specs = [
    { label: 'Year',         value: '2021' },
    { label: 'Make',         value: 'Toyota' },
    { label: 'Model',        value: 'Camry SE' },
    { label: 'Mileage',      value: '34,210 mi' },
    { label: 'Engine',       value: '2.5L 4-Cylinder' },
    { label: 'Transmission', value: 'Automatic' },
    { label: 'Drivetrain',   value: 'FWD' },
    { label: 'Fuel Type',    value: 'Gasoline' },
    { label: 'MPG',          value: '28 city / 39 hwy' },
    { label: 'Ext. Color',   value: 'Midnight Black Metallic' },
    { label: 'Int. Color',   value: 'Black Fabric' },
    { label: 'Seats',        value: '5' },
    { label: 'Title',        value: 'Clean' },
    { label: 'VIN',          value: '4T1B11HK1MU469173' },
]

const activePhoto = ref(0)

const form = ref({ name: '', phone: '', email: '', message: `Hi, I'm interested in the 2021 Toyota Camry SE listed at $22,900. Is it still available?` })
const submitted = ref(false)

function submit() {
    submitted.value = true
}
</script>

<template>
    <Head title="2021 Toyota Camry SE — AutoHaven" />

    <div class="min-h-screen bg-white text-gray-900 antialiased font-sans">

        <!-- NAV -->
        <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-100">
            <div class="mx-auto max-w-7xl px-6 h-16 flex items-center justify-between">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-orange-500 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight">AutoHaven</span>
                </a>

                <nav class="hidden md:flex items-center gap-1 text-sm text-gray-500">
                    <a href="/" class="px-3 py-1.5 hover:text-gray-900 transition-colors rounded-lg hover:bg-gray-50">Home</a>
                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    <a href="/#inventory" class="px-3 py-1.5 hover:text-gray-900 transition-colors rounded-lg hover:bg-gray-50">Inventory</a>
                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    <span class="px-3 py-1.5 text-gray-900 font-medium">2021 Toyota Camry SE</span>
                </nav>

                <a href="tel:+18001234567" class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-orange-500 text-white text-sm font-semibold hover:bg-orange-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Call Us
                </a>
            </div>
        </header>

        <!-- HERO PHOTO GALLERY -->
        <div class="pt-16">

            <!-- Main photo -->
            <div class="relative bg-gray-950 overflow-hidden" style="height: 60vh; min-height: 400px;">
                <img
                    :src="car.photos[activePhoto]"
                    :alt="`${car.year} ${car.make} ${car.model}`"
                    class="w-full h-full object-cover transition-all duration-500"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>

                <!-- Bottom overlay: title + price -->
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

                <!-- Photo counter -->
                <div class="absolute top-4 right-4 px-3 py-1.5 rounded-full bg-black/50 backdrop-blur-sm text-white text-xs font-medium">
                    {{ activePhoto + 1 }} / {{ car.photos.length }}
                </div>
            </div>

            <!-- Thumbnail strip -->
            <div class="bg-gray-950 px-4 pb-3 pt-2">
                <div class="mx-auto max-w-7xl">
                    <div class="flex gap-2 overflow-x-auto pb-1">
                        <button
                            v-for="(photo, i) in car.photos" :key="i"
                            @click="activePhoto = i"
                            class="shrink-0 w-24 h-14 rounded-lg overflow-hidden border-2 transition-all"
                            :class="activePhoto === i ? 'border-orange-500' : 'border-transparent opacity-50 hover:opacity-80'"
                        >
                            <img :src="photo" :alt="`Photo ${i+1}`" class="w-full h-full object-cover"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- QUICK HIGHLIGHTS BAR -->
        <div class="bg-white border-b border-gray-100 sticky top-16 z-40 shadow-sm">
            <div class="mx-auto max-w-7xl px-6">
                <div class="flex items-center gap-6 overflow-x-auto py-3 text-sm">
                    <div class="flex items-center gap-2 shrink-0">
                        <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span class="text-gray-500">Mileage</span>
                        <span class="font-semibold text-gray-900">{{ car.mileage }} mi</span>
                    </div>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <div class="flex items-center gap-2 shrink-0">
                        <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-gray-500">Engine</span>
                        <span class="font-semibold text-gray-900">{{ car.engine }}</span>
                    </div>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <div class="flex items-center gap-2 shrink-0">
                        <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <span class="text-gray-500">Trans.</span>
                        <span class="font-semibold text-gray-900">{{ car.transmission }}</span>
                    </div>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <div class="flex items-center gap-2 shrink-0">
                        <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                        </svg>
                        <span class="text-gray-500">Fuel</span>
                        <span class="font-semibold text-gray-900">{{ car.mpg_city }}/{{ car.mpg_hwy }} MPG</span>
                    </div>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <div class="flex items-center gap-2 shrink-0 text-emerald-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="font-semibold">CARFAX Clean</span>
                    </div>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <div class="flex items-center gap-2 shrink-0 text-emerald-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">1-Owner</span>
                    </div>
                    <div class="w-px h-4 bg-gray-200 shrink-0"></div>
                    <div class="flex items-center gap-2 shrink-0 text-emerald-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">0 Accidents</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="mx-auto max-w-7xl px-6 py-12">
            <div class="flex flex-col lg:flex-row gap-10">

                <!-- LEFT COLUMN -->
                <div class="flex-1 min-w-0 space-y-10">

                    <!-- Description -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">About This Vehicle</h2>
                        <div class="text-gray-600 leading-relaxed whitespace-pre-line text-[15px]">{{ car.description }}</div>
                    </div>

                    <!-- Specs table -->
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Vehicle Details</h2>
                        <div class="rounded-2xl border border-gray-100 overflow-hidden">
                            <div
                                v-for="(spec, i) in specs" :key="spec.label"
                                class="flex items-center justify-between px-5 py-3.5 text-sm"
                                :class="i % 2 === 0 ? 'bg-white' : 'bg-gray-50/70'"
                            >
                                <span class="text-gray-500">{{ spec.label }}</span>
                                <span class="font-semibold text-gray-900 text-right">{{ spec.value }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- CARFAX badge section -->
                    <div class="rounded-2xl border border-emerald-100 bg-emerald-50/50 p-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 mb-1">CARFAX Vehicle History Report</div>
                                <div class="text-sm text-gray-600 leading-relaxed">
                                    This vehicle comes with a free CARFAX report.
                                    <strong class="text-gray-900">1 owner · Clean title · 0 reported accidents · No damage reported.</strong>
                                    Service records on file.
                                </div>
                                <button class="mt-3 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors flex items-center gap-1">
                                    View Full CARFAX Report
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN — sticky price + inquiry card -->
                <div class="w-full lg:w-[380px] shrink-0">
                    <div class="sticky top-36 space-y-4">

                        <!-- Price card -->
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
                                <button class="w-full py-3.5 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition-colors text-sm">
                                    Apply for Financing
                                </button>
                                <a href="tel:+18001234567" class="w-full py-3.5 rounded-xl border-2 border-gray-200 text-gray-800 font-semibold hover:border-orange-300 hover:text-orange-600 transition-all text-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    Call (800) 123-4567
                                </a>
                            </div>

                            <div class="mt-4 flex items-center gap-1.5 text-xs text-gray-400">
                                <svg class="w-3.5 h-3.5 text-orange-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                Usually responds within 1 hour · Mon–Sat 9am–7pm
                            </div>
                        </div>

                        <!-- Inquiry form -->
                        <div class="rounded-2xl border border-gray-100 bg-white shadow-lg p-6">

                            <div v-if="!submitted">
                                <h3 class="font-bold text-gray-900 mb-1">Send a Message</h3>
                                <p class="text-sm text-gray-400 mb-5">We'll get back to you within the hour.</p>

                                <div class="space-y-3">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1.5">First Name</label>
                                            <input
                                                v-model="form.name"
                                                type="text"
                                                placeholder="John"
                                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all placeholder:text-gray-300"
                                            />
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Phone</label>
                                            <input
                                                v-model="form.phone"
                                                type="tel"
                                                placeholder="(555) 000-0000"
                                                class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all placeholder:text-gray-300"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                                        <input
                                            v-model="form.email"
                                            type="email"
                                            placeholder="john@email.com"
                                            class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all placeholder:text-gray-300"
                                        />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Message</label>
                                        <textarea
                                            v-model="form.message"
                                            rows="3"
                                            class="w-full px-3.5 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 transition-all resize-none placeholder:text-gray-300"
                                        ></textarea>
                                    </div>
                                    <button
                                        @click="submit"
                                        class="w-full py-3 rounded-xl bg-gray-900 text-white font-semibold text-sm hover:bg-gray-800 transition-colors"
                                    >
                                        Send Message
                                    </button>
                                </div>

                                <p class="mt-4 text-[11px] text-gray-300 text-center leading-relaxed">
                                    By submitting you agree to be contacted about this vehicle. We never spam.
                                </p>
                            </div>

                            <!-- Success state -->
                            <div v-else class="py-6 text-center">
                                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="font-bold text-gray-900 mb-1">Message Sent!</div>
                                <p class="text-sm text-gray-500">We'll reach out to you within the hour. Talk soon.</p>
                            </div>
                        </div>

                        <!-- VIN copy box -->
                        <div class="rounded-xl border border-gray-100 px-4 py-3 flex items-center justify-between text-sm bg-gray-50">
                            <span class="text-gray-400">VIN</span>
                            <span class="font-mono font-semibold text-gray-700 tracking-wide">{{ car.vin }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="mt-16 bg-slate-950 border-t border-white/5 py-8">
            <div class="mx-auto max-w-7xl px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-white/20">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-md bg-orange-500 flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    </div>
                    <span class="text-white/40 font-semibold tracking-tight">AutoHaven</span>
                </div>
                <span>© 2025 AutoHaven. All rights reserved.</span>
            </div>
        </footer>

    </div>
</template>
