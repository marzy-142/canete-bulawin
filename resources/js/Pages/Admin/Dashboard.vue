<template>
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Dashboard
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
                            Total Donors
                        </h3>
                        <p class="text-3xl font-bold text-red-600">
                            {{ stats.total_donors }}
                        </p>
                    </div>
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
                            Total Inventory
                        </h3>
                        <p class="text-3xl font-bold text-red-600">
                            {{ stats.total_inventory }} units
                        </p>
                    </div>
                </div>

                <!-- Recent Donations -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            Recent Donations
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Donor
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Date
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Blood Type
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="donation in stats.recent_donations"
                                        :key="donation.id"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ donation.donor.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{
                                                new Date(
                                                    donation.donation_date
                                                ).toLocaleDateString()
                                            }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ donation.blood_type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                :class="
                                                    donation.status ===
                                                    'completed'
                                                        ? 'bg-green-100 text-green-800'
                                                        : 'bg-yellow-100 text-yellow-800'
                                                "
                                            >
                                                {{ donation.status }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({
    stats: Object,
});
</script>
