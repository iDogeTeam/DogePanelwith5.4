<template>
    <el-menu theme="light" class="menu-top" :default-active="activeIndex" mode="horizontal" @select="handleSelect">
        <el-submenu index="language">
            <template slot="title">语言选择</template>
            <el-menu-item index="en">English</el-menu-item>
            <el-menu-item index="zh-cn">简体中文</el-menu-item>
            <el-menu-item index="zh-tw">正體中文</el-menu-item>
        </el-submenu>
        <el-submenu index="avatar">
            <template slot="title">这里是头像</template>
            <li><div>
                <p>用户等级</p>
                <p>流量信息</p>
            </div></li>
        </el-submenu>
        <el-menu-item index="feedback">
            <router-link to="404">反馈</router-link>
        </el-menu-item>
        <el-menu-item index="example">
            <router-link to="example">example page</router-link>
        </el-menu-item>
    </el-menu>
</template>

<script>
    import ElMenu from 'element-ui/packages/menu/src/menu'
    import ElMenuItem from 'element-ui/packages/menu/src/menu-item'
    import ElSubmenu from 'element-ui/packages/menu/src/submenu'
    export default {
        components: {
            ElSubmenu,
            ElMenuItem,
            ElMenu
        },
        data () {
            return {
                activeIndex: 'avatar'
            }
        },
        methods: {
            handleSelect (key, keyPath) {
                console.log(key, keyPath)
                console.log(this.$i18n.locale)
            }
        }
    }
</script>

<style>
    .menu-top > * {
        float: right !important;
    }
    .menu-top {
        padding-right: 5px;
    }
</style>
