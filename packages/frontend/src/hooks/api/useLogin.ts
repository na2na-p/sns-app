import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PostApiV1LoginBody } from '@/generated';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const login = async (formData: PostApiV1LoginBody): Promise<User> => {
	const _ = await axios.post(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.login}`,
		formData,
		{ withCredentials: true }
	);
	const { data } = await axios.get(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}/me`,
		{ withCredentials: true }
	);
	return data;
};

const useLogin = (): UseMutationResult<
	User,
	AxiosError,
	PostApiV1LoginBody,
	undefined
> => {
	const queryClient = useQueryClient();

	return useMutation(login, {
		onSuccess: (data) => {
			queryClient.setQueryData(['user'], data);
			// navigation('/');
			location.reload();
		}
	});
};

export default useLogin;
