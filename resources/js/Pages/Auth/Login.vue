<template>
    <div class="wrapper">
        <x-head>
            <title>Log in to {{ $page.props.app.name }}</title>
        </x-head>

        <div class="text-center inner-wrapper">
            <div class="form-signin w-100 m-auto">
                <form @submit.prevent="login">
                    <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>
                    <h2 class="h5 text-black-50 mb-4">{{ $page.props.app.name }}</h2>

                    <div class="alert alert-info text-start" role="alert">
                        Please use your oper credentials to log in.
                    </div>

                    <div v-if="Object.keys(form.errors).length > 0" class="alert alert-danger text-start">
                        <p>Whoops, something went wrong.</p>
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
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                               :class="form.errors.username ? 'is-invalid' : ''"
                               v-model="form.password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" :disabled="form.processing" type="submit">Sign in
                    </button>

                    <p class="mt-5 mb-3 text-muted">Copyright &copy; 1999 – {{ new Date().getFullYear() }}
                        UnrealIRCd</p>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3';

export default defineComponent({
    name: "Auth",

    data() {
        return {
            form: useForm({
                username: null,
                password: null,
            })
        }
    },

    methods: {
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
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin {
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
