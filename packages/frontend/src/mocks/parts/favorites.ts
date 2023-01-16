import { primaryKey } from '@mswjs/data';

import type { DbType } from '@/mocks/db';
import { autoIncrement, findCreate } from '@/mocks/utils';
import commonColumns from '@/mocks/utils/commonColumns';
import isNil from '@/utils/isNil';

export const favoriteDb = {
	Favorites: {
		// 	本物のバックエンドではidはPKでUUIDv7
		id: primaryKey(autoIncrement()),
		userId: String, // HACK: 本物のバックエンドでは外部キー
		messageId: String, // HACK: 本物のバックエンドでは外部キー
		...commonColumns
	}
};

export const favoriteDbData = findCreate((db: DbType) => {
	return {
		favorites: {}
	};
});

export const favoriteHandler = (db: DbType) => {
	favoriteDbData(db);
	return {
		switchFavorite: ({ messageId, userId }: {messageId: string, userId: string}) => {
			const favorite = db.Favorites.findFirst({
				where: {
					userId: {
						equals: userId
					},
					messageId: {
						equals: messageId
					}
				}
			});
			if (isNil(favorite)) {
				return db.Favorites.create({
					userId,
					messageId
				});
			}
			db.Favorites.delete({
				where: {
					userId: {
						equals: userId
					},
					messageId: {
						equals: messageId
					}
				}
			});
			return null;
		}
	};
};
