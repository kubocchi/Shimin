import Dashboard from '../views/Dashboard'
import ActiveCenterForm from '../views/activeCenter/Form'
import ActiveCenterList from '../views/activeCenter/List'
import ActiveCenterConfirm from '../views/activeCenter/confirm'

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/active-center',
        redirect: '/active-center/list',
        name: 'activeCenterList',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'form',
                name: 'activeCenterForm',
                component: ActiveCenterForm
            },
            {
                path: 'list',
                name: 'activeCenterList',
                component: ActiveCenterList
            },
            {
                path: 'confirm',
                name: 'activeCenterConfirm',
                component: ActiveCenterConfirm
            }
        ]
    }
];

export default routes