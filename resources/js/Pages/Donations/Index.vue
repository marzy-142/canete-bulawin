<template>
    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Donations
                </h2>
                <Link
                    :href="route('donations.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    New Donation
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <input
                                type="text"
                                v-model="search"
                                placeholder="Search donations..."
                                class="w-full px-4 py-2 border rounded-lg"
                                @input="handleSearch"
                            />
                        </div>

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
                                        Blood Type
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Quantity (ml)
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Donation Date
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="donation in donations.data"
                                    :key="donation.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ donation.donor.user.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ donation.donor.blood_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ donation.quantity_ml }} ml
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ formatDate(donation.donation_date) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            :class="{
                                                'bg-yellow-100 text-yellow-800':
                                                    donation.status ===
                                                    'pending',
                                                'bg-green-100 text-green-800':
                                                    donation.status ===
                                                    'approved',
                                                'bg-red-100 text-red-800':
                                                    donation.status ===
                                                    'rejected',
                                            }"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        >
                                            {{ donation.status }}
                                        </span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'donations.edit',
                                                    donation.id
                                                )
                                            "
                                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="deleteDonation(donation)"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="donations.links" class="mt-6" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
// import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    donations: Object,
    filters: Object,
});

const search = ref(props.filters.search || "");

const handleSearch = () => {
    router.get(
        route("donations.index"),
        { search: search.value },
        {
            preserveState: true,
            replace: true,
        }
    );
};

const deleteDonation = (donation) => {
    if (confirm("Are you sure you want to delete this donation?")) {
        router.delete(route("donations.destroy", donation.id));
    }
};

const formatDate = (date) => {
    const options = { year: "numeric", month: "short", day: "numeric" };
    return new Date(date).toLocaleDateString("en-US", options);
};
</script>
