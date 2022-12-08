let appModulesRoutes = [

    {path: '/app/home', component: require('./components/app/home.vue').default},



    {path: '/staff', component: require('./components/admin/staff/index.vue').default},
    {path: '/logs', component: require('./components/app/logs/index.vue').default},
    {path: '/cu-staff', component: require('./components/admin/staff/cu.vue').default},
    {path: '/roles', component: require('./components/app/role/index.vue').default},
    {path: '/cu-role', props: true, component: require('./components/app/role/cu.vue').default},

];

export {appModulesRoutes};




