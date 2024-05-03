<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UserListRecords from "@/Pages/Profile/Dashboard/UserListRecords.vue";
import UserOldListRecord from "@/Pages/Profile/Dashboard/UserOldListRecord.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Главная</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <UserListRecords></UserListRecords>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <UserOldListRecord></UserOldListRecord>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
