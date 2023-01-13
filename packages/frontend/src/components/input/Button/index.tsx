import type { ButtonProps } from '@mui/material/Button';
import MuiButton from '@mui/material/Button';

export type { ButtonProps };

const Button = ({ label, ...props }: ButtonProps & {
	label: string;
}) => (
	<MuiButton {...props}>
		{label}
	</MuiButton>
);

export default Button;
