import { primaryKey } from '@mswjs/data';

import type { DbType } from '@/mocks/db';
import { autoIncrement, findCreate } from '@/mocks/utils';
import commonColumns, { COMMON_DATA } from '@/mocks/utils/commonColumns';
import type { CreateUserArgs, UpdateUserArgs, UpdateUserPasswordArgs, UserArgs } from '@/types/api';
import isNil from '@/utils/isNil';

export const usersDb = {
	Users: {
		// 	本物のバックエンドではidはPKでUUIDv7
		id: primaryKey(autoIncrement()),
		name: COMMON_DATA.name,
		email: COMMON_DATA.email,
		password: COMMON_DATA.password,
		...commonColumns
	}
};

export const userDbData = findCreate((db: DbType) => {
	return {
		testUser: db.Users.create({
			name: 'testUser'
		})
	};
});

export const userHandler = (db: DbType) => {
	userDbData(db);
	return {
		User: ({ id }: UserArgs)=>{
			return db.Users.findFirst({
				where: {
					id: {
						equals: id
					}
				}
			});
		},
		userFindByEmail: ({ email, password }: {email: string, password?: string}) => {
			const user = db.Users.findFirst(
				{
					where: {
						email: {
							equals: email
						}
					}
				}
			);
			if (isNil(user)) {
				return null;
			}
			return {
				isAuthenticated: user.password === password,
				user
			};
		},
		createUser: (args: CreateUserArgs) => {
			return db.Users.create({
				created_at: new Date().toISOString(),
				updated_at: new Date().toISOString(),
				...args
			});
		},
		updateUser: (args: UpdateUserArgs, id: string) => {
			return db.Users.update({
				where: {
					id: {
						equals: id
					}
				},
				data: {
					...args
				}
			});
		},
		passwordUpdate: (args: UpdateUserPasswordArgs, id: string) => {
			return db.Users.update({
				where: {
					id: {
						equals: id
					}
				},
				data: {
					...args
				}
			});
		}
	};
};
