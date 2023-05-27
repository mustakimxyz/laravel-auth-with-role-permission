<script setup>
	import EmployeeLayout from "@/Layouts/EmployeeLayout.vue";
	import PrimaryButton from "@/Components/PrimaryButton.vue";
	import DangerButton from "@/Components/DangerButton.vue";
	import { useForm } from "@inertiajs/vue3";
	import { Head } from "@inertiajs/vue3";
	import NavLink from "@/Components/NavLink.vue";

	defineProps({
		allUser: {
			type: Array,
		},
	});
	const form = useForm({
		password: "",
	});
	const deleteUser = (id) => {
		form.delete(route("employee.delete", { id }), {
			preserveScroll: true,
			onSuccess: () => closeModal(),
			onFinish: () => form.reset(),
		});
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
				<NavLink :href="route('employee.create')">
					<PrimaryButton>Create</PrimaryButton>
				</NavLink>
				<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
					<table class="table-auto">
						<thead>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start Date</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							<tr v-for="user in allUser" v-bind:key="user.id">
								<td>{{ user.name }}</td>
								<td>{{ user.position }}</td>
								<td>{{ user.office }}</td>
								<td>{{ user.age }}</td>
								<td>{{ user.start_dat }}</td>
								<td>
									<NavLink :href="route('employee.edit', { id: user.id })">
										<PrimaryButton>Edit</PrimaryButton>
									</NavLink>
									<DangerButton
										class="ml-3"
										:class="{ 'opacity-25': form.processing }"
										:disabled="form.processing"
										@click="deleteUser(user.id)"
									>
										Delete Account
									</DangerButton>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</EmployeeLayout>
</template>
