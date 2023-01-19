import { yupResolver } from '@hookform/resolvers/yup';
import axios from 'axios';
import type { Dispatch, SetStateAction } from 'react';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';


import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import type { PostApiV1MessagesBody } from '@/generated/';
import useMessageCreate from '@/hooks/api/useMessageCreate';
import type Message from '@/types/models/Message';
import getSchemeAndHost from '@/utils/getSchemeAndHost';
import uniqBy from '@/utils/uniqBy';

type UseHooksType = {
	handleClose: () => void;
	messages: Message[];
	setMessages: Dispatch<SetStateAction<Message[]>>;
}

export const useHooks = ({ handleClose, messages, setMessages }: UseHooksType) => {
	const schema = yup.object({
		message: yup.string().max(140, '140文字以下で入力してください。')
	});

	const {
		register,
		handleSubmit,
		formState: { errors, isValid }
	} = useForm<PostApiV1MessagesBody>({
		resolver: yupResolver(schema)
	});

	const refetch = async () => {
		await new Promise((resolve) => setTimeout(resolve, 200));
		const response = await axios.get(`${getSchemeAndHost()}${BASE_URI}${ENDPOINTS_BASE.messages}`, {
			withCredentials: true
		});

		const responseMessagesData = response.data as Message[];

		// string型のid逆順にソート
		setMessages(uniqBy([...responseMessagesData, ...messages], 'id').sort((a, b) => {
			if (a.id < b.id) return 1;
			if (a.id > b.id) return -1;
			return 0;
		}));
	};

	const { mutate } = useMessageCreate();
	const onSubmit: SubmitHandler<PostApiV1MessagesBody> = (data) => {
		mutate(data);
		refetch();
		handleClose();
	};

	return {
		register,
		handleSubmit,
		onSubmit,
		errors,
		isValid
	};
};
