import React from 'react';

import Login from '@/pages/Login';

type routes = {
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
		[P in Pages]: routes;
	};

export default routes;
