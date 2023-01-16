import { primaryKey } from '@mswjs/data';

import type { DbType } from '@/mocks/db';
import { autoIncrement, findCreate } from '@/mocks/utils';
import commonColumns, { COMMON_DATA } from '@/mocks/utils/commonColumns';
import type { MessageArgs, MessagesArgs } from '@/types/api';
import isNil from '@/utils/isNil';
import range from '@/utils/range';

export const messagesDb = {
	Messages: {
		// 	本物のバックエンドではidはPKでUUIDv7
		id: primaryKey(autoIncrement()),
		body: String,
		userId: String, // HACK: 本物のバックエンドでは外部キー
		...commonColumns
	}
};

export const messageDbData = findCreate((db: DbType) => {
	const user = db.Users.findFirst({
		where: {
			id: {
				equals: '1'
			}
		}
	});
	return {
		messages: range(10).map((i) => {
			return db.Messages.create({
				body: `message${i}`,
				userId: user!.id
			});
		})
	};
});

export const messageHandler = (db: DbType) => {
	messageDbData(db);
	return {
		Message: ({ id }: MessageArgs) => {
			return db.Messages.findFirst({
				where: {
					id: {
						equals: id
					}
				}
			});
		},
		Messages: ({ lastMessageId, perPage = 10 }: MessagesArgs) => {
			const messages = db.Messages.findMany({});
			if (isNil(lastMessageId)) {
				return messages.slice(0, perPage);
			}
			const lastMessage = messages.find((message) => message.id === lastMessageId);
			if (isNil(lastMessage)) {
				return [];
			}
			const lastMessageIndex = messages.indexOf(lastMessage);
			return messages.slice(lastMessageIndex + 1, lastMessageIndex + perPage + 1);
		}
	};
};
