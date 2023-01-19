import type { AppBarProps as MuiAppBarProps } from '@mui/material/AppBar';
import MuiAppBar from '@mui/material/AppBar';

export type AppBarProps = MuiAppBarProps;

const AppBar = ({ children, ...rest }: AppBarProps) => (
	<MuiAppBar {...rest}>{children}</MuiAppBar>
);

export default AppBar;
