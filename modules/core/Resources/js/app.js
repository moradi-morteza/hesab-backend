let coreModulesRoutes = [

    {path: '*', component: require('./components/404.vue').default},
    {path: '/home', component: require('./components/home.vue').default},
    {path: '/staff', component: require('./components/staff/index.vue').default},
    {path: '/logs', component: require('./components/logs/index.vue').default},
    {path: '/cu-staff', component: require('./components/staff/cu.vue').default},

    {path: '/roles', component: require('./components/role/index.vue').default},
    {path: '/cu-role', props: true, component: require('./components/role/cu.vue').default},

    {path: '/setting', component: require('./components/setting.vue').default},

];

export {coreModulesRoutes};




