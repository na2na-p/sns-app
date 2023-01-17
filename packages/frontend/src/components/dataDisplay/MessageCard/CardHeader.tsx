import type { CardHeaderProps as MuiCardHeaderProps } from '@mui/material/CardHeader';
import MuiCardHeader from '@mui/material/CardHeader';

export type CardHeaderProps = MuiCardHeaderProps;

const CardHeader = ({ children, ...rest }: CardHeaderProps) => (
	<MuiCardHeader {...rest}>
		{children}
	</MuiCardHeader>
);

export default CardHeader;
