<template>
    <el-container>
        <el-header>
            <h1>Log</h1>
        </el-header>
        <el-main>
            <el-table
                    :data="items"
                    border>
            </el-table>
            <el-pagination
                    layout="prev, pager, next"
                    :total="total">
            </el-pagination>
        </el-main>
    </el-container>
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                total: 50
            }
        }
    };
</script>