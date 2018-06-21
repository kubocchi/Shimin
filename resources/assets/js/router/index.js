

/***********************Admin-Panel-Components***********************/
import Dashboard from '../views/Dashboard'
// 1.1 Active center Routes
import ActiveCenterForm from '../views/admin/activeCenter/Form'
import ActiveCenterList from '../views/admin/activeCenter/List'

// 1.2 Notice Routes
import NoticeEventForm from '../views/admin/notice/event/form'
import NoticeVolunteerForm from '../views/admin/notice/volunteer/form'
import NoticeList from '../views/admin/notice/list'

// 1.3 Subsidy Routes
import SubsidyForm from '../views/admin/subsidy/Form'
import SubsidyList from '../views/admin/subsidy/List'

// 1.4 Disaster Routes
import DisasterForm from '../views/admin/disaster/Form'
import DisasterList from '../views/admin/disaster/List'


/***********************Admin-Panel-Components***********************/


/***********************Website-Components***********************/
import Home from '../views/website/home'

// Active Center
import WebsiteActiveCenterIndex from '../views/website/activeCenter/index'
import WebsiteActiveCenterDetail from '../views/website/activeCenter/detail'
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
                path: '/admin/notice',
                redirect: '/notice/list',
                component: {
                    render(c) { return c('router-view'); }
                },
                children: [
                    {
                        path: 'event/form',
                        name: 'noticeEventForm',
                        component: NoticeEventForm,
                        meta: 'admin'
                    },
                    {
                        path: 'volunteer/form',
                        name: 'noticeVolunteerForm',
                        component: NoticeVolunteerForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'noticeList',
                        component: NoticeList,
                        meta: 'admin'
                    }
                ]
            },
            {
                path: '/admin/subsidy',
                redirect: '/admin/subsidy/list',
                component: {
                    render(c) { return c('router-view'); }
                },
                children: [
                    {
                        path: 'form',
                        name: 'subsidyForm',
                        component: SubsidyForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'subsidyList',
                        component: SubsidyList,
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
        meta: 'home'
    },
    {
        path: '/active-center',
        redirect: '/active-center/index',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'index',
                name: 'websiteActiveCenterIndex',
                component: WebsiteActiveCenterIndex
            },
            {
                path: 'detail',
                name: 'websiteActiveCenterDetail',
                component: WebsiteActiveCenterDetail
            }
        ]
    },
];

export default routes