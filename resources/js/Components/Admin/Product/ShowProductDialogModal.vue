<script setup>
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CreateProductForm from "@/Components/Admin/Product/Form/CreateProductForm.vue";

const props = defineProps({
    product: {
        type: Object,
        required: false,
    },
    show: {
        type: Boolean,
    },
});

const emit = defineEmits(["close"]);

function close() {
    emit("close");
}
</script>

<template>
    <Modal :show="show" @close="close()">
        <h2 class="mb-0">
            {{ product.name }}
        </h2>
        <p>{{ product.internal_id }}</p>

        <div class="mt-4 space-y-4">
            <div>
                <p class="font-bold">Description</p>
                <p>
                    {{ product.description || "No description available." }}
                </p>
            </div>
            <div>
                <p class="font-bold">Inventory Locations</p>
                <div
                    v-for="inventoryLocation in product.inventory_locations
                        .data"
                    class="inline-block bg-gray-50 border rounded p-1"
                >
                    {{ inventoryLocation.name }}: ({{
                        inventoryLocation.pivot.quantity
                    }}
                    pcs)
                </div>
            </div>
        </div>

        <template #footer>
            <div class="flex flex-row justify-end">
                <SecondaryButton class="mr-4" @click="close"
                    >Cancel</SecondaryButton
                >
                <PrimaryButton
                    type="button"
                    :loading="formIsLoading"
                    @click="handleSubmit()"
                    >Create</PrimaryButton
                >
            </div>
        </template>
    </Modal>
</template>
