<template>
    <GuestLayout>
        <!-- Hero Section -->
        <div
            class="relative bg-gradient-to-r from-red-50 to-white overflow-hidden"
        >
            <div class="max-w-7xl mx-auto">
                <div
                    class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"
                >
                    <main
                        class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28"
                    >
                        <div class="sm:text-center lg:text-left">
                            <h1
                                class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl"
                            >
                                <span class="block">Welcome to</span>
                                <span class="block text-red-600"
                                    >BloodLink</span
                                >
                            </h1>
                            <p
                                class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0"
                            >
                                Connecting donors with those in need. Every
                                donation can save up to three lives.
                            </p>
                            <div
                                class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"
                            >
                                <div class="rounded-md shadow">
                                    <Link
                                        href="/register"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 md:py-4 md:text-lg md:px-10"
                                    >
                                        Register as Donor
                                    </Link>
                                </div>
                                <div class="mt-3 sm:mt-0 sm:ml-3">
                                    <Link
                                        href="/login"
                                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 md:py-4 md:text-lg md:px-10"
                                    >
                                        Login
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img
                    class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                    src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80"
                    alt="Blood donation illustration"
                />
            </div>
        </div>

        <!-- Why Donate Section -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2
                        class="text-3xl font-extrabold text-gray-900 sm:text-4xl"
                    >
                        Why Donate Blood?
                    </h2>
                    <p
                        class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4"
                    >
                        Your donation can make a life-saving difference
                    </p>
                </div>

                <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg
                                        class="h-6 w-6 text-red-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h3
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        Save Lives
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-500">
                                        One blood donation can save up to three
                                        lives. Your contribution is crucial for
                                        patients in need.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg
                                        class="h-6 w-6 text-red-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h3
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        Health Benefits
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Regular blood donation helps maintain
                                        healthy iron levels and reduces the risk
                                        of heart disease.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg
                                        class="h-6 w-6 text-red-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <h3
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        Community Impact
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-500">
                                        Join a community of lifesavers and make
                                        a positive impact in your local area.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation Process Section -->
        <div class="bg-gray-50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2
                        class="text-3xl font-extrabold text-gray-900 sm:text-4xl"
                    >
                        The Donation Process
                    </h2>
                    <p
                        class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4"
                    >
                        Simple steps to become a blood donor
                    </p>
                </div>

                <div class="mt-12">
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-md bg-red-600 text-white"
                            >
                                <span class="text-lg font-bold">1</span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">
                                Registration
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Complete a simple registration form and provide
                                basic information.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-md bg-red-600 text-white"
                            >
                                <span class="text-lg font-bold">2</span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">
                                Health Check
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Quick health screening to ensure you're eligible
                                to donate.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-md bg-red-600 text-white"
                            >
                                <span class="text-lg font-bold">3</span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">
                                Donation
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">
                                The actual donation takes about 10-15 minutes.
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-md bg-red-600 text-white"
                            >
                                <span class="text-lg font-bold">4</span>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">
                                Refresh
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Enjoy refreshments and rest for 10-15 minutes
                                before leaving.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2
                        class="text-3xl font-extrabold text-gray-900 sm:text-4xl"
                    >
                        Ready to Make a Difference?
                    </h2>
                    <p
                        class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4"
                    >
                        Join our community of lifesavers today
                    </p>
                    <div class="mt-8 flex justify-center">
                        <Link
                            href="/register"
                            class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 md:py-4 md:text-lg md:px-10"
                        >
                            Register Now
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
