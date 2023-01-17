import { useQuery } from '@tanstack/react-query';

import { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const usePing = () => {
	const uri = `${getSchemeAndHost()}${BASE_URI}/ping`;
	const { data, isLoading, error } = useQuery(['ping'], async () => {
		const res = await fetch(uri, {
			method: 'GET'
		});
		return res.json();
	});
	return { data, isLoading, error };
};

export default usePing;
