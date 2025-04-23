<script setup>
import { Head } from '@inertiajs/vue3'
import DeleteAccount from './Sections/DeleteAccount.vue'
import UpdateInfo from './Sections/UpdateInfo.vue'
import UpdatePassword from './Sections/UpdatePassword.vue'
import UpdateCompany from './Sections/UpdateCompany.vue'

const props = defineProps({
    user: Object,
    status: String,
    company: Object
});
</script>

<template>
    <Head title="Profile" />

    <UpdateInfo :user="user" :status="status" />
    <UpdatePassword />

    <!-- Ensure `user.role` exists and the condition is checked properly -->
    <UpdateCompany 
        v-if="user.user_type === 'employer'" 
        :company="company" 
        :status="status" 
    />

    <DeleteAccount />
</template>
