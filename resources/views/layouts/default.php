<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Todo</title>
</head>
<body>
    <div id="app">
        <el-alert v-if="error"
                  title="Error"
                  :description="error"
                  :closable="true"
                  @close="_onErrorClose"
                  :show-icon="true"
                  type="error">
        </el-alert>
        <transition name="fade">
            <router-view>
            </router-view>
        </transition>
    </div>
    <script src="<?=url('main.js');?>"></script>
    <script type="text/json" id="initial"><?=json_encode($initialData);?></script>
</body>
</html>