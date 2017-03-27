<template>
    <div class="container">
        <span class="demonstration">{{ $t("example") }}</span>
        <el-rate
            v-model="value"
            :colors="['#99A9BF', '#F7BA2A', '#FF9900']">
        </el-rate>
    </div>
</template>

<script>
export default {
    mounted () {
        console.log('Component mounted.')
    },
    data () {
        return {
            value: null
        }
    }
}
</script>
