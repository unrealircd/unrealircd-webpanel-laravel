<template>
    <h2>Channels</h2>

    <b-table-simple hover responsive>
        <b-thead head-variant="dark">
            <b-tr>
                <b-th>{{ __('Name') }}</b-th>
                <b-th>{{ __('Active Users') }}</b-th>
                <b-th>{{ __('Modes') }}</b-th>
                <b-th>{{ __('Topic') }}</b-th>
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

export default defineComponent({
    name: "Channels",

    props: ['base_channels'],

    data() {
        return {
            __: window.__,
            channels: this.base_channels,
        }
    },

    created() {
        if(this.$page.props.app.debug) {
            console.log(this.$page.props.data.channels);
        }
    },

    methods: {

    }
});
</script>

<style scoped>

</style>
