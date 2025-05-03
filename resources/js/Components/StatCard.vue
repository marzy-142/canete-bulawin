<template>
    <div
        class="bg-white p-4 rounded-lg shadow border-l-4"
        :class="`border-${color}-500`"
    >
        <div class="flex items-center">
            <div class="p-3 rounded-full mr-4" :class="`bg-${color}-100`">
                <svg
                    class="w-6 h-6"
                    :class="`text-${color}-600`"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <template v-if="icon === 'users'">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                        />
                    </template>
                    <template v-if="icon === 'heart'">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                        />
                    </template>
                    <template v-if="icon === 'drop'">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                        />
                    </template>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">{{ title }}</p>
                <p class="text-2xl font-bold">{{ value }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: String,
    value: [String, Number],
    icon: {
        type: String,
        default: "users",
        validator: (value) => ["users", "heart", "drop"].includes(value),
    },
    color: {
        type: String,
        default: "red",
        validator: (value) =>
            ["red", "blue", "green", "purple"].includes(value),
    },
});
</script>
