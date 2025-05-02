<script setup>
import { ref } from "vue";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CreateProductForm from "@/Components/Admin/Product/Form/CreateProductForm.vue";

const props = defineProps({
    show: {
        type: Boolean,
    },
});

const submitForm = ref(false);
const formIsLoading = ref(false);

const emit = defineEmits(["success", "close"]);

function handleSubmit() {
    submitForm.value = true;
}

function close() {
    emit("close");
}
</script>

<template>
    <DialogModal :show="show" @close="close()" title="Create Product">
        <!-- Form -->
        <CreateProductForm
            :submit="submitForm"
            @loading="formIsLoading = true"
            @submitted="
                submitForm = false;
                formIsLoading = false;
            "
            @success="emit('success')"
        />

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
    </DialogModal>
</template>
