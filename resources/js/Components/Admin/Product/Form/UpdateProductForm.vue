<script setup>
import { watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
    submit: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["loading", "success", "submitted"]);

const form = useForm({
    internal_id: props.product.internal_id,
    name: props.product.name,
    description: props.product.description,
});

function submit() {
    emit("loading");

    form.post(route("admin.products.update", props.product.uuid), {
        onSuccess: () => {
            form.reset();

            emit("success");
        },
        onFinish: () => {
            console.log("onFinish");
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
        </div>
    </form>
</template>
