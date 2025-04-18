<script setup>
import { switchTheme } from '../theme';
import NavLink from '../Components/NavLink.vue';
import { computed, ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage()
const user = computed(()=>page.props.auth.user)

const show = ref(false)

</script>

<template>
    <div v-show="show" @click="show = false" class="fixed inset-0 z-40"></div>
    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">
            <NavLink data-testid="home" routeName="home" componentName="Home">Home</NavLink>

            <div class="flex items-center space-x-6">
                <div v-if="user" class="relative flex items-center gap-4">
                    <div
                        data-testid="accDropdown"
                        @click="show = !show"
                        class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-slate-700 cursor-pointer"
                        :class="{'bg-slate-700' : show}">
                        <p>{{ user.name }}</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>

                    <Link
                        v-if="user.role === 'admin'"
                        :href="route('admin.index')"
                        class="hover:bg-slate-700 w-6 h-6 grid place-items-center rounded-full hover:outline outline-1 outline-white"
                    >
                        <i class="fa-solid fa-lock"></i>
                    </Link>

                    <div
                        v-show="show"
                        @click="show=false"
                        class="absolute z-50 top-16 right-0 bg-slate-800 text-white rounded-lg border-slate border overflow-hidden w-40">
                        <Link
                            data-testid="newListing" 
                            :href="route('listing.create')"
                            class="block w-full px-6 py-3 hover:bg-slate-700 text-left">New Listing
                        </Link>
                        <Link
                            data-testid="profile" 
                            :href="route('profile.edit')"
                            class="block w-full px-6 py-3 hover:bg-slate-700 text-left">Profile
                        </Link>
                        <Link
                            data-testid="dashboard"  
                            :href="route('dashboard')"
                            class="block w-full px-6 py-3 hover:bg-slate-700 text-left">Dashboard
                        </Link>
                        <Link
                            data-testid="logout" 
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="block w-full px-6 py-3 hover:bg-slate-700 text-left">
                            Logout
                        </Link>
                    </div>
                </div>

                <div v-else class="space-x-6">
                    <NavLink data-testid="login" routeName="login" componentName="Auth/Login">Login</NavLink>
                    <NavLink data-testid="register" routeName="register" componentName="Auth/Register">Register</NavLink>
                </div>
                <button
                    data-testid="switchTheme" 
                    @click="switchTheme"
                    class="hover:bg-slate-700 w-6 h-6 grid place-items-center rounded-full hover:outline outline-1 outline-white"
                >
                    <i class="fa-solid fa-moon"></i>
                </button>

            </div>
        </nav>
    </header>

    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>
