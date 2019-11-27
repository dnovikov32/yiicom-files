import PresetIndex from '../components/presets/PresetIndex.vue';
import PresetEdit from '../components/presets/PresetEdit.vue';
import PresetDelete from '../components/presets/PresetDelete.vue';

const routes = [
    {
        path: '/files/preset/index',
        name: 'files.preset.index',
        component: PresetIndex,
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
        component: PresetDelete,
        meta: {
            auth: true
        }
    }
];

export default routes;