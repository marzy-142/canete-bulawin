<template>
    <button
        @click="toggle"
        type="button"
        class="flex items-center text-sm text-white focus:outline-none"
    >
        <span class="mr-1">{{ text }}</span>
        <svg
            class="w-4 h-4"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7"
            />
        </svg>
    </button>
</template>

<script setup>
const props = defineProps({
    text: String,
});

const toggle = inject("toggle");
</script>
