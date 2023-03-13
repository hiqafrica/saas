<template>
    <a-form layout="vertical">


        <a-row
            :gutter="16"
            v-if="selectedOfflineMethod && selectedOfflineMethod.description"
        >
            <a-col :xs="24" :sm="24" :md="24" :lg="24">
                <a-form-item :label="$t('offline_request.offline_account_details')">
                    <span class="ant-form-text" style="white-space: pre">
                        {{ selectedOfflineMethod.description }}
                    </span>
                </a-form-item>
            </a-col>
        </a-row>



        <a-row :gutter="16">
            <a-col :xs="24" :sm="24" :md="24" :lg="24">
                <a-form-item
                    label="Phone Number"
                    name="phone_number"
                    :help="
                        rules.phone_number ? rules.phone_number.message : null
                    "
                    :validateStatus="rules.phone_number ? 'error' : null"
                    class="required"
                >
                    <a-input
                        v-model:value="formData.phone_number"
                        placeholder="Phone Number"
                    />
                </a-form-item>
            </a-col>
        </a-row>

        <a-row :gutter="16" class="mt-20">
            <a-col :xs="24" :sm="24" :md="24" :lg="24">
                <a-button
                    type="primary"
                    @click="pay"
                    :loading="loading"
                    block
                >
                    {{ $t("payment_settings.complete_transcation") }}
                </a-button>
            </a-col>
        </a-row>
    </a-form>
</template>

<script>
import { defineComponent, ref, computed } from "vue";
import { find } from "lodash-es";
import { useI18n } from "vue-i18n";
import apiAdmin from "../../../../common/composable/apiAdmin";

export default {
    props: ["allMethods", "subscribePlan", "planType"],
    setup(props, { emit }) {
        const { addEditRequestAdmin, loading, rules } = apiAdmin();
        const { t } = useI18n();
        const formData = ref({
            offline_payment_mode_id: undefined,
            subscription_plan_id: props.subscribePlan.xid,
            plan_type: props.planType,
        });

        const selectedOfflineMethod = computed(() => {
            return find(props.allMethods, [
                "xid",
                formData.value.offline_payment_mode_id,
            ]);
        });

        const pay = () => {
            addEditRequestAdmin({
                url: `submit-offline-request`,
                data: formData.value,
                successMessage: t("offline_request.request_submited_successfully"),
                success: (res) => {
                    emit("success", true);
                },
            });
        };

        return {
            loading,
            rules,
            formData,

            selectedOfflineMethod,
            pay,
        };
    },
};
</script>

<style></style>
