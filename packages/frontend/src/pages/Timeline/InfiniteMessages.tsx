/* eslint-disable react/jsx-key */
import MessageCard from '@components/dataDisplay/MessageCard/';
import axios from 'axios';
import { useCallback, useEffect, useState } from 'react';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type Message from '@/types/models/Message';
import getSchemeAndHost from '@/utils/getSchemeAndHost';
import uniqBy from '@/utils/uniqBy';


const sleep = (sec: number) => new Promise((resolve) => setTimeout(resolve, sec * 1000));

const InfiniteMessages = () => {
	const [messages, setMessages] = useState<Message[]>([]);
	const [hasMore, setHasMore] = useState(true);
	const [lastMessageId, setLastMessageId] = useState<Message['id']>();

	const loadMessages = useCallback(async (lastMessageId?: Message['id']) => {
		if (hasMore === false) return;
		const URL = `${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.messages}${lastMessageId ? `?lastMessageId=${lastMessageId}` : ''}`;

		await sleep(1.0);
		const response = await axios.get(URL, {
			withCredentials: true
		});
		const messagesData = response.data as Message[];
		const count = messagesData.length;
		// messagesDataのidの中で一番小さいものを取得
		setLastMessageId(messagesData.reduce((prev, current) => {
			return prev.id < current.id ? prev : current;
		}).id);


		// message.idが重複しないようにsetMessagesを使う
		setMessages(uniqBy([...messages, ...messagesData], 'id'));

		setHasMore(count > 0); // ← ⑧
	}, [hasMore, messages]);

	useEffect(() => {
		loadMessages(lastMessageId);
	}, [lastMessageId, loadMessages]);

	return (
		<>
			{messages.length > 0 &&
				messages.map((message) => (
					<MessageCard
						key={message.id}
						id={message.id}
						userName={message.user_id}
						created_at={new Date(message.created_at)}
						body={message.body}
						favoriteCount={message.favoritesCount}
						isFavorited={message.isFavorite}
					/>
				))
			}
		</>
	);
};

export default InfiniteMessages;
