<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import InputField from '../../Components/InputField.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    listing: Object,
});

const form = useForm({
    name: '',
    sex: '',
    birthdate: '',
    address: '',
    school: '',
    phone: '',
    email: '',
    salary: '',
    time: '',
    resume: null,
});

const handleResumeUpload = (e) => {
    const file = e.target.files[0];
    const allowedExtensions = ['pdf', 'docx'];

    if (file && !allowedExtensions.includes(file.name.split('.').pop().toLowerCase())) {
        form.errors.resume = 'Only PDF and DOCX formats are allowed.';
        return;
    }

    form.resume = file;
};

// Handle salary input to accept only integers
const handleSalaryInput = (event) => {
    form.salary = event.target.value.replace(/\D/g, '');  // Allow only digits
};

const submit = () => {
    form.post(route('listing.apply.store', props.listing.id), {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Apply for Job"/>
    <Container>
        <div class="mb-8">
            <Title>Apply for "{{ listing.title }}"</Title>
        </div>

        <ErrorMessages :errors="form.errors"/>

        <form @submit.prevent="submit" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <InputField label="Full Name" v-model="form.name" />
                    
                    <!-- Sex dropdown -->
                    <div>
                        <label for="sex" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Sex</label>
                        <select 
                            id="sex" 
                            v-model="form.sex" 
                            class="w-full pl-4 pr-4 py-3 border border-gray-300 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="" disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    
                    <InputField label="Birthdate" type="date" v-model="form.birthdate" />
                    <InputField label="Address" v-model="form.address" />
                    <InputField label="School" v-model="form.school" />
                </div>

                <div class="space-y-6">
                    <InputField label="Phone Number" v-model="form.phone" />
                    <InputField label="Email" v-model="form.email" />

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Desired Salary</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-sm">₱</span>
                            <input 
                                type="text"
                                v-model="form.salary"
                                @input="handleSalaryInput"
                                class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter Salary"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Time</label>
                        <div class="space-y-2">
                            <label><input type="radio" value="Full Time" v-model="form.time" class="mr-2">Full Time</label><br>
                            <label><input type="radio" value="Part Time" v-model="form.time" class="mr-2">Part Time</label><br>
                            <label><input type="radio" value="Intern" v-model="form.time" class="mr-2">Intern</label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Upload Resume</label>
                        <input type="file" @change="handleResumeUpload" accept=".pdf,.docx" class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                        <div v-if="form.errors.resume" class="text-red-500 text-sm">{{ form.errors.resume }}</div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <PrimaryBtn :disabled="form.processing" class="w-full">Apply</PrimaryBtn>
            </div>
        </form>
    </Container>
</template>