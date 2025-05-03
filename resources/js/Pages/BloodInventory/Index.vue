<template>
    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Blood Inventory
                </h2>
                <Link
                    :href="route('blood-inventory.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Add Blood Unit
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div
                        v-for="(count, bloodType) in bloodTypeSummary"
                        :key="bloodType"
                        class="bg-white overflow-hidden shadow rounded-lg"
                    >
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div
                                        class="h-12 w-12 rounded-full flex items-center justify-center"
                                        :class="getBloodTypeColor(bloodType)"
                                    >
                                        <span class="text-white font-bold">{{
                                            bloodType
                                        }}</span>
                                    </div>
                                </div>
                                <div class="ml-5">
                                    <div
                                        class="text-sm font-medium text-gray-500"
                                    >
                                        {{ bloodType }} Blood
                                    </div>
                                    <div
                                        class="text-lg font-semibold text-gray-900"
                                    >
                                        {{ count }} units
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inventory Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <input
                                type="text"
                                v-model="search"
                                placeholder="Search inventory..."
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
                                        Expiry Date
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Donation ID
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
                                    v-for="unit in inventory.data"
                                    :key="unit.id"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="
                                                getBloodTypeColor(
                                                    unit.blood_type
                                                )
                                            "
                                        >
                                            {{ unit.blood_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ unit.quantity_ml }} ml
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ formatDate(unit.expiry_date) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            :class="{
                                                'bg-green-100 text-green-800':
                                                    unit.status === 'available',
                                                'bg-red-100 text-red-800':
                                                    unit.status === 'expired' ||
                                                    unit.status === 'used',
                                            }"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                        >
                                            {{ unit.status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ unit.donation_id }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                    >
                                        <Link
                                            :href="
                                                route(
                                                    'blood-inventory.edit',
                                                    unit.id
                                                )
                                            "
                                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="deleteUnit(unit)"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="inventory.links" class="mt-6" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link, router } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    inventory: Object,
    filters: Object,
});

const search = ref(props.filters.search || "");

const handleSearch = () => {
    router.get(
        route("blood-inventory.index"),
        { search: search.value },
        {
            preserveState: true,
            replace: true,
        }
    );
};

const deleteUnit = (unit) => {
    if (confirm("Are you sure you want to delete this blood unit?")) {
        router.delete(route("blood-inventory.destroy", unit.id));
    }
};

const formatDate = (date) => {
    const options = { year: "numeric", month: "short", day: "numeric" };
    return new Date(date).toLocaleDateString("en-US", options);
};

const getBloodTypeColor = (bloodType) => {
    const colors = {
        "A+": "bg-red-500",
        "A-": "bg-red-400",
        "B+": "bg-blue-500",
        "B-": "bg-blue-400",
        "AB+": "bg-purple-500",
        "AB-": "bg-purple-400",
        "O+": "bg-green-500",
        "O-": "bg-green-400",
    };
    return colors[bloodType] || "bg-gray-500";
};

const bloodTypeSummary = computed(() => {
    const summary = {};
    props.inventory.data.forEach((unit) => {
        if (unit.status === "available") {
            summary[unit.blood_type] = (summary[unit.blood_type] || 0) + 1;
        }
    });
    return summary;
});
</script>
