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
							<textarea type="text" v-model="ship.description" class="form-control" :required="true"></textarea>
							<label class="">Описание</label>

						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3">
							<input type="number" v-model="ship.ordering" :required="true" class="form-control">
							<label class="">Сортировка</label>

						</div>
					</div>
					<!-- <div class="mb-3">
						
						<multiselect v-model="values" :options="categories" :multiple="true" :close-on-select="false"
							:clear-on-select="false" :preserve-search="true" placeholder="Категории кают" label="title" track-by="id"
							:preselect-first="true">
							<template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single"
									v-if="values.length" v-show="!isOpen">{{ values.length }} options selected</span></template>
						</multiselect>
					</div> -->
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
						<gallery />
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
				
					<div class="row mb-2">
						<div class="col-12 ">
							<div class="border border-primary-subtle p-2">
								<div class="mb-3">
									<label class="mb-3 pe-0 ps-0">Галерея</label>
									<div class="row" v-if="ship.gallery.length > 0" v-for="(image, index) in ship.gallery">
										<div class="col">
											<input type="text" class="form-control" v-model="this.ship.gallery[index].title"
												placeholder="Описание" aria-label="Описание">
										</div>
										<div class="col">
											<input type="number" class="form-control" v-model="this.ship.gallery[index].ordering"
												placeholder="Сортировка" aria-label="Сортировка">
										</div>
										<div class="col" v-if="this.ship.gallery[index].url">
											<img :src="this.ship.gallery[index].url" alt="" style="max-width: 150px;">
										</div>
										<div class="col ">
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
	data: function () {
		return {
			files: [],
			ship: {
				title: '',
				description: '',
				spec: [{ name: '', value: '' }],
				// categories: [],
				description: '',
				ordering: '',
				gallery: []
			}
		}
	},
	created() {
	},
	methods: {
		saveForm() {
			event.preventDefault();
			let newShip = this.ship;
			let router = this.$router;
			axios.post('/api/ships', newShip)
				.then(function (resp) {
					router.push({ path: '/' });
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not create your company");
				});
		},

		addSpec() {
			this.ship.spec.push({ name: '', value: '', ordering: 1 });

		},
		deleteSpec(index) {
			this.ship.spec.splice(index, 1);
		},
		addImage() {
			this.ship.gallery.push({ title: '', file: '', ordering: 1 });
		},
		deleteImage(index) {
			this.ship.gallery.splice(index, 1);
			this.files.splice(index, 1)
		},
		addImageUrlToGallery(file, index) {
			this.ship.gallery[index].file = file;
			this.ship.gallery[index].url = file;
		},
		addFileToGallery(event, index) {
			this.files[index] = event.target.files[0]
			let addImageUrlToGallery = this.addImageUrlToGallery;
			let formData = new FormData();
			formData.append('file', event.target.files[0]);
			axios.post('/store_file', formData)
				.then(function (response) {
					addImageUrlToGallery(response.data.file, index);
				})
				.catch(function (error) {
					console.log(error);
				});
		},
	}
}
</script>