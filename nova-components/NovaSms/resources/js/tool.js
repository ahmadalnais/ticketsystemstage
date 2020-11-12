Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'NovaSms',
            path: '/NovaSms',
            component: require('./components/Tool'),
        },
    ])
})
