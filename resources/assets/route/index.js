import notFound from '../components/notFound'
import example from '../components/example'
import user from './user'
import admin from './admin'
const routes = [
    {
        path: '/',
        redirect: '/example'
    },
    {
        path: '/example',
        component: example
    },
    {
        path: '/login',
        component: example
    },
    {
        path: '/register',
        component: example
    },
    admin,
    user,
    {
        path: '*',
        component: notFound
    }
]

export default routes
