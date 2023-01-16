import dateFnsFormat from 'date-fns/format'; // eslint-disable-line import/no-duplicates
import ja from 'date-fns/locale/ja'; // eslint-disable-line import/no-duplicates
import dateFnsParse from 'date-fns/parse'; // eslint-disable-line import/no-duplicates

export const DATE_FORMAT = {
	YYYY_MM_DD__HH_MM_SS: 'yyyy-MM-dd HH:mm:ss'
} as const;

type Format = typeof DATE_FORMAT[keyof typeof DATE_FORMAT];

export const formatDateTime = (date: Date, format: Format) => {
	return dateFnsFormat(date, format, {
		locale: ja
	});
};

export const parse = (date: string, format: Format) => {
	return dateFnsParse(date, format, new Date());
};

export const formatDateString = (
	date: string,
	parseFormat: Format,
	formatFormat: Format
) => {
	return formatDateTime(parse(date, parseFormat), formatFormat);
};
