import { useNavigate } from 'react-router-dom';

import Card from '@/components/dataDisplay/Card';
import Button from '@/components/input/Button';
import TextInput from '@/components/input/TextInput';
import Box from '@/components/layout/Box';
import Stack from '@/components/layout/Stack';
import SHADOW from '@/constants/SHADOW';
import routes from '@/routes';

import { useHooks } from './hooks';

const SignUp = () => {
	const { register, handleSubmit, onSubmit, errors } = useHooks();
	const navigate = useNavigate();
	const loginNavigate = () => {
		navigate(routes.login.path());
	};
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
						height: 500,
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
							placeholder="メールアドレスを入力"
							{...register('email')}
							error={'email' in errors}
							helperText={errors.email?.message}
						/>
						<TextInput
							required
							type='text'
							placeholder="ニックネームを入力"
							{...register('name')}
							error={'Nickname' in errors}
							helperText={errors.email?.message}
						/>
						<TextInput
							required
							type="password"
							placeholder="パスワードを入力"
							{...register('password')}
							error={'password' in errors}
							helperText={errors.password?.message}
						/>
						<TextInput
							required
							type="password"
							placeholder="パスワードを再入力"
							{...register('passwordConfirm')}
							error={'passwordConfirm' in errors}
							helperText={errors.password?.message}
						/>
					</Stack>
				</Card>
				<Stack direction="row" width='100%' sx={{
					justifyContent: 'space-between'
				}}>
					<Button
						label='戻る'
						variant="outlined"
						onClick={loginNavigate}
						sx={{
							width: '100%'
						}}
					/>
					<Button
						label='登録する'
						variant="contained"
						onClick={handleSubmit(onSubmit)}
						sx={{
							width: '100%'
						}}
					/>
				</Stack>
			</Stack>
		</Box>
	);
};

export default SignUp;
