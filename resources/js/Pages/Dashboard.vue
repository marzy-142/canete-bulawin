<template>
    <AppLayout>
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <StatCard
                    title="Total Donors"
                    :value="stats?.donors || 0"
                    icon="users"
                />
                <StatCard
                    title="Total Donations"
                    :value="stats?.donations || 0"
                    icon="heart"
                />
                <StatCard
                    title="Blood Inventory"
                    :value="(stats?.inventory || 0) + ' units'"
                    icon="drop"
                />
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import StatCard from "@/Components/StatCard.vue";

const props = defineProps({
    stats: {
        type: Object,
        default: () => ({
            donors: 0,
            donations: 0,
            inventory: 0,
        }),
    },
});
</script>
