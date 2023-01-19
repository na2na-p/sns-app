import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';
// import { useNavigate } from 'react-router-dom';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PostApiV1MessagesBody } from '@/generated';
// import routes from '@/routes';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const signUp = async (formData: PostApiV1MessagesBody): Promise<User> => {
	const response = await axios.post(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.messages}`,
		formData,
		{ withCredentials: true }
	);
	return response.data;
};

const useSignUp = (): UseMutationResult<
	User,
	AxiosError,
	PostApiV1MessagesBody,
	undefined
> => {
	// const queryClient = useQueryClient();
	// const navigate = useNavigate();

	return useMutation(signUp, {
		onSuccess: async () => {
			// queryClient.setQueryData(['user'], data);
		}
	});
};

export default useSignUp;
