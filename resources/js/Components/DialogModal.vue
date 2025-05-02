<script setup>
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

defineProps({
    title: {
        type: String,
        default: "",
    },
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit("close");
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ title }}
            </div>

            <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                <slot />
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 dark:bg-gray-800">
            <slot name="footer" />
        </div>
    </Modal>
</template>
