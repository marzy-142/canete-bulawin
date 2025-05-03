<template>
    <DonorLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Donor Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900">
                            Total Donations
                        </h3>
                        <p class="text-3xl font-bold text-red-600">
                            {{ stats.total_donations }}
                        </p>
                    </div>
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900">
                            Last Donation
                        </h3>
                        <p
                            class="text-3xl font-bold text-red-600"
                            v-if="stats.last_donation"
                        >
                            {{
                                new Date(
                                    stats.last_donation.donation_date
                                ).toLocaleDateString()
                            }}
                        </p>
                        <p class="text-3xl font-bold text-gray-400" v-else>
                            Never
                        </p>
                    </div>
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                    >
                        <h3 class="text-lg font-semibold text-gray-900">
                            Next Eligible Date
                        </h3>
                        <p
                            class="text-3xl font-bold"
                            :class="
                                isEligible ? 'text-green-600' : 'text-red-600'
                            "
                        >
                            {{
                                new Date(
                                    stats.next_eligible_date
                                ).toLocaleDateString()
                            }}
                        </p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <Link
                            :href="route('donor.schedule')"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        >
                            Schedule Donation
                        </Link>
                        <Link
                            :href="route('donor.donations')"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                        >
                            View Donation History
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </DonorLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import DonorLayout from "@/Layouts/DonorLayout.vue";
import { computed } from "vue";

const props = defineProps({
    stats: Object,
});

const isEligible = computed(() => {
    return new Date(props.stats.next_eligible_date) <= new Date();
});
</script>
