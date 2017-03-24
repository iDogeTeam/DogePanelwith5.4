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
        path: '*',
        component: NotFound
    }
]

export default Routes
