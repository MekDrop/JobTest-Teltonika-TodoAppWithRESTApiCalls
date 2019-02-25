<template>
    <el-container>
        <el-header>
            <h1>Change password</h1>
        </el-header>
        <el-main>
            <el-form>
                <el-form-item label="Enter your password">
                    <el-input min-length="6" name="password" v-model="password" type="password" autocomplete="off" />
                </el-form-item>
                <el-form-item label="Repeat password">
                    <el-input min-length="6" v-model="password_confirmed" type="password" autocomplete="off" />
                </el-form-item>
                <el-button type="submit">Change password</el-button>
            </el-form>
        </el-main>
    </el-container>
</template>

<script>
    export default {
        data() {
            return {
                password: '',
                password_confirmed: ''
            };
        }
    }
</script>