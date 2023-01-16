import { factory } from '@mswjs/data';

import { favoriteDb } from '@/mocks/parts/favorites';
import { messagesDb } from '@/mocks/parts/messages';
import { usersDb } from '@/mocks/parts/users';

export const db = factory({
	...usersDb,
	...messagesDb,
	...favoriteDb
});

export type DbType = typeof db;
