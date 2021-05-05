require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import JsonEditor from 'vue-json-edit';
import AvsisLayout from './Layouts/AvsisLayout';
import "metro4/build/css/metro-all.min.css";
import Metro from 'metro4';

const el = document.getElementById('app');

createApp({
    mounted(){
        console.log("siempre carga el app");
        Metro.init();
    },
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => import(`./Pages/${name}`)
            .then(({ default: page}) => {
                if(page.layout === undefined)
                {
                    page.layout = AvsisLayout
                }
                return page;
            }),
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(JsonEditor)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
