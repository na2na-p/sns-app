import { yupResolver } from '@hookform/resolvers/yup';
import type { SubmitHandler } from 'react-hook-form';
import { useForm } from 'react-hook-form';
import * as yup from 'yup';

import type { PutApiV1UsersMePasswordBody } from '@/generated/';
import useUserPasswordUpdate from '@/hooks/api/useUserPasswordUpdate';

type PasswordUpdateForm = {
	currentPassword: string;
	newPassword: string;
	newPasswordConfirmation: string;
};

export const useHooks = () => {
	const schema = yup.object({
		currentPassword: yup
			.string()
			.required('この項目は必須です。')
			.min(8, '8文字以上で入力してください。')
			.max(32, '32文字以下で入力してください。'),
		newPassword: yup
			.string()
			.required('この項目は必須です。')
			.min(8, '8文字以上で入力してください。')
			.max(32, '32文字以下で入力してください。'),
		newPasswordConfirmation: yup
			.string()
			.required('この項目は必須です。')
			.min(8, '8文字以上で入力してください。')
			.max(32, '32文字以下で入力してください。')
			.oneOf([yup.ref('newPassword')], 'パスワードが一致しません。')

	});
	const {
		register,
		handleSubmit,
		formState: { errors }
	} = useForm<PasswordUpdateForm>({
		resolver: yupResolver(schema)
	});
	const { mutate } = useUserPasswordUpdate();
	const onSubmit: SubmitHandler<PutApiV1UsersMePasswordBody> = (data) => {
		mutate({
			currentPassword: data.currentPassword,
			newPassword: data.newPassword
		} satisfies PutApiV1UsersMePasswordBody);
	};

	return {
		register,
		handleSubmit,
		onSubmit,
		errors
	};
};
