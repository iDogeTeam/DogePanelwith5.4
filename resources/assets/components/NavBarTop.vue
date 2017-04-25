<template>
    <el-menu theme="light" class="menu-top" :default-active="activeIndex" mode="horizontal" @select="handleSelect">
        <el-menu-item index="1">Link 1</el-menu-item>
        <el-submenu index="2">
            <template slot="title">Link 2</template>
            <el-menu-item index="2-1">Link 2-1</el-menu-item>
            <el-menu-item index="2-2">Link 2-2</el-menu-item>
            <el-menu-item index="2-3">Link 2-3</el-menu-item>
        </el-submenu>
        <el-menu-item index="3">
            <router-link to="404">404 page</router-link>
        </el-menu-item>
        <el-menu-item index="4">
            <router-link to="example">example page</router-link>
        </el-menu-item>
    </el-menu>
</template>

<script>
export default {
    data () {
        return {}
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
</style>
