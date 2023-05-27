<script setup>
	import InputError from "@/Components/InputError.vue";
	import InputLabel from "@/Components/InputLabel.vue";
	import TextInput from "@/Components/TextInput.vue";
	import { Head, Link, useForm } from "@inertiajs/vue3";
	import EmployeeLayout from "@/Layouts/EmployeeLayout.vue";
	import PrimaryButton from "@/Components/PrimaryButton.vue";

	const form = useForm({
		name: "",
		position: "",
		office: "",
		age: "",
		start_date: "",
	});

	const submit = () => {
		form.post(route("employee.store"));
	};
	
</script>

<template>
	<Head title="Employee" />

	<EmployeeLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Employees
			</h2>
		</template>
		<div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
					<form @submit.prevent="submit">
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
							<InputLabel for="position" value="Position" />

							<TextInput
								id="position"
								type="text"
								class="mt-1 block w-full"
								v-model="form.position"
								required
								autofocus
								autocomplete="position"
							/>

							<InputError class="mt-2" :message="form.errors.position" />
						</div>
						<div>
							<InputLabel for="office" value="Office" />

							<TextInput
								id="office"
								type="text"
								class="mt-1 block w-full"
								v-model="form.office"
								required
								autofocus
								autocomplete="office"
							/>

							<InputError class="mt-2" :message="form.errors.office" />
						</div>
						<div>
							<InputLabel for="age" value="Age" />

							<TextInput
								id="age"
								type="number"
								class="mt-1 block w-full"
								v-model="form.age"
								required
								autofocus
								autocomplete="age"
							/>

							<InputError class="mt-2" :message="form.errors.age" />
						</div>
						<div>
							<InputLabel for="start_date" value="Start Date" />

							<TextInput
								id="start_date"
								type="date"
								class="mt-1 block w-full"
								v-model="form.start_date"
								required
								autofocus
								autocomplete="start_date"
							/>

							<InputError class="mt-2" :message="form.errors.start_date" />
						</div>

						<div class="flex items-center justify-end mt-4">
							<PrimaryButton
								class="ml-4"
								:class="{ 'opacity-25': form.processing }"
								:disabled="form.processing"
							>
								Create
							</PrimaryButton>
						</div>
					</form>
				</div>
			</div>
		</div>
	</EmployeeLayout>
</template>
