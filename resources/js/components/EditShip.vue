<template>
	<div class="container">

		<div class="form-group">
			<router-link to="/" class="btn btn-secondary">Назад</router-link>
		</div>
		<div class="panel panel-default mt-3">
			<div class="panel-heading">
				<h1>Новый корабль</h1>
			</div>
			<div class="panel-body">
				<form v-on:submit="saveForm()">
					<div class="row">

						<div class="form-floating mb-3">
							<input type="text" v-model="ship.title" class="form-control" :required="true">
							<label class="">Название</label>

						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3">
							<textarea type="text" v-model="ship.description" class="form-control" :required="true" style="height: 300px;"></textarea>
							<label class="">Описание</label>

						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3">
							<input type="number" v-model="ship.ordering" :required="true" class="form-control">
							<label class="">Сортировка</label>

						</div>
					</div>

					<div class="row  mb-3">
						<div class="col-12">
							<div class="border border-primary-subtle p-2">
								<label class=" pe-0 ps-0">Спецификация</label>
								<div class="row" v-if="ship.spec.length > 0" v-for="(spec, index) in ship.spec">
									<div class="col mb-2">
										<input type="text" class="form-control" v-model="this.ship.spec[index].name" placeholder="Название"
											aria-label="Название" :required="true">
									</div>
									<div class="col">
										<input type="text" class="form-control" v-model="this.ship.spec[index].value" placeholder="Значение"
											aria-label="Значение">
									</div>
									<div class="col">
										<button class="btn btn-danger" type="button" v-on:click="deleteSpec(index)">Удалить</button>
									</div>
								</div>
								<button type="button" v-on:click="addSpec" class="btn btn-primary ms-auto" style="width: 200px;">+
									Добавить</button>
							</div>
						</div>
					</div>
					<div class="row ">
						<div class="col-12 ">
							<div class="border border-primary-subtle p-2">
								<div class="mb-3">
									<label class="mb-3 pe-0 ps-0">Галерея</label>
									<div class="row mb-3" v-if="ship.gallery.length > 0" v-for="(image, index) in ship.gallery">
										<div class="col">
											<input type="text" class="form-control" v-model="this.ship.gallery[index].title"
												placeholder="Описание" aria-label="Описание">
										</div>
										<div class="col">
											<input type="number" class="form-control" v-model="this.ship.gallery[index].ordering"
												placeholder="Сортировка" aria-label="Сортировка">
										</div>
										<div class="col">
											<img :src="this.ship.gallery[index].url" alt="" style="max-width: 150px;">
										</div>
										<div class="col mb-2">
											<input type="file" class="form-control" v-on:change="addFileToGallery($event, index)"
												placeholder="Картинка" aria-label="картинка">
										</div>
										<div class="col">
											<button class="btn btn-danger" type="button" v-on:click="deleteImage(index)">Удалить</button>
										</div>
									</div>
								</div>
								<button type="button" v-on:click="addImage" class="btn btn-primary ms-auto" style="width: 200px;">+
									Добавить</button>

							</div>
						</div>
					</div>

					<div class="form-group mt-5 mb-5">
						<router-link to="/" class="btn btn-secondary me-2">Назад</router-link>
						<button type="submit" class="btn btn-primary ">Сохранить</button>

					</div>
				</form>
			</div>
		</div>

	</div>
</template>

<script>
export default {


	mounted() {
		let app = this;
		let id = app.$route.params.id;
		app.shipId = id;
		axios.get('/api/ships/' + id)
			.then(function (resp) {
				app.ship = resp.data;
				app.ship.spec = JSON.parse(app.ship.spec)
			})
			.catch(function () {
				alert("Could not load your ship")
			});
			console.log(this.ship.spec);
	},
	data: function () {
		return {
			files: [],
			shipId: null,
			ship: {
				title: '',
				description: '',
				spec: [{ name: '', value: '' }],
				description: '',
				ordering: '',
				gallery: []
			}
		}
	},
	created() {
	},

}
</script>