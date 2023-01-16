import { rest } from 'msw';

import ENDPOINTS_BASE, { BASE_URI } from '@/constants/ENDPOINTS_BASE';
import { db } from '@/mocks/db';
import { favoriteHandler } from '@/mocks/parts/favorites';
import { messageHandler } from '@/mocks/parts/messages';
import { userHandler }	from '@/mocks/parts/users';
import type { CreateUserReturnType } from '@/types/api';
import isNil from '@/utils/isNil';


const handler = {
	...userHandler(db),
	...messageHandler(db),
	...favoriteHandler(db)
};

const handlers = [
	rest.get(`${BASE_URI}/ping`, (req, res, ctx) => {
		return res(ctx.json({ message: 'pong' }));
	}),
	rest.post(`${BASE_URI}/ping`, (req, res, ctx) => {
		return res(ctx.json({ message: 'pong' }));
	}),
	rest.post(`${BASE_URI}${ENDPOINTS_BASE.users}`, async (req, res, ctx) => {
		const json = await req.json();
		handler.createUser(json);
		const result = handler.userFindByEmail({
			email: json.email
		});
		if (isNil(result)) {
			ctx.status(500);
			return;
		}
		ctx.json({
			userId: result.user.id,
			name: result.user.name,
			email: result.user.email,
			created_at: result.user.created_at,
			updated_at: result.user.updated_at
		} satisfies CreateUserReturnType);
		return;
	})
];

export default handlers;
