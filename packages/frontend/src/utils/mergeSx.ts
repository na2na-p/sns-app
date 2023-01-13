import type { SxProps, Theme } from '@mui/material';
import type { SystemStyleObject } from '@mui/system';
import merge from 'lodash/merge';

const mergeObjects = (...source: any[]) => merge({}, ...source);

const mergeSx =
	(
		...source: Array<SxProps<Theme> | null | undefined>
	): ((theme: Theme) => SystemStyleObject<Theme>) =>
		(theme: Theme) =>
			mergeObjects(
				{},
				...source.map((sx) => (typeof sx === 'function' ? sx(theme) : sx))
			);

export default mergeSx;
