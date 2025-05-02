<script setup>
import { ref } from "vue";
import Button from "@/Components/Button.vue";
import DeleteProductDialogModal from "./DeleteProductDialogModal.vue";

const props = defineProps({
    products: {
        type: Array,
        required: true,
    },
});

const selectedProduct = ref(null);
const showDeleteProductDialogModal = ref(false);

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
                    id
                </th>
                <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                    Name
                </th>
                <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                >
                    Description
                </th>
                <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-0">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <transition-group
                enter-active-class="transition-opacity duration-500"
                leave-active-class="transition-all duration-500"
                leave-to-class="opacity-0 translate-x-full"
            >
                <tr v-for="product in products" :key="product.id">
                    <td
                        class="py-4 pr-3 pl-4 text-sm font-medium whitespace-nowrap text-gray-900 sm:pl-0"
                    >
                        {{ product.id }}
                    </td>
                    <td
                        class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                    >
                        {{ product.name }}
                    </td>
                    <td
                        class="px-3 py-4 text-sm whitespace-nowrap text-gray-500"
                    >
                        {{ product.description }}
                    </td>
                    <td
                        class="relative py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-0"
                    >
                        <a
                            href="#"
                            class="text-indigo-600 hover:text-indigo-900"
                            >Edit<span class="sr-only"
                                >, {{ product.name }}</span
                            ></a
                        >

                        <Button
                            size="sm"
                            class="ml-2 text-indigo-600 hover:text-indigo-900 font-medium"
                            type="button"
                            variant="link"
                            @click.prevent="
                                handleShowDeleteProductDialog(product)
                            "
                            @click="handleShowDeleteProductDialog(product)"
                        >
                            Delete
                        </Button>
                    </td>
                </tr>
            </transition-group>
        </tbody>
    </table>

    <!-- Delete Product Dialog Modal -->
    <DeleteProductDialogModal
        :show="showDeleteProductDialogModal"
        :product="selectedProduct"
        @close="
            showDeleteProductDialogModal = false;
            selectedProduct = null;
        "
    />
</template>
