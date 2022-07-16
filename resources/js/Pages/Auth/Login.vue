<template>
    <div class="wrapper">
        <x-head>
            <title>{{ __('Log in to') }} {{ $page.props.app.name }}</title>
        </x-head>

        <div class="text-center inner-wrapper">
            <div class="form-signin m-auto">
                <form @submit.prevent="login" class="form-signin-form w-100">
                    <h1 class="h3 mb-3 fw-normal">{{ __('Please Sign In') }}</h1>
                    <h2 class="h5 text-black-50 mb-4">{{ $page.props.app.name }}</h2>

                    <div class="alert alert-info text-start" role="alert">
                        {{ __('Please use your oper credentials to log in.') }}
                    </div>

                    <div v-if="Object.keys(form.errors).length > 0" class="alert alert-danger text-start">
                        <p>{{ __('Whoops, something went wrong.') }}</p>
                        <ul>
                            <li v-for="key in Object.keys(form.errors)">
                                {{ form.errors[key] }}
                            </li>
                        </ul>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username"
                               :class="form.errors.username ? 'is-invalid' : ''"
                               v-model="form.username">
                        <label for="floatingInput">{{ __('Username') }}</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                               :class="form.errors.username ? 'is-invalid' : ''"
                               v-model="form.password">
                        <label for="floatingPassword">{{ __('Password') }}</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" :disabled="form.processing" type="submit">
                        {{ __('Sign in') }}
                    </button>
                </form>

                <div class="mt-5 mb-3 text-muted d-flex align-items-center gap-2">
                    <span>Copyright &copy; 1999 – {{ new Date().getFullYear() }} UnrealIRCd</span>
                    <span>&middot;</span>
                    <div class="d-flex gap-2 align-items-center">
                        Language:
                        <b-dropdown ref="lang" id="lang-dropdown" toggle-tag="span" :text="langs.name" class="m-md-2">
                            <b-dropdown-item v-for="lang in languages" :href="route('lang', { 'lang': lang.value })">
                                {{ lang.name }}
                            </b-dropdown-item>
                        </b-dropdown>
                    </div>
                </div>
            </div>
        </div>

        <b-container :toast="{root:true}" class="topper" fluid="sm" position="position-sticky"/>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3';
import { BDropdown, useToast } from "bootstrap-vue-3";

const languages = [
    { value: 'en', name: window.__('English') },
    { value: 'tr', name: window.__('Turkish') },
]


export default defineComponent({
    name: "Auth",
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
                    solid: true,
                });
            }
        }, 500);
    },

    data() {
        return {
            langs: {},
            __: window.__,
            form: useForm({
                username: null,
                password: null,
            })
        }
    },

    methods: {
        getLanguage() {
            for (let i = 0; i < languages.length; i++) {
                if (languages[i].value === this.$page.props.app.lang) {
                    this.langs = languages[i];
                    return;
                }
            }
        },

        login() {
            this.form.post(route('login'), {
                onError: (err) => {
                    console.error(err);
                }
            });
        }
    }
});
</script>

<style scoped>
.wrapper, .inner-wrapper {
    height: 100vh;
}

.inner-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin-form {
    max-width: 440px;
    padding: 15px;
}

.form-signin .form-floating:focus-within {
    z-index: 2;
}

.form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
</style>
