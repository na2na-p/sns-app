import React from 'react';

import Login from '@/pages/Login';

type Routes = {
	path: () => string;
	component: JSX.Element;
}

type Pages = 'login';
const routes =
	{
		login: {
			path: () => '/',
			component: <Login />
		}
	} as const satisfies {
		[P in Pages]: Routes;
	};

export default routes;
