import Typography from '@/components/dataDisplay/Typography';
import Box from '@/components/layout/Box';
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
				</Toolbar>
			</AppBar>
		</Box>
	);
};

export default Header;
