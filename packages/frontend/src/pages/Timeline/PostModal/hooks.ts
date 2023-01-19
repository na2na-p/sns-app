import { yupResolver } from '@hookform/resolvers/yup';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';

import type { PostApiV1MessagesBody } from '@/generated/';
import useMessageCreate from '@/hooks/api/useMessageCreate';

export const useHooks = ({ handleClose }: { handleClose: () => void }) => {
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

	const { mutate } = useMessageCreate();
	const onSubmit: SubmitHandler<PostApiV1MessagesBody> = (data) => {
		mutate(data);
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
