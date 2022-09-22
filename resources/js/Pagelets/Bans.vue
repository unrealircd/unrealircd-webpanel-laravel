<template>
    <h2>{{ __('Bans')  }}</h2>

    <b-table-simple hover responsive>
        <b-thead head-variant="dark">
            <b-tr>
                <b-th>{{ __('Type') }}</b-th>
                <b-th>{{ __('Name') }}</b-th>
                <b-th>{{ __('Expires At' )}}</b-th>
                <b-th>{{ __('Reason') }} </b-th>
                <b-th>{{ __('Set At') }}</b-th>
                <b-th>{{ __('Set By') }}</b-th>
            </b-tr>
        </b-thead>
        <b-tbody>
            <b-tr v-for="ban in bans" :key="ban.type_string">
                <b-td>{{ ban.type_string }}</b-td>
                <b-td>{{ ban.name }}</b-td>
                <b-td>{{ ban.expire_at === null ? 'Never' : new Date(ban.expire_at).toLocaleString() }}</b-td>
                <b-td>{{ ban.reason }}</b-td>
                <b-td>{{ new Date(ban.set_at_string).toLocaleString() }}</b-td>
                <b-td>{{ ban.set_by }}</b-td>
            </b-tr>
        </b-tbody>
    </b-table-simple>
</template>

<script>
import { ref, defineComponent } from 'vue'

export default defineComponent({
    name: "Bans",

    props: ['base_bans'],

    data() {
        return {
            __: window.__,
            bans: this.base_bans,
        }
    },

    created() {
        if(this.$page.props.app.debug) {
            console.log(this.bans);
        }
    },

    methods: {

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
