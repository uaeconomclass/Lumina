<script setup lang="ts">
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const mobileOpen = ref(false)
</script>

<template>
    <div class="min-h-screen bg-white text-gray-900 antialiased" style="font-family: 'Geist', ui-sans-serif, system-ui, sans-serif;">

        <header class="fixed top-0 inset-x-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-100">
            <div class="mx-auto max-w-7xl px-6 h-16 flex items-center justify-between">
                <RouterLink to="/" class="flex items-center gap-2.5 shrink-0">
                    <div class="w-8 h-8 rounded-lg bg-orange-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight text-gray-900">AutoHaven</span>
                </RouterLink>

                <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                    <RouterLink to="/cars" class="px-4 py-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all">Inventory</RouterLink>
                    <a href="#why"     class="px-4 py-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all">Why Us</a>
                    <a href="#contact" class="px-4 py-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all">Contact</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="tel:+18001234567" class="hidden sm:flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-orange-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        (800) 123-4567
                    </a>
                    <RouterLink to="/cars" class="px-4 py-2 rounded-lg bg-orange-500 text-white text-sm font-semibold hover:bg-orange-600 transition-colors">
                        View Cars
                    </RouterLink>
                    <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path v-if="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            <path v-else stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div v-if="mobileOpen" class="md:hidden border-t border-gray-100 bg-white px-6 py-4 space-y-1">
                <RouterLink to="/"     class="block px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Home</RouterLink>
                <RouterLink to="/cars" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Inventory</RouterLink>
                <a href="tel:+18001234567" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-orange-500">(800) 123-4567</a>
            </div>
        </header>

        <slot />

        <footer class="bg-slate-950 border-t border-white/5 py-10">
            <div class="mx-auto max-w-7xl px-6">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-8">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-7 h-7 rounded-md bg-orange-500 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
                                </svg>
                            </div>
                            <span class="text-white font-bold tracking-tight">AutoHaven</span>
                        </div>
                        <p class="text-sm text-white/30 leading-relaxed">Quality pre-owned vehicles. No-haggle pricing. CARFAX on every car.</p>
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-white/40 uppercase tracking-widest mb-4">Quick Links</div>
                        <div class="space-y-2 text-sm text-white/30">
                            <RouterLink to="/cars" class="block hover:text-white/60 transition-colors">Browse Inventory</RouterLink>
                            <a href="#why"     class="block hover:text-white/60 transition-colors">Why AutoHaven</a>
                            <a href="#contact" class="block hover:text-white/60 transition-colors">Contact Us</a>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-white/40 uppercase tracking-widest mb-4">Visit Us</div>
                        <div class="text-sm text-white/30 space-y-1">
                            <p>123 Auto Drive, Dallas, TX 75201</p>
                            <p>Mon–Sat 9am–7pm · Sun 11am–5pm</p>
                            <a href="tel:+18001234567" class="block text-orange-400 font-medium mt-2 hover:text-orange-300 transition-colors">(800) 123-4567</a>
                        </div>
                    </div>
                </div>
                <div class="pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-white/20">
                    <span>© 2025 AutoHaven. All rights reserved.</span>
                    <div class="flex gap-5">
                        <a href="#" class="hover:text-white/40 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-white/40 transition-colors">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
