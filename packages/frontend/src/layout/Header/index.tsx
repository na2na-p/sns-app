import { useNavigate } from 'react-router-dom';

import Typography from '@/components/dataDisplay/Typography';
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
					<Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
						{APP_NAME}
					</Typography>
					{isAuthenticated && (
						<Stack direction="row">
							<Button
								color="inherit"
								label="パスワード変更"
								startIcon={<KeyIcon />}
								onClick={() => {
									// history.pushState(null, '', routes.userInfoUpdate.path());
									navigate(routes.passwordUpdate.path());
								}}
							/>
							<Button
								color="inherit"
								label="情報編集"
								startIcon={<EditIcon />}
								onClick={() => {
									// history.pushState(null, '', routes.userInfoUpdate.path());
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
