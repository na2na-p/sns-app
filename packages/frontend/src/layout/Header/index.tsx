import { useNavigate } from 'react-router-dom';

import EditIcon from '@/components/icons/EditIcon';
import KeyIcon from '@/components/icons/KeyIcon';
import LogoutIcon from '@/components/icons/LogoutIcon';
import Button from '@/components/input/Button';
import Box from '@/components/layout/Box';
import Stack from '@/components/layout/Stack';
import Toolbar from '@/components/navigation/Toolbar';
import AppBar from '@/components/surfaces/AppBar';
import useLogout from '@/hooks/api/useLogout';
import useAuth from '@/hooks/useAuth';
import routes from '@/routes';

const APP_NAME = 'sns-app';

const Header = () => {
	const { isAuthenticated } = useAuth();
	const { mutate } = useLogout();
	const navigate = useNavigate();
	return (
		<Box>
			<AppBar position="static">
				<Toolbar>
					<Box
						sx={{
							flexGrow: 1
						}}
					>
						<Button
							color="inherit"
							label={APP_NAME}
							onClick={() => {
								navigate(routes.timeline.path());
							}}
						/>
					</Box>
					{isAuthenticated && (
						<Stack direction="row">
							<Button
								color="inherit"
								label="パスワード変更"
								startIcon={<KeyIcon />}
								onClick={() => {
									navigate(routes.passwordUpdate.path());
								}}
							/>
							<Button
								color="inherit"
								label="情報編集"
								startIcon={<EditIcon />}
								onClick={() => {
									navigate(routes.userInfoUpdate.path());
								}}
							/>
							<Button
								color="inherit"
								label="ログアウト"
								startIcon={<LogoutIcon />}
								onClick={() => {
									mutate();
									navigate(routes.login.path());
								}}
							/>
						</Stack>
					)}
				</Toolbar>
			</AppBar>
		</Box>
	);
};

export default Header;
