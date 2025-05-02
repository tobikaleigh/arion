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
    name: "",
    description: "",
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
            <InputLabel for="name" value="Name" />
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
