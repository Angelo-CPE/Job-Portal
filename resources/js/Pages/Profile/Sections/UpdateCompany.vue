<script setup>
import Container from '../../../Components/Container.vue'
import Title from '../../../Components/Title.vue'
import InputField from '../../../Components/InputField.vue'
import PrimaryBtn from '../../../Components/PrimaryBtn.vue'
import ErrorMessages from '../../../Components/ErrorMessages.vue'
import SessionMessages from '../../../Components/SessionMessages.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    company: Object,
    status: String
})

const form = useForm({
    company_name: props.company.company_name ?? '',
    description: props.company.description ?? '',
    website: props.company.website ?? '',
    contact_number: props.company.contact_number ?? '',
})

const submit = () => {
    form.patch(route('company.update'), {
        preserveScroll: true,
    })
}
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Title>Update Company Info</Title>
            <p>Update your company profile information.</p>
        </div>

        <ErrorMessages :errors="form.errors" />
        <SessionMessages :status="status" />

        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Company Name" icon="building" v-model="form.company_name" class="w-1/2" />
            <InputField label="Description" icon="align-left" v-model="form.description" class="w-full" />
            <InputField label="Website" icon="globe" v-model="form.website" class="w-1/2" />
            <InputField label="Contact Number" icon="phone" v-model="form.contact_number" class="w-1/2" />
            <PrimaryBtn :disabled="form.processing">Save</PrimaryBtn>
        </form>
    </Container>
</template>
