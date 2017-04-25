<template>
    <el-row class="full-height">
        <el-col :span="4" class="full-height">
            <navBarLeft/>
        </el-col>
        <el-col :span="20">
            <navBarTop/>
            <router-view/>
        </el-col>
    </el-row>
</template>

<script>
import navBarTop from './NavBarTop'
import navBarLeft from './NavBarLeft'
import 'element-ui/lib/theme-default/index.css'
import 'normalize.css'
export default {
    components: {
        navBarTop,
        navBarLeft
    }
}
</script>

<style>
    html, body {
        margin: 0;
        padding: 0;
    }
    html, body, .full-height {
        height: 100%;
    }
    body {
        font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei",Arial,sans-serif;
        font-size: 14px;
        -webkit-font-smoothing: antialiased;
        overflow: auto;
    }
    h1 {
        font-size: 	20px;
    }
    h2 {
        font-size: 	18px;
    }
    h3 {
        font-size: 	16px;
    }
    a {
        text-decoration: none;
    }
    .el-menu a {
        display: block;
        height:100%;
        width:100%;
    }
</style>
