<template>
    <h2>Users</h2>

    <div class="mb-4 bg-dark rounded-3 bg-opacity-25">
        <h6 class="bg-dark rounded-top px-3 py-2 text-white text-uppercase mb-0">Filter Table</h6>
        <div class="px-3 py-2 d-flex justify-content-between align-content-center align-items-center">
            <b-form-radio-group v-model="form.checkSelected" :options="filterOptions" class="align-self-center"
                                @change="this.checkboxChecked"
                                value-field="item" text-field="name" disabled-field="notEnabled">
            </b-form-radio-group>

            <b-button variant="primary" @click.prevent="resetFilters">Clear Filters</b-button>
        </div>
    </div>

    <b-table-simple hover responsive>
        <b-thead head-variant="dark">
            <b-tr>
                <b-th>Username</b-th>
                <b-th>Server</b-th>
                <b-th>Channels</b-th>
                <b-th>Modes</b-th>
                <b-th>VHost</b-th>
            </b-tr>
        </b-thead>
        <b-tbody>
            <b-tr v-for="user in users" :key="user.name">
                <b-td>{{ user.name }}</b-td>
                <b-td>{{ user.user.servername }}</b-td>
                <b-td>{{ user.user.channels }}</b-td>
                <b-td>{{ user.user.modes.split('') }}</b-td>
                <b-td>{{ user.user.hasOwnProperty('vhost') ? user.user.vhost : user.user.cloakedhost }}</b-td>
            </b-tr>
        </b-tbody>
    </b-table-simple>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";

const filterOptions = [
    { item: 'hide_services', name: 'Hide Services Bots (+S)' },
    { item: 'hide_bots', name: 'Hide Bots (+B)' },
    { item: 'only_tls', name: 'Show only TLS Users (+z)' },
]

export default defineComponent({
    name: "Users",

    props: ['base_users'],

    data() {
        return {
            users: {},
            form: useForm({
                checkSelected: [],
            }),
        }
    },

    setup() {
        return {
            filterOptions
        }
    },

    created() {
        this.users = this.base_users;
    },

    methods: {
        resetFilters() {
            this.form.checkSelected = [];
            this.users = this.base_users
        },

        checkboxChecked() {
            this.users = this.base_users;
            const users = this.base_users;
            const new_users_list = [];
            console.log(this.form.checkSelected)

            if (this.form.checkSelected[0] === 'hide_services') {
                for (let i = 0; i < users.length; i++) {
                    if (!users[i].user.modes.includes('S')) {
                        new_users_list.push(users[i]);
                    }
                }
                this.users = new_users_list;
            }

            if (this.form.checkSelected[0] === 'hide_bots') {
                for (let i = 0; i < users.length; i++) {
                    if (!users[i].user.modes.includes('B')) {
                        new_users_list.push(users[i]);
                    }
                }
                this.users = new_users_list;
            }

            if (this.form.checkSelected[0] === 'only_tls') {
                for (let i = 0; i < users.length; i++) {
                    if (users[i].user.modes.includes('z')) {
                        new_users_list.push(users[i]);
                    }
                }
                this.users = new_users_list;
            }
        }
    }
});
</script>

<style scoped>

</style>
