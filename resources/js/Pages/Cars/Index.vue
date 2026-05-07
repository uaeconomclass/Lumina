<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref, computed, watch, onMounted } from 'vue'

interface Car {
    id: number; year: number; make: string; model: string
    price: number; mileage: number; transmission: string
    body: string; badge?: string; img: string; carfax: boolean
}

const allCars: Car[] = [
    { id: 1,  year: 2021, make: 'Toyota',    model: 'Camry SE',          price: 22900, mileage: 34210, transmission: 'Automatic', body: 'Sedan',   badge: 'Best Value',   img: 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800&q=80', carfax: true },
    { id: 2,  year: 2020, make: 'Honda',     model: 'CR-V EX',           price: 26500, mileage: 41880, transmission: 'CVT',       body: 'SUV',     badge: 'Just Arrived', img: 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80', carfax: true },
    { id: 3,  year: 2022, make: 'Ford',      model: 'F-150 XLT',         price: 38900, mileage: 28440, transmission: 'Automatic', body: 'Truck',   badge: 'Low Miles',    img: 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800&q=80', carfax: true },
    { id: 4,  year: 2019, make: 'BMW',       model: '330i xDrive',        price: 29900, mileage: 52100, transmission: 'Automatic', body: 'Sedan',   badge: undefined,      img: 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80',     carfax: true },
    { id: 5,  year: 2021, make: 'Chevrolet', model: 'Equinox LT',         price: 24500, mileage: 31200, transmission: 'Automatic', body: 'SUV',     badge: undefined,      img: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&q=80',     carfax: true },
    { id: 6,  year: 2020, make: 'Nissan',    model: 'Altima SR',          price: 19900, mileage: 48700, transmission: 'CVT',       body: 'Sedan',   badge: undefined,      img: 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&q=80',  carfax: true },
    { id: 7,  year: 2022, make: 'Honda',     model: 'Civic Sport',        price: 22100, mileage: 18900, transmission: 'CVT',       body: 'Sedan',   badge: 'Low Miles',    img: 'https://images.unsplash.com/photo-1583121274602-3e2820c69888?w=800&q=80',  carfax: true },
    { id: 8,  year: 2019, make: 'Ford',      model: 'Explorer XLT',       price: 31500, mileage: 61400, transmission: 'Automatic', body: 'SUV',     badge: undefined,      img: 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?w=800&q=80', carfax: true },
    { id: 9,  year: 2021, make: 'Toyota',    model: 'RAV4 XLE',           price: 32900, mileage: 27600, transmission: 'Automatic', body: 'SUV',     badge: 'Popular',      img: 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&q=80', carfax: true },
    { id: 10, year: 2020, make: 'Jeep',      model: 'Grand Cherokee Ltd', price: 34500, mileage: 44200, transmission: 'Automatic', body: 'SUV',     badge: undefined,      img: 'https://images.unsplash.com/photo-1590362891991-f776e747a588?w=800&q=80', carfax: true },
    { id: 11, year: 2022, make: 'Mazda',     model: 'CX-5 GT',            price: 29800, mileage: 22100, transmission: 'Automatic', body: 'SUV',     badge: 'Just Arrived', img: 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&q=80',    carfax: true },
    { id: 12, year: 2019, make: 'Hyundai',   model: 'Sonata SEL',         price: 17900, mileage: 57300, transmission: 'Automatic', body: 'Sedan',   badge: undefined,      img: 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&q=80',    carfax: true },
]

const makes     = ['All Makes', 'BMW', 'Chevrolet', 'Ford', 'Honda', 'Hyundai', 'Jeep', 'Mazda', 'Nissan', 'Toyota']
const bodyTypes = ['All Types', 'Sedan', 'SUV', 'Truck']
const priceOpts = [
    { label: 'Any Price', min: 0,     max: Infinity },
    { label: 'Under $20k', min: 0,    max: 20000 },
    { label: '$20k – $30k', min: 20000, max: 30000 },
    { label: '$30k – $40k', min: 30000, max: 40000 },
    { label: '$40k+',       min: 40000, max: Infinity },
]
const sortOpts = [
    { label: 'Newest First',   value: 'year-desc' },
    { label: 'Price: Low → High', value: 'price-asc' },
    { label: 'Price: High → Low', value: 'price-desc' },
    { label: 'Lowest Mileage',  value: 'mileage-asc' },
]

const filterMake  = ref('All Makes')
const filterBody  = ref('All Types')
const filterPrice = ref(0)
const sortBy      = ref('year-desc')
const viewMode    = ref<'grid' | 'list'>('grid')
const page        = ref(1)
const perPage     = 9

const filteredCars = computed(() => {
    const priceRange = priceOpts[filterPrice.value]
    let list = allCars.filter(c => {
        if (filterMake.value !== 'All Makes' && c.make !== filterMake.value) return false
        if (filterBody.value !== 'All Types' && c.body !== filterBody.value) return false
        if (c.price < priceRange.min || c.price > priceRange.max) return false
        return true
    })
    if (sortBy.value === 'year-desc')   list = [...list].sort((a, b) => b.year - a.year)
    if (sortBy.value === 'price-asc')   list = [...list].sort((a, b) => a.price - b.price)
    if (sortBy.value === 'price-desc')  list = [...list].sort((a, b) => b.price - a.price)
    if (sortBy.value === 'mileage-asc') list = [...list].sort((a, b) => a.mileage - b.mileage)
    return list
})

const totalPages    = computed(() => Math.max(1, Math.ceil(filteredCars.value.length / perPage)))
const paginatedCars = computed(() => filteredCars.value.slice((page.value - 1) * perPage, page.value * perPage))

const activeFilters = computed(() => {
    const f = []
    if (filterMake.value !== 'All Makes') f.push({ key: 'make',  label: filterMake.value })
    if (filterBody.value !== 'All Types') f.push({ key: 'body',  label: filterBody.value })
    if (filterPrice.value !== 0)          f.push({ key: 'price', label: priceOpts[filterPrice.value].label })
    return f
})

watch([filterMake, filterBody, filterPrice, sortBy], () => { page.value = 1 })

onMounted(() => {
    const params = new URLSearchParams(window.location.search)
    const make  = params.get('make')
    const price = params.get('price')
    if (make && makes.includes(make))       filterMake.value  = make
    if (price && Number(price) < priceOpts.length) filterPrice.value = Number(price)
})

function removeFilter(key: string) {
    if (key === 'make')  filterMake.value  = 'All Makes'
    if (key === 'body')  filterBody.value  = 'All Types'
    if (key === 'price') filterPrice.value = 0
}

function clearAll() {
    filterMake.value  = 'All Makes'
    filterBody.value  = 'All Types'
    filterPrice.value = 0
}

function formatMileage(n: number) {
    return n.toLocaleString()
}
</script>

<template>
    <Head title="Browse Inventory — AutoHaven" />
    <AppLayout>

        <!-- HERO BANNER -->
        <div class="pt-16">
            <div class="relative overflow-hidden py-14" style="background: linear-gradient(135deg, #0f172a 0%, #1a0e06 100%);">
                <div class="absolute inset-0 opacity-[0.03]"
                    style="background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,1) 1px, transparent 1px); background-size: 60px 60px;"></div>
                <div class="absolute top-0 right-0 w-96 h-96 rounded-full pointer-events-none"
                    style="background: radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 65%);"></div>
                <div class="mx-auto max-w-7xl px-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="text-xs font-semibold text-orange-400 tracking-widest uppercase mb-2">AutoHaven</div>
                            <h1 class="text-4xl sm:text-5xl font-bold text-white tracking-tight">Browse Inventory</h1>
                            <p class="text-white/40 mt-2 text-sm">
                                Up to 50 vehicles available · All with CARFAX · No-haggle pricing
                            </p>
                        </div>
                        <div class="flex gap-3">
                            <div class="px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-center">
                                <div class="text-2xl font-bold text-white">50</div>
                                <div class="text-xs text-white/40">In Stock</div>
                            </div>
                            <div class="px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-center">
                                <div class="text-2xl font-bold text-orange-400">$0</div>
                                <div class="text-xs text-white/40">Hidden Fees</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTER BAR -->
        <div class="sticky top-16 z-40 bg-white border-b border-gray-100 shadow-sm">
            <div class="mx-auto max-w-7xl px-6 py-3">
                <div class="flex flex-wrap items-center gap-3">

                    <!-- Make -->
                    <div class="relative">
                        <select v-model="filterMake"
                            class="appearance-none h-9 pl-3 pr-8 rounded-lg border border-gray-200 text-sm font-medium text-gray-700 bg-white focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 cursor-pointer transition-all hover:border-gray-300"
                            :class="filterMake !== 'All Makes' ? 'border-orange-400 text-orange-600 bg-orange-50' : ''">
                            <option v-for="m in makes" :key="m">{{ m }}</option>
                        </select>
                        <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <!-- Body type -->
                    <div class="relative">
                        <select v-model="filterBody"
                            class="appearance-none h-9 pl-3 pr-8 rounded-lg border border-gray-200 text-sm font-medium text-gray-700 bg-white focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 cursor-pointer transition-all hover:border-gray-300"
                            :class="filterBody !== 'All Types' ? 'border-orange-400 text-orange-600 bg-orange-50' : ''">
                            <option v-for="b in bodyTypes" :key="b">{{ b }}</option>
                        </select>
                        <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <!-- Price -->
                    <div class="relative">
                        <select v-model="filterPrice"
                            class="appearance-none h-9 pl-3 pr-8 rounded-lg border border-gray-200 text-sm font-medium text-gray-700 bg-white focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/20 cursor-pointer transition-all hover:border-gray-300"
                            :class="filterPrice !== 0 ? 'border-orange-400 text-orange-600 bg-orange-50' : ''">
                            <option v-for="(p, i) in priceOpts" :key="i" :value="i">{{ p.label }}</option>
                        </select>
                        <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <!-- Divider -->
                    <div class="hidden sm:block w-px h-5 bg-gray-200"></div>

                    <!-- Active filter pills -->
                    <div class="flex flex-wrap items-center gap-1.5">
                        <button v-for="f in activeFilters" :key="f.key" @click="removeFilter(f.key)"
                            class="flex items-center gap-1 h-7 px-2.5 rounded-full bg-orange-100 text-orange-700 text-xs font-semibold hover:bg-orange-200 transition-colors">
                            {{ f.label }}
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <button v-if="activeFilters.length > 1" @click="clearAll"
                            class="h-7 px-2.5 rounded-full text-gray-400 text-xs font-medium hover:text-gray-600 hover:bg-gray-100 transition-colors">
                            Clear all
                        </button>
                    </div>

                    <!-- Right side: results + sort + view -->
                    <div class="ml-auto flex items-center gap-3">
                        <span class="text-sm text-gray-400 hidden sm:block whitespace-nowrap">
                            {{ filteredCars.length }} result{{ filteredCars.length !== 1 ? 's' : '' }}
                        </span>

                        <div class="relative">
                            <select v-model="sortBy"
                                class="appearance-none h-9 pl-3 pr-8 rounded-lg border border-gray-200 text-sm text-gray-600 bg-white focus:outline-none focus:border-orange-400 cursor-pointer hover:border-gray-300 transition-all">
                                <option v-for="s in sortOpts" :key="s.value" :value="s.value">{{ s.label }}</option>
                            </select>
                            <svg class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>

                        <!-- View toggle -->
                        <div class="hidden sm:flex items-center gap-0.5 p-0.5 rounded-lg bg-gray-100 border border-gray-200">
                            <button @click="viewMode = 'grid'" class="p-1.5 rounded-md transition-all" :class="viewMode === 'grid' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-400 hover:text-gray-600'">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                                    <rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/>
                                    <rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/>
                                </svg>
                            </button>
                            <button @click="viewMode = 'list'" class="p-1.5 rounded-md transition-all" :class="viewMode === 'list' ? 'bg-white shadow-sm text-gray-900' : 'text-gray-400 hover:text-gray-600'">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESULTS -->
        <div class="mx-auto max-w-7xl px-6 py-10">

            <!-- Empty state -->
            <div v-if="filteredCars.length === 0" class="py-24 text-center">
                <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-gray-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No vehicles found</h3>
                <p class="text-sm text-gray-500 mb-5">Try adjusting your filters.</p>
                <button @click="clearAll" class="px-5 py-2.5 rounded-xl bg-orange-500 text-white text-sm font-semibold hover:bg-orange-600 transition-colors">
                    Clear Filters
                </button>
            </div>

            <!-- GRID VIEW -->
            <div v-else-if="viewMode === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a
                    v-for="car in paginatedCars" :key="car.id"
                    :href="`/cars/${car.id}`"
                    class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 block"
                >
                    <div class="relative h-52 overflow-hidden bg-gray-100">
                        <img :src="car.img" :alt="`${car.year} ${car.make} ${car.model}`"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                        <div v-if="car.badge" class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-orange-500 text-white text-xs font-semibold">
                            {{ car.badge }}
                        </div>
                        <div class="absolute bottom-3 right-3 px-3 py-1.5 rounded-lg bg-black/50 backdrop-blur-sm text-white text-sm font-bold">
                            ${{ car.price.toLocaleString() }}
                        </div>
                        <div v-if="car.carfax" class="absolute bottom-3 left-3 flex items-center gap-1 px-2 py-1 rounded-md bg-emerald-500/90 text-white text-[11px] font-semibold">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            CARFAX
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="text-xs text-gray-400 mb-1">{{ car.year }} · {{ car.body }}</div>
                        <h3 class="font-bold text-gray-900 text-lg leading-tight mb-3">{{ car.make }} {{ car.model }}</h3>
                        <div class="flex items-center justify-between text-sm text-gray-400">
                            <span>{{ formatMileage(car.mileage) }} mi</span>
                            <span>{{ car.transmission }}</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-900">${{ car.price.toLocaleString() }}</span>
                            <span class="text-xs font-semibold text-orange-500 group-hover:gap-2 flex items-center gap-1 transition-all">
                                View Details
                                <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- LIST VIEW -->
            <div v-else class="space-y-4">
                <a
                    v-for="car in paginatedCars" :key="car.id"
                    :href="`/cars/${car.id}`"
                    class="group flex bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 block"
                >
                    <div class="relative w-52 sm:w-64 shrink-0 overflow-hidden bg-gray-100">
                        <img :src="car.img" :alt="`${car.year} ${car.make} ${car.model}`"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy"/>
                        <div v-if="car.badge" class="absolute top-3 left-3 px-2 py-0.5 rounded-md bg-orange-500 text-white text-[11px] font-semibold">
                            {{ car.badge }}
                        </div>
                    </div>
                    <div class="flex-1 p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="text-xs text-gray-400 mb-1">{{ car.year }} · {{ car.body }}</div>
                            <h3 class="font-bold text-gray-900 text-xl mb-3">{{ car.make }} {{ car.model }}</h3>
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-400">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                    {{ formatMileage(car.mileage) }} mi
                                </span>
                                <span>{{ car.transmission }}</span>
                                <span v-if="car.carfax" class="flex items-center gap-1 text-emerald-600 font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    CARFAX Clean
                                </span>
                            </div>
                        </div>
                        <div class="sm:text-right">
                            <div class="text-2xl font-bold text-gray-900">${{ car.price.toLocaleString() }}</div>
                            <div class="text-xs text-gray-400 mt-0.5 mb-3">No hidden fees</div>
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-orange-500 text-white text-sm font-semibold group-hover:bg-orange-600 transition-colors">
                                View Details
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- PAGINATION -->
            <div v-if="totalPages > 1" class="mt-12 flex items-center justify-center gap-1.5">
                <button
                    @click="page--" :disabled="page === 1"
                    class="w-9 h-9 rounded-xl flex items-center justify-center border text-sm font-medium transition-all disabled:opacity-30 disabled:cursor-not-allowed hover:border-orange-300 hover:text-orange-600"
                    :class="page === 1 ? 'border-gray-200 text-gray-400' : 'border-gray-200 text-gray-600'"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <button
                    v-for="p in totalPages" :key="p"
                    @click="page = p"
                    class="w-9 h-9 rounded-xl flex items-center justify-center border text-sm font-medium transition-all"
                    :class="page === p
                        ? 'bg-orange-500 border-orange-500 text-white shadow-sm'
                        : 'border-gray-200 text-gray-600 hover:border-orange-300 hover:text-orange-600'"
                >
                    {{ p }}
                </button>

                <button
                    @click="page++" :disabled="page === totalPages"
                    class="w-9 h-9 rounded-xl flex items-center justify-center border text-sm font-medium transition-all disabled:opacity-30 disabled:cursor-not-allowed hover:border-orange-300 hover:text-orange-600"
                    :class="page === totalPages ? 'border-gray-200 text-gray-400' : 'border-gray-200 text-gray-600'"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Pagination info -->
            <div v-if="filteredCars.length > 0" class="mt-4 text-center text-sm text-gray-400">
                Showing {{ (page - 1) * perPage + 1 }}–{{ Math.min(page * perPage, filteredCars.length) }} of {{ filteredCars.length }} vehicles
            </div>
        </div>

        <!-- BOTTOM CTA STRIP -->
        <div class="border-t border-gray-100 bg-gray-50 py-10">
            <div class="mx-auto max-w-7xl px-6 flex flex-col sm:flex-row items-center justify-between gap-5">
                <div>
                    <div class="font-bold text-gray-900 text-lg mb-1">Can't find what you're looking for?</div>
                    <p class="text-sm text-gray-500">Tell us what you need and we'll find it for you.</p>
                </div>
                <a href="tel:+18001234567"
                    class="shrink-0 flex items-center gap-2 px-7 py-3.5 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Call (800) 123-4567
                </a>
            </div>
        </div>

    </AppLayout>
</template>
