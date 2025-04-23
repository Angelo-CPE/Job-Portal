<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    user_type: "", // added for user type selection
    company_name: "", // Company-specific fields
    description: "",
    website: "",
    contact_number: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

const toggleUserType = (type, event) => {
    event.preventDefault(); // Prevent form submission when clicking the buttons
    if (type === 'company') {
        form.user_type = 'employer';  // Use 'employer' instead of 'company'
    } else {
        form.user_type = type;
    }
};
</script>

<template>
    <Head title="Register"></Head>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Register a New Account</Title>
            <p>Already have an account? <TextLink routeName="login" label="Login" /></p>
        </div>

        <ErrorMessages :errors="form.errors" />

        <form @submit.prevent="submit" class="space-y-6">
            <!-- Name, Email, Password fields -->
            <InputField data-testid="registerNameInput" label="Name" icon="id-badge" v-model="form.name"/>
            <InputField data-testid="registerEmailInput" label="Email" type="email" icon="at" v-model="form.email"/>
            <InputField data-testid="registerPasswordInput" label="Password" type="password" icon="key" v-model="form.password"/>
            <InputField data-testid="registerConfirmPasswordInput" label="Confirm Password" type="password" icon="key" v-model="form.password_confirmation"/>

            <!-- Radio buttons for user type -->
            <div class="space-x-4">
                <button @click="toggleUserType('applicant', $event)" class="px-4 py-2 bg-blue-500 text-white rounded">Job Applicant</button>
                <button @click="toggleUserType('company', $event)" class="px-4 py-2 bg-green-500 text-white rounded">Company</button>
            </div>

            <!-- Company-specific fields -->
            <div v-if="form.user_type === 'employer'" class="space-y-4">
                <InputField v-model="form.company_name" label="Company Name" icon="business"/>
                <InputField v-model="form.description" label="Description" icon="info"/>
                <InputField v-model="form.website" label="Website (Optional)" icon="link"/>
                <InputField v-model="form.contact_number" label="Contact Number (Optional)" icon="phone"/>
            </div>

            <p class="text-slate-500 text-sm dark:text-slate-400">
                By creating an account, you agree to our Terms of Service and Privacy Policy.
            </p>

            <PrimaryBtn data-testid="registerButton" :disabled="form.processing">Register</PrimaryBtn>
        </form>
    </Container>
</template>
