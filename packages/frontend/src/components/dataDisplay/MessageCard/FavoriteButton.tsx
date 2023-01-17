import StarIcon from '@/components/icons/StarIcon';
import Button from '@/components/input/Button';

const FavoriteButton = ({
	count,
	isFavorited
}: {
	count: number,
	isFavorited: boolean,
}) => {
	return (
		<Button
			variant="text"
			startIcon={<StarIcon
				variant={isFavorited ? 'filled' : 'outlined'}
			/>}
			label={count.toString()}
			color='primary'
		/>
	);
};

export default FavoriteButton;
