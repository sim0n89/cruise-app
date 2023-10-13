<template>
	<div class="container-fluid">
		<div>
			<h2 class="text-center">Список кораблей</h2>
			<router-link :to="{ name: 'create_ship' }" class="btn btn-secondary">Создать корабль</router-link>

			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">Изображения</th>
						<th scope="col">Название</th>
						<th scope="col">Категории</th>
						<th scope="col"> Спецификация</th>
						<th scope="col">Описание</th>
						<th scope="col">Действия</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="ship in ships" :key="ship.id">
						<td style="width: 400px;">
							<div class="d-flex flex-wrap">
								<img v-for="img in ship.gallery" v-bind:src=img.url class='img-fluid' style="max-width: 150px;">
							</div>
						</td>
						<td>{{ ship.title }}</td>
						
						<td>
							<div class="d-flex flex-wrap">
								<span v-for="cat in ship.category" class="badge bg-secondary mb-1 me-2">{{ cat.title }}</span>
							</div>
						</td>
						<td>
							<ul>
								<li v-for="spec in JSON.parse(ship.spec)">
									<b>{{ spec.name }}</b>: {{ spec.value }}
								</li>
							</ul>
						</td>
						<td v-html="ship.description"></td>
						<td>
							<div class="btn-group" role="group">
								<router-link :to="{ name: 'edit', params: { id: ship.id } }" class="btn btn-success">Edit</router-link>
								<button class="btn btn-danger" @click="deleteShip(ship.id)">Delete</button>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>

export default {
	data() {
		return {
			ships: []
		}
	},
	created() {
		axios
			.get('/api/ships/')
			.then(response => {
				this.ships = response.data;
			});
	},
	methods: {
		deleteShip(id) {
			axios 
				.delete(`/api/ships/`+id)
				.then(response => {
					let i = this.ships.map(data => data.id).indexOf(id);
					this.ships.splice(i, 1)
				});
		}
	}
}
</script>