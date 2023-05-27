<script setup>
	import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
	import GuestLayout from "@/Layouts/GuestLayout.vue";
	import { Head, useForm } from "@inertiajs/vue3";
	import PrimaryButton from "@/Components/PrimaryButton.vue";
	import DangerButton from "@/Components/DangerButton.vue";
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
	const closeModal = () => {
		confirmingUserDeletion.value = false;

		form.reset();
	};
</script>

<template>
	<Head title="Dashboard" />
	<Head title="Employee" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Dashboard
			</h2>
		</template>

		<EmployeeLayout>
			<template #header>
				<h2 class="font-semibold text-xl text-gray-800 leading-tight">
					Employees
				</h2>
			</template>

			<div class="py-12">
				<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
					<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
						<table class="table-auto">
							<thead>
								<tr>
									<th class="px-4 py-2">Avatar</th>
									<th class="px-4 py-2">Name</th>
									<th class="px-4 py-2">Role</th>
									<th class="px-4 py-2">Status</th>
									<th class="px-4 py-2">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="user in allUser" v-bind:key="user.id">
									<td class="border px-4 py-2">
										<img
											class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
											v-bind:src="user.avatar"
											alt="Bordered avatar"
										/>
									</td>
									<td class="border px-4 py-2">{{ user.name }}</td>
									<td class="border px-4 py-2">
										<div v-for="role in user.roles" v-bind:key="role.id">
											{{ role.name }} |
										</div>
									</td>
									<td class="border px-4 py-2">{{ user.approval_status }}</td>
									<td class="border px-4 py-2">
										<NavLink :href="route('user.edit', { id: user.id })">
											<PrimaryButton>Edit</PrimaryButton>
										</NavLink>
										|
										<DangerButton
											class="ml-3"
											:class="{ 'opacity-25': form.processing }"
											:disabled="form.processing"
											@click="deleteUser(user.id)"
										>
											Delete
										</DangerButton>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</EmployeeLayout>
	</AuthenticatedLayout>
</template>
