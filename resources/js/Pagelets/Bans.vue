<template>
    <h2>Bans</h2>

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
                <b-th>Type</b-th>
                <b-th>Name</b-th>
                <b-th>Reason</b-th>
                <b-th>Set At</b-th>
                <b-th>Set By</b-th>
            </b-tr>
        </b-thead>
        <b-tbody>
            <b-tr v-for="ban in bans" :key="ban.type_string">
                <b-td>{{ ban.type_string }}</b-td>
                <b-td>{{ ban.name }}</b-td>
                <b-td>{{ ban.reason }}</b-td>
                <b-td>{{ ban.set_at_string }}</b-td>
                <b-td>{{ ban.set_by }}</b-td>
            </b-tr>
        </b-tbody>
    </b-table-simple>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { useForm } from "@inertiajs/inertia-vue3";

const filterOptions = [
    { item: 'only_glines', name: 'Only G-Lines' },
    { item: 'only_zlines', name: 'Only Z-Lines' },
    { item: 'only_klines', name: 'Only K-Lines' },
    { item: 'only_gzlines', name: 'Only GZ-Lines' },
    { item: 'only_shun', name: 'Only SHUN' },
]

export default defineComponent({
    name: "Bans",

    props: ['base_bans'],

    data() {
        return {
            bans: this.base_bans,
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
        if(this.$page.props.app.debug) {
            console.log(this.bans);
        }
    },

    methods: {
        resetFilters() {
            this.form.checkSelected = [];
            this.bans = this.base_bans
        },

        checkboxChecked() {
            this.bans = this.base_bans;
            const bans = this.base_bans;
            const new_bans_list = [];
            console.log(this.form.checkSelected)

            if (this.form.checkSelected[0] === 'only_glines') {
                for (let i = 0; i < bans.length; i++) {
                    if (bans[i].type === 'gline') {
                        new_bans_list.push(bans[i]);
                    }
                }
                this.bans = new_bans_list;
            }

            if (this.form.checkSelected[0] === 'only_zlines') {
                for (let i = 0; i < bans.length; i++) {
                    if (bans[i].type === 'zline') {
                        new_bans_list.push(bans[i]);
                    }
                }
                this.bans = new_bans_list;
            }

            if (this.form.checkSelected[0] === 'only_klines') {
                for (let i = 0; i < bans.length; i++) {
                    if (bans[i].type === 'kline') {
                        new_bans_list.push(bans[i]);
                    }
                }
                this.bans = new_bans_list;
            }

            if (this.form.checkSelected[0] === 'only_gzlines') {
                for (let i = 0; i < bans.length; i++) {
                    if (!bans[i].type === 'gzline') {
                        new_bans_list.push(bans[i]);
                    }
                }
                this.bans = new_bans_list;
            }

            if (this.form.checkSelected[0] === 'only_shun') {
                for (let i = 0; i < bans.length; i++) {
                    if (!bans[i].type === 'shun') {
                        new_bans_list.push(bans[i]);
                    }
                }
                this.bans = new_bans_list;
            }
        }
    }
});
</script>

<style scoped>

</style>
