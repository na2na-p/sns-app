import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PostApiV1UsersBody } from '@/generated';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const signUp = async (formData: PostApiV1UsersBody): Promise<User> => {
	const response = await axios.post(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.users}`,
		formData,
		{ withCredentials: true }
	);
	return response.data;
};

const useSignUp = (): UseMutationResult<
	User,
	AxiosError,
	PostApiV1UsersBody,
	undefined
> => {
	const queryClient = useQueryClient();

	return useMutation(signUp, {
		onSuccess: (data) => {
			queryClient.setQueryData(['user'], data);
			// navigation('/');
			location.reload();
		}
	});
};

export default useSignUp;