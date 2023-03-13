<template>
	<div
		class="main-container">
		<div class="container-content">
			<a-row type="flex" justify="center">
				<a-col :span="8">
					<div class="text-center">
						<a-typography-title :level="4">
							Press Button to Continue
						</a-typography-title>
					</div>

					<a-divider />

					<a-alert v-if="successMessage != ''" type="success" show-icon banner>
						<template #message>
							<span v-html="successMessage" />
						</template>
					</a-alert>


					<a-form layout="vertical" class="mt-20">
                        <p style=" display: flex; justify-content: center;">
                            <a-form-item >
							<a-button type="primary" @click="verify" :loading="loading">
								Continue
							</a-button>
						</a-form-item>
                    </p>

					</a-form>
				</a-col>
			</a-row>
		</div>
	</div>
</template>

<script>
import { defineComponent } from "vue";
import { useRouter } from "vue-router";
import modules from "../../../common/composable/modules";

export default defineComponent({
	setup() {

		const router = useRouter();
		const {
			rules,
			purchaseCode= 'noq',
			errorMessage,
			successMessage,
			loading,
			verifyPurchase,
		} = modules();

		const verify = () =>
			verifyPurchase({
				success: (res) => {
					router.push({ name: "admin.login" });
				},
			});

		return {
			rules,
			purchaseCode,
			loading,
			verify,
			errorMessage,
			successMessage,


		};
	},
});
</script>

<style lang="less">
.main-container {
	height: 100vh;
}

.container-content {
	margin-top: 100px;
}
</style>
