<template>
    <b-tr>
        <b-td>{{ ban.type_string }}</b-td>
        <b-td>{{ ban.name }}</b-td>
        <b-td>{{ new Date(ban.expire_at).toUTCString() }}</b-td>
        <b-td>{{ ban.reason }}</b-td>
        <b-td>{{ ban.set_at_string }}</b-td>
        <b-td>{{ ban.set_by }}</b-td>
        <b-td class="d-flex gap-2">
            <b-button size="sm" v-b-modal="`edit-modal-ban-${id}`" variant="primary">{{ __('Edit') }}</b-button>
            <b-button size="sm" v-b-modal="`delete-modal-ban-${id}`" variant="danger">{{ __('Delete') }}</b-button>

            <b-modal header-bg-variant="danger" header-text-variant="light" centered
                     ok-title="Delete" ok-variant="danger" @ok.once="deleteBan()"
                     :id="`delete-modal-ban-${id}`" title="Are you sure?">
                <p>{{ __('Are you sure you want to remove this :ban', ban.type_string)}}?</p>
            </b-modal>

            <b-modal centered
                     ok-title="Update" ok-variant="primary" @ok.once="editBan()"
                     :id="`edit-modal-ban-${id}`" :title="__('Update Ban')">
                <b-form>
                    <b-form-group :label="__('Name')" label-for="name"
                                  :escription="__('To change the host/ip mask, please create a new entry.')">
                        <b-form-input id="name" type="text" v-model="_ban.name" disabled/>
                    </b-form-group>

                    <b-form-group :label="__('Expires At')" label-for="date" description="Please pick a date and time">
                        <div class="d-flex gap-2">
                            <input class="form-control" type="date" id="date" v-model="_ban.date"/>
                            <input class="form-control" type="time" step="1" id="time" min="00:00:00" max="23:59:59"
                                   v-model="_ban.time"/>
                        </div>
                    </b-form-group>

                    <b-form-group :label="__('Reason')" label-for="reason">
                        <b-form-input :label="__('Reason')" id="reason" type="text" v-model="_ban.reason"/>
                    </b-form-group>
                </b-form>
            </b-modal>
        </b-td>
    </b-tr>
</template>

<script>
import { ref, defineComponent } from 'vue';
import { useToast } from 'bootstrap-vue-3';

export default defineComponent({
    name: "Ban",

    props: {
        ban: {
            type_string: String,
            name: String,
            reason: String,
            set_at_string: String,
            set_by: String,
            expire_at: String,
        },
        id: Number,
    },

    setup() {
        let toast = useToast();
        return {
            toast,
        }
    },

    data() {
        return {
            __: window.__,
            _ban: this.ban
        }
    },

    created() {
        this._ban.date = new Date(this.ban.expire_at).toISOString().slice(0, 10);
        this._ban.time = new Date(this.ban.expire_at).toISOString().slice(11, 19);
    },

    methods: {
        editBan() {
            window.axios.put(route('bans'), this._ban)
                .then(res => {
                    if (res.data.type === "success") {
                        this.toast.show({
                            title: window.__('Success!'),
                            body: res.data.message
                        }, {
                            variant: 'success',
                        });

                        window.location.reload();
                    }
                })
                .catch(e => {
                    this.toast.show({
                        title: window.__('Something went wrong'),
                        body: e.response.data.message
                    }, {
                        variant: 'danger',
                    })
                });
        },

        deleteBan() {
            window.axios.delete(route('bans'), { data: this.ban })
                .then(res => {
                    if (res.data.type === "success") {
                        this.toast.show({
                            title: window.__('Success!'),
                            body: res.data.message
                        }, {
                            variant: 'success',
                        });

                        window.location.reload();
                    }
                })
                .catch(e => {
                    this.toast.show({
                        title: window.__('Something went wrong'),
                        body: e.response.data.message
                    }, {
                        variant: 'danger',
                    })
                });
        }
    }
});
</script>

<style scoped>

</style>
