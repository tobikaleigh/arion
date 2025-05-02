<script setup>
import { ref } from "vue";
import CreateProductDialog from "@/Components/Admin/Product/CreateProductDialog.vue";
import ProductTable from "@/Components/Admin/Product/ProductTable.vue";

const showCreateProductDialog = ref(false);

const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1
                    class="text-base font-semibold text-gray-900 dark:text-white"
                >
                    All products
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    A list of all the products in your account including their
                    name, title, and email address.
                </p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button
                    @click="showCreateProductDialog = true"
                    type="button"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                    Add product
                </button>

                <CreateProductDialog
                    :show="showCreateProductDialog"
                    @close="showCreateProductDialog = false"
                    @success="showCreateProductDialog = false"
                />
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                >
                    <ProductTable :products="products" />
                </div>
            </div>
        </div>
    </div>
</template>
