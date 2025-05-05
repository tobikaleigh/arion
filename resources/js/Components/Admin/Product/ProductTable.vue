<script setup>
import { ref } from "vue";
import Button from "@/Components/Button.vue";
import ShowProductDialogModal from "./ShowProductDialogModal.vue";
import UpdateProductDialogModal from "./UpdateProductDialogModal.vue";
import DeleteProductDialogModal from "./DeleteProductDialogModal.vue";

const props = defineProps({
    products: {
        type: Array,
        required: true,
    },
});

const showProductDialogModal = ref(false);
const showUpdateProductDialogModal = ref(false);
const showDeleteProductDialogModal = ref(false);
const selectedProduct = ref(null);

function handleShowProductDialogModal(product) {
    if (
        showUpdateProductDialogModal.value ||
        showDeleteProductDialogModal.value
    ) {
        return;
    }

    selectedProduct.value = product;
    showProductDialogModal.value = true;
}

function handleShowUpdateProductDialog(product) {
    selectedProduct.value = product;
    showUpdateProductDialogModal.value = true;
}

function handleShowDeleteProductDialog(product) {
    selectedProduct.value = product;
    showDeleteProductDialogModal.value = true;
}
</script>

<template>
    <table class="min-w-full divide-y divide-gray-300">
        <thead>
            <tr>
                <th
                    scope="col"
                    class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                >
                    ID
                </th>
                <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                    Name
                </th>
                <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 w-52"
                >
                    Description
                </th>
                <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                    Locations
                </th>
                <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-0">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <transition-group
                enter-active-class="transition-opacity duration-500"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
                leave-active-class="transition-all duration-500"
                leave-to-class="opacity-0 translate-x-4"
            >
                <tr
                    v-for="product in products"
                    :key="product.id"
                    class="*:hover:bg-gray-50 cursor-pointer"
                    @click="handleShowProductDialogModal(product)"
                >
                    <td
                        class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0"
                    >
                        {{ product.internal_id }}
                    </td>
                    <td
                        class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                    >
                        {{ product.name }}
                    </td>
                    <td
                        class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                    >
                        <div class="w-52 overflow-hidden truncate">
                            <span v-if="!product.description" class="italic"
                                >No description.</span
                            >
                            {{ product.description }}
                        </div>
                    </td>
                    <td
                        class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                    >
                        <span
                            class="bg-gray-50 border rounded p-1"
                            v-for="inventoryLocation in product
                                .inventory_locations.data"
                            :key="inventoryLocation.id"
                        >
                            {{ inventoryLocation.name }}: ({{
                                inventoryLocation.pivot.quantity
                            }}
                            pcs)
                        </span>
                    </td>
                    <td
                        class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0"
                    >
                        <div>
                            <Button
                                size="sm"
                                class="ml-2 text-indigo-600 hover:text-indigo-900 font-medium"
                                type="button"
                                variant="link"
                                @click="handleShowUpdateProductDialog(product)"
                            >
                                Edit
                            </Button>
                            <Button
                                size="sm"
                                class="ml-2 text-indigo-600 hover:text-indigo-900 font-medium"
                                type="button"
                                variant="link"
                                @click="handleShowDeleteProductDialog(product)"
                            >
                                Delete
                            </Button>
                        </div>
                    </td>
                </tr>
            </transition-group>
        </tbody>
    </table>

    <!-- Show Product Dialog Modal -->
    <ShowProductDialogModal
        :show="showProductDialogModal"
        :product="selectedProduct"
        @close="
            showProductDialogModal = false;
            selectedProduct = null;
        "
    />

    <!-- Delete Product Dialog Modal -->
    <DeleteProductDialogModal
        :show="showDeleteProductDialogModal"
        :product="selectedProduct"
        @close="
            showDeleteProductDialogModal = false;
            selectedProduct = null;
        "
    />

    <!-- Update Product Dialog Modal -->
    <UpdateProductDialogModal
        :show="showUpdateProductDialogModal"
        :product="selectedProduct"
        @close="
            showUpdateProductDialogModal = false;
            selectedProduct = null;
        "
        @success="
            showUpdateProductDialogModal = false;
            selectedProduct = null;
        "
    />
</template>
