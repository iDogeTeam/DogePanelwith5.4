<template>
    <div class="container">
        <span class="demonstration">{{ $t("example") }}</span>
        <el-rate
            :value="value"
            :colors="['#99A9BF', '#F7BA2A', '#FF9900']">
        </el-rate>
        <router-link to="/user">进入用户中心</router-link>
    </div>
</template>

<script>
    import _ from 'lodash'
    export default {
        data () {
            return {
                value: _.random(0, 5)
            }
        },
        mounted () {
            let routes = this.$router.options.routes
            console.log(routes)
        }
    }
</script>
