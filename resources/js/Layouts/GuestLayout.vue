<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <Link href="/" class="text-xl font-bold text-red-600"
                        >BloodLink</Link
                    >
                    <div class="flex space-x-4">
                        <Link
                            :href="route('login')"
                            class="text-gray-600 hover:text-red-600"
                            >Login</Link
                        >
                        <Link
                            :href="route('register')"
                            class="text-gray-600 hover:text-red-600"
                            >Register</Link
                        >
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <slot />
        </main>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
