<template>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">{{ title }}</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'

export default defineComponent({
    name: "Toast",

    props: {
        style: {
            type: String,
            default: 'info',
        },
        message: {
            type: String|null,
            default: null,
        }
    },

    data() {
        return {
            title: null,
        }
    },

    created() {
        switch(this.style) {
            case 'info':
                this.title = 'Check me out';
                break;
            case 'success':
                this.title = 'Woo-hoo!';
                break;
            case 'warn':
                this.title = 'Whoa, hold on!';
                break;
            case 'error':
            default:
                this.title = 'Something went wrong!'
                break;
        }
    }
});
</script>

<style scoped>

</style>
