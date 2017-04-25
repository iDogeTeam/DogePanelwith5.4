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
    import navBarTop from '../navBarTop'
    import navBarLeft from './navBarLeft'
    export default {
        components: {
            navBarTop,
            navBarLeft
        }
    }
</script>

<style>

</style>
