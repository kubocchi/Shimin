import Dashboard from '../views/Dashboard'

// Active center Routes
import ActiveCenterForm from '../views/activeCenter/Form'
import ActiveCenterList from '../views/activeCenter/List'

// Disaster Routes
import DisasterForm from '../views/disaster/Form'
import DisasterList from '../views/disaster/List'

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
            }
        ]
    },
    {
        path: '/disaster',
        redirect: '/disaster/list',
        name: 'disasterList',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'form',
                name: 'disasterForm',
                component: DisasterForm
            },
            {
                path: 'list',
                name: 'disasterList',
                component: DisasterList
            }
        ]
    }
];

export default routes