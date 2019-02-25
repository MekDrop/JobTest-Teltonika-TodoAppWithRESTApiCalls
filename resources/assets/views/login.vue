<template>
    <el-container>
        <el-header>
            <h1>Login</h1>
        </el-header>
        <el-main>
            <el-alert
                      :closable="false"
                      title="To access todo app you need first login in with this form."
                      type="info">
            </el-alert>
            <el-form>
                <el-form-item label="E-mail">
                    <el-input name="email" v-model="email" type="email" autocomplete="on" />
                </el-form-item>
                <el-form-item label="Password">
                    <el-input name="password" v-model="password" type="password" autocomplete="on" />
                </el-form-item>
                <input type="hidden" name="route" :value="previousRoute" />
                <el-button>Login</el-button>
            </el-form>
        </el-main>
    </el-container>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: ''
            };
        },
        computed: {
            previousRoute() {
                return this.$route.params.previous;
            }
        }
    }
</script>