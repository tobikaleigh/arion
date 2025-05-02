<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const emit = defineEmits(["close"]);
const props = defineProps({
    show: {
        type: Boolean,
    },
    product: {
        type: Object,
        required: false,
    },
});

const isLoading = ref(false);

const deleteProduct = () => {
    router.delete(
        route("admin.products.destroy", {
            product: props.product.uuid,
        }),
        {
            preserveScroll: true,
            only: ["products"],
            onStart: () => {
                isLoading.value = true;
            },
            onSuccess: () => {
                emit("close");
            },
            onFinish: () => {
                isLoading.value = false;
            },
        }
    );
};

function close() {
    emit("close");
}
</script>

<template>
    <DialogModal :show="show" @close="close()" title="Delete Product">
        <div>
            <p class="text-sm text-gray-500">
                Are you sure you want to delete this product? This action cannot
                be undone.
            </p>

            <div class="bg-gray-50 border rounded px-5 py-2 mt-4">
                <p class="text-sm text-gray-500">
                    <strong>Product ID:</strong> {{ product.id }}
                </p>
                <p class="text-sm text-gray-500">
                    <strong>Product Name:</strong> {{ product.name }}
                </p>
                <p class="text-sm text-gray-500">
                    <strong>Product Description:</strong>
                    {{ product.description }}
                </p>
            </div>
        </div>

        <template #footer>
            <div class="flex flex-row justify-end">
                <SecondaryButton class="mr-4" @click="close"
                    >Cancel</SecondaryButton
                >
                <DangerButton
                    type="button"
                    :loading="isLoading"
                    @click="deleteProduct()"
                    >Delete Product</DangerButton
                >
            </div>
        </template>
    </DialogModal>
</template>
