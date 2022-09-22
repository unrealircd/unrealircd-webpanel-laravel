<template>
    <b-tr>
        <b-td>{{ ban.type_string }}</b-td>
        <b-td>{{ ban.name }}</b-td>
        <b-td>{{ ban.expire_at === null ? 'Never' : new Date(ban.expire_at).toLocaleString() }}</b-td>
        <b-td>{{ ban.reason }}</b-td>
        <b-td>{{ new Date(ban.set_at_string).toLocaleString() }}</b-td>
        <b-td>{{ ban.set_by }}</b-td>
        <b-td class="d-flex gap-2">
            <b-button size="sm" v-b-modal="`edit-modal-ban-${id}`" variant="primary">{{ __('Edit') }}</b-button>
            <b-button size="sm" v-b-modal="`delete-modal-ban-${id}`" variant="danger">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-2">
                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                </svg>

                <span>{{ __('Delete') }}</span>
            </b-button>

            <b-modal header-bg-variant="danger" header-text-variant="light" centered
                     ok-title="Delete" ok-variant="danger" @ok.once="deleteBan()"
                     :id="`delete-modal-ban-${id}`" title="Are you sure?">
                <p>{{ __('Are you sure you want to remove this :ban', _ban.type_string)}}?</p>
            </b-modal>

            <b-modal centered
                     ok-title="Update" ok-variant="primary" @ok.once="editBan()"
                     :id="`edit-modal-ban-${id}`" :title="__('Update Ban')">
                <b-form>
                    <b-form-group :label="__('Name')" label-for="name"
                                  :escription="__('To change the host/ip mask, please create a new entry.')">
                        <b-form-input id="name" type="text" v-model="ban.name" disabled/>
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
        </b-td>
    </b-tr>
</template>

<script>
import { ref, defineComponent } from 'vue';
import { useToast } from 'bootstrap-vue-3';
import { useForm } from "@inertiajs/inertia-vue3";

export default defineComponent({
    name: "Ban",

    props: {
        _ban: {
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
            ban: {}
        }
    },

    created() {
        this.ban = useForm(this._ban);
        this.ban.date = new Date(this._ban.expire_at).toISOString().slice(0, 10);
        this.ban.time = new Date(this._ban.expire_at).toISOString().slice(11, 19);
    },

    methods: {
        editBan() {
            this.ban.put(route('bans.update'), {
                onSuccess: () => {
                    console.log("pass")
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

        deleteBan() {
            window.axios.delete(route('bans.destroy'), { data: this.ban })
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
svg {
    width: 16px;
    height: 16px;
    margin-right: .425rem;
}
</style>
