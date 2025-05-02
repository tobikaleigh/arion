<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String | Number,
    disabled: Boolean,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <textarea
        ref="input"
        class="pl-4 border w-full border-gray-200 focus:border-express-600 focus:ring-express-600 rounded-xl"
        :class="{ 'bg-gray-50': disabled }"
        :disabled="disabled"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
