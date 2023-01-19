import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';

import { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const logout = async (): Promise<[]> => {
	const { data } = await axios.post(
		`${getSchemeAndHost()}${BASE_URI}/logout`,
		{},
		{ withCredentials: true }
	);
	return data;
};

const useLogout = (): UseMutationResult<[], AxiosError, void, undefined> => {
	const queryClient = useQueryClient();

	return useMutation(logout, {
		onSuccess: () => {
			queryClient.resetQueries(['user']);
			location.reload();
		}
	});
};

export default useLogout;
