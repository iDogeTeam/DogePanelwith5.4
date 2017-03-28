<template>
    <div>
        <navbar/>
        <router-view/>
    </div>
</template>

<script>
import navbar from './navbar'
import 'element-ui/lib/theme-default/index.css'
import 'normalize.css'
export default {
    components: {
        navbar
    }
}
</script>

<style>
body {
    margin: 0;
    padding: 0;
    font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;
    font-size: 14px;
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
</style>
