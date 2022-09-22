<template>
    <nav class="navbar py-2 navbar-dark sticky-top navbar-expand-lg bg-dark py-1 shadow">
        <x-link class="navbar-brand bg-dark col-md-3 col-lg-2 me-0 px-5 fs-6">
            {{ $page.props.app.name }}
        </x-link>
    </nav>

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
    </b-card>
</template>

<script>
import { BCardBody, BListGroup } from "bootstrap-vue-3";

export default {
    name: "Install",
    components: { BCardBody, BListGroup },
    props: ['checks'],

    data() {
        return {
            __: window.__,
        }
    }
}
</script>

<style scoped>

</style>
