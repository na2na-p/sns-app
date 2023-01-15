import { DATE_FORMAT, formatDateTime } from '@/utils/formatDate';

export const COMMON_DATA = {
	dateTime: (sampleDate: string = '2022/1/1 12:34:56') =>
		formatDateTime(
			new Date(sampleDate),
			DATE_FORMAT.YYYY_MM_DD__HH_MM_SS
		),
	email: () => 'foo@example.com',
	name: () => 'Hoge太郎',
	password: () => 'p@sswOrd'
};

const commonColumns = {
	created_at: COMMON_DATA.dateTime,
	updated_at: COMMON_DATA.dateTime
};

export default commonColumns;
