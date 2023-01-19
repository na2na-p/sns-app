import { useNavigate } from 'react-router-dom';

import Card from '@/components/dataDisplay/Card';
import Typography from '@/components/dataDisplay/Typography';
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
	const timelineNavigate = () => {
		navigate(routes.timeline.path());
	};
	return (
		<Box sx={{
			position: 'absolute',
			top: '50%',
			left: '50%',
			transform: 'translate(-50%,-50%)'
		}}>
			<Stack>
				<Typography variant="h4">パスワード更新</Typography>
				<Card
					sx={{
						width: 500,
						height: 350,
						radius: 4,
						border: `solid 1px #E4E5E6`,
						boxShadow: SHADOW,
						padding: '30px'
					}}
				>
					<Stack height="100%" spacing={5}>
						<TextInput
							required
							type="password"
							placeholder="現在のパスワードを入力"
							{...register('currentPassword')}
							error={'currentPassword' in errors}
							helperText={errors.password?.message}
						/>
						<TextInput
							required
							type="password"
							placeholder="新しいパスワードを入力"
							{...register('newPassword')}
							error={'newPassword' in errors}
							helperText={errors.password?.message}
						/>
						<TextInput
							required
							type="password"
							placeholder="新しいパスワードを再入力"
							{...register('newPasswordConfirmation')}
							error={'newPasswordConfirmation' in errors}
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
						onClick={timelineNavigate}
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
