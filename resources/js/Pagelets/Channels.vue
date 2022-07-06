<template>
    <h2>Channels</h2>

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
                <b-th>Name</b-th>
                <b-th>Active Users</b-th>
                <b-th>Modes</b-th>
                <b-th>Topic</b-th>
            </b-tr>
        </b-thead>
        <b-tbody>
            <b-tr v-for="chan in channels" :key="chan.name">
                <b-td>{{ chan.name }}</b-td>
                <b-td>{{ chan.num_users }}</b-td>
                <b-td>{{ chan.modes.split('') }}</b-td>
                <b-td>
                    <p class="mb-1">{{ chan.topic }}</p>
                    <p class="small m-0">Set by <strong>{{ chan.topic_set_by }}</strong></p>
                </b-td>
            </b-tr>
        </b-tbody>
    </b-table-simple>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";

const filterOptions = [
    { item: 'hide_secret', name: 'Hide Secret Channels (+s)' },
    { item: 'hide_private', name: 'Hide Private Channels (+p)' },
    { item: 'only_registered', name: 'Only registered Channels (+r)' },
    { item: 'only_tls', name: 'Only TLS-enabled Channels (+Z)' },
]

export default defineComponent({
    name: "Channels",

    props: ['base_channels'],

    data() {
        return {
            channels: this.base_channels,
            form: useForm({
                checkSelected: [],
            }),
        }
    },

    created() {
        if(this.$page.props.app.debug) {
            console.log(this.$page.props.data.channels);
        }
    },

    setup() {
        return {
            filterOptions
        }
    },

    methods: {
        resetFilters() {
            this.form.checkSelected = [];
            this.channels = this.base_channels;
        },

        checkboxChecked() {
            this.channels = this.base_channels;
            const channels = this.base_channels;
            const new_channels_list = [];
            console.log(this.form.checkSelected)

            if (this.form.checkSelected[0] === 'hide_secret') {
                for (let i = 0; i < channels.length; i++) {
                    if (!channels[i].modes.includes('s')) {
                        new_channels_list.push(channels[i]);
                    }
                }
                this.channels = new_channels_list;
            }

            if (this.form.checkSelected[0] === 'hide_private') {
                for (let i = 0; i < channels.length; i++) {
                    if (!channels[i].modes.includes('p')) {
                        new_channels_list.push(channels[i]);
                    }
                }
                this.channels = new_channels_list;
            }

            if (this.form.checkSelected[0] === 'only_registered') {
                for (let i = 0; i < channels.length; i++) {
                    if (channels[i].modes.includes('r')) {
                        new_channels_list.push(channels[i]);
                    }
                }
                this.channels = new_channels_list;
            }

            if (this.form.checkSelected[0] === 'only_tls') {
                for (let i = 0; i < channels.length; i++) {
                    if (channels[i].modes.includes('Z')) {
                        new_channels_list.push(channels[i]);
                    }
                }
                this.channels = new_channels_list;
            }
        }
    }
});
</script>

<style scoped>

</style>
