<script setup>
import { watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    submit: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["success", "loading", "submitted"]);

const form = useForm({
    internal_id: "",
    name: "",
    description: "",
    inventory_location_name: "",
    inventory_location_quantity: 1,
});

function submit() {
    emit("loading");

    form.post(route("admin.products.store"), {
        onSuccess: () => {
            form.reset();

            emit("success");
        },
        onFinish: () => {
            emit("submitted");
        },
    });
}

watch(
    () => props.submit,
    (value) => {
        if (value) {
            submit();
        }
    }
);
</script>

<template>
    <form @submit.prevent="submit()">
        <div>
            <InputLabel for="Internal ID" value="Internal ID" />
            <TextInput
                name="internal_id"
                type="text"
                class="mt-1 block w-full"
                v-model="form.internal_id"
                :error="form.errors.internal_id"
                placeholder="Enter internal ID"
                autofocus
            />
            <InputError
                v-if="form.errors.internal_id"
                class="mt-2"
                :message="form.errors.internal_id"
            />

            <InputLabel for="name" value="Name" class="mt-4" />
            <TextInput
                name="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                :error="form.errors.name"
                placeholder="Enter product name"
                autofocus
            />
            <InputError
                v-if="form.errors.name"
                class="mt-2"
                :message="form.errors.name"
            />

            <InputLabel for="description" value="Description" class="mt-4" />
            <TextArea
                name="description"
                type="text"
                rows="4"
                class="mt-1 block w-full"
                v-model="form.description"
                :error="form.errors.description"
                placeholder="Enter product description"
            />
            <InputError
                v-if="form.errors.description"
                class="mt-2"
                :message="form.errors.description"
            />

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <InputLabel
                        for="inventory_location_name"
                        value="Inventory Location"
                        class="mt-4"
                    />
                    <TextInput
                        name="inventory_location_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.inventory_location_name"
                        :error="form.errors.inventory_location_name"
                        placeholder="Enter inventory location"
                    />
                    <InputError
                        v-if="form.errors.inventory_location_name"
                        class="mt-2"
                        :message="form.errors.inventory_location_name"
                    />
                </div>

                <div>
                    <InputLabel
                        for="inventory_location_quantity"
                        value="Inventory Quantity"
                        class="mt-4"
                    />
                    <TextInput
                        name="inventory_location_quantity"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.inventory_location_quantity"
                        :error="form.errors.inventory_location_quantity"
                        placeholder="Enter location quantity"
                    />
                    <InputError
                        v-if="form.errors.inventory_location_quantity"
                        class="mt-2"
                        :message="form.errors.inventory_location_quantity"
                    />
                </div>
            </div>
        </div>
    </form>
</template>
