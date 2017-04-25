import main from '../components/user/main'
import home from '../components/user/home'
import node from '../components/user/node'
import nodeInfo from '../components/user/nodeInfo'
import edit from '../components/user/edit'
import log from '../components/user/log'

const user = {
    path: '/user',
    component: main,
    children: [
        {
            path: '',
            component: home
        },
        {
            path: 'node',
            component: {
                template: '<router-view/>'
            },
            children: [
                {
                    path: '',
                    component: node
                },
                {
                    path: ':id',
                    component: nodeInfo
                }
            ]
        },
        {
            path: 'edit',
            component: edit
        },
        {
            path: 'log/:page?',
            component: log
        }
    ]
}
export default user
