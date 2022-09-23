<template>
    <nav class="navbar py-2 navbar-dark sticky-top navbar-expand-lg bg-dark py-1 shadow">
        <x-link class="navbar-brand bg-dark col-md-3 col-lg-2 me-0 px-5 fs-6">
            {{ $page.props.app.name }}
        </x-link>
    </nav>

    <div v-if="step === 1">
        <b-card class="my-4 w-50 mx-auto" no-body
                :header="`${$page.props.app.name} ${__('installer')}`"
                header-tag="header"
        >
            <b-list-group flush>
                <b-list-group-item>
                    <div class="d-flex flex-row align-items-center gap-4">
                        <div>
                            <span v-if="checks.is_valid_version >= 0" class="text-success fw-bolder">
                                &checkmark; {{ __('Pass') }}
                            </span>
                            <span v-else class="text-danger fw-bolder">&cross; {{ __('FAIL') }}</span>
                        </div>
                        <div class="w-75">
                            <h5 class="mb-0">{{ __('PHP Version') }}</h5>
                            <p class="small text-black-50 mb-0">
                                {{ __('Minimum :version required', { version: `v${checks.min_required}` }) }}</p>
                            <p class="mb-0">{{ __(':version installed', { version: `v${checks.php_version}` }) }}</p>
                        </div>
                    </div>
                </b-list-group-item>

                <b-list-group-item>
                    <div class="d-flex flex-row align-items-center gap-4">
                        <div>
                            <span v-if="checks.has_sqlite === true" class="text-success fw-bolder">
                                &checkmark; {{ __('Pass') }}
                            </span>
                            <span v-else class="text-danger fw-bolder">&cross; {{ __('FAIL') }}</span>
                        </div>
                        <div class="w-75">
                            <h5 class="mb-0">{{ __('SQLite 3') }}</h5>
                            <p class="small text-black-50 mb-0">{{ __('Required') }}</p>
                            <p class="mb-0">
                                {{ __(':version installed', { version: checks.sqlite3_version.versionString })
                                }}</p>
                        </div>
                    </div>
                </b-list-group-item>

                <b-list-group-item>
                    <div class="d-flex flex-row align-items-center gap-4">
                        <div>
                            <span v-if="checks.has_ssl === 'on'" class="text-success fw-bolder">
                                &checkmark; {{ __('Pass') }}
                            </span>
                            <span v-else class="text-danger fw-bolder">&cross; {{ __('FAIL') }}</span>
                        </div>
                        <div class="w-75">
                            <h5 class="mb-0">{{ __('SSL') }}</h5>
                            <p class="small text-black-50 mb-0">{{ __('Required') }}</p>
                            <b-alert show variant="danger" v-if="checks.ssl.validity === false" class="my-2">
                                {{ __("This certificate is self-signed. We recommend using Let's Encrypt for SSL in a production scenario.")
                                }}
                            </b-alert>
                            <p class="mb-0 small">{{ __('Issued by') }} <strong>{{ checks.ssl.issuer }}</strong></p>
                            <p class="mb-0 small" v-if="checks.ssl.validity !== false">
                                {{ __('Signed by') }}
                                <strong>{{ checks.ssl.validity }}</strong>
                            </p>
                            <p class="mb-0" v-if="checks.ssl.validity !== false">
                                {{ __('Expires At') }}
                                <strong>{{ checks.ssl.cert_expiry }}</strong>
                            </p>
                        </div>
                    </div>
                </b-list-group-item>
            </b-list-group>
            <b-card-footer class="d-flex justify-content-end">
                <b-button variant="success" @click.prevent="nextStep(null)">
                    Next Step
                </b-button>
            </b-card-footer>
        </b-card>
    </div>

    <div v-if="step === 2">
        <b-form class="form-setup-form w-100" @submit="setup_1">
            <b-card class="my-4 w-50 mx-auto" no-body
                    :header="`${$page.props.app.name} ${__('installer')} - Step 2`"
                    header-tag="header"
            >
                <b-card-body>
                    <div class="form-setup m-auto">
                        <b-form-group id="fieldset-1" :label="__('App Name')"
                                      label-for="app_name" label-class="mb-1">
                            <b-form-input id="app_name" v-model="form.app_name"
                                          @blur="writeToLocalStorage('app_name', form.app_name)"></b-form-input>
                            <p class="text-danger" v-if="form.errors.app_name">{{ form.errors.app_name.toString() }}</p>
                        </b-form-group>

                        <b-form-group id="fieldset-2" :label="__('App URL')"
                                      label-for="app_url" label-class="mb-1">
                            <b-form-input id="app_url" v-model="form.app_url"
                                          @blur="writeToLocalStorage('app_url', form.app_url)"></b-form-input>
                            <p class="text-danger" v-if="form.errors.app_url">{{ form.errors.app_url.toString() }}</p>
                        </b-form-group>
                    </div>
                </b-card-body>
                <b-card-footer class="d-flex justify-content-between">
                    <b-button variant="dark" @click.prevent="clearStorage">
                        Reset
                    </b-button>

                    <b-button variant="success" type="submit">
                        Next Step
                    </b-button>
                </b-card-footer>
            </b-card>
        </b-form>
    </div>

    <div v-if="step > 1">
        {{ step }} - {{ hash }} - {{ hash_num }}
    </div>
</template>

<script>
import { BButton, BCardBody, BFormFloatingLabel, BFormInput, BListGroup, useToast } from "bootstrap-vue-3";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    name: "Install",
    components: { BFormInput, BFormFloatingLabel, BButton, BCardBody, BListGroup },
    props: ['checks'],

    data() {
        return {
            __: window.__,
            step: 1,
            hash: '',
            hash_num: 1,
            form: useForm({
                app_url: '',
                app_name: '',
            })
        }
    },

    setup() {
        return {
            toast: useToast(),
        }
    },

    created() {
        this.getStep();

        this.form.app_url = this.readFromLocalStorage('app_url');
        this.form.app_name = this.readFromLocalStorage('app_name');
    },

    updated() {
        this.getStep();
    },

    methods: {
        writeToLocalStorage(name, text) {
            localStorage.setItem(name, text ?? '');
        },

        readFromLocalStorage(name) {
            return localStorage.getItem(name);
        },

        clearLocalStorage(name) {
            localStorage.removeItem(name);
        },

        getStep() {
            if (window.location.hash !== '') {
                this.hash_num = parseInt(window.location.hash.split('=')[1]);

                if (this.hash_num) {
                    this.nextStep(this.hash_num)
                }
            }
        },

        nextStep(num = null) {
            if (num === null) {
                this.step += 1;
                this.hash = `step=${this.step}`;
                this.clearStorage();
            } else {
                this.step = num;
                this.hash = `step=${num}`;
            }

            window.location.hash = this.hash;
        },

        clearStorage() {
            this.form.reset('app_name', 'app_url');
            this.clearLocalStorage('app_url');
            this.clearLocalStorage('app_name');
        },

        setup_1() {
            window.axios.post(route('install.check.one'), this.form).then(res => {
                console.log('success')
                //    this.nextStep();
            }).catch(e => {
                this.form.errors = e.response.data.errors;
                this.toast.danger(__('Whoops, something went wrong.'))
            })
        }
    }
}
</script>

<style scoped>
.form-setup-form {
    padding: 15px;
}
</style>
