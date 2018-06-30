

/***********************Admin-Panel-Components***********************/
import Dashboard from '../views/admin/Dashboard'
// 1.1 Active center Routes
import ActiveCenterForm from '../views/admin/transmission/active-center/Form'
import ActiveCenterList from '../views/admin/transmission/active-center/List'

// 1.2 Notice Routes
import NoticeEventForm from '../views/admin/transmission/notice/event/form'
import NoticeVolunteerForm from '../views/admin/transmission/notice/volunteer/form'
import NoticeMembershipForm from '../views/admin/transmission/notice/membership/form'
import NoticeList from '../views/admin/transmission/notice/list'

// 1.3 Subsidy Routes
import SubsidyForm from '../views/admin/transmission/subsidy/Form'
import SubsidyList from '../views/admin/transmission/subsidy/List'

// 1.4 Disaster Routes
import DisasterForm from '../views/admin/transmission/disaster/Form'
import DisasterList from '../views/admin/transmission/disaster/List'


// 2.4 Kawarabi Routes
import KawarabiForm from '../views/admin/file/kawarabi/form'
import KawarabiList from '../views/admin/file/kawarabi/list'

// 2.1 Various Routes
import VariousForm from '../views/admin/file/various/form'
import VariousList from '../views/admin/file/various/list'

// 2.1 Various Routes
import DreamForm from '../views/admin/file/dream/form'
import DreamList from '../views/admin/file/dream/list'

// .4 Various Routes
import BusinessReportForm from '../views/admin/file/businessReport/form'
import BusinessReportList from '../views/admin/file/businessReport/list'

import YearForm from '../views/admin/file/businessReport/year/form'
import YearList from '../views/admin/file/businessReport/year/list'

import BusinessForm from '../views/admin/file/businessReport/business/form'
import BusinessList from '../views/admin/file/businessReport/business/list'

import GroupInformationForm from '../views/admin/group-information/form'
import GroupInformationList from '../views/admin/group-information/list'


/***********************Admin-Panel-Components***********************/


/***********************Website-Components***********************/
import Home from '../views/website/home'

// Active Center
import activeCenterIndex from '../views/website/activeCenter/index'
import activeCenterDetail from '../views/website/activeCenter/detail'

// Disaster Center
import DisasterIndex from '../views/website/disaster/index'
import DisasterDetail from '../views/website/disaster/detail'

// Subsidy Center
import SubsidyIndex from '../views/website/subsidy/index'
import SubsidyDetail from '../views/website/subsidy/detail'

// Business Report 
import BusinessReport from '../views/website/business-report/index'

// Format
import VariousIndex from '../views/website/various/index'

// Dream
import DreamIndex from '../views/website/yumekousaten/index'
import DreamDetail from '../views/website/yumekousaten/index'

// Kawarabi
import KawarabiIndex from '../views/website/kawaraban/index'
import KawarabiDetail from '../views/website/kawaraban/index'
// Notice Center
import NoticeIndex from '../views/website/notice/index'
import EventDetail from '../views/website/notice/event/detail'
import VolunteerDetail from '../views/website/notice/volunteer/detail'
import MembershipDetail from '../views/website/notice/membership/detail'
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
                path: '/login',
                name: 'login',
                meta: 'login'
            },
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
                        path: 'membership/form',
                        name: 'noticeMembershipForm',
                        component: NoticeMembershipForm,
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
            }, 
            {
                path: '/admin/file/various',
                redirect: 'various/list',
                component: {
                    render(c) { return c('router-view'); }
                },
                children: [
                    {
                        path: 'form',
                        name: 'variousForm',
                        component: VariousForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'variousList',
                        component: VariousList,
                        meta: 'admin'
                    }
                ]
            },
            {
                path: '/admin/file/business-report',
                redirect: 'file/business-report/list',
                component: {
                    render(c) { return c('router-view'); }
                },
                children: [
                    {
                        path: 'form',
                        name: 'businessReportForm',
                        component: BusinessReportForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'businessReportList',
                        component: BusinessReportList,
                        meta: 'admin'
                    },
                    {
                        path: '/admin/file/business-report/year',
                        redirect: 'file/business-report/list',
                        component: {
                            render(c) { return c('router-view'); }
                        },
                        children: [
                            {
                                path: 'form',
                                name: 'yearForm',
                                component: YearForm,
                                meta: 'admin'
                            },
                            {
                                path: 'list',
                                name: 'yearList',
                                component: YearList,
                                meta: 'admin'
                            }
                            
                        ]
                    },
                    {
                        path: '/admin/file/business-report/business',
                        redirect: 'file/business-report/list',
                        component: {
                            render(c) { return c('router-view'); }
                        },
                        children: [
                            {
                                path: 'form',
                                name: 'businessForm',
                                component: BusinessForm,
                                meta: 'admin'
                            },
                            {
                                path: 'list',
                                name: 'businessList',
                                component: BusinessList,
                                meta: 'admin'
                            }
                            
                        ]
                    }
                ]
            },
            {
                path: '/admin/file/dream',
                redirect: 'file/dream/list',
                component: {
                    render(c) { return c('router-view'); }
                },
                children: [
                    {
                        path: 'form',
                        name: 'dreamForm',
                        component: DreamForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'dreamList',
                        component: DreamList,
                        meta: 'admin'
                    }
                ]
            },
            {
                path: '/admin/file/kawarabi',
                redirect: 'file/kawarabi/list',
                component: {
                    render(c) { return c('router-view'); }
                },
                children: [
                    {
                        path: 'form',
                        name: 'kawarabiForm',
                        component: KawarabiForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'kawarabiList',
                        component: KawarabiList,
                        meta: 'admin'
                    }
                ]
            },
            {
                path: '/admin/group-information',
                redirect: '/group-information/list',
                component: {
                    render(c) { return c('router-view'); }
                },
                children: [
                    {
                        path: 'form',
                        name: 'groupInformationForm',
                        component: GroupInformationForm,
                        meta: 'admin'
                    },
                    {
                        path: 'list',
                        name: 'groupInformationList',
                        component: GroupInformationList,
                        meta: 'admin'
                    }
                ]
            },
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
                name: 'activeCenterIndex',
                component: activeCenterIndex
            },
            {
                path: ':id/detail',
                name: 'activeCenterDetail',
                component: activeCenterDetail
            }
        ]
    },
    {
        path: '/disaster',
        redirect: '/disaster/index',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'index',
                name: 'disasterIndex',
                component: DisasterIndex
            },
            {
                path: ':id/detail',
                name: 'disasterDetail',
                component: DisasterDetail
            }
        ]
    },
    {
        path: '/subsidy',
        redirect: '/subsidy/index',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'index',
                name: 'subsidyIndex',
                component: SubsidyIndex
            },
            {
                path: ':id/detail',
                name: 'subsidyDetail',
                component: SubsidyDetail
            }
        ]
    },
    {
        path: '/business-report',
        name: 'businessReportIndex',
        component: BusinessReport
    },
    {
        path: '/various',
        name: 'various',
        component: VariousIndex
    },
    {
        path: '/yumekousaten',
        redirect: '/yumekousaten/index',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'index',
                name: 'yumekousatenIndex',
                component: DreamIndex
            },
            {
                path: ':id/detail',
                name: 'yumekousatenDetail',
                component: DreamDetail
            }
        ]
    },
    {
        path: '/kawaraban',
        redirect: '/kawaraban/index',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'index',
                name: 'kawarabanIndex',
                component: KawarabiIndex
            },
            {
                path: ':id/detail',
                name: 'kawarabanDetail',
                component: KawarabiDetail
            }
        ]
    },
    {
        path: '/notice',
        redirect: '/notice/index',
        component: {
            render(c) { return c('router-view'); }
        },
        children: [
            {
                path: 'index',
                name: 'noticeIndex',
                component: NoticeIndex
            },
            {
                path: 'event/:id/detail',
                name: 'eventDetail',
                component: EventDetail
            },
            {
                path: 'volunteer/:id/detail',
                name: 'volunteerDetail',
                component: VolunteerDetail
            },
            {
                path: 'member/:id/detail',
                name: 'membershipDetail',
                component: MembershipDetail
            }
        ]
    },
];

export default routes