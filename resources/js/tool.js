Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'nova-kustomer',
            path: '/feedbacks',
            component: require('./views/Index').default,
        },
        {
            name: 'feedback-detail',
            path: '/feedback/:feedbackId',
            component: require('./views/Detail').default,
            props: true,
        },
    ])
})
