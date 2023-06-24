<template>

    <form @submit.prevent="login">
        <div class="w-1/3 mx-auto">
            <div>
                <label for="email" class="label">E-mail</label>
                <input type="text" v-model="form.email" id="email" class="input"/>
                <div class="input-error" v-if="form.errors.email">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" v-model="form.password" id="password" class="input"/>
                <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit">Log in</button>

                <div class="mt-2 text-center">
                <Link :href="route('user-account.create')" class="text-sm text-gray-500">
                    Create account? Click here
                </Link>
                </div>

            </div>
        </div>
    </form>

</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

// inertia collect all laravel errors that happen in backend and all of them are avalible in vue frontend
// form.errors.email

const form = useForm({
    email: null,
    password: null
})

const login = () => form.post(route('login.store'))

</script>