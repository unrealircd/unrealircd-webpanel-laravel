<template>
    <div class="pt-3 pb-2 mb-3 border-bottom d-flex justify-content-between align-items-center">
        <h1 class="h1">{{ __('Bans') }}</h1>

        <b-button v-b-modal.addBan>{{ __('New Ban') }}</b-button>
    </div>

    <b-table-simple hover responsive>
        <b-thead head-variant="dark">
            <b-tr>
                <b-th>{{ __('Type') }}</b-th>
                <b-th>{{ __('Name') }}</b-th>
                <b-th>{{ __('Expires At') }}</b-th>
                <b-th>{{ __('Reason') }}</b-th>
                <b-th>{{ __('Set At') }}</b-th>
                <b-th>{{ __('Set By') }}</b-th>
                <b-th></b-th>
            </b-tr>
        </b-thead>
        <b-tbody>
            <ban v-for="(ban, i) in bans" :key="ban.type_string" :ban="ban" :id="i"/>
        </b-tbody>
    </b-table-simple>

    <b-modal centered ok-title="Add" ok-variant="primary" @ok.once="createBan()" :id="`addBan`"
             :title="__('Create Ban')">
        <b-form>
            <b-form-group :label="__('Type')" label-for="type">
                <b-form-select @change="checkType" v-model="ban.type_string" id="name">
                    <b-form-select-option v-for="b in banTypes" :value="b">{{ b }}</b-form-select-option>
                </b-form-select>
            </b-form-group>

            <b-form-group :label="__('Mask')" label-for="mask">
                <b-form-input id="mask" type="text" v-model="ban.name" :placeholder="type_placeholder"/>
            </b-form-group>

            <b-form-group :label="__('Expires At')" label-for="date" description="Please pick a date and time">
                <div class="d-flex gap-2">
                    <input class="form-control" type="date" id="date" v-model="ban.date"/>
                    <input class="form-control" type="time" step="1" id="time" min="00:00:00" max="23:59:59"
                           v-model="ban.time"/>
                </div>
            </b-form-group>

            <b-form-group :label="__('Reason')" label-for="reason">
                <b-form-input :label="__('Reason')" id="reason" type="text" v-model="ban.reason"/>
            </b-form-group>
        </b-form>
    </b-modal>
</template>

<script>
import { ref, defineComponent } from 'vue'
import 'bootstrap';
import Authenticated from "@/Layouts/Authenticated.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Ban from "@/Components/Ban.vue";
import { BFormSelectOption } from "bootstrap-vue-3";

export default defineComponent({
    components: {
        BFormSelectOption,
        Ban,
        Authenticated
    },

    layout: Authenticated,

    props: ['base_bans'],

    data() {
        return {
            type_placeholder: '*@123.456.78.90',
            __: window.__,
            bans: this.base_bans,
            form: useForm({
                checkSelected: [],
            }),
            ban: useForm({
                type_string: 'kline',
                name: null,
                reason: null,
                time: null,
                date: null,
            }),
            banTypes: [
                'gline',
                'zline',
                'gzline',
                'kline',
                'eline',
                'shun',
            ]
        }
    },

    methods: {
        checkType() {
            /* very hacky. the "this.ban.type_string" prop wasn't updating before the function call so we
             * were getting erroneous matches.
             */
            setTimeout(() => {
                const ts = this.ban.type_string;

                const host_mask = ['kline', 'gline', 'shun'];
                const ip_mask = ['zline', 'gzline'];

                if (host_mask.includes(ts)) {
                    this.type_placeholder = 'john@server4.isp.example.org';
                }

                if (ip_mask.includes(ts)) {
                    this.type_placeholder = '*@123.456.78.90';
                }
                if (this.$page.props.app.debug) {
                    console.log(host_mask.includes(ts), ip_mask.includes(ts), this.ban.type_string, this.type_placeholder)
                }
            }, 100)
        },

        createBan() {
            this.ban.post(route('bans'), {
                onSuccess: (res) => {
                    window.location.reload();
                },
                onError: (e) => {
                    this.toast.show({
                        title: __('Something went wrong'),
                        body: e.response.data.message
                    }, {
                        variant: 'danger',
                        solid: true,
                    })
                }
            });
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
