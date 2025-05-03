<template>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Donations</h3>
        <ul class="divide-y divide-gray-200">
            <li v-for="donation in donations" :key="donation.id" class="py-3">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div
                            class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center"
                        >
                            <span class="text-red-600 font-medium">{{
                                donation.donor.blood_type
                            }}</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            {{ donation.donor.user.name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ formatDate(donation.donation_date) }} -
                            {{ donation.quantity_ml }}ml
                        </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
defineProps({
    donations: Array,
});

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString();
};
</script>
