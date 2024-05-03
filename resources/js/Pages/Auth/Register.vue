<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    surname: '',
    patronymic: '',
    birthday: '',
    insurance_policy_number: ''
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="flex mb-4">
                <div class="mr-2">
                    <InputLabel for="name" value="Имя" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mr-2">
                    <InputLabel for="surname" value="Фамилия" />

                    <TextInput
                        id="surname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.surname"
                        required
                        autofocus
                        autocomplete="surname"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="patronymic" value="Отчество" />

                    <TextInput
                        id="surname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.patronymic"
                        required
                        autofocus
                        autocomplete="patronymic"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
            </div>

            <div class="mb-4 grid gap-2 grid-cols-[1fr_2fr]">
                <div>
                    <InputLabel for="birthday" value="День рождение" />

                    <TextInput
                        id="birthday"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.birthday"
                        required
                        autofocus
                        autocomplete="birthday"
                    />

                    <InputError class="mt-2" :message="form.errors.birthday" />
                </div>

                <div>
                    <InputLabel for="insurance_policy_number" value="Номер полюса" />

                    <TextInput
                        id="insurance_policy_number"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.insurance_policy_number"
                        required
                        autofocus
                        autocomplete="insurance_policy_number"
                    />

                    <InputError class="mt-2" :message="form.errors.insurance_policy_number" />
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Почта" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Пароль" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Подтвердить пароль" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Уже зарегистрированы?
                </Link>

                <PrimaryButton class="ms-4 bg-blue-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Зарегистрироваться
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
