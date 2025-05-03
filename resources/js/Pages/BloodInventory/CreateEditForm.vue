<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ unit ? "Edit Blood Unit" : "Add Blood Unit" }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div>
                                <label
                                    for="blood_type"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Blood Type
                                </label>
                                <select
                                    id="blood_type"
                                    v-model="form.blood_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{
                                        'border-red-500': errors.blood_type,
                                    }"
                                >
                                    <option value="">Select blood type</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                                <p
                                    v-if="errors.blood_type"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.blood_type }}
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
                                    for="expiry_date"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Expiry Date
                                </label>
                                <input
                                    type="date"
                                    id="expiry_date"
                                    v-model="form.expiry_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{
                                        'border-red-500': errors.expiry_date,
                                    }"
                                />
                                <p
                                    v-if="errors.expiry_date"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.expiry_date }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Status
                                </label>
                                <select
                                    id="status"
                                    v-model="form.status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{ 'border-red-500': errors.status }"
                                >
                                    <option value="available">Available</option>
                                    <option value="used">Used</option>
                                    <option value="expired">Expired</option>
                                </select>
                                <p
                                    v-if="errors.status"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.status }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="donation_id"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Donation
                                </label>
                                <select
                                    id="donation_id"
                                    v-model="form.donation_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    :class="{
                                        'border-red-500': errors.donation_id,
                                    }"
                                >
                                    <option value="">Select a donation</option>
                                    <option
                                        v-for="donation in donations"
                                        :key="donation.id"
                                        :value="donation.id"
                                    >
                                        {{ donation.donor.user.name }} -
                                        {{ donation.donor.blood_type }} ({{
                                            formatDate(donation.donation_date)
                                        }})
                                    </option>
                                </select>
                                <p
                                    v-if="errors.donation_id"
                                    class="mt-1 text-sm text-red-600"
                                >
                                    {{ errors.donation_id }}
                                </p>
                            </div>

                            <div class="flex items-center justify-end">
                                <Link
                                    :href="route('blood-inventory.index')"
                                    class="text-gray-600 hover:text-gray-900 mr-4"
                                >
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    :disabled="form.processing"
                                >
                                    {{ unit ? "Update" : "Create" }} Blood Unit
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
    unit: {
        type: Object,
        default: null,
    },
    donations: {
        type: Array,
        required: true,
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    blood_type: props.unit?.blood_type || "",
    quantity_ml: props.unit?.quantity_ml || 450,
    expiry_date: props.unit?.expiry_date || "",
    status: props.unit?.status || "available",
    donation_id: props.unit?.donation_id || "",
});

const submitForm = () => {
    if (props.unit) {
        form.put(route("blood-inventory.update", props.unit.id));
    } else {
        form.post(route("blood-inventory.store"));
    }
};
</script>
