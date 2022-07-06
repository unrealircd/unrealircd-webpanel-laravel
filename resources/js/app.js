import './bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css';
import { BootstrapVue3 } from "bootstrap-vue-3";


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(BootstrapVue3)
            .use(ZiggyVue, Ziggy)
            .component('XHead', Head)
            .component('XLink', Link)
            .mount(el);
    },
}).then(() => {});

InertiaProgress.init({ color: '#3399ff' });
