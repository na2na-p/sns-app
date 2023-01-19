import { Navigate } from 'react-router-dom';

import { useAuth } from '@/hooks/useAuth';

import routes from '.';

type AuthRouterProps = {
	children: React.ReactNode;
};

export const PrivateRoute = ({ children }: AuthRouterProps) => {
	const check = useAuth();

	if (!check.checked) {
		return <div>Loading...</div>;
	}

	if (check.isAuthenticated) {
		return <>{children}</>;
	}

	return <Navigate to={routes.login.path()} />;
};

export const GuestRoute = (props: AuthRouterProps) => {
	const { children } = props;
	const check = useAuth();

	if (!check.checked) {
		return <div>Loading...</div>;
	}

	if (check.isAuthenticated) {
		return <Navigate to={routes.timeline.path()} />;
	}

	return <>{children}</>;
};
