// import store from '@/store'
// import VueCookie from 'vue-cookie'

/*************************** Layout components ******************************/
import DefaultLayout from '@/layouts/Default'

/************************* Main views components ****************************/
import IndexView from '@/views/Index'
import LoadRepo from '@/views/LoadRepo'
import RepoList from '@/views/RepoList'

export default [
    {
        path: '*',
        redirect: '/'
    },
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {
                name: 'my-app.index',
                path: '',
                component: IndexView,
                meta: {
                    localizationKey: 'index'
                }
            },
            {
                name: 'my-app.load-repo',
                path: '/load-repo',
                component: LoadRepo,
                meta: {
                    localizationKey: 'index'
                }
            },
            {
                name: 'my-app.repo-list',
                path: '/repo-list',
                component: RepoList,
                meta: {
                    localizationKey: 'index'
                }
            }
        ],
        //beforeEnter: onlyAuthenticated
    }
]
