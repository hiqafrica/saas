<template>
    <div class="login-main-container" v-if="1 > 6">
        <a-row class="main-container-div">
            <a-col :xs="24" :sm="24" :md="24" :lg="8">
                <a-row class="login-left-div">
                    <a-col
                        :xs="{ span: 20, offset: 2 }"
                        :sm="{ span: 20, offset: 2 }"
                        :md="{ span: 16, offset: 4 }"
                        :lg="{ span: 16, offset: 4 }"
                    >
                        <a-card
                            :title="null"
                            class="login-div"
                            :bordered="innerWidth <= 768 ? true : false"
                        >

                            <DemoCredentials :credentials="credentials" />
                        </a-card>
                    </a-col>
                </a-row>
            </a-col>
            <a-col :xs="0" :sm="0" :md="24" :lg="16">
                <div class="right-login-div">
                    <img class="right-image" :src="loginBackground" />
                </div>
            </a-col>
        </a-row>
    </div>



    <div class="auth-page-wrapper pt-5">
        <!-- authemtication  page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="#" class="d-inline-block auth-logo">
                                    <img src="http://127.0.0.1:8000/assets/images/logo-light.png" alt="" height="20">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Login </h5>
                                    <p class="text-muted">Log into your HiQ Africa account now</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <div class="needs-validation" >

                                        <a-form layout="vertical">

                                <a-alert
                                    v-if="onRequestSend.error != ''"
                                    :message="onRequestSend.error"
                                    type="error"
                                    show-icon
                                    class="mb-20 mt-10"
                                />
                                <a-alert
                                    v-if="onRequestSend.success"
                                    :message="$t('messages.login_success')"
                                    type="success"
                                    show-icon
                                    class="mb-20 mt-10"
                                />
                                <a-form-item
                                    :label="$t('user.email_phone')"
                                    name="email"
                                    :help="rules.email ? rules.email.message : null"
                                    :validateStatus="rules.email ? 'error' : null"
                                >
                                    <a-input
                                        v-model:value="credentials.email"
                                        @pressEnter="onSubmit"
                                        :placeholder="
                                            $t('common.placeholder_default_text', [
                                                $t('user.email_phone'),
                                            ])
                                        "
                                    />
                                </a-form-item>

                                <a-form-item
                                    :label="$t('user.password')"
                                    name="password"
                                    :help="rules.password ? rules.password.message : null"
                                    :validateStatus="rules.password ? 'error' : null"
                                >
                                    <a-input-password
                                        v-model:value="credentials.password"
                                        @pressEnter="onSubmit"
                                        :placeholder="
                                            $t('common.placeholder_default_text', [
                                                $t('user.password'),
                                            ])
                                        "
                                    />
                                </a-form-item>


                                <div class="mt-4">
                                            <button
                                            :loading="loading"
                                        @click="onSubmit"

                                        block
                                            class="btn btn-primary w-100" type="submit">{{ $t("menu.login") }}</button>
                                        </div>
                            </a-form>


                                    </div>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">New here ? <a href="/register" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                 HiQ Africa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
</template>

<script>
import { defineComponent, reactive, ref } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import common from "../../../common/composable/common";
import apiAdmin from "../../../common/composable/apiAdmin";
import DemoCredentials from "./DemoCredentials.vue";
import { loadScript } from "vue-plugin-load-script";

loadScript("http://127.0.0.1:8000/assets/js/layout.js");
loadScript("http://127.0.0.1:8000/assets/libs/bootstrap/js/bootstrap.bundle.min.js");
loadScript("http://127.0.0.1:8000/assets/libs/simplebar/simplebar.min.js");
loadScript("http://127.0.0.1:8000/assets/libs/node-waves/waves.min.js");
loadScript("http://127.0.0.1:8000/assets/libs/feather-icons/feather.min.js");
loadScript("http://127.0.0.1:8000/assets/js/pages/plugins/lord-icon-2.1.0.js");
loadScript("http://127.0.0.1:8000/assets/js/plugins.js");

loadScript("http://127.0.0.1:8000/assets/libs/particles.js/particles.js");
loadScript("http://127.0.0.1:8000/assets/js/pages/particles.app.js");
loadScript("http://127.0.0.1:8000/assets/js/pages/form-validation.init.js");
loadScript("http://127.0.0.1:8000/assets/js/pages/passowrd-create.init.js");


export default defineComponent({
    components: {
        DemoCredentials,
    },
    setup() {
        const { addEditRequestAdmin, loading, rules } = apiAdmin();
        const { globalSetting, appType } = common();
        const loginBackground = globalSetting.value.login_image_url;
        const store = useStore();
        const router = useRouter();
        const credentials = reactive({
            email: null,
            password: null,
        });
        const onRequestSend = ref({
            error: "",
            success: "",
        });

        const onSubmit = () => {
            onRequestSend.value = {
                error: "",
                success: false,
            };

            addEditRequestAdmin({
                url: "auth/login",
                data: credentials,
                success: (response) => {
                    const user = response.user;
                    store.commit("auth/updateUser", user);
                    store.commit("auth/updateToken", response.token);
                    store.commit("auth/updateExpires", response.expires_in);
                    store.commit(
                        "auth/updateVisibleSubscriptionModules",
                        response.visible_subscription_modules
                    );

                    if (appType == "non-saas") {
                        store.dispatch("auth/updateAllWarehouses");
                        store.commit("auth/updateWarehouse", response.user.warehouse);

                        router.push({
                            name: "admin.dashboard.index",
                            params: { success: true },
                        });
                    } else {
                        if (user.is_superadmin && user.user_type == "super_admins") {
                            store.commit("auth/updateApp", response.app);
                            store.commit(
                                "auth/updateEmailVerifiedSetting",
                                response.email_setting_verified
                            );
                            router.push({
                                name: "superadmin.dashboard.index",
                                params: { success: true },
                            });
                        } else {
                            store.commit("auth/updateApp", response.app);
                            store.commit(
                                "auth/updateEmailVerifiedSetting",
                                response.email_setting_verified
                            );
                            store.commit(
                                "auth/updateAddMenus",
                                response.shortcut_menus.credentials
                            );
                            store.dispatch("auth/updateAllWarehouses");
                            store.commit("auth/updateWarehouse", response.user.warehouse);
                            router.push({
                                name: "admin.dashboard.index",
                                params: { success: true },
                            });
                        }
                    }
                },
                error: (err) => {
                    onRequestSend.value = {
                        error: err.error.message ? err.error.message : "",
                        success: false,
                    };
                },
            });
        };

        return {
            loading,
            rules,
            credentials,
            onSubmit,
            onRequestSend,
            globalSetting,
            loginBackground,
            innerWidth: window.innerWidth,
        };
    },
});
</script>

<style lang="less">

@import 'http://127.0.0.1:8000/assets/css/bootstrap.min.css';
@import 'http://127.0.0.1:8000/assets/css/icons.min.css';
@import 'http://127.0.0.1:8000/assets/css/app.min.css';
@import 'http://127.0.0.1:8000/assets/css/custom.min.css';
</style>
