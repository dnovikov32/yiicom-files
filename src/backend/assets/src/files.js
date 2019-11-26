import Vue from 'vue';
import presetStore from './store/presets.js';
import PresetsIndex from './components/presets/PresetsIndex.vue';
import PresetEdit from './components/presets/PresetEdit.vue';
import PresetsDelete from './components/presets/PresetsDelete.vue';

window.App.$store.registerModule('presets', presetStore);

const routes = [
    {
        path: '/files/preset/index',
        name: 'files.preset.index',
        component: PresetsIndex,
        meta: {
            auth: true,
            breadcrumbs: [
                { text: 'Пресеты' }
            ]
        }
    },
    {
        path: '/files/preset/create',
        name: 'files.preset.create',
        component: PresetEdit,
        meta: {
            auth: true,
            breadcrumbs: [
                { text: 'Пресеты', href: '/#/files/preset/index' },
                { text: 'Создать' }
            ]
        }
    },
    {
        path: '/files/preset/update',
        name: 'files.preset.update',
        component: PresetEdit,
        meta: {
            auth: true,
            breadcrumbs: [
                { text: 'Пресеты', href: '/#/files/preset/index' },
                { text: 'Изменить' }
            ]
        }
    },
    {
        path: '/files/preset/delete',
        name: 'files.preset.delete',
        component: PresetsDelete,
        meta: {
            auth: true
        }
    }
];

window.App.$router.addRoutes(routes);