<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import ProductSection from "@/Components/Admin/Product/ProductSection.vue";

const props = defineProps({
    products: Object,
});
</script>

<template>
    <AdminLayout title="Dashboard">
        <ProductSection :products="products.data" />
    </AdminLayout>
</template>
