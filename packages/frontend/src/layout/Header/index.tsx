import Typography from '@/components/dataDisplay/Typography';
import EditIcon from '@/components/icons/EditIcon';
import LogoutIcon from '@/components/icons/LogoutIcon';
import Button from '@/components/input/Button';
import Box from '@/components/layout/Box';
import Stack from '@/components/layout/Stack';
import Toolbar from '@/components/navigation/Toolbar';
import AppBar from '@/components/surfaces/AppBar';

const APP_NAME = 'sns-app';

const Header = () => {
	return (
		<Box sx={{ flexGrow: 1 }}>
			<AppBar position="static">
				<Toolbar>
					<Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
						{APP_NAME}
					</Typography>
					{/* TODO: ログアウト時はボタン類全て非表示 */}
					<Stack direction='row'>
						<Button color='inherit' label='情報編集' startIcon={<EditIcon />} />
						<Button color='inherit' label='ログアウト' startIcon={<LogoutIcon />} />
					</Stack>
				</Toolbar>
			</AppBar>
		</Box>
	);
};

export default Header;
