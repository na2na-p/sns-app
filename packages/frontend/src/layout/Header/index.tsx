import { redirect, useNavigate } from 'react-router-dom';

import Typography from '@/components/dataDisplay/Typography';
import EditIcon from '@/components/icons/EditIcon';
import LogoutIcon from '@/components/icons/LogoutIcon';
import Button from '@/components/input/Button';
import Box from '@/components/layout/Box';
import Stack from '@/components/layout/Stack';
import Toolbar from '@/components/navigation/Toolbar';
import AppBar from '@/components/surfaces/AppBar';
import useLogout from '@/hooks/api/useLogout';
import useAuth from '@/hooks/useAuth';

const APP_NAME = 'sns-app';

const Header = () => {
	const { isAuthenticated } = useAuth();
	const { mutate } = useLogout();
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
								label="情報編集"
								startIcon={<EditIcon />}
							/>
							<Button
								color="inherit"
								label="ログアウト"
								startIcon={<LogoutIcon />}
								onClick={() => {
									mutate();
									history.pushState(null, '', '/');
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
