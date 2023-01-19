import axios from 'axios';
import { useState } from 'react';

import StarIcon from '@/components/icons/StarIcon';
import Button from '@/components/input/Button';
import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type User from '@/types/models/User';
import getSchemeAndHost from '@/utils/getSchemeAndHost';

const FavoriteButton = ({
	count,
	isFavorited,
	messageId
}: {
	count: number;
	isFavorited: boolean;
	messageId: string;
}) => {
	const favorite = async (messageId: string): Promise<User> => {
		const response = await axios.put(
			`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.messages}/${messageId}/favorite`,
			{},
			{ withCredentials: true }
		);
		return response.data;
	};
	const [favoriteState, setFavoriteState] = useState<boolean>(isFavorited);
	const [favoriteCount, setFavoriteCount] = useState<number>(count);
	return (
		<Button
			variant="text"
			startIcon={<StarIcon variant={favoriteState ? 'filled' : 'outlined'} />}
			label={favoriteCount.toString()}
			color="primary"
			onClick={() => {
				favorite(messageId);
				// trueへの一方通行
				// favoriteStateが初期
				setFavoriteState(favoriteState === isFavorited ? true : favoriteState);
				setFavoriteCount(favoriteCount === count ? count + 1 : favoriteCount);
			}}
		/>
	);
};

export default FavoriteButton;
