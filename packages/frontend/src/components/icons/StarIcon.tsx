import MuiStarIcon from '@mui/icons-material/Star';
import MuiStarBorderOutlinedIcon from '@mui/icons-material/StarBorderOutlined';

const StarIcon = ({ variant='outlined' }: {variant: 'filled' | 'outlined'}) => {
	if (variant === 'filled') {
		return <MuiStarIcon />;
	}
	return <MuiStarBorderOutlinedIcon />;
};

export default StarIcon;
