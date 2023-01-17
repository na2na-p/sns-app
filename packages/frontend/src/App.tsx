import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { useEffect } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

import Stack from '@/components/layout/Stack';
import Header from '@/layout/Header';
import routes from '@/routes';


const App = () => {
	const queryClient = new QueryClient();
	return (
		<QueryClientProvider client={queryClient}>
			<Stack>
				<Header />
				<BrowserRouter>
					<Routes>
						<Route
							path={routes.timeline.path()}
							element={routes.timeline.component} />
					</Routes>
				</BrowserRouter>
			</Stack>
		</QueryClientProvider>
	);
};

export default App;
