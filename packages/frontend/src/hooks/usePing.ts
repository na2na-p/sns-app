import { useQuery } from '@tanstack/react-query';

import { BASE_URI } from '@/constants/ENDPOINTS_BASE';

const usePing = () => {
	const uri = `${BASE_URI}/ping`;
	const { data, isLoading, error } = useQuery(['ping'], async () => {
		const res = await fetch(uri);
		return res.json();
	});
	return { data, isLoading, error };
};

export default usePing;
