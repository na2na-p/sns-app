import type { Iso8601 } from '@/utils/formatDate/iso8601';

export type Users = {
	id: string;
	name: string;
	email: string;
	password: string;
	created_at: Iso8601;
	updated_at: Iso8601;
}

export type Messages = {
	id: string;
	body: string;
	created_at: Iso8601;
	updated_at: Iso8601;
	user_id: Users['id'];
}

export type Favorites = {
	id: string;
	created_at: Iso8601;
	updated_at: Iso8601;
	user_id: Users['id'];
	message_id: Messages['id'];
}
