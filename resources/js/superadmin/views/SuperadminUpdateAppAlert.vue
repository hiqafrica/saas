<template>
	<a-row
		class="mt-20"
		v-if="appSetting.update_app_notification && productStatus == 'update_available'"
	>
		<a-col :span="24">
			<a-alert
				v-if="productStatus == 'update_available'"
				type="success"
				:message="$t('update_app.update_available')"
				showIcon
				@click="
					() => $router.push({ name: 'superadmin.settings.update_app.index' })
				"
			>
				<template #description>
					{{
						$t("messages.new_app_version_avaialbe", [product.product.version])
					}}
				</template>
				<template #closeText>
					<a-button type="primary">
						<template #icon>
							<CloudDownloadOutlined />
						</template>
						{{ $t("update_app.update_now") }}
					</a-button>
				</template>
			</a-alert>
		</a-col>
	</a-row>
</template>

<script>
import { watch, onMounted, computed, ref, defineComponent } from "vue";
import { SyncOutlined, CloudDownloadOutlined } from "@ant-design/icons-vue";
import common from "../../common/composable/common";
import axios from "axios";

export default defineComponent({
	components: {
		SyncOutlined,
		CloudDownloadOutlined,
	},
	setup() {
		const { appSetting } = common();
		const appVersion = window.config.app_version;
		const productStatus = ref("fetching");
		const product = ref([]);

		onMounted(() => {
			if (appSetting.value.update_app_notification) {
                productStatus.value = "success";
			}
		});

		return {
			appSetting,
			productStatus,
			product,
		};
	},
});
</script>
