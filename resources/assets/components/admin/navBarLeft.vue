<template>
    <el-menu theme="dark"
             class="full-height menu-left"
             router
             mode="vertical"
             :default-active="activeIndex">
        <li class="logo">DogeSpeed</li>
        <el-menu-item index="/admin">管理中心</el-menu-item>
        <el-menu-item index="/admin/user">用户管理</el-menu-item>
        <el-menu-item index="/admin/node">节点管理</el-menu-item>
        <el-menu-item index="/admin/log">流量记录</el-menu-item>
        <el-menu-item index="/user">用户中心</el-menu-item>
    </el-menu>
</template>

<script>
    import ElMenu from 'element-ui/packages/menu/src/menu'
    import ElMenuItem from 'element-ui/packages/menu/src/menu-item'
    export default {
        components: {
            ElMenuItem,
            ElMenu
        },
        data () {
            return {
                activeIndex: location.pathname.split('/', 3).join('/')
            }
        }
    }
</script>

<style lang="scss">
    .menu-left {
        a {
            color: #f0f0f0;
        }
        .is-active a {
            color: #20a0ff;
        }
    }
</style>
