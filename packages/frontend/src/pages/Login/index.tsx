import Card from '@/components/dataDisplay/Card';
import Button from '@/components/input/Button';
import TextInput from '@/components/input/TextInput';
import Stack from '@/components/layout/Stack';
import { usePostApiV1Login } from '@/generated/default/default';

import { Attempt } from './Attempt';
import { useHooks } from './hooks';
import SHADOW from './SHADOW';

const Login = () => {
	const {
		isAttempted,
		formData,
		register,
		handleSubmit,
		onSubmit,
		errors
	} = useHooks();
	return (
		<Card
			sx={{
				width: 500,
				height: 250,
				radius: 4,
				border: `solid 1px #E4E5E6`,
				boxShadow: SHADOW,
				padding: '30px',
				position: 'absolute',
				top: '50%',
				left: '50%',
				transform: 'translate(-50%,-50%)'
			}}
		>
			<Stack>
				<TextInput
					required
					type='email'
					placeholder='Email'
					{...register('email')}
					error={'email' in errors}
					helperText={errors.email?.message}
				/>
				<TextInput
					required
					type='password'
					placeholder='Password'
					{...register('password')}
					error={'password' in errors}
					helperText={errors.password?.message}
				/>
				<Button
					color='primary'
					variant='contained'
					label='ログイン'
					size='large'
					onClick={handleSubmit(onSubmit)}
				/>
			</Stack>

		</Card>
	);
};

export default Login;
