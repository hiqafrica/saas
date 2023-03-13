<template>
	<SuperAdminPageHeader>
		<template #header>
			<a-page-header title="Momo Pay Settings" class="p-0">
				<template #extra>
					<a-button type="primary" @click="onSubmit">
						<template #icon> <SaveOutlined /> </template>
						{{ $t("common.update") }}
					</a-button>
				</template>
			</a-page-header>
		</template>
		<template #breadcrumb>
			<a-breadcrumb separator="-" style="font-size: 12px">
				<a-breadcrumb-item>
					<router-link :to="{ name: 'admin.dashboard.index' }">
						{{ $t(`menu.dashboard`) }}
					</router-link>
				</a-breadcrumb-item>
				<a-breadcrumb-item>
					{{ $t("menu.payment_settings") }}
				</a-breadcrumb-item>
				<a-breadcrumb-item>
					Momo Pay
				</a-breadcrumb-item>
			</a-breadcrumb>
		</template>
	</SuperAdminPageHeader>

	<a-row>
		<a-col :xs="24" :sm="24" :md="24" :lg="4" :xl="4" class="bg-setting-sidebar">
			<SubscriptionSidebar />
		</a-col>
		<a-col :xs="24" :sm="24" :md="24" :lg="20" :xl="20">
			<a-card class="page-content-container">
				<a-form layout="vertical">
					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								label="PayPack Client ID"
								name="paypal_client_id"
								:help="
									rules.paypal_client_id
										? rules.paypal_client_id.message
										: null
								"
								:validateStatus="rules.paypal_client_id ? 'error' : null"
								class="required"
							>
								<a-input
									v-model:value="formData.paypal_client_id"
									:placeholder="
										$t('common.placeholder_default_text', [
											'PayPack Client ID',
										])
									"
								/>
							</a-form-item>
						</a-col>
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								label="PayPack Secret"
								name="paypal_secret"
								:help="
									rules.paypal_secret
										? rules.paypal_secret.message
										: null
								"
								:validateStatus="rules.paypal_secret ? 'error' : null"
								class="required"
							>
								<a-input
									v-model:value="formData.paypal_secret"
									:placeholder="
										$t('common.placeholder_default_text', [
											'PayPack Secret',
										])
									"
								/>
							</a-form-item>
						</a-col>
					</a-row>



					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="12" :lg="12">
							<a-form-item
								label="PayPack Status"
								name="paypal_status"
								:help="
									rules.paypal_status
										? rules.paypal_status.message
										: null
								"
								:validateStatus="rules.paypal_status ? 'error' : null"
								class="required"
							>
								<a-switch
									v-model:checked="formData.paypal_status"
									checkedValue="active"
									unCheckedValue="inactive"
								/>
							</a-form-item>
						</a-col>
					</a-row>

					<a-row :gutter="16">
						<a-col :xs="24" :sm="24" :md="24" :lg="24">
							<a-form-item>
								<a-button
									type="primary"
									@click="onSubmit"
									:loading="loading"
								>
									<template #icon> <SaveOutlined /> </template>
									{{ $t("common.update") }}
								</a-button>
							</a-form-item>
						</a-col>
					</a-row>
				</a-form>
			</a-card>
		</a-col>
	</a-row>
</template>
<script>
import { onMounted, ref } from "vue";
import {
	EyeOutlined,
	PlusOutlined,
	EditOutlined,
	DeleteOutlined,
	ExclamationCircleOutlined,
	SaveOutlined,
} from "@ant-design/icons-vue";
import { useI18n } from "vue-i18n";
import apiAdmin from "../../../../common/composable/apiAdmin";
import SuperAdminPageHeader from "../../../layouts/SuperAdminPageHeader.vue";
import SubscriptionSidebar from "../SubscriptionSidebar.vue";

export default {
	components: {
		EyeOutlined,
		PlusOutlined,
		EditOutlined,
		DeleteOutlined,
		ExclamationCircleOutlined,
		SaveOutlined,

		SubscriptionSidebar,
		SuperAdminPageHeader,
	},
	setup() {
		const { addEditRequestAdmin, loading, rules } = apiAdmin();
		const { t } = useI18n();
		const formData = ref({});
		const webhookUrl = ref("");

		onMounted(() => {
			axiosAdmin.get("superadmin/payment-settings/paypal").then((response) => {
				formData.value = response.data.data;
				webhookUrl.value = response.data.webhook_url;
			});
		});

		const onSubmit = () => {
			addEditRequestAdmin({
				url: `superadmin/payment-settings/paypal/update`,
				data: formData.value,
				successMessage: t("payment_settings.credential_saved"),
				success: (res) => {},
			});
		};

		return {
			loading,
			rules,
			formData,
			webhookUrl,

			onSubmit,
		};
	},
};
</script>
