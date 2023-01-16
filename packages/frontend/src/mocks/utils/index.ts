import type { DbType } from '@/mocks/db';

type Incrementor = {
	(): string;
};
export const autoIncrement = (): Incrementor => {
	let counter = 0;
	return () => {
		return `${++counter}`;
	};
};

type Creator<Result, Args extends unknown[]> = {
	(db: DbType, ...extra: Args): Result;
};
type Decorator = {
	<Result, Args extends unknown[]>(fn: Creator<Result, Args>): Creator<
		Result,
		Args
	>;
};
export const findCreate: Decorator = (fn) => {
	const resultMap: Record<string, any> = {};
	return (db, ...rest) => {
		const key = JSON.stringify(rest);
		return resultMap[key] ? resultMap[key] : (resultMap[key] = fn(db, ...rest));
	};
};

