import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

import Stack from '@/components/layout/Stack';
import Header from '@/layout/Header';
import routes from '@/routes';
import { GuestRoute, PrivateRoute } from '@/routes/AuthRouter';

const App = () => {
	const queryClient = new QueryClient();
	return (
		<QueryClientProvider client={queryClient}>
			<Stack
				sx={{
					height: '100vh'
				}}
			>
				<BrowserRouter>
					<Header />
					<Routes>
						<Route
							path={routes.login.path()}
							element={<GuestRoute>{routes.login.component}</GuestRoute>}
						/>
						<Route
							path={routes.signUp.path()}
							element={<GuestRoute>{routes.signUp.component}</GuestRoute>}
						/>
						<Route
							path={routes.passwordUpdate.path()}
							element={<PrivateRoute>{routes.passwordUpdate.component}</PrivateRoute>}
						/>
						<Route
							path={routes.userInfoUpdate.path()}
							element={<PrivateRoute>{routes.userInfoUpdate.component}</PrivateRoute>}
						/>
						<Route
							path={routes.timeline.path()}
							element={<PrivateRoute>{routes.timeline.component}</PrivateRoute>}
						/>
						{/* 該当がなければtimelineへ */}
						<Route
							path="*"
							element={<PrivateRoute>{routes.timeline.component}</PrivateRoute>}
						/>
					</Routes>
				</BrowserRouter>
			</Stack>
		</QueryClientProvider>
	);
};

export default App;
