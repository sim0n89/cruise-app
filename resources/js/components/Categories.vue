<template>
	<div>
		<h2 class="text-center">Categories</h2>
		<div class="d-flex justify-content-end">
			<router-link to="/categories/create" сlass="btn btn-primary">Добавить категорию</router-link>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Image</th>
					<th scope="col">Type</th>
					<th scope="col">Description</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="category in categories" :key="category.id">
				
					<td>{{ category.title }}</td>
					<td>
							<div class="d-flex flex-wrap">
								<img v-for="photo in JSON.parse(category.photos)" :src="photo" class="img-fluid" style="max-width: 300px;">
							</div>
					</td>
					<td style="width: 200px;">
						{{ category.type }}
					</td>
					<td v-html="category.description">
					</td>
					<td>
						<div class="btn-group" role="group">
							<router-link :to="{ name: 'category_edit', params: { id: category.id } }" class="btn btn-success">Edit</router-link>
							<button class="btn btn-danger" @click="deleteCategory(ship.id)">Delete</button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import axios from 'axios';

export default {
	data() {
		return {
			categories: []
		}
	},
	created() {
		axios
			.get('/api/categories/')
			.then(response => {
				this.categories = response.data;
			});
	},
	methods: {
		deleteCategory(id) {
			this.axios
				.delete(`/api/category/delete/${id}`)
				.then(response => {
					let i = this.ships.map(data => data.id).indexOf(id);
					this.ships.splice(i, 1)
				});
		}
	}
}
</script>