import main from '../components/admin/main'
import home from '../components/admin/home'
import node from '../components/admin/node'
import nodeEdit from '../components/admin/nodeEdit'
import user from '../components/admin/user'
import userEdit from '../components/admin/userEdit'
import log from '../components/admin/log'

const admin = {
    path: '/admin',
    component: main,
    children: [
        {
            path: '',
            component: home
        },
        {
            path: 'user',
            component: {
                template: '<router-view/>'
            },
            children: [
                {
                    path: ':page?',
                    component: user
                },
                {
                    path: 'edit/:id',
                    component: userEdit
                }
            ]
        },
        {
            path: 'node',
            component: {
                template: '<router-view/>'
            },
            children: [
                {
                    path: ':page?',
                    component: node
                },
                {
                    path: 'edit/:id',
                    component: nodeEdit
                }
            ]
        },
        {
            path: 'log/:page?',
            component: log
        }
    ]
}

export default admin
