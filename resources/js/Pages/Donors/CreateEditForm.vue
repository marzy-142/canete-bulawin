<template>
    <AppLayout>
        <div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                {{ form.id ? "Edit Donor" : "Register New Donor" }}
            </h2>

            <form @submit.prevent="submit">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Full Name</label
                        >
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                            required
                        />
                        <p
                            v-if="form.errors.name"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.name }}
                        </p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Email</label
                        >
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                            required
                        />
                        <p
                            v-if="form.errors.email"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <!-- Password (only for create) -->
                    <div v-if="!form.id">
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Password</label
                        >
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                            required
                        />
                        <p
                            v-if="form.errors.password"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <!-- Confirm Password (only for create) -->
                    <div v-if="!form.id">
                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Confirm Password</label
                        >
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                            required
                        />
                    </div>

                    <!-- Blood Type -->
                    <div>
                        <label
                            for="blood_type"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Blood Type</label
                        >
                        <select
                            id="blood_type"
                            v-model="form.blood_type"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                            required
                        >
                            <option value="">Select Blood Type</option>
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
                            v-if="form.errors.blood_type"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.blood_type }}
                        </p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label
                            for="phone"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Phone Number</label
                        >
                        <input
                            id="phone"
                            v-model="form.phone"
                            type="tel"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                            required
                        />
                        <p
                            v-if="form.errors.phone"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.phone }}
                        </p>
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label
                            for="address"
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Address</label
                        >
                        <textarea
                            id="address"
                            v-model="form.address"
                            rows="3"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                            required
                        ></textarea>
                        <p
                            v-if="form.errors.address"
                            class="text-red-500 text-sm mt-1"
                        >
                            {{ form.errors.address }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <Link
                        href="/donors"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50"
                    >
                        Cancel
                    </Link>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 disabled:opacity-50"
                        :disabled="form.processing"
                    >
                        {{ form.id ? "Update Donor" : "Register Donor" }}
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    donor: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    id: props.donor?.id || null,
    name: props.donor?.user.name || "",
    email: props.donor?.user.email || "",
    password: "",
    password_confirmation: "",
    blood_type: props.donor?.blood_type || "",
    phone: props.donor?.phone || "",
    address: props.donor?.address || "",
});

const submit = () => {
    if (form.id) {
        form.put(`/donors/${form.id}`, {
            onSuccess: () => {
                form.reset();
            },
        });
    } else {
        form.post("/donors", {
            onSuccess: () => {
                form.reset();
            },
        });
    }
};
</script>
