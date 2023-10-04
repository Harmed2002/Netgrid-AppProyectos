import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import VistaLogin from '../views/LoginView.vue'
import AppLayout from '@/layout/AppLayout.vue';
import Usuario from '@/views/admin/Usuario.vue';

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: '/login',
			name: 'login',
			component: VistaLogin,
			meta: {redirectIfAuth: true}
		},
		{
			path: '/',
			component: AppLayout,
			children: [
				{
					path: '/',
					name: 'home',
					component: HomeView,
					meta: {requireAuth: true}
				},

				{
					path: 'about',
					name: 'about',
					// route level code-splitting
					// this generates a separate chunk (About.[hash].js) for this route
					// which is lazy-loaded when the route is visited.
					component: () => import('../views/AboutView.vue'),
					meta: {requireAuth: true}
				},

				{
					path: 'usuario',
					name: 'Usuario',
					component: Usuario,
					meta: {requireAuth: true}
				},

				{
					path: 'project',
					name: 'Project',
					// route level code-splitting
					// this generates a separate chunk (About.[hash].js) for this route
					// which is lazy-loaded when the route is visited.
					component: () => import('../views/ProjectView.vue'),
					meta: {requireAuth: true}
				},

				{
					path: 'task',
					name: 'Task',
					// route level code-splitting
					// this generates a separate chunk (About.[hash].js) for this route
					// which is lazy-loaded when the route is visited.
					component: () => import('../views/TaskView.vue'),
					meta: {requireAuth: true}
				},
			]
		}
	]
})

// Guard (Bloquea el flujo y, si pasa la validación, deja seguir con next)
router.beforeEach((to, from, next) => {
	let token = localStorage.getItem("access_token");

	//console.log(to);

	// Verifico si requiere autorización
	if (to.meta.requireAuth) {
		if (!token)
			return next({name: 'login'});
		
		return next();
	}

	// Si redirectIfAuth es true y existe el token
	if (to.meta.redirectIfAuth && token) {
		return next({name: 'about'})
	}

	return next();
})

export default router
