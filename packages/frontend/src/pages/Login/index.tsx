import { useNavigate } from 'react-router-dom';

import Card from '@/components/dataDisplay/Card';
import Button from '@/components/input/Button';
import TextInput from '@/components/input/TextInput';
import Box from '@/components/layout/Box';
import Stack from '@/components/layout/Stack';
import routes from '@/routes';

import { useHooks } from './hooks';
import SHADOW from './SHADOW';

const Login = () => {
	const { signUpNavigate, register, handleSubmit, onSubmit, errors } = useHooks();

	return (
		<Box sx={{
			position: 'absolute',
			top: '50%',
			left: '50%',
			transform: 'translate(-50%,-50%)'
		}}>
			<Stack>
				<Card
					sx={{
						width: 500,
						height: 325,
						radius: 4,
						border: `solid 1px #E4E5E6`,
						boxShadow: SHADOW,
						padding: '30px'
					}}
				>
					<Stack height="100%" spacing={5}>
						<TextInput
							required
							type="email"
							placeholder="Email"
							{...register('email')}
							error={'email' in errors}
							helperText={errors.email?.message}
						/>
						<TextInput
							required
							type="password"
							placeholder="Password"
							{...register('password')}
							error={'password' in errors}
							helperText={errors.password?.message}
						/>
						<Button
							color="primary"
							variant="contained"
							label="ログイン"
							size="large"
							onClick={handleSubmit(onSubmit)}
						/>
					</Stack>
				</Card>
				<Button
					label='新規登録はこちら'
					variant="outlined"
					onClick={signUpNavigate}
				/>
			</Stack>
		</Box>
	);
};

export default Login;
