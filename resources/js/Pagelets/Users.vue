<template>
    <h2>Users</h2>

    <b-table-simple hover responsive>
        <b-button variant="secondary" class="my-2" size="sm" @click.prevent="toggleHost">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                <path fill-rule="evenodd"
                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                      clip-rule="evenodd"/>
            </svg>

            <span>{{ __('Toggle VHost') }}</span>
        </b-button>
        <b-thead head-variant="dark">
            <b-tr class="">
                <b-th>{{ __('Username') }}</b-th>
                <b-th class="d-none d-md-table-cell">{{ __('Server') }}</b-th>
                <b-th>{{ __('Channels') }}</b-th>
                <b-th>{{ __('Modes') }}</b-th>
                <b-th class="d-none d-md-table-cell d-flex align-items-end justify-content-between">
                    <div class="">{{ __('VHost') }}</div>
                </b-th>
            </b-tr>
        </b-thead>
        <b-tbody>
            <b-tr v-for="user in users" :key="user.name">
                <b-td>
                    <div>{{ user.name }}</div>
                    <div class="block small d-md-none">
                        {{ user.user.servername }}
                    </div>
                    <div class="block small d-md-none">
                        <div v-if="!show_realhost" class="w-100 d-flex justify-content-between">
                            <span v-if="user.user.hasOwnProperty('vhost')" v-text="user.user.vhost"/>
                            <span v-else class="fst-italic opacity-75 small">- {{ __('No vhost for user') }} -</span>
                        </div>
                        <div v-if="show_realhost" class="w-100 d-flex justify-content-between">
                            <span>{{ user.ip ?? user.hostname }}</span>
                        </div>
                    </div>
                </b-td>
                <b-td class="d-none d-md-table-cell">{{ user.user.servername }}</b-td>
                <b-td>
                    <span class="d-none d-md-block">{{ user.user.channels }}</span>
                    <span class="d-md-none">{{ user.user.channels?.length }}</span>
                </b-td>
                <b-td class="font-monospace">{{ user.user.modes }}</b-td>
                <b-td class="d-none d-md-table-cell">
                    <div v-if="!show_realhost" class="w-100 d-flex justify-content-between">
                        <span v-if="user.user.hasOwnProperty('vhost')" v-text="user.user.vhost"/>
                        <span v-else class="fst-italic opacity-75 small">- {{ __('No vhost for user') }} -</span>
                    </div>
                    <div v-if="show_realhost" class="w-100 d-flex justify-content-between">
                        <span>{{ user.ip ?? user.hostname }}</span>
                    </div>
                </b-td>
            </b-tr>
        </b-tbody>
    </b-table-simple>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";

export default defineComponent({
    name: "Users",

    props: ['base_users'],

    data() {
        return {
            __: window.__,
            show_realhost: false,
            users: this.base_users,
        }
    },

    created() {
        if (this.$page.props.app.debug) {
            console.log(this.users);
        }
    },

    methods: {
        toggleHost() {
            this.show_realhost = !this.show_realhost;
        },
    }
});
</script>

<style scoped>
svg {
    width: 16px;
    height: 16px;
    margin-right: .425rem;
}
</style>
