<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-[70px] h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
        <div class="w-full flex flex-col sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <p class="text-sm mb-2">
                Или запишитесь на приём по номеру телефона
            </p>
            <div class="flex justify-between">
                <TextInput placeholder="89998884422" class=" m-auto" model-value=""></TextInput>
                <PrimaryButton>
                    Отправить
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
