import Ships from './components/Ships.vue';
import CreateShip from './components/CreateShip.vue';
import EditShip  from './components/EditShip.vue';
import Categories  from './components/Categories.vue';
import EditCategory from './components/EditCategory.vue';

const routes = [
	{
			name: 'home',
			path: '/',
			component: Ships
	},
	{
			name: 'create_ship',
			path: '/ships/create',
			component: CreateShip
	},
	{
			name: 'edit',
			path: '/edit/ships/:id',
			component: EditShip
	},
	{
		name: 'categories',
		path: '/categories',
		component: Categories
	},
	{
		name: 'category_edit',
		path: '/categories/edit/:id',
		component: EditCategory
	},
	{
		name: 'create_category',
		path: '/categories/create',
		component: EditCategory
	}
];

export default routes;