import { factory } from '@mswjs/data';

import { usersDb } from '@/mocks/parts/users';

export const db = factory({
	...usersDb
});

export type DbType = typeof db;
