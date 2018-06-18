import Dashboard from '../views/Dashboard'

// Active center Routes
import ActiveCenterForm from '../views/activeCenter/Form'
import ActiveCenterList from '../views/activeCenter/List'

// Disaster Routes
import DisasterForm from '../views/disaster/Form'
import DisasterList from '../views/disaster/List'

const routes = [
    {
        path: '/admin',
        redirect: '/admin/dashboard',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: '/admin/dashboard',
                name: 'dashboard',
                component: Dashboard
            },
            {
                path: '/admin/active-center',
                redirect: '/active-center/list',
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
                path: '/admin/disaster',
                redirect: '/disaster/list',
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
        ]
    }
];

export default routes