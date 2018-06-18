

/***********************Admin-Panel-Components***********************/
import Dashboard from '../views/Dashboard'
// Active center Routes
import ActiveCenterForm from '../views/activeCenter/Form'
import ActiveCenterList from '../views/activeCenter/List'

// Disaster Routes
import DisasterForm from '../views/disaster/Form'
import DisasterList from '../views/disaster/List'
/***********************Admin-Panel-Components***********************/


/***********************Website-Components***********************/
import Home from '../views/website/home'
/***********************Website-Components***********************/
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
                component: Dashboard,
                meta: 'admin'
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
                        component: ActiveCenterForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'activeCenterList',
                        component: ActiveCenterList,
                        meta: 'admin'
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
                        component: DisasterForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'disasterList',
                        component: DisasterList,
                        meta: 'admin'
                    }
                ]
            }
        ]
    },
    {
        path: '/',
        name: 'home',
        component: Home,
    }
];

export default routes