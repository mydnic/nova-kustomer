Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'nova-kustomer',
            path: '/feedbacks',
            component: require('./views/Index'),
        },
        {
            name: 'feedback-detail',
            path: '/feedback/:feedbackId',
            component: require('./views/Detail'),
            props: true,
        },
    ])
})
