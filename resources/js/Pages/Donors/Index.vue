<template>
    <AppLayout>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    Donor Management
                </h2>
                <Link
                    href="/donors/create"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                >
                    Add New Donor
                </Link>
            </div>

            <div class="mb-4">
                <input
                    v-model="search"
                    type="text"
                    placeholder="Search donors..."
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                    @input="searchDonors"
                />
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Name
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Blood Type
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Last Donation
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="donor in donors.data" :key="donor.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ donor.user.name }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                    :class="{
                                        'bg-red-100 text-red-800':
                                            donor.blood_type.includes('A'),
                                        'bg-blue-100 text-blue-800':
                                            donor.blood_type.includes('B'),
                                        'bg-purple-100 text-purple-800':
                                            donor.blood_type.includes('AB'),
                                        'bg-green-100 text-green-800':
                                            donor.blood_type.includes('O'),
                                    }"
                                >
                                    {{ donor.blood_type }}
                                </span>
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                            >
                                {{
                                    donor.last_donation_date
                                        ? formatDate(donor.last_donation_date)
                                        : "Never"
                                }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                            >
                                <Link
                                    :href="`/donors/${donor.id}/edit`"
                                    class="text-blue-600 hover:text-blue-900 mr-3"
                                    >Edit</Link
                                >
                                <button
                                    @click="deleteDonor(donor.id)"
                                    class="text-red-600 hover:text-red-900"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <Pagination :links="donors.links" class="mt-4" />
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, watch } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    donors: Object,
    filters: Object,
});

const search = ref(props.filters.search || "");

const searchDonors = () => {
    router.get(
        "/donors",
        { search: search.value },
        {
            preserveState: true,
            replace: true,
        }
    );
};

const deleteDonor = (id) => {
    if (confirm("Are you sure you want to delete this donor?")) {
        router.delete(`/donors/${id}`, {
            preserveState: true,
            onSuccess: () => {
                // Refresh the page to update the list
                router.reload({ only: ["donors"] });
            },
        });
    }
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString();
};
</script>
