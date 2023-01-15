type Phantomic<T, U extends string> = T & { [key in U]: never };
export type Iso8601 = Phantomic<string, 'Iso8601'>;

const isoPattern = /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d{3}Z$/;
export const iso8601 = (str: String) => {
	if (!str.match(isoPattern)) {
		throw new Error('not ISO8601');
	}
	return str as Iso8601;
};

export default iso8601;
