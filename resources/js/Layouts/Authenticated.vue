<template>
    <nav class="navbar py-2 navbar-dark sticky-top navbar-expand-lg bg-dark py-1 shadow">
        <x-link class="navbar-brand bg-dark col-md-3 col-lg-2 me-0 px-5 fs-6" :href="route('dashboard')">
            {{ $page.props.app.name }}
        </x-link>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="w-100 px-3 d-flex align-items-center justify-content-between">
            <div class="text-white">{{ __('Hi') }}, {{ $page.props.auth?.user?.username ?? __('IRC User') }}</div>
            <div class="">
                <button type="button" class="link signout-link" @click.prevent="signout">{{ __('Sign out') }}</button>
            </div>
        </div>
    </nav>

    <div class="">
        <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('dashboard')"
                    :active="route().current('dashboard')">
                {{ __('Dashboard') }}
            </x-link>
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('users')"
                    :active="route().current('users')">
                {{ __('Users') }}
            </x-link>
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('channels')"
                    :active="route().current('channels')">
                {{ __('Channels') }}
            </x-link>
            <x-link router-tag="x-link" class="nav-item" exact-active-class="active" exact :href="route('bans')"
                    :active="route().current('bans')">
                {{ __('Bans') }}
            </x-link>
        </div>

        <main class="col-md-9 position-relative ms-sm-auto col-lg-10">
            <b-alert variant="danger" class="rounded-0 border-0 bg-danger text-white mb-0" show>
                {{ __('Debug Mode is currently enabled.') }}
            </b-alert>
            <div class="container-fluid px-md-4">
                <slot/>

                <div class="small mb-3 text-muted d-flex align-items-center gap-2">
                    <span>Copyright &copy; 1999 – {{ new Date().getFullYear() }} UnrealIRCd</span>
                    <span>&middot;</span>
                    <div class="d-block position-relative">
                        <div class="d-flex gap-1 align-items-center">
                            <span>Language</span>
                            <b-dropdown dropup size="sm" id="lang-dropdown" :text="langs.name" class="my-md-2">
                                <b-dropdown-item v-for="lang in languages" :key="lang.value" :href="route('lang', { 'lang': lang.value })">
                                    {{ lang.name }}
                                </b-dropdown-item>
                            </b-dropdown>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <b-container :toast="{root:true}" class="topper" fluid="sm" position="position-sticky"/>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { BDropdown, useToast } from "bootstrap-vue-3";
import { Inertia } from '@inertiajs/inertia';

const languages = [
    { value: 'en', name: window.__('English') },
    { value: 'tr', name: window.__('Turkish') },
]

export default defineComponent({
    name: "Authenticated",
    components: { BDropdown },

    setup() {
        let toast = useToast();

        return {
            toast,
            languages,
        }
    },

    created() {
        this.getLanguage();

        setTimeout(() => {
            if (this.$page.props.flash.data) {
                this.toast.show({
                    title: this.$page.props.flash.data.title,
                    body: this.$page.props.flash.data.message
                }, {
                    variant: this.$page.props.flash.data.type,
                });
            }
        }, 500);
    },

    data() {
        return {
            langs: {},
            __: window.__,
        }
    },

    methods: {
        signout() {
            window.axios.post(route('signout')).then(res => {
                if(res.data) {
                    this.toast.show({
                        title: window.__('Success!'),
                        body: window.__('You have been signed out.')
                    }, {
                        variant: 'success',
                    });
                    Inertia.visit(route('login'))
                }
            });
        },

        getLanguage() {
            for (let i = 0; i < languages.length; i++) {
                if (languages[i].value === this.$page.props.app.lang) {
                    this.langs = languages[i];
                    return;
                }
            }
        },
    }
})
</script>

<style scoped lang="scss">
main {
    height: 100vh;
}

.sidebar {
    position: fixed;
    top: 1px;
    bottom: 0;
    left: 0;
    z-index: 1; /* Behind the navbar */
    padding: 48px 0 0; /* Height of navbar */
}

@media (max-width: 767.98px) {
    .sidebar {
        top: 5rem;
    }
}

.nav-item {
    margin: .4rem;
    font-weight: 500;
    color: #333 !important;
    display: block;
    padding: .725rem .925rem;
    text-decoration: none;
    border-radius: .325rem;

    &:hover {
        background: #3399ff77;
    }
}

.nav-item.active {
    color: #fff !important;
    background: #3399ff;
}

.sidebar-heading {
    font-size: .75rem;
}

/*
 * Navbar
 */

.navbar-brand {
    background-color: #212529;
    z-index: 100;
    height: 32px;
}

.navbar .navbar-toggler {
    top: .25rem;
    right: 1rem;
}

.navbar .form-control {
    padding: .75rem 1rem;
}

.form-control-dark {
    color: #fff;
    background-color: rgba(255, 255, 255, .1);
    border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
    border-color: transparent;
    box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}

.link:hover {
    color: #d8ddd8 !important;
}

.signout-link {
    color: #fff;
    background: transparent;
    border: 0;
    cursor: pointer;
    box-shadow: none;
}
</style>
