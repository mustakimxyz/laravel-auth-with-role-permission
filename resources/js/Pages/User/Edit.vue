<script setup>
	import InputError from "@/Components/InputError.vue";
	import InputLabel from "@/Components/InputLabel.vue";
	import TextInput from "@/Components/TextInput.vue";
	import { Head, Link, useForm } from "@inertiajs/vue3";
	import EmployeeLayout from "@/Layouts/EmployeeLayout.vue";
	import PrimaryButton from "@/Components/PrimaryButton.vue";

	const props = defineProps({
		user: Object,
	});

	const form = useForm({
		name: props.user.name,
		role: props.user.role,
		email: props.user.email,
		approval_status: props.user.approval_status,
		image: "",
		imagePreview: "../../" + props.user.avatar,
	});

	const pickImage = (e) => {
		e.preventDefault();
		form.image = e.target.files[0];
		form.imagePreview = URL.createObjectURL(form.image);
	};

	const submit = () => {
		form.patch(route("user.update", props.user.id));
	};
</script>

<template>
	<Head title="User" />

	<EmployeeLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">User</h2>
		</template>
		<div class="py-12">
			<div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
				<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
					<form @submit.prevent="submit" enctype="multipart/form-data">
						<div class="text-center">
							<img
								v-if="form.imagePreview"
								:src="form.imagePreview"
								class="mx-auto mb-4 w-32 rounded-lg"
								@click="$refs.file.click()"
								@error="imageUrl = 'https://placekitten.com/250/250'"
								alt="Avatar"
							/>
							<img
								v-else
								src="https://placekitten.com/250/250"
								class="mx-auto mb-4 w-32 rounded-lg"
								@click="$refs.file.click()"
								alt="Avatar"
							/>
							<h5 class="mb-2 text-xl font-medium leading-tight">
								Click Image to Select Your Avatar
							</h5>

							<input
								ref="file"
								type="file"
								name="upload"
								@input="pickImage"
								accept="image/png, image/gif, image/jpeg"
								hidden
							/>
							<InputError class="mt-2" :message="form.errors.image" />
						</div>
						<div>
							<InputLabel for="name" value="Name" />

							<TextInput
								id="name"
								type="text"
								class="mt-1 block w-full"
								v-model="form.name"
								required
								autofocus
								autocomplete="name"
							/>

							<InputError class="mt-2" :message="form.errors.name" />
						</div>
						<div>
							<InputLabel for="email" value="Email" />

							<TextInput
								id="email"
								type="text"
								class="mt-1 block w-full"
								v-model="form.email"
								required
								autofocus
								autocomplete="email"
							/>

							<InputError class="mt-2" :message="form.errors.email" />
						</div>
						<div>
							<InputLabel for="role" value="Position" />

							<select
								name="approval_status"
								v-model="form.approval_status"
								id=""
								class="mt-1 block w-full"
							>
								<option value="" disabled>Select Option</option>
								<option value="approved">Approve</option>
								<option value="rejected">Reject</option>
							</select>

							<InputError class="mt-2" :message="form.errors.role" />
						</div>
						<!-- <div class="mt-4">
							<InputLabel for="password" value="Password" />

							<TextInput
								id="password"
								type="password"
								class="mt-1 block w-full"
								v-model="form.password"
								required
								autocomplete="new-password"
							/>

							<InputError class="mt-2" :message="form.errors.password" />
						</div>

						<div class="mt-4">
							<InputLabel
								for="password_confirmation"
								value="Confirm Password"
							/>

							<TextInput
								id="password_confirmation"
								type="password"
								class="mt-1 block w-full"
								v-model="form.password_confirmation"
								required
								autocomplete="new-password"
							/>

							<InputError
								class="mt-2"
								:message="form.errors.password_confirmation"
							/>
						</div> -->

						<div class="flex items-center justify-end mt-4">
							<PrimaryButton
								class="ml-4"
								:class="{ 'opacity-25': form.processing }"
								:disabled="form.processing"
							>
								Update
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</EmployeeLayout>
</template>
