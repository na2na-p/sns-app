import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PutApiV1MessagesMessageIdFavoriteBody } from '@/generated';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const favorite = async (formData: PutApiV1MessagesMessageIdFavoriteBody, messageId: string): Promise<User> => {
	const response = await axios.put(
		`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.messages}/${messageId}/favorite`,
		formData,
		{ withCredentials: true }
	);
	return response.data;
};

const useFavorite = (messageId: string): UseMutationResult<
	User,
	AxiosError,
	PutApiV1MessagesMessageIdFavoriteBody,
	undefined
> => {
	const queryClient = useQueryClient();

	return useMutation((formData: PutApiV1MessagesMessageIdFavoriteBody) => favorite(formData, messageId), {
		onSuccess: (data) => {
			queryClient.setQueryData(['user'], data);
			// navigation('/');
			location.reload();
		}
	});
};

export default useFavorite;
