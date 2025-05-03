<script setup>
import { ref } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import {
    Bars3Icon,
    BellIcon,
    CalendarIcon,
    ChartPieIcon,
    Cog6ToothIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
    XMarkIcon,
} from "@heroicons/vue/24/outline";
import { ChevronDownIcon, MagnifyingGlassIcon } from "@heroicons/vue/20/solid";

const user = usePage().props.auth.user;

const navigation = [
    {
        name: "Products",
        route: "admin.products.index",
        icon: HomeIcon,
        current: true,
    },
    {
        name: "Documents",
        route: "admin.products.index",
        icon: DocumentDuplicateIcon,
        current: false,
    },
];
const teams = [
    { id: 1, name: "Heroicons", href: "#", initial: "H", current: false },
    { id: 2, name: "Tailwind Labs", href: "#", initial: "T", current: false },
    { id: 3, name: "Workcation", href: "#", initial: "W", current: false },
];
const quickLinks = [
    {
        name: "Arion Webshop",
        href: "https://shop.arionracing.dk/shop/",
        initial: "WS",
    },
    {
        name: "Arion Homepage",
        href: "https://arionracing.dk/",
        initial: "HP",
    },
];
const userNavigation = [{ name: "Your profile", route: "profile.show" }];

const sidebarOpen = ref(false);
</script>

<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                class="relative z-50 lg:hidden"
                @close="sidebarOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild
                        as="template"
                        enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full"
                        enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leave-from="translate-x-0"
                        leave-to="-translate-x-full"
                    >
                        <DialogPanel
                            class="relative mr-16 flex w-full max-w-xs flex-1"
                        >
                            <TransitionChild
                                as="template"
                                enter="ease-in-out duration-300"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="ease-in-out duration-300"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div
                                    class="absolute top-0 left-full flex w-16 justify-center pt-5"
                                >
                                    <button
                                        type="button"
                                        class="-m-2.5 p-2.5"
                                        @click="sidebarOpen = false"
                                    >
                                        <span class="sr-only"
                                            >Close sidebar</span
                                        >
                                        <XMarkIcon
                                            class="size-6 text-white"
                                            aria-hidden="true"
                                        />
                                    </button>
                                </div>
                            </TransitionChild>
                            <!-- Sidebar component, swap this element with another sidebar if you like -->
                            <div
                                class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4"
                            >
                                <div class="flex h-16 shrink-0 items-center">
                                    <img
                                        class="h-8 w-auto"
                                        src="/assets/images/brand/logo_white_x250.png"
                                        alt="Your Company"
                                    />
                                </div>
                                <nav class="flex flex-1 flex-col">
                                    <ul
                                        role="list"
                                        class="flex flex-1 flex-col gap-y-7"
                                    >
                                        <li>
                                            <ul
                                                role="list"
                                                class="-mx-2 space-y-1"
                                            >
                                                <li
                                                    v-for="item in navigation"
                                                    :key="item.name"
                                                >
                                                    <a
                                                        :href="
                                                            route(item.route)
                                                        "
                                                        :class="[
                                                            item.current
                                                                ? 'bg-gray-50 text-indigo-600'
                                                                : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600',
                                                            'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                                        ]"
                                                    >
                                                        <component
                                                            :is="item.icon"
                                                            :class="[
                                                                item.current
                                                                    ? 'text-indigo-600'
                                                                    : 'text-gray-400 group-hover:text-indigo-600',
                                                                'size-6 shrink-0',
                                                            ]"
                                                            aria-hidden="true"
                                                        />
                                                        {{ item.name }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div
                                                class="text-xs/6 font-semibold text-gray-400"
                                            >
                                                Your quick links
                                            </div>
                                            <ul
                                                role="list"
                                                class="-mx-2 mt-2 space-y-1"
                                            >
                                                <li
                                                    v-for="link in quickLinks"
                                                    :key="link.name"
                                                >
                                                    <a
                                                        :href="link.href"
                                                        class="text-gray-700 hover:bg-gray-50 hover:text-indigo-600 group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold"
                                                        target="_blank"
                                                    >
                                                        <span
                                                            class="border-gray-200 text-gray-400 group-hover:border-indigo-600 group-hover:text-indigo-600 flex size-6 shrink-0 items-center justify-center rounded-lg border bg-white text-[0.625rem] font-medium"
                                                            >{{
                                                                link.initial
                                                            }}</span
                                                        >
                                                        <span
                                                            class="truncate"
                                                            >{{
                                                                link.name
                                                            }}</span
                                                        >
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mt-auto">
                                            <Link
                                                :href="route('profile.show')"
                                                class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 hover:text-indigo-600"
                                            >
                                                <Cog6ToothIcon
                                                    class="size-6 shrink-0 text-gray-400 group-hover:text-indigo-600"
                                                    aria-hidden="true"
                                                />
                                                Settings
                                            </Link>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div
            class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
        >
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div
                class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4"
            >
                <div class="flex h-16 shrink-0 items-center">
                    <img
                        class="h-8 w-auto"
                        src="/assets/images/brand/logo_white_x250.png"
                        alt="Your Company"
                    />
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li v-for="item in navigation" :key="item.name">
                                    <Link
                                        :href="route(item.route)"
                                        :class="[
                                            item.current
                                                ? 'bg-gray-50 text-indigo-600'
                                                : 'text-gray-700 hover:bg-gray-50 hover:text-indigo-600',
                                            'group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold',
                                        ]"
                                    >
                                        <component
                                            :is="item.icon"
                                            :class="[
                                                item.current
                                                    ? 'text-indigo-600'
                                                    : 'text-gray-400 group-hover:text-indigo-600',
                                                'size-6 shrink-0',
                                            ]"
                                            aria-hidden="true"
                                        />
                                        {{ item.name }}
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="text-xs/6 font-semibold text-gray-400">
                                Your quick links
                            </div>
                            <ul role="list" class="-mx-2 mt-2 space-y-1">
                                <li v-for="link in quickLinks" :key="link.name">
                                    <a
                                        :href="link.href"
                                        class="text-gray-700 hover:bg-gray-50 hover:text-indigo-600 group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold"
                                        target="_blank"
                                    >
                                        <span
                                            class="border-gray-200 text-gray-400 group-hover:border-indigo-600 group-hover:text-indigo-600 flex size-6 shrink-0 items-center justify-center rounded-lg border bg-white text-[0.625rem] font-medium"
                                            >{{ link.initial }}</span
                                        >
                                        <span class="truncate">
                                            {{ link.name }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="mt-auto">
                            <Link
                                :href="route('profile.show')"
                                class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 hover:text-indigo-600"
                            >
                                <Cog6ToothIcon
                                    class="size-6 shrink-0 text-gray-400 group-hover:text-indigo-600"
                                    aria-hidden="true"
                                />
                                Settings
                            </Link>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div class="sticky top-0 z-40 lg:mx-auto lg:max-w-7xl lg:px-8">
                <div
                    class="flex h-16 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-xs sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none"
                >
                    <button
                        type="button"
                        class="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                        @click="sidebarOpen = true"
                    >
                        <span class="sr-only">Open sidebar</span>
                        <Bars3Icon class="size-6" aria-hidden="true" />
                    </button>

                    <!-- Separator -->
                    <div
                        class="h-6 w-px bg-gray-200 lg:hidden"
                        aria-hidden="true"
                    />

                    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                        <form
                            class="grid flex-1 grid-cols-1"
                            action="#"
                            method="GET"
                        >
                            <input
                                type="search"
                                name="search"
                                aria-label="Search"
                                class="border-0 col-start-1 row-start-1 block size-full bg-white pl-8 text-base text-gray-900 outline-hidden placeholder:text-gray-400 sm:text-sm/6"
                                placeholder="Search"
                            />
                            <MagnifyingGlassIcon
                                class="pointer-events-none col-start-1 row-start-1 size-5 self-center text-gray-400"
                                aria-hidden="true"
                            />
                        </form>
                        <div class="flex items-center gap-x-4 lg:gap-x-6">
                            <button
                                type="button"
                                class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500"
                            >
                                <span class="sr-only">View notifications</span>
                                <BellIcon class="size-6" aria-hidden="true" />
                            </button>

                            <!-- Separator -->
                            <div
                                class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200"
                                aria-hidden="true"
                            />

                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative">
                                <MenuButton
                                    class="-m-1.5 flex items-center p-1.5"
                                >
                                    <span class="sr-only">Open user menu</span>
                                    <span class="flex items-center">
                                        <span
                                            class="text-sm/6 font-semibold text-gray-900"
                                            aria-hidden="true"
                                            ><span
                                                class="hidden lg:inline-block mr-2 font-medium"
                                                >Logged in:</span
                                            >{{ user.name }}</span
                                        >
                                        <ChevronDownIcon
                                            class="ml-2 size-5 text-gray-400"
                                            aria-hidden="true"
                                        />
                                    </span>
                                </MenuButton>
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-hidden"
                                    >
                                        <MenuItem
                                            v-for="item in userNavigation"
                                            :key="item.name"
                                            v-slot="{ active }"
                                        >
                                            <Link
                                                :href="route(item.route)"
                                                :class="[
                                                    active
                                                        ? 'bg-gray-50 outline-hidden'
                                                        : '',
                                                    'block px-3 py-1 text-sm/6 text-gray-900',
                                                ]"
                                                >{{ item.name }}</Link
                                            >
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>
            </div>

            <main class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
