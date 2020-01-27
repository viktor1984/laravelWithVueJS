import VueRouter from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('@/views/Home').default
    },
    {
        path: '/projects',
        component: require('@/views/Project').default
    },
    {
        path: '/projects/:project_id/commits',
        component: require('@/views/Commit').default,
        name: 'project.commits',
        props: true
    }
];

export default new VueRouter({
    routes: routes,
    linkActiveClass: 'is-active'
});
