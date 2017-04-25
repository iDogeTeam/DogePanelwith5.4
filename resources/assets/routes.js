import NotFound from './components/NotFound'

import Example from './components/Example'

const Routes = [
    {
        path: '/example',
        component: Example
    },
    {
        path: '/',
        redirect: '/example'
    },
    {
        path: '/login',
        component: Example
    },
    {
        path: '/register',
        component: Example
    },
    {
        path: '/user',
        component: Example,
        children: [
            {
                path: '',
                component: Example
            },
            {
                path: 'edit',
                component: Example
            },
            {
                path: 'node',
                component: Example,
                children: [
                    {
                        path: '',
                        component: Example
                    },
                    {
                        path: ':id',
                        component: Example
                    }
                ]
            },
            {
                path: 'log/:page?',
                component: Example
            }
        ]
    },
    {
        path: '/admin',
        component: Example,
        children: [
            {
                path: '',
                component: Example
            },
            {
                path: 'user',
                component: Example,
                children: [
                    {
                        path: ':page?',
                        component: Example
                    },
                    {
                        path: 'edit/:id',
                        component: Example
                    }
                ]
            },
            {
                path: 'node',
                component: Example,
                children: [
                    {
                        path: ':page?',
                        component: Example
                    },
                    {
                        path: 'edit/:id',
                        component: Example
                    }
                ]
            },
            {
                path: 'log/:page?',
                component: Example
            }
        ]
    },
    {
        path: '*',
        component: NotFound
    }
]

export default Routes
