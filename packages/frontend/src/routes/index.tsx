import Login from '@/pages/Login';
import PasswordUpdate from '@/pages/PasswordUpdate';
import SignUp from '@/pages/SignUp';
import Timeline from '@/pages/Timeline';
import UserInfoUpdate from '@/pages/UserInfoUpdate';
import kebabCase from '@/utils/kebabCase';

type Routes = {
	path: () => string;
	component: JSX.Element;
};

type Pages =
	| 'login'
	| 'timeline'
	| 'signUp'
	| 'passwordUpdate'
	| 'userInfoUpdate';
const routes = {
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
		component: <SignUp />
	},
	passwordUpdate: {
		path: () => `/users/me/password`,
		component: <PasswordUpdate />
	},
	userInfoUpdate: {
		path: () => `/user/me/edit`,
		component: <UserInfoUpdate />
	}
} as const satisfies {
	[P in Pages]: Routes;
};

export default routes;
