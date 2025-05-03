<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ donation ? "Edit Donation" : "New Donation" }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div>
                                <label
                                    for="donor_id"
                                    class="block text-sm font-medium text-gray-700"
                                    >Donor</label
                                >
                                <select
                                    id="donor_id"
                                    v-model="form.donor_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{
                                        'border-red-500': errors.donor_id,
                                    }"
                                >
                                    <option value="">Select a donor</option>
                                    <option
                                        v-for="donor in donors"
                                        :key="donor.id"
                                        :value="donor.id"
                                    >
                                        {{ donor.user.name }} ({{
                                            donor.blood_type
                                        }})
                                    </option>
                                </select>
                                <p
                                    v-if="errors.donor_id"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.donor_id }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="donation_date"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Donation Date
                                </label>
                                <input
                                    type="date"
                                    id="donation_date"
                                    v-model="form.donation_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{
                                        'border-red-500': errors.donation_date,
                                    }"
                                />
                                <p
                                    v-if="errors.donation_date"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.donation_date }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="quantity_ml"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Quantity (ml)
                                </label>
                                <input
                                    type="number"
                                    id="quantity_ml"
                                    v-model="form.quantity_ml"
                                    min="450"
                                    max="500"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{
                                        'border-red-500': errors.quantity_ml,
                                    }"
                                />
                                <p
                                    v-if="errors.quantity_ml"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.quantity_ml }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700"
                                    >Status</label
                                >
                                <select
                                    id="status"
                                    v-model="form.status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': errors.status }"
                                >
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                                <p
                                    v-if="errors.status"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.status }}
                                </p>
                            </div>

                            <div class="flex items-center justify-end">
                                <Link
                                    :href="route('donations.index')"
                                    class="text-gray-600 hover:text-gray-900 mr-4"
                                >
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    :disabled="form.processing"
                                >
                                    {{
                                        donation ? "Update" : "Create"
                                    }}
                                    Donation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    donation: {
        type: Object,
        default: null,
    },
    donors: {
        type: Array,
        required: true,
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    donor_id: props.donation?.donor_id || "",
    donation_date: props.donation?.donation_date || "",
    quantity_ml: props.donation?.quantity_ml || 450,
    status: props.donation?.status || "pending",
});

const submitForm = () => {
    if (props.donation) {
        form.put(route("donations.update", props.donation.id));
    } else {
        form.post(route("donations.store"));
    }
};
</script>
