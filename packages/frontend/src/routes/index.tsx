import Login from '@/pages/Login';
import Timeline from '@/pages/Timeline';
import kebabCase from '@/utils/kebabCase';

type Routes = {
	path: () => string;
	component: JSX.Element;
}

type Pages = 'login' | 'timeline' | 'signUp' | 'passwordUpdate' | 'userInfoUpdate';
const routes =
	{
		timeline: {
			path: () => '/',
			component: <Timeline />
		},
		login: {
			path: () => '/login',
			component: <Login />
		},
		signUp: {
			path: () => `/${kebabCase('signUp')}`,
			component: <></>
		},
		passwordUpdate: {
			path: () => `/users/:userId/password`,
			component: <></>
		},
		userInfoUpdate: {
			path: () => `/user/:userId/edit`,
			component: <></>
		}
	} as const satisfies {
		[P in Pages]: Routes;
	};

export default routes;
