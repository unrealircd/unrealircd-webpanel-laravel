<template>
    <div class="wrapper">
        <x-head>
            <title>Log in to {{ server_name }}</title>
        </x-head>

        <div class="text-center inner-wrapper">
            <div class="form-signin w-100 m-auto">
                <form>
                    <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>
                    <h2 class="h5 text-black-50 mb-4">{{ server_name }}</h2>

                    <div class="alert alert-info text-start" role="alert">
                        Please use your oper credentials to log in.
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username"
                            v-model="form.data.username">
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            v-model="form.data.password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

                    <p class="mt-5 mb-3 text-muted">Copyright &copy; 1999 – {{ new Date().getFullYear() }} UnrealIRCd</p>
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
            server_name: import.meta.env.VITE_APP_NAME,
            form: useForm({
                data: {
                    username: null,
                    password: null,
                }
            })
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
