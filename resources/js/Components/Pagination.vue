<template>
    <div
        v-if="links.length > 3"
        class="flex justify-center mt-6 space-x-2 text-sm"
    >
        <template v-for="(link, key) in links" :key="key">
            <component
                :is="link.url ? 'Link' : 'span'"
                :href="link.url"
                class="px-3 py-1 border rounded"
                :class="{
                    'bg-red-600 text-white border-red-600': link.active,
                    'text-gray-500 cursor-not-allowed': !link.url,
                    'hover:bg-red-100 hover:text-red-700':
                        link.url && !link.active,
                }"
            >
                {{ link.label }}
            </component>
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links: Array,
});
</script>
