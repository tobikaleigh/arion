<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    type: {
        type: String,
        default: "submit",
    },
    block: {
        type: Boolean,
        default: false,
    },
    size: {
        type: String,
        default: "md",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    loading: {
        type: Boolean,
        default: false,
    },
    navButton: {
        type: Boolean,
        default: false,
    },
});

const clicked = ref(false);

const isLoading = computed(() => {
    if (props.navButton) {
        return clicked.value;
    }

    return props.loading;
});

const handleClick = () => {
    clicked.value = true;
};
</script>

<template>
    <button
        :type="type"
        class="block w-full md:w-auto font-bold transition-all ease-in-out hover:-translate-y-0.5"
        :class="{
            'md:block md:w-full': block,
            'md:inline-flex md:w-auto items-center': !block,
            // Sizes
            'text-sm px-6 py-1': size === 'sm',
            'px-8 text-base py-1.5 duration-200': size === 'md',
            'text-base px-10 py-2 duration-200': size === 'lg',
            'text-lg px-20 py-2.5 duration-300': size === 'xl',
            // Disabled
            'opacity-60': disabled || isLoading,
        }"
        :disabled="disabled || isLoading"
        @click="handleClick()"
    >
        <!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
        <span class="flex justify-center">
            <svg
                v-if="isLoading"
                class="absolute animate-spin"
                :class="{
                    'w-4': size === 'sm',
                    'w-4': size === 'md',
                    'w-5': size === 'lg',
                    'w-6': size === 'xl',
                }"
                viewBox="0 0 38 38"
                xmlns="http://www.w3.org/2000/svg"
            >
                <defs>
                    <linearGradient
                        x1="8.042%"
                        y1="0%"
                        x2="65.682%"
                        y2="23.865%"
                        id="a"
                    >
                        <stop stop-color="#fff" stop-opacity="0" offset="0%" />
                        <stop
                            stop-color="#fff"
                            stop-opacity=".631"
                            offset="63.146%"
                        />
                        <stop stop-color="#fff" offset="100%" />
                    </linearGradient>
                </defs>
                <g fill="none" fill-rule="evenodd">
                    <g transform="translate(1 1)">
                        <path
                            d="M36 18c0-9.94-8.06-18-18-18"
                            id="Oval-2"
                            stroke="url(#a)"
                            stroke-width="2"
                        ></path>
                        <circle fill="#fff" cx="36" cy="18" r="1"></circle>
                    </g>
                </g>
            </svg>
            <span class="flex items-center" :class="{ invisible: isLoading }">
                <slot />
            </span>
        </span>
    </button>
</template>
