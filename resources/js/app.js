import './bootstrap';

import {createApp, h} from 'vue';
import {createInertiaApp, Link} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';

// Mixins
import base from './base';

// Plugins
import {i18nVue} from "laravel-vue-i18n";
import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';

// Misc
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Styles
import 'v-calendar/dist/style.css';

// Initialize Inertia App
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            /* Plugins */
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(i18nVue, {
                resolve: async lang => {
                    const languageFiles = import.meta.glob('../../lang/*.json');
                    return await languageFiles[`../../lang/${lang}.json`]();
                }
            })
            .use(SetupCalendar, {})
            /* Mixins */
            .mixin(base)
            /* Components */
            .component('inertia-link', Link)
            .component('Calendar', Calendar)
            .component('DatePicker', DatePicker)
            /* Mountpoint */
            .mount(el);
    },
    //progress: false, // Disable progress bar
    progress: {
        color: '#4B5563',
    },
});