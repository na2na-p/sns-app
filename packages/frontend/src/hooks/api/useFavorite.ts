import type { UseMutationResult } from '@tanstack/react-query';
import { useMutation } from '@tanstack/react-query';
import type { AxiosError } from 'axios';
import axios from 'axios';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const favorite = async (messageId: string): Promise<User> => {
	const response = await axios.put(
		`${getSchemeAndHost()}${BASE_URI}${
			ENDPOINTS_BASE.messages
		}/${messageId}/favorite`,
		{},
		{ withCredentials: true }
	);
	return response.data;
};

const useFavorite = (
	messageId: string
): UseMutationResult<User, AxiosError, unknown, undefined> => {
	return useMutation(() => favorite(messageId));
};

export default useFavorite;
