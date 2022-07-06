<template>
    <authenticated>
        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h1">Dashboard</h1>
        </div>

        <h2>Basic Stats</h2>

        <div>
            <b-card-group deck>
                <b-card bg-variant="primary" text-variant="white" header="Users">
                    <b-card-text>
                        <h5 class="card-title">{{ $page.props.data.users.length }}</h5>
                        <p class="card-text">Users on IRC.</p>
                    </b-card-text>
                </b-card>

                <b-card bg-variant="success" text-variant="white" header="Channels">
                    <b-card-text>
                        <h5 class="card-title">{{ $page.props.data.channels.length }}</h5>
                        <p class="card-text">Channels on IRC.</p>
                    </b-card-text>
                </b-card>

                <b-card bg-variant="secondary" text-variant="white" header="Bans">
                    <b-card-text>
                        <h5 class="card-title">{{ $page.props.data.bans.length }}</h5>
                        <p class="card-text">TKLs on IRC.</p>
                    </b-card-text>
                </b-card>
            </b-card-group>
        </div>

        <hr/>

        <b-card no-body>
            <b-tabs card>
                <b-tab title="Users" active lazy>
                    <b-card-text>
                        <Users :base_users="base_users" />
                    </b-card-text>
                </b-tab>
                <b-tab title="Channels" lazy>
                    <b-card-text>
                        <Channels :base_channels="base_channels" />
                    </b-card-text>
                </b-tab>
                <b-tab title="Bans" lazy>
                    <b-card-text>
                        <Bans :base_bans="base_bans" />
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </authenticated>
</template>

<script>
import Authenticated from "@/Layouts/Authenticated.vue";
import { defineComponent } from "vue";
import 'bootstrap';
import { BFormCheckboxGroup, BListGroup, BListGroupItem } from "bootstrap-vue-3";
import Users from "@/Pagelets/Users.vue";
import Channels from "@/Pagelets/Channels.vue";
import Bans from "@/Pagelets/Bans.vue";

export default defineComponent({
    components: {
        Bans,
        Channels,
        Users,
        BFormCheckboxGroup,
        BListGroupItem,
        BListGroup,
        Authenticated,
    },

    data() {
        return {
            base_users: this.$page.props.data.users,
            base_channels: this.$page.props.data.channels,

            base_bans: this.$page.props.data.bans,
            bans: this.$page.props.data.bans,
        }
    }
})
</script>

<style scoped>

</style>
