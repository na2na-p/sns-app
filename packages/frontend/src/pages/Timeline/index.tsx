import ScrollContainer from '@/components/dataDisplay/ScrollContainer';
import Typography from '@/components/dataDisplay/Typography';
import Stack from '@/components/layout/Stack';
import GrayContainer from '@/layout/GrayContainer';

import InfiniteMessages from './InfiniteMessages';

const Timeline = () => {
	return (
		<Stack
			spacing={0}
			height="100%"
			sx={{
				minHeight: 0
			}}
		>
			<Typography variant="h4">タイムライン</Typography>
			<GrayContainer width="100%" height="100%">
				<ScrollContainer>
					<Stack spacing={2}>
						<InfiniteMessages />
					</Stack>
				</ScrollContainer>
			</GrayContainer>
		</Stack>
	);
};

export default Timeline;
