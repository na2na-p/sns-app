import { SpeedDialAction, SpeedDialIcon } from '@mui/material';

import ScrollContainer from '@/components/dataDisplay/ScrollContainer';
import Typography from '@/components/dataDisplay/Typography';
import EditIcon from '@/components/icons/EditIcon';
import Stack from '@/components/layout/Stack';
import SpeedDial from '@/components/navigation/SpeedDial';
import GrayContainer from '@/layout/GrayContainer';

import InfiniteMessages from './InfiniteMessages';

const Timeline = () => {
	return (
		<>
			<SpeedDial
				ariaLabel="Menu"
				icon={<SpeedDialIcon />}
				sx={{
					position: 'fixed',
					right: 50,
					bottom: 50
				}}>
				<SpeedDialAction
					key={'openModal'}
					icon={<EditIcon />}
					tooltipTitle="投稿する"
				/>
			</SpeedDial>
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
		</>
	);
};

export default Timeline;
